<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio1</title>
</head>

<body>
    <?php

    //para declarar arrays
    $personas = [
        1 => "Jose",
        2 => "Juan",
        3 => "Tomas",
    ];

    // Mostrar el array con print_r y formatearlo en HTML usando <pre>
    // echo "<pre>";
    // print_r($personas);
    // echo "</pre>";

    // Mostrar el array con foreach y saltos de línea HTML
    foreach ($personas as $dni => $nombre) {
        echo "DNI: $dni - Nombre: $nombre<br>";
    }

    //Muestra algún elemento del array de personas (con DNIs y nombres) que has creado anteriormente.
    echo "<br><br>";
    echo $personas[2] . '<br><br>';


    // $series = [
    //     1 => 'El juego del calamar',
    //     '1' => 'La casa de papel',
    //     1.3 => 'Alice in Borderland',
    //     true => 'The Witcher'
    // ];
    // echo $series([1]); //devuelve the witcher porque se sobreesceibe el ultimo valor si son iguales

    //añadir elementos a un array
    // array_push
    array_push(
        $personas,
        'Qué difícil es el amor para un otaku',
        'Los Simpsons'
    );

    //     $series[] = 'Sense8';
    // $series[10] = 'Ataque a los titanes';

    foreach ($personas as $dni => $nombre) {
        echo "DNI: $dni - Nombre: $nombre<br>";
    }

    //     Modificar elementos en un array
    // $personas[1] = 'Stranger Things';
    // echo $personas[1]; // Devuelve 'Stranger Things'

    //Eliminar un elemento de un array función unset()

    /*
    Cuando eliminamos un elemento, el array no se reindexa, por lo que si tenemos como key los valores del 0 al 5 
    y eliminamos el elemento 1, esta key simplemente deja de existir.

    */

    unset($personas[1]);
    echo "<br><br>";

    foreach ($personas as $dni => $nombre) {
        echo "DNI: $dni - Nombre: $nombre<br>";
    }

    //añadir persona
    // array_push($personas[1],"1","Antonio Galan");
    $personas[1] = "Antonio Galan";

    //modificar nombre
    $personas[2] = "Juanillo";

    //Elminar una persona
    unset($personas[4], $personas[5]);

    // Muestra los cambios
    echo "<br><br>";

    foreach ($personas as $dni => $nombre) {
        echo "DNI: $dni - Nombre: $nombre<br>";
    }

    /*Funciones útiles
    print_r => Parecida a var_dump, pero imprime información más
    legible. Podemos emplearla para ver los elementos de un
    array sin necesidad de usar un bucle.

    array_values => Resetea todas las keys del array y las
    vuelve a asignar de manera ordenada.

    count => Cuenta el número de elementos de un array

    key => Devuelve la key del elemento actual del array
*/

    /*

    Recorrer Arrays
    pagina 23 de php5 arrays

*/
    echo "<br><br>";
    echo "<h3>Recorrer Arrays Metodo 1</h3>";
    // echo "<br><br>";
    $peliculas = [
        'El señor de los anillos: La comunidad del anillo',
        'El señor de los anillos: Las dos torres',
        'El señor de los anillos: El retorno del rey'
    ];

    for ($i = 0; $i < count($peliculas); $i++) {
        echo $peliculas[$i] . "<br>";
    }

    echo "<br><br>";
    echo "<h3>Recorrer Arrays Metodo 2</h3>";

    foreach ($peliculas as $pelicula) {
        echo $pelicula . "<br>";
    }

    echo "<br><br>";

    foreach ($peliculas as $key => $pelicula) {
        echo $key . " => " . $pelicula . "<br>";
    }

    echo "<br><br>";
    echo "<h3>Recorrer Arrays Metodo 3</h3>";
    
    $i = 0;
    while ($i < count($peliculas)) {
        echo $peliculas[$i] . "<br>";
        $i++;
    }

// Utiliza el método más adecuado para recorrer el array de
// personas que has creado y muestra cada par DNI => Nombre en
// una línea distinta.

$personas = [
    "12231223A" => "Jose",
    "12121212B" => "Juan",
    "12121212C" => "Tomas",
    // Si quieres agregar más personas, puedes hacerlo aquí
];

// Recorrer el array y mostrar cada par DNI => Nombre
foreach ($personas as $dni => $nombre) {
    echo "DNI: $dni - Nombre: $nombre<br>";
}

/*
Ordenar arrays
    sort - Ordena los elementos del array de menor a mayor y resetea
    las keys.
    
    rsort - Ordena los elementos del array de mayor a menor y resetea
    las keys.
    
    asort - Ordena los elementos del array de menor a mayor sin
    resetear las keys.
    
    arsort - Ordena los elementos del array de mayor a menor sin
    resetear las keys.

    ksort - Ordena los elementos del array de menor a mayor de
    acuerdo a las keys.

    krsort - Ordena los elementos del array de mayor a menor de
    acuerdo a las keys.

    para verlo
    - - - - - - - 
    print_r($array);

    Operaciones con Arrays

Acceso a los elementos del array

`$nombreArray[posicion];`

Eliminar los elementos de un array

`unset ($nombreArray);`

Borrar un elemento de un array

`unset ($nombreArray[posición]);`

Unión de arrays

`array array_merge (array $array1, ...array $arrayN)`

Ordenar arrays.

`sort($nombreArray);` // ordena de menor a mayor

`rsort($nombreArray);` // ordena de mayor a menor



















*/

    ?>

</body>

</html>