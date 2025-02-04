<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perrito al Azar</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        // Obtener la lista de razas desde la API
        $apiUrl = "https://dog.ceo/api/breeds/list/all";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $razas = $datos["message"];
    ?>
    <form method="GET" action="">
        <label>Escoge una raza</label>
        <select name="raza">
            <?php
                foreach ($razas as $raza => $subrazas) {
                    if (empty($subrazas)) { ?>
                        <option value="<?php echo $raza; ?>"><?php echo $raza; ?></option>
                    <?php } else {
                        foreach ($subrazas as $subraza) { ?>
                            <option value="<?php echo $raza . '/' . $subraza; ?>"><?php echo $raza . ' ' . $subraza; ?></option>
                        <?php }
                    }
                }
            ?>
        </select>
        <br>
        <input type="submit" value="Mostrar Perrito">
    </form>
    <?php
        if (isset($_GET["raza"])) {
            $raza = $_GET["raza"];
            $apiUrl = "https://dog.ceo/api/breed/" . $raza . "/images/random";
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $datos = json_decode($respuesta, true);
            $imagen = $datos["message"];
            ?>
            <div>
                <img src="<?php echo $imagen; ?>">
            </div>
            <?php
        }
    ?>
</body>
</html>