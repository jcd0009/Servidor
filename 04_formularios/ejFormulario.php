<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio Validacion de formularios</title>

    <!-- BootStrap para mejora visual -->
    <!-- importa la hoja de estilos CSS de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- visualización de errores  -->
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>

    <style>
        .error {
            color: red;
        }

        .container {
            padding: 20px;
            /* Ajusta este valor según sea necesario */
            border: 1px solid #ccc;
            /* Ejemplo de borde, puedes cambiar o quitar */
            border-radius: 5px;
            /* Bordes redondeados opcional */
            margin-top: 20px;
            /* Margen superior opcional */
            background-color: #f9f9f9;
            /* Color de fondo opcional */
        }

        /* Espaciado adicional para los campos del formulario */
        .form-control {
            margin-bottom: 15px;
            /* Espaciado entre campos */
        }
    </style>

</head>

<body>
    <div class="container">
        <h2>Validacion de formularios</h2>

        <!-- aqui va el contenido php -->

        <!-- se ejecuta cuando el usuario envía el formulario  -->
        <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $tmp_dni = $_POST["dni"];
                $tmp_nombre = $_POST["nombre"];
                $tmp_apellidos = $_POST["apellidos"];
                $tmp_fecha_nacimiento = $_POST["fechaNacimiento"];
                $tmp_correo = $_POST["correo"];

                // Controlar los errores de DNI
                if ($tmp_dni == "") {
                    $error_dni = "El DNI es obligatorio";
                } else {
                    // Convierte el DNI a mayúsculas
                    $tmp_dni = strtoupper($tmp_dni);

                    // Utilizamos caracteres regulares para controlar el DNI
                    $patron = "/^[0-9]{8}[A-Z]$/";

                    if (!preg_match($patron, $tmp_dni)) {
                        $error_dni = "El DNI debe contener 8 números y 1 letra";
                    } else {
                        // Substr se utiliza para obtener una parte de una cadena
                        $numero_dni = (int)substr($tmp_dni, 0, 8);
                        $letra_dni = substr($tmp_dni, 8, 1);

                        // Para saber si la letra está bien
                        $resto_dni = $numero_dni % 23;
                        $letras_dni = "TRWAGMYFPDXBNJZSQVHLCKE";
                        $letra_correcta = substr($letras_dni, $resto_dni, 1);

                        // Comprobar si la letra está bien
                        if ($letra_dni != $letra_correcta) {
                            $error_dni = "La letra del DNI es incorrecta";
                        } else {
                            $dni = $tmp_dni;
                        }
                    }
                }

                // Controlar los errores de nombre
                if ($tmp_nombre == '') {
                    $error_nombre = "El nombre es obligatorio.";
                } else {
                    if (strlen($tmp_nombre) < 2 || strlen($tmp_nombre) > 30) {
                        $error_nombre = "El nombre debe tener entre 2 y 30 caracteres";
                    } else {
                        $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑüÜ]+$/";

                        if (!preg_match($patron, $tmp_nombre)) {
                            $error_nombre = "El nombre solo puede contener letras y espacios en blanco";
                        } else {
                            $nombre = ucwords($tmp_nombre);
                        }
                    }
                }

                // Comprobar apellidos
                if ($tmp_apellidos == '') {
                    $error_apellidos = "Los apellidos son obligatorios";
                } else {
                    $patron = "/^[a-zA-Z áéíóúÁÉÍÓÚñÑüÜ]+ [a-zA-Z áéíóúÁÉÍÓÚñÑüÜ]+$/";
                    if (!preg_match($patron, $tmp_apellidos)) {
                        $error_apellidos = "Debe contener los dos apellidos con un espacio";
                    } else {
                        $apellidos = ucwords($tmp_apellidos);
                    }
                }

                // Comprobar fecha de nacimiento
                // (si es menor de 18 se muestra y no debe tener +120 años)
                if ($tmp_fecha_nacimiento == "") {
                    $error_fecha_nacimiento = "La fecha de nacimiento es obligatoria";
                } else {
                    $patron = "/^[0-9]{4}\-[0-9]{2}\-[0-9]{2}$/";
                    if (!preg_match($patron, $tmp_fecha_nacimiento)) {
                        $error_fecha_nacimiento = "Formato de fecha incorrecto";
                    } else {
                        // Obtener la fecha actual en formato año-mes-día
                        $currentDate = date("Y-m-d");
                        list($currentYear, $currentMonth, $currentDay) = explode('-', $currentDate);
                        list($year, $month, $day) = explode('-', $tmp_fecha_nacimiento);

                        // Verificar si la persona es mayor de 120 años
                        if ($currentYear - $year > 120) {
                            $error_fecha_nacimiento = "La edad no puede ser mayor de 120 años";
                        } elseif ($currentYear - $year < 18 || 
                                ($currentYear - $year == 18 && ($currentMonth < $month || 
                                ($currentMonth == $month && $currentDay < $day)))) {
                            $error_fecha_nacimiento = "No puedes ser menor de edad";
                        } else {
                            $fechaNacimiento = $tmp_fecha_nacimiento;
                        }
                    }
                }

                //comprobar correo electronico
                if ($tmp_correo == "") {
                    $error_correo = "El correo es obligatorio";
                } else {
                    $patron = "/^[a-zA-Z0-9_\-.+]+@([a-zA-Z0-9-]+.)+[a-zA-Z]+$/";
                    if (!preg_match($patron, $tmp_correo)) {
                        $error_correo = "El correo debe ser valido";
                   
                    } else {

                        //str_contains
                        $palabrasBaneadas = ["tonto", "lechuguino", "bebo"];

                        $palabrasEncontradas = "";
                        foreach($palabrasBaneadas as $palabraBaneada) {
                            if(str_contains($tmp_correo, $palabraBaneada)) {
                                $palabrasEncontradas = "$palabraBaneada" . $palabrasEncontradas;  
                            }

                            if ($palabrasEncontradas != '') {
                                $error_correo = "No se permite las palabra: $palabrasEncontradas";
                            } else {
                                $correo = $tmp_correo;
                            }
                        }

                        
                    }
                }
            }
        ?>


            <!-- El formulario utiliza clases de Bootstrap como form-label y form-control para mejorar el diseño de los campos. Cada campo tiene un área para mostrar errores que se genera solo si existe alguna variable de error -->
             
        <!-- formulario HTML -->
        <!-- class col-4 es para hacer 4 columnas -->
        <form class="col-4" action="" method="POST">
            <!-- mb-3 agrega un margen inferior moderado al elemento con bootstrap -->
            <div class="mb-3">
                <!-- form-label  y form-control son una clase de Bootstrap que proporciona estilos predeterminados para etiquetas de formulario. -->
                <label class="form-label">DNI</label>
                <input class="form-control" type="text" name="dni">

                <!-- mostrar el error -->
                <?php if (isset($error_dni)) echo "<span class='error'>$error_dni</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre">

                <!-- mostrar el error -->
                <?php if (isset($error_nombre)) echo "<span class='error'>$error_nombre</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Apellidos</label>
                <input class="form-control" type="text" name="apellidos">

                <!-- mostrar el error -->
                <?php if (isset($error_apellidos)) echo "<span class='error'>$error_apellidos</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Nacimiento</label>
                <input class="form-control" type="date" name="fechaNacimiento">

                <!-- mostrar el error -->
                <?php if (isset($error_fecha_nacimiento)) echo "<span class='error'>$error_fecha_nacimiento</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Correo Electronico</label>
                <input class="form-control" type="text" name="correo">

                <!-- Mostrar el Error -->
                 <?php if(isset($error_correo)) echo "<span class='error'>$error_correo</span>" ?>
            </div>

            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Enviar">
            </div>

        </form>

        <!-- Para mostrarlo en el html -->
        <?php
        if(isset($dni) && isset($nombre) && isset($apellidos) && isset($fechaNacimiento) && (isset($correo))) { ?>
            <h3>DNI: <?php echo $dni ?></h3>
            <h3>Nombre: <?php echo $nombre ?></h3>
            <h3>Apellidos: <?php echo $apellidos ?></h3>
            <h3>Fecha de Nacimiento: <?php echo $fechaNacimiento ?></h3>
            <h3>Correo Electronico: <?php echo $correo ?></h3>
            
        <?php } ?>
    </div>

    <!-- hace que todos los componentes interactivos de Bootstrap funcionen en tu página -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>