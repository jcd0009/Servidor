<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOG API</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h1>Perritos Random</h1>

    <?php
    $perritos = ""; // Variable para almacenar la URL de la imagen

    // Solo hacer la petición a la API si el usuario ha presionado el botón
    if(isset($_GET["random"])) {
        $apiUrl = "https://dog.ceo/api/breeds/image/random";

        // Inicializar cURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        // Decodificar JSON y obtener la URL de la imagen
        $datos = json_decode($respuesta, true);
        $perritos = $datos["message"]; 
    }
    ?>
    
    <!-- Formulario para generar un perrito aleatorio -->
    <form action="" method="GET">
        <input type="submit" name="random" value="Random">
    </form>

    <br><br>

    <!-- Mostrar la imagen solo si se ha obtenido una URL válida -->
    <?php if (!empty($perritos)) { ?>
        <img width="500px" src="<?php echo $perritos; ?>" alt="Perrito aleatorio">
    <?php } ?>

</body>
</html>
