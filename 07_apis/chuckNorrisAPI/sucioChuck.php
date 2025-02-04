<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chistes de Chuck Norris</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <?php
        // Obtener la lista de categorías desde la API
        $apiUrl = "https://api.chucknorris.io/jokes/categories";
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $categorias = json_decode($respuesta, true);
    ?>
    <form method="GET" action="">
        <label>Selecciona una categoría</label>
        <select name="categoria">
            <?php
                foreach ($categorias as $categoria) {
                    ?>
                    <option value="<?php echo $categoria; ?>"><?php echo $categoria; ?></option>
                    <?php
                }
            ?>
        </select>
        <br>
        <input type="submit" value="Mostrar Chiste">
    </form>
    <?php
        if (isset($_GET["categoria"])) {
            $categoria = $_GET["categoria"];
            $apiUrl = "https://api.chucknorris.io/jokes/random?category=" . $categoria;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $chiste = json_decode($respuesta, true);
            ?>
            <div>
                <p><?php echo $chiste["value"]; ?></p>
            </div>
            <?php
        }
    ?>
</body>
</html>