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
    <title>Index de Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php'); //  establece la conexion con la base de datos
    ?>

    <link rel="stylesheet" href="../util/CSS/productos/estilo_index_Producto.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>
<body>

    <!-- Botón con icono de flecha hacia la izquierda para regresar al índice principal -->
    <a href="../index.php" class="btn btn-secondary btn-volver">
        <i class="fas fa-arrow-left"></i>
    </a>



    <div class="container">
        <h1>Productos</h1>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $id_producto = $_POST["id_producto"];
                

                //  borrar el anime
                $sql = "DELETE FROM productos WHERE id_producto = $id_producto"; //Se crea una consulta SQL que eliminará un registro de la tabla animes de la base de datos, donde el campo id_anime sea igual al valor de $id_anime. Esto borra el anime cuyo id_anime coincide con el proporcionado en el formulario.

                $_conexion -> query($sql); // ejecuta la consulta SQL en la base de datos utilizando el objeto $_conexion (que es la conexión previamente establecida a la base de datos MySQL). Si la consulta es exitosa, el anime con el id_anime indicado será eliminado de la base de datos.
            }

            $sql = "SELECT * FROM productos";
            $resultado = $_conexion -> query($sql);
            /**
             * Aplicamos la función query a la conexión, donde se ejecuta la sentencia SQL hecha
             * 
             * El resultado se almacena $resultado, que es un objeto con una estructura parecida
             * a los arrays
             */
        ?>
        <a class="btn btn-secondary" href="./nuevo_producto.php">Crear nuevo producto</a><br><br>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nombre</th>
                    <th>Precio</th>
                    <th>Categoria</th>
                    <th>Stock</th>
                    <th>Descripcion</th>
                </tr>
            </thead>
            <tbody>

                <!-- Este fragmento de código PHP está procesando y mostrando resultados de una consulta a la base de datos en una tabla HTML -->
                
                <?php
                    while($fila = $resultado -> fetch_assoc()) {    // trata el resultado como un array asociativo | las claves del array corresponden a los nombres de las columnas de la tabla de la base de datos.
                        echo "<tr>";
                        echo "<td>" . $fila["nombre"] . "</td>";
                        echo "<td>" . $fila["precio"] . "</td>";
                        echo "<td>" . $fila["categoria"] . "</td>";
                        echo "<td>" . $fila["stock"] . "</td>";
                        echo "<td>" . $fila["descripcion"] . "</td>"; 
                        ?>
                        <td>
                            <img width="100" height="200" src="../imagenes/<?php echo $fila["imagen"]; ?>">

                        </td>
                        <td>
                            <a class="btn btn-primary" 
                               href="./editar_producto.php?id_producto=<?php echo $fila["id_producto"] ?>">Editar</a>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="id_producto" value="<?php echo $fila["id_producto"] ?>">
                                <input class="btn btn-danger" type="submit" value="Borrar">
                            </form>
                        </td>
                        <?php
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>