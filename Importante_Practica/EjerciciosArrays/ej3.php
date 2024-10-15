<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <link href="/Importante_Practica/EjerciciosArrays/estilos.css" rel="stylesheet" type="text/css">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>

<body>
    <?php

    $paises = array(
        "Italy" => "Rome",
        "Luxembourg" => "Luxembourg",
        "Belgium" => "Brussels",
        "Denmark" => "Copenhagen",
        "Finland" => "Helsinki",
        "France" => "Paris",
        "Slovakia" => "Bratislava",
        "Slovenia" => "Ljubljana",
        "Germany" => "Berlin",
        "Greece" => "Athens",
        "Ireland" => "Dublin",
        "Netherlands" => "Amsterdam",
        "Portugal" => "Lisbon",
        "Spain" => "Madrid",
        "Sweden" => "Stockholm",
        "United Kingdom" => "London",
        "Cyprus" => "Nicosia",
        "Lithuania" => "Vilnius",
        "Czech Republic" => "Prague",
        "Estonia" => "Tallin",
        "Hungary" => "Budapest",
        "Latvia" => "Riga",
        "Malta" => "Valetta",
        "Austria" => "Vienna",
        "Poland" => "Warsaw"
    );

    ksort($paises);
    ?>

    <table>
        <thead>
            <tr>
                <th>Paises</th>
                <th>Capitales</th>
            </tr>
        </thead>
        <tbody>
            <?php

            //tabla ordenados por los nombres de sus países.
            foreach ($paises as $nombrePais => $capital) {
                // list($nombre, $capital) = $nombrePais;
                echo "<tr>";
                echo "<td>$nombrePais</td>";
                echo "<td>$capital</td>";
                echo "</td>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>