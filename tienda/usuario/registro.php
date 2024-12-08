<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');
    ?>
    <link rel="stylesheet" href="../util/CSS/usuario/estilo_registro.css">
</head>
<body>
    <?php

    

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $error_usuario = $error_pass = "";
        $tmp_usuario = $_POST["usuario"];
        $tmp_pass = $_POST["pass"];

        //validaciones

        //usuario
        if($tmp_usuario == "") {
            $error_usuario = "Debes Introducir un nombre de usuario";
        } else {
            $patron = "/^[a-zA-Z0-9]{3,15}$/";

            if(!preg_match($patron, $tmp_usuario)) {
                $error_usuario ="Debe tener entre 3 y 15 caracteres, y solo puede tener letras y números.";
            } else {
                $usuario = $tmp_usuario;
            }
        }

        //contraseña
        if($tmp_pass == "") {
            $error_pass = "Debe introducir una contraseña";
        } else {
            $patron = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\W_]{8,15}$/";

            if(!preg_match($patron, $tmp_pass)) {
                $error_pass = "Debe tener entre 8 y 15 caracteres, y tiene que tener letras en mayus y minus, algun numero y puede tener caracteres especiales";
            } else {
                $pass = $tmp_pass;
            }
        }

        // Verifica si el usuario ya existe
        if (empty($error_usuario) && empty($error_pass)) {
            $existe_usuario = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
            $existe_usuario_resultado = $_conexion->query($existe_usuario);

            if($existe_usuario_resultado->num_rows > 0) {
                
                echo "<h2>El usuario '$usuario' ya está registrado. Elige otro nombre de usuario.</h2>";
            } else {
                
                $pass_cifrada = password_hash($pass, PASSWORD_DEFAULT);
                $sql = "INSERT INTO usuarios (usuario, pass) VALUES ('$usuario', '$pass_cifrada')";
                $_conexion->query($sql);

                header("location: ./iniciar_sesion.php");
                exit;
            }

        }
    }
    ?>
    <div class="container">
        <h1>Registro</h1>
        
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Usuario</label>
                <input class="form-control" type="text" name="usuario">
                <?php if(isset($error_usuario)) echo "<span class='error'>$error_usuario</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Contraseña</label>
                <input class="form-control" type="password" name="pass">
                <?php if(isset($error_pass)) echo "<span class='error'>$error_pass</span>" ?>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Registrarse">
            </div>
        </form>
        <div class="mb-3">
            <h3>Si ya tienes cuenta, inicia sesión o mira los Productos de la tienda</h3>
            <a class="btn btn-secondary" href="iniciar_sesion.php">Iniciar sesión</a>
            <a class="btn btn-secondary" href="../index.php">Productos</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>