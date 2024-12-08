<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- index si se ha logeado -->
    <link rel="stylesheet" href="../tienda/util/CSS/Index/estilo_index.css">
    
    <!-- index si no ha iniciado sesion -->
    <?php if (!isset($_SESSION["usuario"])): ?>
        <link rel="stylesheet" href="../tienda/util/CSS/Index/estilo_index_sin_registro.css">
    <?php endif; ?>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<?php if(isset($_SESSION["usuario"])): ?>
    <!-- Si el usuario ha iniciado sesión -->
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

<?php else: ?>
    <!-- Si el usuario no ha iniciado sesión -->
    

    <div class="container">
    <h1>Productos</h1>
    <a href="usuario/iniciar_sesion.php" class="btn btn-primary">Iniciar sesión</a>

    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        require('./util/conexion.php');

        // productos
        $sql = "SELECT * FROM productos";
        $resultado = $_conexion->query($sql);
    ?>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Descripción</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Mostrar los productos en la tabla
                while($fila = $resultado->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $fila["nombre"] . "</td>";
                    echo "<td>" . $fila["precio"] . "</td>";
                    echo "<td>" . $fila["categoria"] . "</td>";
                    echo "<td>" . $fila["stock"] . "</td>";
                    echo "<td>" . $fila["descripcion"] . "</td>";
                    echo "<td><img width='100' height='150' src='../tienda/imagenes/" . $fila["imagen"] . "' class='img-fluid'></td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>

</div>

<?php endif; ?>

<!-- Pie de página -->
<footer>
    <p>&copy; 2024 Tienda de Jose. Todos los derechos reservados.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
