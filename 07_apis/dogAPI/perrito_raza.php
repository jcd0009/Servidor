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
    <h1>Seleccionar raza de perro con el select</h1>

    <?php
    // Obtener la lista de razas
    $apiUrl = "https://dog.ceo/api/breeds/list/all";

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $respuesta = curl_exec($curl);
    curl_close($curl);

    $datos = json_decode($respuesta, true);
    $razas = $datos["message"];

    // Si se ha seleccionado una raza
    $image = "";
    if(isset($_GET["breed"])) {
        $customRaza = $_GET["breed"];
        $fotoPerro = "https://dog.ceo/api/breed/$customRaza/images/random"; // ✅ URL corregida

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $fotoPerro);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datosFoto = json_decode($respuesta, true);
        $image = $datosFoto["message"];
    }
    ?>
    
    <form action="" method="GET">
        <label for="breed">Selecciona la raza de perro: </label>
        <select name="breed" id="breed">
            <?php
                foreach($razas as $raza => $subRaza) { 
                    if(empty($subRaza)) { ?>
                        <option value="<?php echo $raza ?>">
                            <?php echo ucfirst($raza); ?>
                        </option>
                    <?php }
                } 
            ?>
        </select>
        <input type="submit" value="Ver Imagen">
    </form>
    
    <br><br>
    
    <?php
    if(!empty($image)){ ?>
        <img src="<?php echo $image ?>" alt="Imagen de un <?php echo $customRaza; ?>" width="500px">
    <?php } ?>
    
</body>
</html>
