<!-- Crea una página llamada perrito_aleatorio.php que nos muestre un perrito al azar. -->

<!DOCTYPE html>
<html lang="en">
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
    $apiUrl = "https://dog.ceo/api/breeds/image/random";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $respuesta = curl_exec($curl);
    curl_close($curl);

    $datos = json_decode($respuesta, true);
    $perritos = $datos["message"];
    ?>
    
    <form action="" method="GET">
        <input type="submit" value="Random">
    </form>
    <br><br>
    <img  width="500px" src="<?php echo $perritos; ?> ">  

    
</body>
</html>