
<?php

require_once 'accesodatos.php';

$db=accesodatos::initModelo();

$puntos=$_GET['puntos'];


function verresu($datos){

    if(count($datos)==0){
        echo "<br>No hay resultados disponibles</br>";
    }else{
    echo "<table border='1'>";
        
    foreach($datos as $filas){
        echo "<tr>";
        foreach($filas as $clave=>$valor){
            echo "<th>".$clave."</th>";
        }
        echo "</tr>";
        echo "<tr>";
        foreach($filas as $valor){
            
            echo "<td>".$valor."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
    }
}
require_once 'verpuntos.php';