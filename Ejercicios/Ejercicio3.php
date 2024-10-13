<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejercicio 3</title>
    <?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    ?>
</head>

<body>
    <!-- 
        Realizar un formulario que reciba dos numeros y devuelva todos los numeros primos 
        dentro de ese rango incluidos los extremos
    -->

    <form action="" method="post">
        <label for="numero1">Numero 1</label>
        <input type="text" name="numero1" id="numero1"><br><br>

        <label for="numero1">Numero 2</label>
        <input type="text" name="numero2" id="numero2"><br><br>

        <input type="submit" value="Enviar">

    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $num1 = $_POST["numero1"];
        $num2 = $_POST["numero2"];

        $numerosPrimo = ""; //variable para almacenar los numeros primos

        // Los números primos son aquellos que solo tienen dos divisores: 1 y el propio número.

        for ($i = $num1; $i <= $num2; $i++) {

            if($i>1) {
                if ($i > 1) {
                    $esPrimo = true; //para asumir que es primo
                }
                
            
            }


            
        }   
        echo "<h3>Los numeros primos entre " . $num1 . " y " . $num2 . " son: " . $numerosPrimo . "</h3>";
    }
    ?>

</body>

</html>