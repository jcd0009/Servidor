<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio examen</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../04_formularios/CSS/estilo.css">

    <!-- Errors -->
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);    
    ?>

</head>
<body>
    <div class="container">

        <!--- contenido PHP -->
        <?php
         if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_nombre = $_POST["nombre"];
            $tmp_apellidos = $_POST["apellidos"];
            $tmp_usuario = $_POST["usuario"];
            $tmp_dni = $_POST["dni"];
            $tmp_fecha = $_POST["fecha"];

            if(isset($_POST["numFavorito"])) {
                $tmp_numFavorito = $_POST["numFavorito"];
            } else {
                $tmp_numFavorito = '';
            }

            

            if(isset($_POST["aficiones"])) {
                $tmp_aficiones = $_POST["aficiones"];
            } else {
                $tmp_aficiones = "";
            }

            if(isset($_POST["colorFavorito"])) {
                $tmp_colorFavorito = $_POST["colorFavorito"];
            } else {
                $tmp_colorFavorito = '';
            }

            $tmp_descripcion = $_POST["descripcion"];
            

            //validacion nombre
            if($tmp_nombre == "") {
                $error_nombre = "Debes introducir un nombre";
            } else {
                $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}(\s[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30})?$/";
                if(!preg_match($patron, $tmp_nombre)) {
                    $error_nombre="Valores incorrectos";
                } else {
                    $nombre = ucwords($tmp_nombre);
                }
            }

            //validar apellidos
            if($tmp_apellidos == '') {
                $error_apellidos = "Debes introducir los apellidos";
            } else {
                $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}+ [a-zA-ZáéíóúÁÉÍÓÚñÑ]{1,30}+$/";
                if(!preg_match($patron, $tmp_apellidos)) {
                    $error_apellidos="Valores Incorrectos";
                } else {
                    $apellidos = ucwords($tmp_apellidos);
                }
            }

            // Validar usuario
            if ($tmp_usuario == '') {
                $error_usuario = "Debes introducir un usuario";
            } else {
                $patron = "/^[a-zA-ZñÑ0-9_.]{1,15}$/";
                if (!preg_match($patron, $tmp_usuario)) {
                    $error_usuario = "Valores incorrectos";
                } else {
                    $palabrasBaneadas = ["jose", "casado"];
                    $palabrasEncontradas = "";

                    foreach ($palabrasBaneadas as $palabraBaneada) {
                        if (str_contains($tmp_usuario, $palabraBaneada)) {
                            $palabrasEncontradas = "$palabraBaneada, " . $palabrasEncontradas;
                        }
                    }

                    if ($palabrasEncontradas != '') {
                        // Quita la última coma y espacio si es necesario
                        $palabrasEncontradas = rtrim($palabrasEncontradas, ', ');
                        $error_usuario = "No se permiten las palabras: $palabrasEncontradas";
                    } else {
                        $usuario = $tmp_usuario;
                    }
                }
            }

            

            //validar dni
            if($tmp_dni == '') {
                $error_dni = "Debe introducir un DNI";
            } else {
                $tmp_dni = strtoupper($tmp_dni);
                $patron = "/^[0-9]{8}[A-Z]$/";

                if(!preg_match($patron, $tmp_dni)) {
                    $error_dni = "Valores Incorrectos";
                } else{
                    $numerodni=(int)substr($tmp_dni,0,8);
                    $letradni = substr($tmp_dni,8,1);

                    $asignacionletradni = $numerodni % 23;

                    $letras_dni = "TRWAGMYFPDXBNJZSQVHLCKE";

                    $letracorrecta= substr($letras_dni, $asignacionletradni, 1);

                    if($letradni !== $letracorrecta) {
                        $error_dni = "La letra del DNI no es correcta";
                    }else {
                        $dni = $tmp_dni;
                    }
                }
            }

            //validacionFecha
            if($tmp_fecha == "") {
                $error_fecha = "Debes introducir una fecha";
            }else {
                $patron = "/^\d{4}-\d{2}-\d{2}$/";

                if(!preg_match($patron, $tmp_fecha)){
                    $error_fecha = "Formato invalido";
                } else {

                    list($year, $month, $day) = explode ('-', $tmp_fecha);

                    //fechas validas
                    $añoActual = date("Y");
                    $fechalimite = $añoActual + 5;

                    if($tmp_fecha < 1998){
                        $error_fecha = "Debe ser depues de 1998";
                    } elseif($tmp_fecha>$fechalimite) {
                        $error_fecha="No debe ser dentro de 6 años";
                    } else {
                        $fecha = $tmp_fecha;
                    }
                }
            }

            //numero favorito
            if(empty($tmp_numFavorito)) {
                $error_numFavorito = "Debes introducir un numero";
            } else {
                if(!is_numeric($tmp_numFavorito) || $tmp_numFavorito < 1 || $tmp_numFavorito > 10) {
                    $error_numFavorito = "Valores incorrectos";
                } else {
                    $numFavorito = $tmp_numFavorito;
                }
            }

            //validar Aficiones
            if(empty($tmp_aficiones)) {
                $error_aficiones = "Debes seleccionar una aficion";
            } else {
                $AficionesAll = ["gimnasio", "futbol", "tenis", "padel"];

                if(!in_array($tmp_aficiones, $AficionesAll)) {
                    $error_aficiones = "No es valida";
                } else {
                    $aficiones = $tmp_aficiones;
                }
            }

            //validar Color favorito
            if (empty($tmp_colorFavorito)) {
                $error_colorFavorito = "Debe seleccionar un color";
            } else {
                
                $colores = [ "rojo", "verde", "azul", "negro"];

                if(!in_array($tmp_colorFavorito, $colores)) {
                    $error_colorFavorito = "No es valido";
                } else {
                    $colorFavorito = $tmp_colorFavorito;
                }
            }

            //validar descripcion
            if($tmp_descripcion == '') {
                $errorDescripcion = "Debes añadir una descripcion";
            } else {
                if (strlen($tmp_descripcion) > 255) {
                    $errorDescripcion = "No puedes exceder los 255 caracteres";

            } else {
                $descripcion = $tmp_descripcion;
            }
            }
            

         }
         ?>

        <!-- Contenido HTML -->
        <h1>Ejercicio Examen</h1>

        <form class="col-12" action="" method="post">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre" placeholder="Introduce el nombre">
                <?php if(isset($error_nombre)) echo "<span class='error'>$error_nombre</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input class="form-control" type="text" name="apellidos" placeholder="Introduce los apellidos">
                <?php if(isset($error_apellidos)) echo "<span class='error'>$error_apellidos</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text"  name="usuario" placeholder="Introduce el usuario">
                <?php if(isset($error_usuario)) echo "<span class='error'>$error_usuario</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">DNI</label>
                <input class = "form-control" type="text" name="dni" placeholder="Introduce el DNI">
                <?php if(isset($error_dni)) echo "<span class='error'>$error_dni</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha</label>
                <input class="form-control" type="date" name="fecha">
                <?php if(isset($error_fecha)) echo "<span class='error'>$error_fecha</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Numero Favorito</label>
                <input class="form-control" type="number" name="numFavorito" placeholder="Dime tu numero favorito">
                <?php if(isset($error_numFavorito)) echo "<span class = 'error'>$error_numFavorito</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Aficiones</label>
                <select class="form-control" name="aficiones">
                    <option selected="true" disabled="disabled">Seleccione una opcion</option>
                    <option value="gimnasio">Gimnasio</option>
                    <option value="futbol">Futbol</option>
                    <option value="tenis">Tenis</option>
                    <option value="padel">Padel</option>
                </select>
                <?php if(isset($error_aficiones)) echo "<span class='error'>$error_aficiones</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Color favorito</label>
                    <br>
                    <label>
                        <input type="radio" name="colorFavorito" value="rojo"> Rojo
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="colorFavorito" value="verde"> Verde
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="colorFavorito" value="azul"> Azul
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="colorFavorito" value="negro">Negro
                    </label>
                    <br>
                    <?php if(isset($error_colorFavorito)) echo "<span class='error'>$error_colorFavorito</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" maxlength="255" rows="4" placeholder="Ingrese una descripción..." ></textarea>
                <?php if(isset($errorDescripcion)) echo "<span class='error'>$errorDescripcion</span>" ?>
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
            

        </form>
        <?php if (isset($nombre) && isset($apellidos) && isset($usuario) && isset($dni) && isset($fecha) && isset($numFavorito) && isset($aficiones) && isset($colorFavorito) && isset($descripcion)) { ?>
        <div class="container-info">
            <h1>Información de Usuario</h1>
            <div class="user-info">
                <p><strong>Nombre:</strong> <?php echo $nombre ?></p>
                <p><strong>Apellidos:</strong> <?php echo $apellidos ?></p>
                <p><strong>Usuario:</strong> <?php echo $usuario ?></p>
                <p><strong>DNI:</strong> <?php echo $dni ?></p>
                <p><strong>Fecha de nacimiento:</strong> <?php echo $fecha ?></p>
                <p><strong>Número favorito:</strong> <?php echo $numFavorito ?></p>
                <p><strong>Aficiones:</strong> <?php echo $aficiones ?></p>
                <p><strong>Color favorito:</strong> <?php echo $colorFavorito ?></p>
                <p><strong>Descripcion:</strong> <?php echo $descripcion ?></p>
            </div>
        </div>
    <?php } ?>

    </div>
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>
</html>