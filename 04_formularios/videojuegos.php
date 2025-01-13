<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videojuegos</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS externo -->
    <link rel="stylesheet" href="../04_formularios/CSS/estilo.css"> 

    <!-- Para errores por pantalla -->
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);    
    ?>
</head>
<body>

    <div class="container">
        <!-- codigo php -->

        <?php
        if ($_SERVER["REQUEST_METHOD"] =="POST"){
            $tmp_titulo = $_POST["titulo"];
            if(isset($_POST["consola"])) {
                $tmp_consola = $_POST["consola"];
            } else {
                $tmp_consola = "";
            }
            $tmp_fechaLanzamiento = $_POST["fechaLanzamiento"];
            $tmp_pegi = $_POST["pegi"];
            $tmp_descripcion = $_POST["descripcion"];

            // variable titulo
            if ($tmp_titulo == '') {
            $error_titulo = "Debes introducir un titulo";
            } else {
                $patron = "/^[a-zA-Z0-9_]{1,80}$/";
                if (!preg_match($patron, $tmp_titulo)) {
                $error_titulo = "Debe contener entre 1 y 80 caracteres";
                } else {
                $titulo = $tmp_titulo;
                }
            }

            // variable consola
            if ($tmp_consola == '') {
                $error_consola = "Debes seleccionar alguna consola";
            } else {
                $consolas_validas = ["Nintendo Swtich","PS5","PS4","XBOX","PC"];
                if (!in_array($tmp_consola, $consolas_validas)) {
                    $error_consola = "La consola no es valida";
                } else {
                    $consola = $tmp_consola;
                }
                
            }

            // Validación de fecha
            if ($tmp_fechaLanzamiento == '') {
                $errorFecha = "Debes introducir una fecha";
            } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $tmp_fechaLanzamiento)) {
                $errorFecha = "Formato de fecha incorrecto. Debe ser YYYY-MM-DD.";
            } else {
                list($year, $month, $day) = explode('-', $tmp_fechaLanzamiento);
                if ($year < 1947) {
                    $errorFecha = "Introduce un juego creado a partir de 1947.";
                }
                $currentYear = date('Y');
                if ($year > $currentYear + 5 || ($year == $currentYear + 5 && ($month > date('m') || ($month == date('m') && $day > date('d'))))) {
                    $errorFecha = "Introduce un juego que no salga dentro de más de 5 años.";
                } else {
                    $fechaLanzamiento = $tmp_fechaLanzamiento; // Asignación correcta de la fecha
                }
            }


            //variable pegi
            if (empty($tmp_pegi)) {
                $errorpegi = "Debe introducir un PEGI";
            } else {
                $pegi = $tmp_pegi;
            }

            //variable descripcion
            // Descripción
            if (strlen($tmp_descripcion) > 255) {
                $errorDescripcion = "No puedes exceder los 255 caracteres";
            } else {
                $descripcion = $tmp_descripcion; // Asegúrate de que esto se ejecute
            }

        }
        ?>

        <!-- codigo html -->
        <h1>Videojuegos</h1>
        <form class="col-12" action="" method="post">
            <div class="mb-3">
                <label class="form-label">Título</label>
                <input class="form-control" type="text" name="titulo" placeholder="Ingrese el título del videojuego" >
                <?php if(isset($error_titulo)) echo "<span class='error'>$error_titulo</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Consola</label>
                <div class="form-check">
                <label>Selecciona una consola:</label><br>
                    <input type="radio" name="consola" value="Nintendo Switch"> Nintendo Switch<br>
                    <input type="radio" name="consola" value="PS5"> PS5<br>
                    <input type="radio" name="consola" value="PS4"> PS4<br>
                    <input type="radio" name="consola" value="XBOX"> XBOX<br>
                    <input type="radio" name="consola" value="PC"> PC<br>
                    <?php if(isset($error_consola)) echo "<span class='error'>$error_consola</span>" ?>
                </div>
                
            </div>

            <div class="mb-3">
                <label class="form-label">Fecha de Lanzamiento</label>
                <input class="form-control" type="date" name="fechaLanzamiento" >
                <?php if(isset($errorFecha)) echo "<span class='error'>$errorFecha</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">PEGI</label>
                <select class="form-control" name="pegi" >
                    <option value="3">3</option>
                    <option value="7">7</option>
                    <option value="12">12</option>
                    <option value="16">16</option>
                    <option value="18">18</option>
                </select>
                <?php if(isset($errorpegi)) echo "<span class='error'>$errorpegi</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" maxlength="255" rows="4" placeholder="Ingrese una descripción..." ></textarea>
                <?php if(isset($errorDescripcion)) echo "<span class='error'>$errorDescripcion</span>" ?>
            </div>

            <div class="mb-3">
                <input class="btn btn-primary" type="submit" value="Enviar">
            </div>
        </form>

        <!-- para mostrar las variables por pantalla -->
        <?php
        if (isset($titulo) && isset($consola) && isset($fechaLanzamiento) && isset($pegi) && isset($descripcion)) { ?>
            <h1> <?php echo $titulo; ?> </h1>
            <h2> Plataforma: <?php echo $consola; ?> </h2>
            <h3> Fecha de Lanzamiento: <?php echo $fechaLanzamiento; ?> </h3>
            <h4> PEGI: <?php echo $pegi; ?> </h4>
            <p> <?php echo $descripcion; ?> </p>
        <?php } ?>
        
        
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
