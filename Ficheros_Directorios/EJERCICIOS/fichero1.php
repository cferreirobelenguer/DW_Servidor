
<?php
/* Realizar programa php (contador.php) que muestre cuantas veces se ha accedido a la página en total
 y cuantas  veces desde un mismo navegador 
 trabajando sobre un fichero llamado accesos.txt y con un valor de cookie válido por tres meses.*/
//Contador de visitas de navegador
$visitas = 0;
if (isset($_COOKIE["visitas"])) {
    $visitas = $_COOKIE["visitas"];
}

$visitas++;
setcookie("visitas", $visitas, time() + 90 * 24 * 3600);
$contenidoFichero = "";

define('FICHERO', 'accesos.txt');

function creacionFichero()
{
    if(!isset($archivo)){
    //Se crea el archivo
    $archivo = @fopen(FICHERO, "w+b");
    if ($archivo == false) {
        echo "error al crear el archivo";
    } else {
        fwrite($archivo, $_COOKIE["visitas"]);
        }
    }
    
}
creacionFichero();
function lecturaFichero()
{
    //Abrimos el fichero para lectura
    $frecurso = @fopen(FICHERO, "r");
    $nlinea = 1;
    if (!$frecurso) {
        die(" Fallo al abrir el fichero");
    }
    $contenidoFichero = file_get_contents(FICHERO);
    $totalVisitas=0;
    if (isset($frecurso)) {
        
        while ($linea = fgets($frecurso)) {
            $totalVisitas = $linea;
            $totalVisitas += 1;
            $total = $totalVisitas . "\n" . $_COOKIE["visitas"];
            $archivo = @fopen(FICHERO, "w+b");
            fwrite($archivo,$total);
            
            if ($linea == 1) {
                break;
            }
        }
        fclose($frecurso);
    }

    echo "TOTAL DE VISITAS DE TODOS LOS NAVEGADORES " . $totalVisitas;
    echo "<br>";
    echo "TOTAL DE VISITAS DEL NAVEGADOR: " . $contenidoFichero;
    
}

if (isset($_COOKIE["visitas"])) {
   
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>FICHEROS 1</title>
    </head>

    <body>
        <h1>EL TOTAL DE VISITAS DE LA PÁGINA: </h1>
        <p>&nbsp<?php lecturaFichero(); ?></p>
    </body>

    </html>
<?php

}

?>
