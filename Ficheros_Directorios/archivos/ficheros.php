
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DESCARGA DE ARCHIVOS</title>
</head>
<body>
<h2>Muchas gracias por su visita,los datos fueron cargados</h2>

</body>
</html>
<?php
session_start();
$datosTotalesGustos=[];


//Limpia de posibles inyecciones de código
function limpiar(string $entrada):string{
    $salida=trim($entrada);
    $salida=stripslashes(($salida));
    $salida=htmlspecialchars($salida);
    return $salida;
}
//Recopilamos los datos y limpiamos el código
$cancion=limpiar($_GET["cancion"]);
$gustos=limpiar($_GET["gustos"]);

//Introducimos los gustos musicales en un array para luego volcarlo a un fichero txt, csv y json
array_push($datosTotalesGustos,$cancion);
array_push($datosTotalesGustos,$gustos);
//Creamos sesión de los datos de gustos y canciones
if(!isset($_SESSION["gustos"])){
    $_SESSION["gustos"]=$datosTotalesGustos;
}
//debug de array y sesió
//var_dump($datosTotalesGustos);
//var_dump($_SESSION["gustos"]);

//Volcamos los datos en los tres formatos de texto:txt,csv y json
//txt
define("FILEUSER","gustosMusicales.txt");
    $fichero1 = @fopen(FILEUSER, "w");
    foreach ($datosTotalesGustos as $lineas) {
        
        $total = $lineas."\n";
        
        fwrite($fichero1,$total);
    }

//csv 
    
    fclose($fichero1);

    define("FILEUSER2","gustosMusicales.csv");
    $fichero2= @fopen(FILEUSER2, "w");

    fputcsv($fichero2, $datosTotalesGustos);
    fclose($fichero2);

//json
    define("FILEUSER3","gustosMusicales.json");
      //Retorna la representación JSON del valor dado
    $tvalores_ = json_encode($datosTotalesGustos);
    $fichero3 = FILEUSER3;
      //echo $tvalores_;
    file_put_contents($fichero3, $tvalores_);
    
    

session_destroy();




?>