
<?php
if(!isset($_GET["idioma"])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>idiomas</title>
</head>
<body>
    <center>
    <h1>Elija un idioma</h1>
    <a href="creaCookie.php?idioma=es"><img src="es.png" width="50" height="50"></a>
    <br>
    <br>
    <a href="creaCookie.php?idioma=uk"><img src="uk.jpg" width="60" height="60"></a>
    <form action="#" method="GET">
        <input type="submit" name="terminar" value="TERMINAR">
    </form>
    
    </center>
</body>
</html>



<?php
}

if(!empty($_GET["terminar"])){
    
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
            <h1>GRACIAS POR TU VISITA TURÍSTICA</h1>
            <img src="VIAJERO.jpg" width="200" height="200">
            <br>
        </center>
    </body>

    </html>
    <?php


}

?>
