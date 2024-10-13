<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 2</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>

<body>
    <!-- 
        Realiza un formulario que reciba 3 numero: a,b y c.
        Se mostraran en una lista los multiplos de c que se encuentre entre a y b

        ej:

        Si  a = 3
            b = 10
            c = 2
        
        Los multiplos de 2 entre 3 y 10 son => 4,6,8,y 10
    -->

    <form action="" method="post">
        <label for="num1">Numero1</label>
        <input type="text" name="numero1" id="numero1"><br><br>

        <label for="num2">Numero2</label>
        <input type="text" name="numero2" id="numero2"><br><br>

        <label for="num3">Numero3</label>
        <input type="text" name="numero3" id="numero3"><br><br>

        <input type="submit" value="Enviar">
    </form>

    <?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $num1 = $_POST["numero1"];
        $num2 = $_POST["numero2"];
        $num3 = $_POST["numero3"];

        $multiplos = ""; //variable para almacenar los multiplos


        echo "<h3>Los múltiplos de " . $num3 . " entre " . $num1 . " y " . $num2 . " son:</h3>";

        for ($i = $num1; $i <= $num2; $i++) {
            if ($i % $num3 == 0) {
               $multiplos .= $i . " ";
            }
        }
        echo "<h3>" . $multiplos . "</h3>";
    }
    ?>

</body>

</html>