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
    <title>Nueva Categoria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');
    ?>

    <link rel="stylesheet" href="../util/CSS/categorias/estilo_nueva_categoria.css">
</head>
<body>
    <div class="container">
        <h1>Nueva Categoria</h1>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $tmp_categoria = $_POST["categoria"];
                $tmp_descripcion = $_POST["descripcion"];

                if($tmp_categoria == "") {
                    $error_categoria = "Debes introducir un titulo";
                } else {
                    if(strlen($tmp_categoria) <2 || strlen($tmp_categoria) >30 ){
                        $error_categoria = "El nombre de la categoria no puede tener mas de 30 caracteres";
                    } else {
                        $patron ="/^[a-zA-Zaéíóú´AÉÍÓÚñÑ ]{2,30}$/";

                    if(!preg_match($patron, $tmp_categoria)){
                        $error_categoria = "El nombre solo puede contener letras y espacios";
                    } else {
                        $categoria = $tmp_categoria;
                    }
                    
                    }
                    
                }

                if($tmp_descripcion == "") {
                    $error_descripcion = "Debes introducir una descripcion";
                } else {
                    if(strlen($tmp_descripcion) <2 || strlen($tmp_descripcion) > 255){
                        $error_descripcion = "El nombre de la categoria no puede tener mas de 255 caracteres";
                    } else {
                        $patron ="/^[a-zA-Zaéíóú´AÉÍÓÚñÑ., ]{2,255}$/";

                    if(!preg_match($patron, $tmp_descripcion)){
                        $error_descripcion = "El nombre solo puede contener letras y espacios";
                    } else {
                        $descripcion = $tmp_descripcion;
                    }
                    
                    }
                    
                }   

                // Verificar si no hay errores en la categoría y descripción
                if (empty($error_categoria) && empty($error_descripcion)) {

                    // Verificar si la categoría ya existe
                    $sql = "SELECT * FROM categorias WHERE categoria = '$categoria'";
                    $resultado = $_conexion->query($sql);

                    if ($resultado->num_rows > 0) {
                        // Si ya existe una categoría con el mismo nombre
                        $error_categoria = "Ya existe una categoría con ese nombre.";
                    } else {
                        // Insertar nueva categoría si no hay duplicados
                        /* $sql = "INSERT INTO categorias (categoria, descripcion) VALUES ('$categoria', '$descripcion')"; */

                        //1. Preparacion
                        $sql = $_conexion ->prepare("INSERT INTO categorias (categoria, descripcion) VALUES (?,?)");

                        //2. Enlazado
                        $sql -> bind_param("ss",
                            $categoria,
                            $descripcion
                        );

                        //3.Ejecucion
                        if ($sql->execute()) {
                            echo "<div class='alert alert-success'>Categoría añadida con éxito.</div>";
                        } else {
                            echo "<div class='alert alert-danger'>Error al insertar la categoría: " . $sql->error . "</div>";
                        }
                        
                        // Cerrar la sentencia preparada
                        $sql->close();
                    }
                }
            }

            // Obtener todas las categorías de la base de datos
            $sql = "SELECT * FROM categorias ORDER BY categoria";
            $resultado = $_conexion->query($sql);
            $categorias = [];

            // Almacenar todas las categorías en un array
            while($fila = $resultado->fetch_assoc()) {
                array_push($categorias, $fila["categoria"]);
            }

 
        ?>


        <form class="col-6" action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
                <label class="form-label">Nueva Categoria</label>
                <input class="form-control" type="text" name="categoria">
                <?php if(isset($error_categoria)) echo "<span class= 'error'>$error_categoria</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <input class="form-control" type="text" name="descripcion">
                <?php if(isset($error_descripcion)) echo "<span class= 'error'>$error_descripcion</span>" ?>
            </div>
            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Insertar">
                <a class="btn btn-secondary" href="./index.php">Volver</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>