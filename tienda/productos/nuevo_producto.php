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
    <title>Nuevo Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    

        require('../util/conexion.php');
        // Obtener categorías para el dropdown
        $sql = "SELECT * FROM categorias ORDER BY categoria";
        $resultado = $_conexion -> query($sql);
        $categorias = [];

        while($fila = $resultado -> fetch_assoc()) {
            array_push($categorias, $fila["categoria"]);
        }
    ?>

<link rel="stylesheet" href="../util/CSS/productos/estilo_nuevo_producto.css">
</head>
<body>
    <div class="container">
        <h1>Nuevo Producto</h1>
        <?php
        // Todo es obligatorio salvo el stock que por defecto es 0;
        if($_SERVER["REQUEST_METHOD"] == "POST") {
            $tmp_nombre = $_POST["nombre"];
            $tmp_precio = $_POST["precio"];
            $tmp_stock = $_POST["stock"];
            
            if(isset($_POST["categoria"])) {
                $tmp_categoria = $_POST["categoria"];
            } else {
                $tmp_categoria = "";
            }
            
            $tmp_descripcion = $_POST["descripcion"];

            

            //validaciones

            //validacion nombre
            if($tmp_nombre == "") {
                $error_nombre = "Debes introducir un nombre";
            } else {

                if(strlen($tmp_nombre)<2 || strlen($tmp_nombre) > 50) {
                    $error_nombre = "Min: 2 Caracteres | Max: 50 caracteres";
                } else {
                    $patron = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{2,50}$/";

                    if(!preg_match($patron, $tmp_nombre)){
                        $error_nombre = "Solo puedes introducir letras, espacios y numeros";
                    } else {
                        $nombre = $tmp_nombre;
                    }
                }
                
            }

            // El precio máximo permitido según la base de datos
            $precio_maximo = 9999.99;

            // Eliminar espacios en blanco alrededor del precio
            $tmp_precio = trim($tmp_precio);

            if ($tmp_precio == "") {
                $error_precio = "Debes introducir un número";
            } else {

                $patronCaracteres = "/[^0-9\.\-]/";  // Permite el signo "-" y el punto decimal

                if (preg_match($patronCaracteres, $tmp_precio)) {
                    $error_precio = "Solo se permiten números y un punto decimal.";
                } else {

                    //Hasta 4 dígitos enteros y hasta 2 decimales opcionales
                    $patronFormato = "/^-?[0-9]{1,4}(\.[0-9]{1,2})?$/";  // Permitimos un signo negativo opcional

                    if (!preg_match($patronFormato, $tmp_precio)) {
                        $error_precio = "Se permiten productos de 4 dígitos enteros y hasta 2 decimales opcionales";
                    } else {

                        //numero flotante para hacer las comparaciones
                        $tmp_precio = floatval($tmp_precio);

                        if ($tmp_precio < 0) {
                            $error_precio = "El precio no puede ser negativo.";
                        } 
                        
                        else if ($tmp_precio > $precio_maximo) {
                            $error_precio = "El precio no puede ser mayor a $precio_maximo";
                        } else {
                            
                            $precio = $tmp_precio;
                        }
                    }
                }
            }

            //categoria
            if (empty($tmp_categoria)) {
                $error_categoria = "Debes seleccionar una categoría.";
            } elseif (!in_array($tmp_categoria, $categorias)) {
                $error_categoria = "La categoría seleccionada no es válida.";
            } else {
                $categoria = $tmp_categoria; // Definir solo si es válida
            }


            //validar imagen
            if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] === 0) {
                $nombre_imagen = $_FILES["imagen"]["name"];
                $ubicacion_temporal = $_FILES["imagen"]["tmp_name"];
                $ubicacion_final = "../imagenes/" . $nombre_imagen;

                // Mover la imagen a la carpeta final
                if (move_uploaded_file($ubicacion_temporal, $ubicacion_final)) {
                    $imagen = $ubicacion_final;
                } else {
                    $error_imagen = "Hubo un problema al cargar la imagen.";
                }
            } else {
                $error_imagen = "Debes subir una imagen.";
            }
   

            //descripcion
            if($tmp_descripcion == '') {
                $error_descripcion = "Debes añadir una descripcion";
            } else {
                if (strlen($tmp_descripcion) > 255) {
                    $error_descripcion = "No puedes exceder los 255 caracteres";

                } else {
                    $descripcion = $tmp_descripcion;
                }
            }

            //validar stock

            // El stock máximo permitido 
            $stock_maximo = 9999;

            // Eliminar espacios en blanco alrededor del stock
            $tmp_stock = trim($tmp_stock);

            if ($tmp_stock == "") {
                $error_stock = "Debes introducir un número";
            } else {

                // Asegurarnos de que solo contiene números enteros
                if (!filter_var($tmp_stock, FILTER_VALIDATE_INT)) {
                    $error_stock = "Solo se permiten números enteros.";
                } else {

                    // Convertir el valor a entero
                    $tmp_stock = intval($tmp_stock);

                    if ($tmp_stock < 0) {
                        $error_stock = "El stock no puede ser negativo.";
                    } 
                    else if ($tmp_stock > $stock_maximo) {
                        $error_stock = "El stock no puede ser mayor a $stock_maximo unidades.";
                    } else {
                        // El stock es válido
                        $stock = $tmp_stock;
                    }
                }
            }




            if (!isset($error_nombre) && !isset($error_precio) && !isset($error_categoria) && !isset($error_descripcion)) {
                // Solo se ejecutará si no hay errores
                $sql = "INSERT INTO productos (nombre, precio, categoria, stock, imagen, descripcion) 
                        VALUES ('$nombre', '$precio', '$categoria', $stock, '$ubicacion_final', '$descripcion')";
                
                if ($_conexion->query($sql) === TRUE) {
                    echo "<div class='alert alert-success'>Producto añadido con éxito.</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error al insertar el producto: " . $_conexion->error . "</div>";
                }
            } else {
                echo "<p class='text-danger'>No se pudo insertar el producto. Por favor, revisa los errores.</p>";
            }
            
        }

        
        ?>
        <form class="col-6" action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input class="form-control" type="text" name="nombre">
                <?php if(isset($error_nombre)) echo "<span class='error'>$error_nombre</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Precio</label>
                <input class="form-control" type="text" name="precio">
                <?php if(isset($error_precio)) echo "<span class='error'>$error_precio</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Stock</label>
                <input class="form-control" type="text" name="stock">
                <?php if(isset($error_stock)) echo "<span class='error'>$error_stock</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Categoria</label>
                <select class="form-select" name="categoria">
                    <option value="" selected disabled hidden>--- Elige la Categoria ---</option>
                    <?php
                    foreach($categorias as $categoria) { ?>
                        <option value="<?php echo $categoria ?>">
                            <?php echo $categoria ?>
                        </option>
                    <?php } ?>
                </select>
                <?php if (isset($error_categoria)) echo "<span class='error'>$error_categoria</span>"; ?>

            </div>
            <div class="mb-3">
                <label class="form-label">Imagen</label>
                <input class="form-control" type="file" name="imagen">
                <?php if(isset($error_imagen)) echo "<span class='error'>$error_imagen</span>" ?>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripcion</label>
                <textarea class="form-control" name="descripcion" rows="4" maxlength="255"></textarea>
                <?php if(isset($error_descripcion)) echo "<span class='error'>$error_descripcion</span>" ?>
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