<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 5</title>
    <!-- Enlace al archivo CSS -->
    <link href="estilos.css" rel="stylesheet" type="text/css">
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>

<body>
    <?php

    // Array de estudiantes
    $estudiantes = [
        "usu1",
        "usu2",
        "usu3",
        "usu4",
        "usu5",
        "usu6",
        "usu7"
    ];

    // Asignar una nota aleatoria a cada estudiante
    $notas = [];
    for ($i = 0; $i < count($estudiantes); $i++) {
        $notas[$i] = rand(1, 10); // Nota aleatoria entre 1 y 10
    }

    // Función para obtener la calificación final
    function obtenerCalificacion($nota)
    {
        if ($nota < 5) {
            return 'Suspenso';
        } elseif ($nota < 7) {
            return 'Aprobado';
        } elseif ($nota < 9) {
            return 'Notable';
        } else {
            return 'Sobresaliente';
        }
    }
    // Ordenar los estudiantes por nombre (clave del array)
    ksort($estudiantes);


    ?>

    <!-- Mostrar la tabla con los estudiantes, notas y calificación -->
    <table>
        <thead>
            <tr>
                <th>Estudiante</th>
                <th>Nota</th>
                <th>Calificación</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Imprimir cada estudiante con su nota y calificación
            for ($i = 0; $i < count($estudiantes); $i++) {
                $calificacion = obtenerCalificacion($notas[$i]); // Obtener la calificación según la nota
                echo "<tr>";
                echo "<td>{$estudiantes[$i]}</td>";
                echo "<td>{$notas[$i]}</td>";
                echo "<td>{$calificacion}</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>

</html>