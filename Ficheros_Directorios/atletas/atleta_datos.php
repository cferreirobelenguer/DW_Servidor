<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO ATLETAS</title>
</head>

<body>
    <h1>SU REGISTRO SE HA HECHO SATISFACTORIAMENTE</h1>
    <form action="atleta_datos.php" method="POST">
        <p>
            <label for="">Nombre: </label>
            <input type="text" name="nombre">
        </p>
        <p>
            <label for="">Categoría: </label>
            Atletismo<input type="radio" name="categoria" value="atletismo">
            Natación<input type="radio" name="categoria" value="natación">
            Baloncesto<input type="radio" name="categoria" value="baloncesto">
            Waterpolo<input type="radio" name="categoria" value="waterpolo">
        </p>
        <p>
            <label for="">Marca: </label>
            <select name="marca">
                <option selected="selected" value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </p>
        <input type="submit" name="boton" value="ENVIAR">
    </form>
</body>

</html>
<?php

//Limpiar las entradas para evitar la posible inyección de código
function limpiarEntrada(string $entrada): string
{
    $salida = trim($entrada); // Elimina espacios antes y después de los datos
    $salida = stripslashes($salida); // Elimina backslashes \
    $salida = htmlspecialchars($salida); // Traduce caracteres especiales en entidades HTML
    return $salida;
}

//Evitar acumulación de registros de atletas,cada 2  minutos se hacen registros

$nregistros = 0;
if (isset($_COOKIE["nregistros"])) {
    $nregistros = $_COOKIE["nregistros"];
    if ($nregistros > 2) {
        echo "Ha superado el número de registros, espere dos minutos para poder volver a registrar";
        exit();
    }
}
$nregistros++;
setcookie("nregistros", $nregistros, time() + 2 * 60);


//Procesar los datos
$nombre = limpiarEntrada($_POST["nombre"]);
$categoria = limpiarEntrada($_POST["categoria"]);
$marca = limpiarEntrada($_POST["marca"]);
$fecha = date("d:m:Y G:i");

$datos = $fecha . " , " . $nombre . " , " . $categoria . " , " . $marca . " . ";

//Introducir datos en txt
define('FILEUSER', 'resultadoAltetas.txt');
if (!is_readable(FILEUSER)) {
    // El directorio donde se crea tiene que tener permisos adecuados
    $fich = @fopen(FILEUSER, "w") or die("Error al crear el fichero.");
    fclose($fich);
}

$resu = @file_put_contents(FILEUSER, $datos);


//Introducir datos en csv

define('FILEUSER2', 'resultadoAltetas.csv');

$datos_ = [];
array_push($datos_, $datos);
$fich4 = @fopen(FILEUSER2, "w");
fputcsv($fich4, $datos_);

//Introducir datos en json
define('FILEUSER3', 'resultadoAltetas.json');
//Retorna la representación JSON del valor dado

$tvalores_ = json_encode($datos);
$file = FILEUSER3;
//echo $tvalores_;
file_put_contents($file, $tvalores_);



?>