<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Anime</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    
    ?>
    <link rel="stylesheet" href="../CSS/estiloTopAnime.css">
</head>
<body>
    
    <div class="container">
    <h1>Animes</h1>
<?php
     $apiUrl = "https://api.jikan.moe/v4/top/anime"; //inicia la url de la api
     
     $page = isset($_GET["page"]) ? $_GET["page"] : 1;
     $tipo = isset($_GET["type"]) ? $_GET["type"] : "";
     
     
     if (isset($_GET["page"]) && isset($_GET["type"])) { 
         $apiUrl = "https://api.jikan.moe/v4/top/anime?page=$page&type=$tipo";
     } else if (isset($_GET["page"])) {
         $apiUrl = "https://api.jikan.moe/v4/top/anime?page=$page";
     } else if (isset($_GET["type"])) {
         $apiUrl = "https://api.jikan.moe/v4/top/anime?type=$tipo";
     }
    

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $animes = $datos["data"];
        $pagination = $datos["pagination"];
        //print_r($animes);
    ?>
    <form action="" method="GET">
        <input type="radio" name="type" id="tv" value="tv">
        <label for="tv">📺 Serie</label>

        <input type="radio" name="type" id="movie" value="movie">
        <label for="movie">🎬 Película</label>

        <input type="radio" name="type" id="all" value="">
        <label for="all">🌎 Todos</label>

        <input type="submit" value="Aplicar">
    </form>
    <br><br>

    <table>
        <thead>
            <tr>
                <th>Posición</th>
                <th>Título</th>
                <th>Nota</th>
                <th>Imagen</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($animes as $anime) { ?>
                <tr>
                    <td><?php echo $anime["rank"] ?></td>
                    <td>
                        <a href="anime.php?id=<?php echo $anime["mal_id"] ?>">
                            <?php echo $anime["title"] ?>
                        </a>
                    </td>
                    <td><?php echo $anime["score"] ?></td>
                    <td>
                        <img width="100px" src="<?php echo $anime["images"]["jpg"]["image_url"] ?>">
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>


    <?php
    // Verifica si el número de página actual es mayor a 1 para mostrar el enlace "Anterior".
    if ($pagination["current_page"] > 1) { ?>
        <!-- Crea un enlace "Anterior" que disminuye el número de página en 1 y mantiene el tipo seleccionado. -->
        <a href="?page=<?php echo $page-1 ?>&type=<?php echo $tipo ?>">Anterior</a>
    <?php }
    
    // Verifica si hay una página siguiente disponible para mostrar el enlace "Siguiente".
    if ($pagination["has_next_page"]) { ?>
        <!-- Crea un enlace "Siguiente" que aumenta el número de página en 1 y mantiene el tipo seleccionado. -->
        <a href="?page=<?php echo $page+1 ?>&type=<?php echo $tipo ?>">Siguiente</a>
    <?php } ?>
    </div>
</body> 
</html>