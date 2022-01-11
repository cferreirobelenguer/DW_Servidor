<?php
//Incluímos la bbdd al index.php
include_once 'verpuntos.php';
$db=verpuntos::initModelo();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TELEFONÍA</title>
</head>
<body>
    <!--Petición de consulta por GET-->
    <form name="consulta" method="GET">
        <p>
            <label for="">Introduzca puntos a consultar</label>
            <input type="text" name="puntos"/>
        </p>
        <h1>MOSTRAR LOS NOMBRES Y PUNTOS DE LOS CLIENTES QUE TIENEN IGUAL O MAYOR CANTIDAD DE PUNTOS QUE LOS SOLICITADOS.
            MOSTRANDO ERROR SI NO HAY NINGÚN CLIENTE QUE TENGA ESA CANTIDAD IGUAL O SUPERIOR</h1>
        <input type="submit" value="PROCESAR CONSULTA"/>
    </form>
    <?php
    if($_SERVER['REQUEST_METHOD']=='GET'){
            verresu($db->consulta1(intval($_GET['puntos'])));
        
    }

    function verresu($datos){
        //Si no hay datos no se muestra nada
        if(count($datos)==0){
            echo "<br>No hay resultados disponibles.<br>";
            return;
        }
        //Se leen los datos de las consultas en formato tabla
        echo "<table>";
        $cabecera=false;
        //Si existen datos en la cabecera de la consulta se leen como cabecera de la tabla
        foreach($datos as $fila){
            if($cabecera==true){
                echo "<tr>";
                foreach($fila as $clave=>$valor){
                    echo "<th>".$clave."</th>";
                }
                echo "</tr>";
                $cabecera=true;
            }
            //Se lee la consulta por filas en un array asociativo en formato tabla html
            echo "<tr>";
            foreach($fila as $valor){
                echo "<td>$valor </td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        
    }

    ?>
</body>
</html>
