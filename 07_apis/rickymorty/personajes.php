<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar personajes Rick y Morty</title>
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h1>Buscar Personajes de Rick y Morty</h1>

    <?php
        $apiUrl = "https://rickandmortyapi.com/api/character";

        $cantidad = isset($_GET["quantity"]) ? $_GET["quantity"] : "";
        $genero = isset($_GET["gender"]) ? $_GET["gender"] : "";
        $especie = isset($_GET["species"]) ? $_GET["species"] : "";
        $pagina = isset($_GET["page"]) ? $_GEt["page"] : 1;

        // Formando la URL de la API con los parámetros del formulario
        if (isset($_GET["quantity"]) && isset($_GET["gender"]) && isset($_GET["species"])) {
            $apiUrl = "https://rickandmortyapi.com/api/character?quantity=$cantidad&gender=$genero&species=$especie&page=$pagina";
        }

        // Haciendo la solicitud a la API
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $respuesta = curl_exec($curl);
        curl_close($curl);

        // Decodificando los datos obtenidos de la API
        $datos = json_decode($respuesta, true);
        $personajes = isset($datos["results"]) ? $datos["results"] : [];
        $totalPersonajes = isset($datos["info"]["count"]) ? $datos["info"]["count"] : 0;
    ?>

    <!-- Formulario para filtrar los resultados -->
    <form action="" method="GET">
        <label for="quantity">Cantidad de Personajes:</label>
        <input type="number" name="quantity" id="quantity" required>
        <br><br>

        <label for="gender">Selecciona un género:</label>
        <select name="gender" id="gender">
            <option value="Female">Female</option>
            <option value="Male">Male</option>
        </select>
        <br><br>

        <label for="species">Selecciona una especie:</label>
        <select name="species" id="species">
            <option value="human">Human</option>
            <option value="alien">Alien</option>
        </select>
        <br><br>

        <input type="submit" value="Buscar">
    </form>

    <!-- Mostrar la tabla solo si el formulario ha sido enviado -->
    <?php
        // Verificar si los parámetros están presentes para mostrar la tabla
        if (isset($_GET["quantity"]) && isset($_GET["gender"]) && isset($_GET["species"])) {
    ?>
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Género</th>
                    <th>Especie</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Aseguramos que no se muestren más personajes de los que existen
                    if ($cantidad > count($personajes)) {
                        $cantidad = count($personajes);
                    }

                    // Iteramos a través de los personajes y los mostramos en la tabla
                    for ($i = 0; $i < $cantidad; $i++) { 
                ?>
                    <tr>
                        <td><?php echo $personajes[$i]["name"]; ?></td>
                        <td><?php echo $personajes[$i]["gender"]; ?></td>
                        <td><?php echo $personajes[$i]["species"]; ?></td>
                        <td>
                            <img width="100px" src="<?php echo $personajes[$i]["image"]; ?>" alt="Imagen del personaje">
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php
        }
    ?>

</body>
</html>