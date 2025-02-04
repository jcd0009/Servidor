<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chistes CHUCK NORRIS</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h1>Chistes de CHUCK NORRIS</h1>

    <?php
    $chistes = ""; // Variable para almacenar el chiste

    // Si el usuario ha enviado el formulario
    if(isset($_GET["chiste"])) {
        $apiURL = "https://api.chucknorris.io/jokes/random"; // URL de la API

        // Inicializar cURL
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiURL);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        // Decodificar JSON y obtener el chiste
        $datos = json_decode($respuesta, true);
        $chistes = $datos["value"]; // Obtener el chiste de la respuesta
    }
    ?>

    <!-- Formulario para obtener un chiste -->
    <form action="" method="GET">
        <input type="submit" name="chiste" value="Dime un chiste CHUCK">
    </form>

    <br><br>

    <!-- Mostrar el chiste si hay uno disponible -->
    <?php if (!empty($chistes)) { ?>
        <h4><?php echo $chistes; ?></h4>
    <?php } ?>

</body>
</html>
