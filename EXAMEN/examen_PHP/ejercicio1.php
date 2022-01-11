

<?php

$nombres = ["Juan","Pedro","María","Elena","Luis"];
$notas  = [7.5, 6.0, 7.8, 9.5, 3.5 ];

$calificaciones=[];

foreach($nombres as $clave=>$valor){
        array_push($calificaciones,$nombres[$clave],$notas[$clave]);
    }

var_dump($calificaciones);
echo ("<br>");
$datos=[];
$contador=0;
$datos1=[];
$datos2=[];
foreach($calificaciones as $clave=>$valor){
    if(is_float($calificaciones[$clave])){
        array_push($datos2,$calificaciones[$clave]);
    }else{
        array_push($datos1,$calificaciones[$clave]);
    }

}
array_push($datos,$datos1);
array_push($datos,$datos2);
print_r($datos);






?>