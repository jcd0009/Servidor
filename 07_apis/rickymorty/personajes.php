<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Top Personajes - Rick and Morty</title>
    <link rel="stylesheet" href="./CSS/estilo.css">
</head>
<body>
    <div class="container">
        <h1>Busca Personajes de Rick and Morty</h1>
        
        <form action="" method="get">
            <label for="cantidad">Cantidad de personajes:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" max="20" required>
            
            <label for="gender">Género:</label> 
            <select name="gender" id="gender" required>
                <option disabled selected hidden>--- Elige una opción ---</option>
                <option value="female">Mujer</option>
                <option value="male">Hombre</option>
            </select>
            
            <label for="species">Especie:</label> 
            <select name="species" id="species" required>
                <option disabled selected hidden>--- Elige una opción ---</option>
                <option value="human">Humano</option>
                <option value="alien">Alien</option>
            </select>
            
            <button type="submit">Buscar</button>
        </form>

        <?php
        if (isset($_GET["cantidad"]) && isset($_GET["gender"]) && isset($_GET["species"])) {
            $cant = intval($_GET["cantidad"]);
            $genero = $_GET["gender"];
            $especie = $_GET["species"];
            
            if ($cant < 1 || $cant > 20) {
                echo "<div style='color: white; font-weight: bold;'>⚠️ La cantidad debe estar entre 1 y 20.</div>";
                exit();
            }

            $apiUrl = "https://rickandmortyapi.com/api/character/?gender=$genero&species=$especie";

            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $apiUrl);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $respuesta = curl_exec($curl);
            curl_close($curl);

            $datos = json_decode($respuesta, true);
            $personajes = array_slice($datos["results"], 0, $cant); 
        ?>
        
        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Género</th>
                    <th>Especie</th>
                    <th>Origen</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($personajes as $personaje) { ?>
                <tr>
                    <td><?php echo ($personaje["name"]); ?></td>
                    <td><?php echo ($personaje["gender"]); ?></td>
                    <td><?php echo ($personaje["species"]); ?></td>
                    <td><?php echo ($personaje["origin"]["name"]); ?></td>
                    <td>
                        <img width="100px" src="<?php echo ($personaje["image"]); ?>">
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <?php
        } // Cierre del if principal
        ?>
    </div>
</body>
</html>
