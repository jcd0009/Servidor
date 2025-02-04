<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Se define el juego de caracteres y la compatibilidad con dispositivos móviles -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Título de la página -->
    <title>Chistes CHUCK NORRIS</title>
    <link rel="stylesheet" href="./CSS/estilo.css">
    <?php
        // Configuración para mostrar todos los errores durante el desarrollo
        error_reporting(E_ALL);
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <!-- Título principal de la página -->
    <h1>Chistes con select de CHUCK NORRIS</h1>
    
    <?php        
        // URL de la API que proporciona las categorías de chistes
        $apiUrl = "https://api.chucknorris.io/jokes/categories";

        // Se inicializa una sesión cURL para realizar una petición HTTP a la API
        $curl = curl_init();
        // Se establece la URL a la que se hará la petición
        curl_setopt($curl, CURLOPT_URL, $apiUrl);
        // Se indica que la respuesta se retorne como una cadena de texto en lugar de imprimirla directamente
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Se ejecuta la petición y se almacena la respuesta en la variable $respuesta
        $respuesta = curl_exec($curl);
        // Se cierra la sesión cURL para liberar recursos
        curl_close($curl);

        // Se decodifica la respuesta JSON a un array asociativo de PHP
        $datos = json_decode($respuesta, true);
        // La respuesta de la API es un array plano con las categorías de chistes, por lo que lo asignamos directamente a $chistes
        $chistes = $datos;

        // Variable donde se almacenará el texto del chiste obtenido, inicialmente vacía
        $textoChiste = "";

        // Se verifica si el formulario ha sido enviado comprobando si existe el parámetro GET "categories"
        if (isset($_GET["categories"])) {
            // Se recoge la categoría seleccionada por el usuario desde el formulario
            $customChiste = $_GET["categories"];

            // Se construye la URL para obtener un chiste aleatorio de la categoría seleccionada.
            // Se utiliza urlencode() para asegurarse de que la categoría se codifique correctamente en la URL.
            $chisteSeleccionado = "https://api.chucknorris.io/jokes/random?category=" . urlencode($customChiste);

            // Se inicializa una nueva sesión cURL para la petición del chiste
            $curl = curl_init();
            // Se establece la URL de la API que devuelve un chiste aleatorio de la categoría indicada
            curl_setopt($curl, CURLOPT_URL, $chisteSeleccionado);
            // Se indica nuevamente que la respuesta se retorne como cadena
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            // Se ejecuta la petición y se almacena la respuesta en la variable $respuesta
            $respuesta = curl_exec($curl);
            // Se cierra la sesión cURL
            curl_close($curl);

            // Se decodifica la respuesta JSON para convertirla en un array asociativo
            $datosChiste = json_decode($respuesta, true);
            // En la respuesta de la API, el chiste se encuentra en el campo "value"
            $textoChiste = $datosChiste["value"];
        }
    ?>

    <!-- Se inicia el formulario que enviará la categoría seleccionada por el usuario -->
    <form action="" method="GET">
        <!-- Etiqueta y campo de selección para elegir la categoría -->
        <label for="categories">Selecciona una categoría de chiste: </label>
        <select name="categories" id="categories">
            <?php 
                // Se recorre el array $chistes para generar una opción en el select por cada categoría
                foreach ($chistes as $chiste) { 
            ?>
                <!-- Cada opción tendrá como valor la categoría y se mostrará con la primera letra en mayúsculas -->
                <option value="<?php echo $chiste; ?>">
                    <?php echo ucfirst($chiste); ?>
                </option>
            <?php 
                } // Fin del bucle foreach
            ?>
        </select>
        <!-- Botón para enviar el formulario -->
        <input type="submit" value="Dámelo">
    </form>

    <!-- Espacio visual para separar el formulario del resultado -->
    <br><br>

    <?php
        // Si se ha obtenido un chiste (la variable $textoChiste no está vacía), se muestra en la página
        if (!empty($textoChiste)) { 
    ?>
        <!-- Se muestra el chiste dentro de un encabezado de nivel 4 -->
        <h4><?php echo $textoChiste; ?></h4>
    <?php 
        } // Fin de la comprobación si existe un chiste
    ?>
    
</body>
</html>
