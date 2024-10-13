<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 1</title>
    <?php
        error_reporting( E_ALL );
        ini_set("display_errors", 1 );    
    ?>
</head>

<body>
    <!--
        Realiza un formulario que reciba 3 numeros y devuelva el mayor de ellos

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

        $resultado = match (true) {
            $num1 > $num2 && $num1 > $num3 => "El " . $num1 . " es el mayor",
            $num2 > $num1 && $num2 > $num3 => "El " . $num2 . " es el mayor",
            $num3 > $num1 && $num3 > $num2 => "El " . $num3 . " es el mayor"
        };
        echo "<h1>$resultado</h1>";
    }

    ?>
</body>

</html>