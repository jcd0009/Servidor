<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../tienda/util/CSS/Index/estilo_index.css">
</head>
<body>
    <?php
    session_start();
    if(!isset($_SESSION["usuario"])) {
        header("location: usuario/iniciar_sesion.php");
        exit;
    }
    ?>

    <!-- Encabezado -->
    <div class="container">
        <h1>Bienvenid@ al Panel de Administración, <?php echo $_SESSION["usuario"]; ?></h1>
        <p>Desde aquí puedes gestionar las categorías y productos de la tienda.</p>
    </div>

    <!-- Contenedor de botones -->
    <div class="botones-container">
        <a href="categorias/index.php" class="btn btn-primary">Categorías</a>
        <a href="productos/index.php" class="btn btn-primary">Productos</a>
        <a href="usuario/cambiar_credenciales.php" class="btn btn-warning">Modificar Contraseña</a>
        <a href="usuario/cerrar_sesion.php" class="btn btn-danger">Cerrar sesión</a>
    </div>

    <!-- Pie de página -->
    <footer>
        <p>&copy; 2024 Tienda de Jose. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
