<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
    session_start();
    
    if (!isset($_SESSION['usuario'])) {
        header("Location: ../usuario/iniciar_sesion.php");
        exit;
    }

   
    require('../util/conexion.php');
    ?>

<link rel="stylesheet" href="../util/CSS/usuario/estilo_cambiar_credenciales.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>
    
    <a href="../usuario/iniciar_sesion.php" class="btn btn-secondary btn-volver">
        <i class="fas fa-arrow-left"></i>
    </a>
    <?php 

    
    // Variables de error
    $error_actual = $error_nueva = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_SESSION['usuario']; // El usuario ya está en la sesión
        $pass_actual = $_POST['pass_actual'];
        $pass_nueva = $_POST['pass_nueva'];

        
        if (empty($pass_actual)) {
            $error_actual = "Debes introducir tu contraseña.";
        }

        
        if (empty($pass_nueva)) {
            $error_nueva = "Debes introducir una contraseña nueva.";
        } else {
            $patron = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d\W_]{8,15}$/";
            if (!preg_match($patron, $pass_nueva)) {
                $error_nueva = "La nueva contraseña debe tener entre 8 y 15 caracteres, y tiene que tener letras en mayus y minus, algun numero y puede tener caracteres especiales.";
            }
        }

        
        if (empty($error_actual) && empty($error_nueva)) {
            // Verificar la contraseña actual en la base de datos
            $sql = "SELECT pass FROM usuarios WHERE usuario = '$usuario'";
            $resultado = $_conexion->query($sql);

            if ($resultado->num_rows > 0) {
                $datos_usuario = $resultado->fetch_assoc();
                if (password_verify($pass_actual, $datos_usuario['pass'])) {
                    // Si la ontraseña actual es correcta ciframos la nueva contraseña
                    $pass_nueva_cifrada = password_hash($pass_nueva, PASSWORD_DEFAULT);
                    $sql_update = "UPDATE usuarios SET pass = '$pass_nueva_cifrada' WHERE usuario = '$usuario'";

                    if ($_conexion->query($sql_update) === TRUE) {
                        echo "<h2>Contraseña cambiada con éxito.</h2>";
                    } else {
                        echo "<h2>Hubo un error al cambiar la contraseña. Intenta nuevamente.</h2>";
                    }
                } else {
                    $error_actual = "La contraseña actual es incorrecta.";
                }
            } else {
                $error_actual = "Usuario no encontrado.";
            }
        }
    }

    
    ?>

    <div class="container">
        <h1>Cambiar Contraseña</h1>
        <form method="post" action="">
            <div class="mb-3">
                <label for="pass_actual" class="form-label">Contraseña Actual</label>
                <input type="password" class="form-control" id="pass_actual" name="pass_actual">
                <?php if (!empty($error_actual)) echo "<span class='error'>$error_actual</span>"; ?>
            </div>
            <div class="mb-3">
                <label for="pass_nueva" class="form-label">Nueva Contraseña</label>
                <input type="password" class="form-control" id="pass_nueva" name="pass_nueva">
                <?php if (!empty($error_nueva)) echo "<span class='error'>$error_nueva</span>"; ?>
            </div>
            <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
