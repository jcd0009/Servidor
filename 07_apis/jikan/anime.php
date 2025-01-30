<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anime</title>
    <link rel="stylesheet" href="../CSS/estiloAnime.css"> <!-- Enlace al archivo CSS externo -->
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);    
    ?>
</head>
<body>
    <div class="container">
        <?php
            $id = $_GET["id"];
            $apiUrl = "https://api.jikan.moe/v4/anime/$id/full";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $datos = json_decode($respuesta, true);
            $anime = $datos["data"];
        ?>
        <a href="top_anime.php" class="btn-volver">Volver a la lista de animes</a>


        <h1><?php echo $anime["title"] ?></h1>
        <h2>Nota media: <?php echo $anime["score"] ?></h2>
        <img class="anime-img" src="<?php echo $anime["images"]["jpg"]["image_url"] ?>" alt="Imagen de <?php echo $anime["title"] ?>">

        <h3>Sinopsis</h3>
        <p><?php echo $anime["synopsis"] ?></p>

        <h3>Géneros</h3>
        <ul>
            <?php foreach($anime["genres"] as $genero) { ?>
                <li><?php echo $genero["name"] ?></li>
            <?php } ?>
        </ul>

        <iframe class="trailer" src="<?php echo $anime["trailer"]["embed_url"] ?>"></iframe>

        <h3>Animes relacionados</h3>
        <ul>
            <?php
            foreach($anime["relations"] as $relacionado) {
                foreach($relacionado["entry"] as $entrada) {
                    if($entrada["type"] == "anime") {
                        echo "<li>" . $entrada["name"] . "</li>";
                    }
                }
            }
            ?>
        </ul>

        <h3>Productores</h3>
        <ul>
            <?php
            foreach($anime["producers"] as $productor) {
                if (isset($productor["mal_id"])) {
                    echo "<li><a href='productor.php?id=" . $productor["mal_id"] . "'>" . $productor["name"] . "</a></li>";
                }
            }
            ?>
        </ul>
    </div>
</body>
</html>
