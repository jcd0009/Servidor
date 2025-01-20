<?php

    header("Content-Type: application/json");
    include("conexion_pdo.php");

    $metodo = $_SERVER["REQUEST_METHOD"]; //cogemos el metodo de la peticion que solicitamos
    $entrada = json_decode(file_get_contents('php://input'), true);

    switch($metodo){
        case "GET":
            //echo json_encode(["metodo" => "get"]);
            manejarGet($_conexion);
            break;
        case "POST":
            manejarPost($_conexion, $entrada);
            break;
        case "PUT":
            echo json_encode(["metodo" => "put"]);
            break;
        case "DELETE":
            echo json_encode(["metodo" => "delete"]);
            
            break;
        default:
            echo json_encode(["metodo" => "otro"]);
            break;
    }   

    function manejarGet($_conexion) {
        $sql = "SELECT * FROM animes";
        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute();
        $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC); #equivalente al getResult de mysqli
        echo json_encode($resultado);
    }

    function manejarPost($_conexion, $entrada) {
        $sql = "INSERT INTO animes (id_anime, titulo, nombre_estudio, anno_estreno, num_temporadas)
            VALUES (:id_anime, :titulo, :nombre_estudio, :anno_estreno, :num_temporadas)";

        $stmt = $_conexion -> prepare($sql);
        $stmt -> execute([
            "id_anime" => $entrada["id_anime"],
            "titulo" => $entrada["titulo"],
            "nombre_estudio" => $entrada["nombre_estudio"],
            "anno_estreno" => $entrada["anno_estreno"],
            "num_temporadas" => $entrada["num_temporadas"]

        ]);

        if($stmt) {
            echo json_encode(["mensaje" => "El anime se ha insertado correctamente"]);
        } else {
            echo json_encode(["mensaje" => "Error al insertar el anime"]);
        }
    }
?>