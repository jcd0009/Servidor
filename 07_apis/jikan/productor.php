<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Información del productor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
    <link rel="stylesheet" href="../CSS/estiloProductor.css">
</head>
<body>
    <?php
        $id = $_GET["id"];
        $apiUrl = "https://api.jikan.moe/v4/producers/$id/full";

        // Inicialización de cURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        // Decodificación del JSON
        $datos = json_decode($respuesta, true);
        
        if (isset($datos["data"])) {
            $productor = $datos["data"];
        } else {
            echo "<p>No se encontró información para este productor.</p>";
            exit();
        }
    ?>
    
    <div class="container mt-4">
        <!-- Enlace para volver a la lista de animes -->
        <a href="top_anime.php" class="btn-volver">Volver a la lista de animes</a>

        <!-- Mostrar el título del productor -->
        <h1><?php echo $productor["titles"][0]["title"]; ?></h1>

        <!-- Mostrar la imagen del productor -->
        <img src="<?php echo $productor["images"]["jpg"]["image_url"]; ?>" class="anime-img" alt="Imagen del productor"><br>

        <!-- Mostrar la descripción del productor -->
        <h2>Acerca de:</h2>
        <p>
            <?php 
                if (isset($productor["about"])) {
                    echo $productor["about"];  // Si hay información sobre el productor, la muestra
                } else {
                    echo 'No hay información disponible sobre este productor.';  // Si no hay información, muestra un mensaje por defecto
                }
            ?>
        </p><br>
    </div>



</body>
</html>
