<?php
    session_start(); // Iniciar la sesión

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario'])) {
       
        header("Location: ../usuario/iniciar_sesion.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        require('../util/conexion.php');

        $id_producto = $_GET["id_producto"];
        $sql = "SELECT * FROM productos WHERE id_producto = '$id_producto'";
        $resultado = $_conexion->query($sql);
        
        while($fila = $resultado->fetch_assoc()) {
            $nombre = $fila["nombre"];
            $precio = $fila["precio"];
            $categoria = $fila["categoria"];
            $stock = $fila["stock"];
            $imagen = $fila["imagen"];
            $descripcion = $fila["descripcion"];
            $imagen = $fila["imagen"];
        }

        $sql_categorias = "SELECT DISTINCT categoria FROM productos ORDER BY categoria";
        $resultado_categorias = $_conexion->query($sql_categorias);
        $categorias = [];

        while ($fila = $resultado_categorias->fetch_assoc()) {
            $categorias[] = $fila["categoria"];
        }

        // Procesar el formulario de actualización
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST["nombre"];
            $precio = $_POST["precio"];
            $categoria = $_POST["categoria"];
            $stock = $_POST["stock"];
            $descripcion = $_POST["descripcion"];

            // Actualizar el producto
            $sql = "UPDATE productos SET
                nombre = '$nombre',
                precio = '$precio',
                categoria = '$categoria',
                stock = '$stock',
                descripcion = '$descripcion'
                WHERE id_producto = '$id_producto'
                ";

            if ($_conexion->query($sql)) {
                echo "Producto actualizado correctamente.";
            } else {
                echo "Error al actualizar el producto: " . $_conexion->error;
            }
        }
    ?>
    <link rel="stylesheet" href="../util/CSS/productos/estilo_editar_producto.css">
</head>
<body>
    <div class="container">
        <h1>Editar Producto</h1>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre" value="<?php echo $nombre ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="number" name="precio" value="<?php echo $precio ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Categoría</label>
                <select class="form-select" name="categoria">
                    <option value="<?php echo $categoria ?>" selected hidden><?php echo $categoria ?></option>
                    <?php
                    foreach($categorias as $cat) { ?>
                        <option value="<?php echo $cat ?>">
                            <?php echo $cat ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input class="form-control" type="text" name="stock" value="<?php echo $stock ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="4"><?php echo $descripcion ?></textarea>
            </div>
            <div class="mb-3">
                <input type="hidden" name="id_producto" value="<?php echo $id_producto ?>">
                <input class="btn btn-primary" type="submit" value="Confirmar">
                <a class="btn btn-secondary" href="index.php">Volver</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
