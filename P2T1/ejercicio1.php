<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libros</title>

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../P2T1/estilo.css">

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
            $tmp_titulo = $_POST["titulo"];

            if(isset($_POST["paginas"])) {
                $tmp_paginas = $_POST["paginas"];
            } else {
                $tmp_paginas = '';
            }

            if(isset($_POST["genero"])) {
                $tmp_genero = $_POST["genero"];
            } else {
                $tmp_genero = '';
            }

            if(isset($_POST["secuela"])) {
                $tmp_secuela = $_POST["secuela"];
            } else {
                $tmp_secuela = '';
            }

            

            $tmp_fecha = $_POST["fecha"];

            $tmp_sinopsis = $_POST["sinopsis"];


            // validar titulo
            if ($tmp_titulo == '') {
                $error_titulo = "Debes introducir un titulo";
                } else {
                    $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9.,; ]{1,40}$/";
                    if (!preg_match($patron, $tmp_titulo)) {
                    $error_titulo = "Debe contener entre 1 y 40 caracteres";
                    } else {
                        $buscar = ".,; ";
                        $primeraLetra=substr($tmp_titulo,0,1);
                        
                        

                        if(is_numeric($primeraLetra) || str_contains($buscar, $primeraLetra)) {
                            $error_titulo = "No puede empezar por numero o simbolos";
                        } else {
                            $titulo = $tmp_titulo;
                        }
                    
                    }
                }

            //numero paginas
            if(empty($tmp_paginas)) {
                $error_paginas = "Debes introducir un numero";
            } else {
                if(!is_numeric($tmp_paginas) || $tmp_paginas < 10 || $tmp_paginas > 9999) {
                    $error_paginas = "Valores incorrectos";
                } else {
                    $paginas = $tmp_paginas;
                }
            }

            //validar Genero
            if (empty($tmp_genero)) {
                $error_genero = "Debe seleccionar un Genero";
            } else {
                
                $generos = [ "fantasia", "ciencia ficcion", "romance", "drama"];

                if(!in_array($tmp_genero, $generos)) {
                    $error_genero = "No es valido";
                } else {
                    $genero = $tmp_genero;
                }
            }

            //validar Secuela

            if(empty($tmp_secuela)) {
                $error_secuela = "Debe seleccionar una opcion";
            } else {
                $opciones = ["si", "no"];
                if(!in_array($tmp_secuela, $opciones)) {
                    $error_secuela = "La opcion no es valida";
                } else {
                    $secuela = $tmp_secuela;
                }
            }

             //validar Fecha
             if ($tmp_fecha == '') {
                $error_fecha = "Debe introducir una fecha";
            } else {
                $patron = "/^\d{4}-\d{2}-\d{2}$/";

                if(!preg_match($patron, $tmp_fecha)) {
                    $error_fecha = "Formato incorrecto";
                } else {
                    list($year, $month, $day) = explode ('-', $tmp_fecha);

                    //fechas validas
                    $añoActual = date("Y");
                    $fechalimite = $añoActual + 5;

                    if($tmp_fecha < 1800){
                        $error_fecha = "Debe ser despues de 1799";
                    } elseif($tmp_fecha>$fechalimite) {
                        $error_fecha="No debe ser dentro de 3 años";
                    } else {
                        $fecha = $tmp_fecha;
                    }
                }

            }


            //validar descripcion
            if($tmp_sinopsis == '') {
                $error_sinopsis = "Debes añadir una descripcion";
            } else {
                if (strlen($tmp_sinopsis) > 200) {
                    $error_sinopsis = "No puedes exceder los 200 caracteres";

                } else {
                    $sinopsis = $tmp_sinopsis;
                }
            }
        }
        ?>

        <!-- Contenido HTML -->
        <h1>Ejercicio Examen</h1>

        <form class="col-12" action="" method="post">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input class="form-control" type="text" name="titulo" placeholder="Ingrese el título" >
                <?php if(isset($error_titulo)) echo "<span class='error'>$error_titulo</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Paginas</label>
                <input class="form-control" type="number" name="paginas" placeholder="Introduce un número de paginas">
                <?php if(isset($error_paginas)) echo "<span class='error'> $error_paginas</span>"?>
            </div>

            <div class="mb-3">
                <label class="form-label">Genero</label>
                    <br>
                    <label>
                        <input type="radio" name="genero" value="fantasia"> Fantasia
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="genero" value="ciencia ficcion"> Ciencia Ficcion
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="genero" value="romance"> Romance
                    </label>
                    <br>
                    <label>
                        <input type="radio" name="genero" value="drama">Drama
                    </label>
                    <br>
                    <?php if(isset($error_genero)) echo "<span class='error'>$error_genero</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Tiene secuela?</label>
                <select class="form-control" name="secuela">
                <option selected="true" disabled="disabled">RESPUESTA</option>
                    <option value="si">SI</option>
                    <option value="no">NO</option>
                </select>
                <?php if(isset($error_secuela)) echo "<span class='error'> $error_secuela</span>"?>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Publicacion</label>
                <input class="form-control" type="date" name="fecha">
                <?php if(isset($error_fecha)) echo "<span class='error'> $error_fecha</span>"?>
            </div>

            <div class="mb-3">
                <label class="form-label">Sinopsis</label>
                <textarea class="form-control" name="sinopsis" maxlength="200" rows="4" placeholder="Ingrese una sinopsis..." ></textarea>
                <?php if(isset($error_sinopsis)) echo "<span class='error'> $error_sinopsis</span>"?>
                
            </div>

            <button type="submit" class="btn btn-primary">Enviar</button>
        </form>
            <?php if (isset($titulo) && isset($paginas) && isset($genero) && isset($secuela) && isset($fecha) && isset($sinopsis)) { ?>
                <div class="container-info">
            <h1>Información de Usuario</h1>
            <div class="user-info">
                <p><strong>Titulo:</strong> <?php echo $titulo ?></p>
                <p><strong>Paginas:</strong> <?php echo $paginas ?></p>
                <p><strong>Género:</strong> <?php echo $genero ?></p>
                <p><strong>Fecha de Publicacion:</strong> <?php echo $fecha ?></p>
                <p><strong>¿Tiene secuela?:</strong> <?php echo $secuela ?></p>
                <p><strong>Sinopsis:</strong> <?php echo $sinopsis ?></p>                
            </div>
        </div>
    <?php } ?>

    </div>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</body>
</html>