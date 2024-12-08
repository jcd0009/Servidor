<?php
    session_start();

    // Verificar si el usuario ha iniciado sesión
    if (!isset($_SESSION['usuario'])) {
        
        header("Location: ../usuario/iniciar_sesion.php");
        exit();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);

        require('../util/conexion.php');

        $categoria_actual = $_GET["categoria"];


        // Consultar la categoría actual en la base de datos
        $sql = "SELECT * FROM categorias WHERE categoria = '$categoria_actual'";
        $resultado = $_conexion -> query($sql);

        while($fila = $resultado -> fetch_assoc()) {
                $categoria = $fila["categoria"];
                $descripcion = $fila["descripcion"];
        }

        
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $categoria = $_POST["categoria"];
            $descripcion = $_POST["descripcion"];

           
            $sql = "UPDATE categorias SET
                categoria = '$categoria',
                descripcion = '$descripcion'
                WHERE categoria = '$categoria_actual'";
            $_conexion -> query($sql);

            if ($_conexion->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Categoría actualizada correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error al actualizar categoría: " . $_conexion->error . "</div>";
            }
        }

        
        $sql = "SELECT * FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        $categorias = [];
        while($fila = $resultado -> fetch_assoc()) {
            array_push($categorias, $fila["categoria"]);
        }
    ?>
    <link rel="stylesheet" href="../util/CSS/categorias/estilo_editar_categoria.css">
</head>
<body>
    <div class="container">
        <h1>Editar Categoría</h1>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <input class="form-control" type="text" name="categoria" value="<?php echo $categoria ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <input class="form-control" type="text" name="descripcion" value="<?php echo $descripcion ?>">
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Confirmar">
                <a class="btn btn-secondary" href="./index.php">Volver</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
