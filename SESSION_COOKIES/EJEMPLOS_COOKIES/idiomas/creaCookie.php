<?php

setcookie("idioma", $_GET["idioma"], time() +30);


if (isset($_COOKIE["idioma"])) {
    switch ($_GET["idioma"]) {
        case "es":
            $visitasUK=0;
            $visitasES = 0;
            // Si existe el cookie lo muestro
            if (isset($_COOKIE["visitasES"])){
            $visitasES = $_COOKIE["visitasES"];
            }
            $visitasES++;
?>
            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>españa</title>
            </head>

            <body>
                <center>
                    <h1>ESPAÑA</h1>
                    <img src="madrid.jpg" width="200" height="200">
                    <img src="barcelona.jpg" width="200" height="200">
                    <br>
                    <?php
                    echo "El total de visitas a España es " . $visitasES;
                    ?>
                </center>
            </body>

            </html>
        <?php
            break;
        case "uk":
            $visitasUK = 0;
            $visitasES=0;
            // Si existe el cookie lo muestro
            if (isset($_COOKIE["visitasUK"])){
            $visitasUK = $_COOKIE["visitasUK"];
            }
            $visitasUK++;
        ?>
            <!DOCTYPE html>
            <html lang="es">

            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Inglaterra</title>
            </head>

            <body>
                <center>
                    <h1>Inglaterra</h1>
                    <img src="londres.jpg" width="200" height="200">
                    <img src="londres1.jpg" width="200" height="200">
                    <br>
                    <?php
                    echo "El total de visitas a Inglaterra es " . $visitasUK;
                    ?>
                </center>
            </body>

            </html><?php
                    break;
            }
            // Vuelvo a fijar el valor de cookie válido por un mes
            setcookie("visitasES", $visitasES, time() + 30*24*3600);
            // Vuelvo a fijar el valor de cookie válido por un mes
            setcookie("visitasUK", $visitasUK, time() + 30*24*3600);
        } else {
            echo "No se ha seleccionado ningún idioma";
        }



                    ?>