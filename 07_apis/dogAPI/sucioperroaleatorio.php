<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
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
    <img src="<?php  echo $perritos?>">
    <a href="perrito_aleatorio.php" class="btn">Cambiar</a>
</body>
</html>