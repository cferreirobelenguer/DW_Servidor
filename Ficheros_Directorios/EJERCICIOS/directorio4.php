
<?php
/* Realizar un programa (contarprogramas.php) donde podamos indicar  
un nombre de directorio y me muestre el nombre de los archivos con extensión .php,
indicándome cuantas líneas de código tiene cada fichero y el total de lineas del directorio.*/



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIRECTORIO 4</title>
</head>
<?php
if (isset($_GET["directorio"])) {
    $directorio = $_GET["directorio"];
    define("DIRECTORIO", $directorio);
}
function recorrer()
{

    $directorio = $_GET["directorio"];

    if (!is_dir(DIRECTORIO)) // Comprueba que realmente existe el directorio
        die("No existe el directorio " . DIRECTORIO);
    // Abrimos el directorio
    $dir_cursor = @opendir(DIRECTORIO) or die("Error al abrir el directorio");
    // Mostramos cada entrada del directorio
    $entrada = readdir($dir_cursor);
    $lineasTotales = 0;
    while ($entrada !== false) {
        if (is_file(DIRECTORIO . "/" . $entrada)) {

            if (substr($entrada, -4) == ".php") {
                echo "<tr><td>" . $entrada . "</td>";
                $archivo = @fopen($entrada, "r");
                $nlinea = 1;
                $contadorLineas = 0;

                while ($linea = fgets($archivo)) {
                    $contadorLineas++;
                    $nlinea++;
                }
                echo "<td>" . $contadorLineas . "</td></tr>";
                $lineasTotales += $contadorLineas;
                fclose($archivo);
            } else {
                echo "No hay archivos php";
            }
        }
        $entrada = readdir($dir_cursor); // lee siguiente entrada

    }
    define("contadorLineas", $lineasTotales);
}
if (!isset($_GET["directorio"])) {


?>

    <body>

        <form action="#" method="GET">
            <label for="">Directorio:</label>
            <input type="text" name="directorio">
        </form>
    <?php
} else {

    ?>
        <h1>DATOS DE DIRECTORIO <?php $_GET["directorio"] ?>
            <table border="1">
                <th>ARCHIVOS PHP</th>
                <th>LÍNEAS DE FICHEROS</th>
                <tr>

                    <?php recorrer(); ?>

                </tr>
            </table>
            <h1>TOTAL DE LÍNEAS DE TODO EL DIRECTORIO: <?php echo contadorLineas ?></h1>
        <?php
    }
        ?>
    </body>

</html>
