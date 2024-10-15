<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array Bi</title>
</head>

<body>
    <?php

    //También podemos crear el array multidimensional añadiendo los elementos del array entre corchetes
    // $juegos = [
    //     ["Pacman", "Atari", 60],
    //     ["Fortnite", "PS4", 0],
    //     ["Mario Kart", "Super Nintendo", 70],
    //     ["Street Fighter", "PS4", 50],
    //     ["Legend of Zelda", "Nintendo 64", 40],
    //     ["Castelvania", "Nintendo 64", 55],
    //     ];

    //queremos almacenar el nombre y el apellido de una lista de usuarios
    $usuarios = array(
        array('Ned', 'Stark'),
        array('Daenerys', 'Targaryen'),
        array('Tyrion', 'Lannister'),
        array('Arya', 'Stark')
    );

    //funcion list=> permite asignar variables a los distintos valores del array
    foreach ($usuarios as $usuario) {
        list($nombre, $apellido) = $usuario;
        echo "Nombre: $nombre" . "<br>";
        echo "Apellido: $apellido" . "<br><br>";
    }


    echo "<br>";
    //ordenar arrays multidimensionales ==> función array_multisort
    // Extraer los nombres y apellidos
    $nombre = array_column($usuarios, 0);
    $apellido = array_column($usuarios, 1);

    // Ordenar el array
    array_multisort($nombre, SORT_ASC, $apellido, SORT_DESC, $usuarios);

    // Mostrar el resultado
    foreach ($usuarios as $usuario) {
        echo $usuario[0] . ' ' . $usuario[1] . '<br>';
    }
    echo "<br>";


    //insertar elementos en arrays multidimensionales ==> array_push

    //Insertar filas en arrays multidimensionales
    $nuevo_usuario = ['Cersei', 'Lannister'];
    array_push($usuarios, $nuevo_usuario);

    // Mostrar el resultado
    foreach ($usuarios as $usuario) {
        echo $usuario[0] . ' ' . $usuario[1] . '<br>';
    }

    echo "<br>";
    //Insertar columnas en arrays multidimensionales
    /*
    Si quisiéramos, por ejemplo, añadir una nueva columna a nuestro array de usuarios, la forma más sencilla sería
    añadirla empleando un bucle for e indicando la key de la nueva columna (si nuestro array tiene dos filas, la tercera tendría la key 2).
    */
    // Añadir un tercer elemento aleatorio a cada sub-array
    for ($i = 0; $i < count($usuarios); $i++) {
        $usuarios[$i][2] = rand(1, 10);
    }

    echo "<br>";

    // Mostrar el resultado
    foreach ($usuarios as $usuario) {
        echo $usuario[0] . ' ' . $usuario[1] . ' - Aleatorio: ' . $usuario[2] . '<br>';
    }

    echo '<br>';


    // Mostrar el array antes de eliminar
    echo "Antes de eliminar:\n";
    foreach ($usuarios as $usuario) {
        echo $usuario[0] . ' ' . $usuario[1] . '<br>';
    }

    // Eliminar el primer usuario
    unset($usuarios[0]);

    // Mostrar el array después de eliminar
    echo "<br>Después de eliminar:\n";
    foreach ($usuarios as $usuario) {
        echo $usuario[0] . ' ' . $usuario[1] . '<br>';
    }

    /*
    Matrices

`$matriz = array (`

`“Clave” => array ( ... ),`

`“Clave” => array ( ... ),`

`“Clave” => array ( ... )`

`);`

**Acceso a las posiciones de la matriz**

`$nombreMatriz[posicion1][posicion2];`

`<?php`

`$matriz = array (`

`“Pos1” => array(“ 1 “, “ 2 “, “ 3 “),`

`“Pos2” => array(“ 4 “, “ 5 “, “ 6 “),`

`“Pos3” => array(“ 7 “, “ 8 “, “ 9 “)`

`);`

`print($matriz [“Pos1”][0]);`

`print($matriz[“Pos1”][1]);`

`print($matriz[“Pos1”][2]);`

`print(“</br>”);`

`print($matriz[“Pos2”][0]);`

`print($matriz[“Pos2”][1]);`

`print($matriz[“Pos2”][2]);`

`print(“</br>”);`

`print($matriz[“Pos3”][0]);`

`print($matriz[“Pos3”][1]);`

`print($matriz[“Pos3”][2]);`

`?>`
    */












































    ?>

</body>

</html>