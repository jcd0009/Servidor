<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
</head>

<body>
    <?php

    //genera 10 numeros aleatorios entre 0 y 100
    $numerAleatorio = rand(0, 100);

    //Almacénalos en un array y muéstralos ordenados de mayor a menor y de menor a mayor.
    $numeros = [];

    for ($i = 1; $i <= 10; $i++) {
        $numeros[$i] = rand(0, 100);
    }

    foreach ($numeros as $numero) {
        echo "Los numeros son: $numero<br>";
    }

    //de mayor a menor
    sort($numeros);
    echo "<br><br>";
    foreach ($numeros as $numero) {
        echo "Los numeros son: $numero<br>";
    }

    //de menor a mayor
    rsort($numeros);
    echo "<br><br>";
    foreach ($numeros as $numero) {
        echo "Los numeros son: $numero<br>";
    }

    ?>

</body>

</html>