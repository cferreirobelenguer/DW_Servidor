
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
    </center>
</body>
</html>



<?php
}

?>