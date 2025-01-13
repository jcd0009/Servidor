<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');
        
    ?>
    <link rel="stylesheet" href="../util/CSS/usuario/estilo_iniciar_sesion.css">
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $error_usuario = $error_pass = "";      
        $tmp_usuario = $_POST["usuario"];
        $tmp_pass = $_POST["pass"];

        if($tmp_usuario == "") {
            $error_usuario = "Debe introducir un nombre de usuario";
        } else {
            $usuario = $tmp_usuario;
        }

        if($tmp_pass == "") {
            $error_pass = "Debe introducir una contraseña";
        } else {
            $pass = $tmp_pass;
        }

        if (empty($error_usuario) && empty($error_pass)) {
        $sql = "SELECT * FROM usuarios WHERE usuario = '$usuario'";
        $resultado = $_conexion -> query($sql);
        //var_dump($resultado);

        if($resultado -> num_rows == 0) {
            echo "<h2>El usuario $usuario no existe</h2>";
        } else {
            $datos_usuario = $resultado -> fetch_assoc();
            /**
             * Podemos acceder a:
             * 
             * $datos_usuario["usuario"]
             * $datos_usuario["contrasena"]
             */
            $acceso_concedido = password_verify($pass,$datos_usuario["pass"]);
            //var_dump($acceso_concedido);
            if($acceso_concedido) {
                //  todo guay
                session_start();
                $_SESSION["usuario"] = $usuario;
                //$_COOKIE["loquesea"] = "loquesea";
                header("location: ../index.php");
                exit;
            } else {
                echo "<h2>La contraseña es incorrecta</h2>";
            }
        }
    }
    }
    ?>
    <div class="container">
        <h1>Iniciar sesión</h1>
        
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
                <input class="btn btn-primary" type="submit" value="Iniciar sesión">
            </div>
        </form>
        <div class="mb-3">
            <h3>Si aún no tienes cuenta, regístrate o mira los productos de la tienda</h3>
            <a class="btn btn-secondary" href="registro.php">Registrarse</a>
            <a class="btn btn-secondary" href="../index.php">Productos</a>
            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>