<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Top animes</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>
<body>
<div class="container">
    <form action="" method="get">
        <label class="form-label">Cantidad de personajes:</label>
        <input type="number" id="cantidad" name="cantidad" min="1" max="20">  
        <br>
        <label class="form-label">Género:</label> 
        <select name="gender" id="gender">
            <option disabled selected hidden>--- Elige una opción---</option>
            <option value="female">Mujer</option>
            <option value="male">Hombre</option>
        </select>
        <br>
        <label class="form-label">Especie:</label> 
        <select name="species" id="species">
            <option disabled selected hidden>--- Elige una opción---</option>
            <option value="human">Humano</option>
            <option value="alien">Alien</option>
        </select>
        <br>
        <input type="submit" value="Enviar">
        <br>
    </form>
    <?php
    if (isset($_GET["cantidad"]) && isset($_GET["gender"]) && isset($_GET["species"])) {
        $cant = $_GET["cantidad"];
        $genero = $_GET["gender"];
        $especie = $_GET["species"];
        $apiUrl = "https://rickandmortyapi.com/api/character/?gender=$genero&species=$especie";

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        $datos = json_decode($respuesta, true);
        $personajes = array_slice($datos["results"], 0, $cant); // para cortar donde quiera
    ?>
    <table class='table table-striped table-hover table-sm'>
        <thead class='table-dark'>
            <tr>
                <th>Nombre del personaje:</th>
                <th>Género:</th>
                <th>Especie:</th>
                <th>Origen:</th>
                <th>Imagen:</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($personajes as $personaje) { ?>
            <tr>
                <td><?php echo $personaje["name"] ?></td>
                <td><?php echo $personaje["gender"] ?></td>
                <td><?php echo $personaje["species"] ?></td>
                <td><?php echo $personaje["origin"]["name"] ?></td>
                <td><img width="100px" src="<?php echo $personaje["image"] ?>"></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php } ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>