<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 4</title>
    <link href="/Importante_Practica/EjerciciosArrays/estilos.css" rel="stylesheet" type="text/css">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>

<body>
    <?php

    // Crea un array multidimensional que contenga la siguiente información de series: título, plataforma y temporadas.
    $series = array(
        array(
            "titulo" => "Breaking Bad",
            "plataforma" => "Netflix",
            "temporadas" => 5
        ),
        array(
            "titulo" => "Stranger Things",
            "plataforma" => "Netflix",
            "temporadas" => 4
        ),
        array(
            "titulo" => "The Mandalorian",
            "plataforma" => "Disney+",
            "temporadas" => 3
        ),
        array(
            "titulo" => "The Boys",
            "plataforma" => "Amazon Prime",
            "temporadas" => 4
        ),
        array(
            "titulo" => "Game of Thrones",
            "plataforma" => "HBO",
            "temporadas" => 8
        )
    );
    ?>

    <!-- Primera tabla: Original -->
    <h2>Tabla original</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Plataforma</th>
                <th>Temporadas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($series as $serie) {
                echo "<tr>";
                echo "<td>{$serie['titulo']}</td>";
                echo "<td>{$serie['plataforma']}</td>";
                echo "<td>{$serie['temporadas']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Espacio entre tablas -->
    <br><br>

    <?php
    // Ordenar por temporadas de menor a mayor
    $temporadas = array_column($series, 'temporadas');
    array_multisort($temporadas, SORT_ASC, $series);
    ?>

    <!-- Segunda tabla: Ordenada por temporadas -->
    <h2>Tabla ordenada por temporadas (de menor a mayor)</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Plataforma</th>
                <th>Temporadas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($series as $serie) {
                echo "<tr>";
                echo "<td>{$serie['titulo']}</td>";
                echo "<td>{$serie['plataforma']}</td>";
                echo "<td>{$serie['temporadas']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <!-- Espacio entre tablas -->
    <br><br>

    <?php
    // Ordenar por plataforma y luego por título
    $plataformas = array_column($series, 'plataforma');
    $titulos = array_column($series, 'titulo');

    array_multisort($plataformas, SORT_ASC, $titulos, SORT_ASC, $series);
    ?>

    <!-- Tercera tabla: Ordenada por plataforma y título -->
    <h2>Tabla ordenada por plataforma y título</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Titulo</th>
                <th>Plataforma</th>
                <th>Temporadas</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($series as $serie) {
                echo "<tr>";
                echo "<td>{$serie['titulo']}</td>";
                echo "<td>{$serie['plataforma']}</td>";
                echo "<td>{$serie['temporadas']}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>
