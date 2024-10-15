<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
</head>

<body>
    <?php

    //Crea un array que contenga los números pares del 1 al 50 y muéstralos.
    $numerosPares = [];

    for ($i = 1; $i <= 50; $i++) {
        if ($i % 2 == 0) {
            $numerosPares[] = $i;
        }
    }

    //mostrar

    foreach ($numerosPares as $numero) {
        echo "NumerosPares: $numero<br>";
    }

    shuffle($numerosPares);

    echo "<br><br>";

    foreach ($numerosPares as $numero) {
        echo "NumerosPares: $numero<br>";
    }

    echo "<br><br>";
    echo "Numeros en orden descendente";
    echo "<br><br>";


    rsort($numerosPares);

    foreach ($numerosPares as $numero) {
        echo "Numeros Pares de mayor a menor: $numero<br>";
    }




    ?>

</body>

</html>