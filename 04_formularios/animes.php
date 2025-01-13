<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animes</title>

    <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="../04_formularios/CSS/estilo.css">
    
    <!-- Errors -->
    <?php
        error_reporting(E_ALL);
        ini_set("display_errors", 1);    
    ?>
</head>
<body>
    <div class="container">

        <!-- php Content -->
        <?php
        
        
        $studios = ["Studio Ghibli", "Toei Animation", "Madhouse", "Bones", "Kyoto Animation"];

            if($_SERVER["REQUEST_METHOD"] == "POST"){
                
                $tmp_title = $_POST["title"];
                

                if(isset($_POST["studioName"])) {
                    $tmp_studioName = $_POST["studioName"];
                } else {
                    $tmp_studioName = '';
                }

                $tmp_premiereDate = $_POST["premiereDate"];
                
                if(isset($_POST["seasonNumbers"])) {
                    $tmp_seasonNumbers = $_POST["seasonNumbers"];
                } else {
                    $tmp_seasonNumbers = "";
                }
                




                
                if($tmp_title == '') {
                    $error_title = "You must introduced a title";
                } else {
                    //any type
                    $pattern = "/^.{1,80}$/";

                    if(!preg_match($pattern, $tmp_title)){
                        $error_title="invalid";
                    } else {
                        $title = $tmp_title;
                    }
                }

                
                if(empty($tmp_studioName)) {
                    $error_studioName="You must selected a studio Name ";
                } else {
                    
                    if(!in_array($tmp_studioName, $studios)) {
                        $error_studioName="Invalid";
                    } else {
                        $studioName = $tmp_studioName;
                    }
                }

                if ($tmp_premiereDate == "") {
                    $error_premiereDate = "You must introduced a year";
                }else {
                    $patron = "/^\d{4}$/";

                    if(!preg_match($patron, $tmp_premiereDate)) {
                        $error_premiereDate="only 4 numbers";
                    } else {
                        
                        //defined dates
                        $currentYear = date("Y");
                        $upperDeadline = $currentYear + 5;

                        if($tmp_premiereDate < 1960){
                            $error_premiereDate = "The year must be 1960 or later.";
                        } elseif($tmp_premiereDate > $upperDeadline) {
                            $error_premiereDate = "The year must not exceed $upperLimit.";
                        } else {
                            $premiereDate = $tmp_premiereDate;
                        }

                    }
                }

                if (empty($tmp_seasonNumbers)) {
                    $errorSeasonsNumber = "You must introduced a number";
                } else {
                   if(!is_numeric($tmp_seasonNumbers) || $tmp_seasonNumbers < 1 || $tmp_seasonNumbers > 99) {
                        $errorSeasonsNumber = "Number not valid";
                    } else {
                        $seasonNumber = $tmp_seasonNumbers;
                    }                      
                    
                }
                
            }
            
        ?> 
        


        <!-- HTML Content -->
        <h1>Animes</h1>
        <form class ="col-12" action="" method="post">
            <div class="mb-3" >
                <label class="form-label">Title</label>
                <input class="form-control" type="text" name="title" placeholder="Anime Title">
                <?php if(isset($error_title)) echo "<span class= 'error'>$error_title</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Studio Name</label>
                <select class = "form-control" name="studioName">
                <option selected="true" disabled="disabled">Select an option</option>
                
                <?php
                // Bucle para generar las opciones de manera dinámica.
                foreach ($studios as $studio) {
                // Verifica si la opción es la seleccionada para marcarla como seleccionada.
                $selected = ($studio === $tmp_studioName) ? 'selected' : '';
                echo "<option value=\"$studio\" $selected>$studio</option>";
                }
                ?>
                </select>
                <?php if(isset($error_studioName)) echo "<span class='error'>$error_studioName</span>" ?>
            </div>

            <div class="mb-3">
                <label class="form-label">Premiere Date</label>
                <input class ="form-control" type="text" name="premiereDate">
                <?php if(isset($error_premiereDate)) echo "<span class='error'>$error_premiereDate</span>" ?> 
            </div>

            <div class="mb-3">
                <label class = "form-label">Season numbers</label>
                <input class="form-control" type="number" name="seasonNumbers">
                <?php if(isset($errorSeasonsNumber)) echo "<span class='error'>$errorSeasonsNumber</span>" ?> 
            </div>

            <button type="submit" class="btn btn-primary">Send</button>

        </form>

        <?php
        if(isset($title) && isset($studioName) && isset($premiereDate) && isset($seasonNumber)) { ?>
            <h1><?php echo $title ?> </h1>
            
            <h2 style="display: inline;">Studio Name: </h2>
            <h6 style="display: inline;"><?php echo $studioName ?></h6>
            <br>
            <h2 style="display: inline;">Permiere Date: </h2>
            <h6 style="display: inline;"> <?php echo $premiereDate ?></h6>
            <br>
            <h2 style="display: inline;">Seasons: </h2>
            <h6 style="display: inline;"> <?php echo $seasonNumber ?></h6>

            <?php } ?>

    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>