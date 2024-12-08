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
    <title>Index de Categorias</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');

    ?>

    <link rel="stylesheet" href="../util/CSS/categorias/estilo_indexCategorias.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">



</head>
<body>

    
    <a href="../index.php" class="btn btn-secondary btn-volver">
        <i class="fas fa-arrow-left"></i>
    </a>
    
<div class="container">
        <h1>Tabla de Categorias</h1>
        <?php
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $categoria = $_POST["categoria"];
                

                //  borrar el producto
                $sql = "DELETE FROM categorias WHERE categoria = '$categoria'"; 

                $_conexion -> query($sql); // ejecuta la consulta SQL en la base de datos utilizando el objeto $_conexion (que es la conexión previamente establecida a la base de datos MySQL). Si la consulta es exitosa, el anime con el id_anime indicado será eliminado de la base de datos.
            }

            $sql = "SELECT * FROM categorias";
            $resultado = $_conexion -> query($sql);
            /**
             * Aplicamos la función query a la conexión, donde se ejecuta la sentencia SQL hecha
             * 
             * El resultado se almacena $resultado, que es un objeto con una estructura parecida
             * a los arrays
             */
        ?>
        <a class="btn btn-secondary" href="nueva_categoria.php">Crear nueva categoria</a><br><br>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Categoria</th>
                    <th>Descripcion</th>
                    
                </tr>
            </thead>
            <tbody>

                <!-- Este fragmento de código PHP está procesando y mostrando resultados de una consulta a la base de datos en una tabla HTML -->
                
                <?php
                    while($fila = $resultado -> fetch_assoc()) {    // trata el resultado como un array asociativo | las claves del array corresponden a los nombres de las columnas de la tabla de la base de datos.
                        echo "<tr>";
                        echo "<td>" . $fila["categoria"] . "</td>";
                        echo "<td>" . $fila["descripcion"] . "</td>";
                        ?>
                        <td>
                            <a class="btn btn-primary" 
                               href="editar_categoria.php?categoria=<?php echo $fila["categoria"] ?>">Editar</a>
                        </td>
                        <td>
                            <form action="" method="post">
                                <input type="hidden" name="categoria" value="<?php echo $fila["categoria"] ?>">
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
    
</body>
</html>