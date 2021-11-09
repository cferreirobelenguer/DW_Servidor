

<?php
/* . Realizar un programa (verfichero.php) donde podamos indicar un fichero de texto plano 
( .txt, html o php por ejemplo) y que me lo muestre por pantalla,
informando del número de caracteres y del número de líneas que contiene.*/
define('FICHERO', 'datos1.txt');


function creacionFichero()
{
    $archivo = @fopen(FICHERO, "w+b");
    fwrite($archivo, "Hola Mundo \nhola\npepito");
    fclose($archivo);
}
creacionFichero();
function contar()
{
    $recurso = @fopen(FICHERO, "r");
    $linea = 1;
    $contadorLinea = 0;
    $contenido = "";
    $totalLongitud = 0;
    $array = [];
    $longitud = 0;
    $contadorCaracteres = 0;
    while ($linea = fgets($recurso)) {
        //linea sin espacios en blanco
        for ($i = 0; $i < strlen($linea); $i++) {
            if (($linea[$i] != " ") && ($linea[$i] != "\n")) {
                array_push($array, $linea[$i]);
                $contadorCaracteres++;
            }
        }

        $longitud = sizeof($array);
        $totalLongitud += $longitud;
        $contenido = $contenido . $linea;
        $contadorLinea++;
        $linea++;
    }
    fclose($recurso);
    echo "El contenido del archivo es: " . $contenido;
    echo "<br>";
    echo "El número de líneas del documento es: " . $contadorLinea;
    echo "<br>";
    //var_dump($array);
    echo "El número de caracteres del documento es: " . $contadorCaracteres;
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FICHERO 2</title>
</head>

<body>
    <p><?php contar(); ?></p>
</body>

</html>
