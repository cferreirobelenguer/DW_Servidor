

<?php
/* Realizar un programa (verdirinfo.php) donde podamos indicar un nombre de directorio 
y me muestre los archivos que lo componen indicando el nombre,
 el tipo de archivo (MIME) y su tamaño en bytes. Mostrar la lista ordenada por tamaño. */
 
define('DIRECTORIO', 'C:\Users\User\Pictures\Saved Pictures'); // Define el directorio que se va a procesar
define("res", []);
function recorrer()
{

    if (!is_dir(DIRECTORIO)) {
        die("No existe el directorio " . DIRECTORIO);
    } else {
        $directorio = @opendir(DIRECTORIO);
        $entrada = readdir($directorio);
        while ($entrada != false) {
            if (is_file(DIRECTORIO . "/" . $entrada)) {

                $res[] = array(
                    "Nombre" => $entrada,
                    "Tamaño" => filesize(DIRECTORIO . "/" . $entrada),
                    "Tipo" => filetype(DIRECTORIO . "/" . $entrada)
                );
            }
            $entrada = readdir($directorio);
        }
    }
    function sort_by_orden($a, $b)
    {
        return $a['Tamaño'] - $b['Tamaño'];
    }
    uasort($res, 'sort_by_orden');

    foreach ($res as $clave => $valor) {
        echo "<tr><td>" . $res[$clave]["Nombre"] . "</td>";
        echo "<td>" . $res[$clave]["Tamaño"] . "</td>";
        echo "<td>" . $res[$clave]["Tipo"] . "</td></tr>";
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIRECTORIO 3</title>
</head>

<body>
    <table border="1">
        <th>Nombre del archivo</th>
        <th>Tamaño del archivo en bytes</th>
        <th>Tipo de archivo</th>

        <?php recorrer(); ?>
    </table>
</body>

</html>
