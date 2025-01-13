<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipos de Futbol</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS externo -->
    <link rel="stylesheet" href="../04_formularios/CSS/estilo.css"> 

     <!-- Para errores por pantalla -->
     <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);    
    ?>
</head>
<body>
    <div class="container">

        <!-- Contenido PHP -->
         <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_nombre = $_POST["nombre"];
            $tmp_inicial = $_POST["inicial"];

            //poner en caso de que sea un select
            if(isset($_POST["liga"])) {
                $tmp_liga = $_POST["liga"];
            } else {
                $tmp_liga = '';
            }
            
            $tmp_ciudad = $_POST["ciudad"];

            //poner en el caso que sea un select
            if(isset($_POST["tituloLiga"])) {
                $tmp_tituloLiga = $_POST["tituloLiga"];
            } else {
                $tmp_tituloLiga = '';
            }

            $tmp_fechaFundacion = $_POST["fechaFundacion"];
            
            //poner el caso de que sea un campo numerico
            if(isset($_POST["numJugadores"])) {
                $tmp_numJugadores= $_POST["numJugadores"];
            } else {
                $tmp_numJugadores='';
            }
            

            // Validar nombre
            if($tmp_nombre == '') {
                $error_nombre = "Debes introducir el nombre del equipo";
            } else {
                $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ. ]{3,20}$/";
                if(!preg_match($patron, $tmp_nombre)) {
                    $error_nombre = "Debe contener entre 3 y 20 caracteres";
                } else {
                    $nombre = $tmp_nombre;
                }
            }

            //validar inicial
            if($tmp_inicial == '') {
                $error_inicial = "Debe introducir las iniciales del Equipo";
            } else {
                $patron = "/^[A-Z]{3}$/";
                if(!preg_match($patron, $tmp_inicial)) {
                    $error_inicial = "Debe tener tres letras mayusculas";
                } else {
                    $inicial = $tmp_inicial;
                }
            }

            //validar Liga
            if(empty($tmp_liga)) {
                $error_liga = "Debe seleccionar una liga";
            } else {
                $ligasValidas = ["LIGA EA Sports", "LIGA Hypermotion", "LIGA Primera RFEF"];
                if(!in_array($tmp_liga, $ligasValidas)) {
                    $error_liga = "La liga no es valida";
                } else {
                    $liga = $tmp_liga;
                }
            }

            //validar Ciudad
            if($tmp_ciudad == "") {
                $error_ciudad = "Debe introducir una ciudad";
            } else {
                $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑçÇ ]+$/";
                if(!preg_match($patron, $tmp_ciudad)) {
                    $error_ciudad = "No puede poner numeros";
                } else {
                    $ciudad = $tmp_ciudad;
                }
            }

            //validar tituloLiga
            if (empty($tmp_tituloLiga)) {
                $error_tituloLiga = "Debe seleccionar una liga";
            } else {
                $titulo = ["SI", "NO"];

                if(!in_array($tmp_tituloLiga, $titulo)) {
                    $error_tituloLiga = "La respuesta no es valida";
                } else {
                    $tituloLiga = $tmp_tituloLiga;
                }
            }

            //validar Fecha
            if ($tmp_fechaFundacion == '') {
                $error_fechaFundacion = "Debe introducir una fecha";
            } else {
                $patron = "/^\d{4}-\d{2}-\d{2}$/";

                if(!preg_match($patron, $tmp_fechaFundacion)) {
                    $error_fechaFundacion = "Formato incorrecto";
                } else {
                    list($day, $month, $year) = explode('-', $tmp_fechaFundacion);

                    // Definir las fechas límite
                    $fechaLimiteInferior = "1889-12-18";
                    $fechaLimiteSuperior = date("Y-m-d");

                    if($tmp_fechaFundacion<$fechaLimiteInferior) {
                        $error_fechaFundacion = "Debe ser despues del 12 de diciembre de 1889";

                    }elseif ($tmp_fechaFundacion > $fechaLimiteSuperior) {
                        $error_fechaFundacion = "No puede ser posterior a hoy";
                    
                    } else {
                        $fechaFundacion = $tmp_fechaFundacion;

                    }
                }

            }

            // Validar Jugadores
            if(empty($tmp_numJugadores)) {
                $error_numJugadores = "Debes introducir un número de jugadores";
            } else {
                if (!is_numeric($tmp_numJugadores) || $tmp_numJugadores < 19 || $tmp_numJugadores > 32) {
                    $error_numJugadores = "Debes poner un número de jugadores entre 19 y 32";
                } else {
                    $numJugadores = $tmp_numJugadores;
                }
            }


        }
        
        ?>
        <!-- Contenido html -->
         <h1>Equipos de Futbol</h1>
         <form class ="col-12" action="" method="post">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre" placeholder="Nombre del equipo">
                <?php if(isset($error_nombre)) echo "<span class='error'>$error_nombre</span>" 
                ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Inicial</label>
                <input class="form-control" type="text" name="inicial" placeholder="Inicial con tres letras">
                <?php if(isset($error_inicial)) echo "<span class='error'>$error_inicial</span>" 
                ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Liga</label>
                <select class="form-control" name="liga">
                <option selected="true" disabled="disabled">Seleccione la LIGA</option>
                    <option value="LIGA EA Sports">LIGA EA Sports</option>
                    <option value="LIGA Hypermotion">LIGA Hypermotion</option>
                    <option value="LIGA Primera RFEF">LIGA Primera RFEF</option>
                </select>
                <?php if (isset($error_liga)) echo "<span class='error'>$error_liga</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Ciudad</label>
                <input class="form-control" type="text" name="ciudad" placeholder="Nombre de la ciudad">
                <?php if(isset($error_ciudad)) echo "<span class='error'>$error_ciudad</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Titulo de LIGA</label>
                <select class="form-control" name="tituloLiga">
                <option selected="true" disabled="disabled">RESPUESTA</option>
                    <option value="SI">SI</option>
                    <option value="NO">NO</option>
                </select>
                <?php if(isset($error_tituloLiga)) echo "<span class='error'>$error_tituloLiga</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Fundacion</label>
                <input class="form-control" type="date" name="fechaFundacion">
                <?php if(isset($error_fechaFundacion)) echo "<span class = 'error'> $error_fechaFundacion</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Numero de jugadores</label>
                <input class="form-control" type="number" name="numJugadores" placeholder="Introduce un número">
                <?php if(isset($error_numJugadores)) echo "<span class='error'> $error_numJugadores</span>"?>
            </div>
            
            <button type="submit" class="btn btn-primary">Enviar</button>

         </form>
         <!-- para mostrar las variables por pantalla -->
        <?php
        if (isset($nombre) && (isset($inicial)) && (isset($liga)) && (isset($ciudad)) && isset($tituloLiga) && isset($numJugadores) && isset($fechaFundacion)) { ?>
            <h1><?php echo $nombre ?> </h1>
            
            <h2 style="display: inline;">Iniciales: </h2>
            <h6 style="display: inline;"><?php echo $inicial ?></h6>
            <br>
            <h2 style="display: inline;">Liga: </h2>
            <h6 style="display: inline;"> <?php echo $liga ?></h6>
            <br>
            <h2 style="display: inline;">Ciudad: </h2>
            <h6 style="display: inline;"> <?php echo $ciudad ?></h6>
            <br>
            <h2 style="display: inline;">Titulo de Liga: </h2>
            <h6 style="display: inline;"> <?php echo $tituloLiga?></h6>
            <br>
            <h2 style="display: inline;">Numero de Jugadores: </h2>
            <h6 style="display: inline;"> <?php echo $numJugadores?></h6>
            <br>
            <h2 style="display: inline;">Fecha de Fundacion: </h2>
            <h6 style="display: inline;"> <?php echo $fechaFundacion?></h6>
        <?php } ?>

    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>