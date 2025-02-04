<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DOG API</title>
    <?php
        // Habilita la visualización de errores para facilitar la depuración
        error_reporting(E_ALL); 
        ini_set("display_errors", 1);
    ?>
</head>
<body>
    <h1>Seleccionar raza de perro con el select</h1>

    <?php
    // URL de la API que proporciona la lista de razas de perros
    $apiUrl = "https://dog.ceo/api/breeds/list/all";

    // Inicializa una sesión cURL para hacer la petición HTTP a la API
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $apiUrl); // Establece la URL de la API
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Indica que queremos recibir la respuesta como string
    $respuesta = curl_exec($curl); // Ejecuta la solicitud
    curl_close($curl); // Cierra la sesión cURL

    // Decodifica la respuesta JSON obtenida de la API
    $datos = json_decode($respuesta, true);
    $razas = $datos["message"]; // Obtiene la lista de razas dentro de la clave "message"

    // Inicializa la variable de imagen vacía
    $image = "";

    // Verifica si se ha seleccionado una raza en el formulario (método GET)
    if(isset($_GET["breed"])) {
        $customRaza = $_GET["breed"]; // Obtiene el valor de la raza seleccionada desde el formulario

        // Construye la URL para obtener una imagen aleatoria de la raza seleccionada
        $fotoPerro = "https://dog.ceo/api/breed/$customRaza/images/random";

        // Inicia una nueva sesión cURL para obtener la imagen de la raza seleccionada
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $fotoPerro); // Configura la URL de la API de imágenes
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); // Indica que queremos la respuesta como string
        $respuesta = curl_exec($curl); // Ejecuta la solicitud
        curl_close($curl); // Cierra la sesión cURL

        // Decodifica la respuesta JSON obtenida
        $datosFoto = json_decode($respuesta, true);
        $image = $datosFoto["message"]; // Obtiene la URL de la imagen de la raza seleccionada
    }
    ?>
    
    <!-- Formulario para seleccionar una raza de perro -->
    <form action="" method="GET">
        <label for="breed">Selecciona la raza de perro: </label>
        <select name="breed" id="breed">
            <?php
                // Recorre la lista de razas obtenida de la API
                foreach($razas as $raza => $subRaza) { 
                    // Si la raza no tiene subrazas
                    if(empty($subRaza)) { ?>
                        <option value="<?php echo $raza ?>">
                            <?php echo ucfirst($raza); // Muestra el nombre de la raza con la primera letra en mayúscula ?>
                        </option>
                    <?php } else { // Si la raza tiene subrazas
                        foreach($subRaza as $sub) { 
                            $mostrar_subRaza = $raza . " " . $sub; // Concatena la raza y la subraza con un espacio
                            $api_subRaza = $raza . "/" . $sub; // Formato requerido por la API para las subrazas ?>
                            <option value="<?php echo $api_subRaza ?>">
                                <?php echo ucfirst($mostrar_subRaza); // Muestra la subraza con la primera letra en mayúscula ?>
                            </option>
                        <?php } 
                    }
                } 
            ?>
        </select>
        <input type="submit" value="Ver Imagen"> <!-- Botón para enviar el formulario -->
    </form>
    
    <br><br>
    
    <?php
    // Si se ha cargado una imagen de la API, la muestra en la página
    if(!empty($image)){ ?>
        <img src="<?php echo $image ?>" alt="Imagen de un <?php echo $customRaza; ?>" width="500px">
    <?php } ?>
    
</body>
</html>
