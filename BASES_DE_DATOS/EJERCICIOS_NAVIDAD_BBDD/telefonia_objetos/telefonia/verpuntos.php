
<?php

include_once 'clientes.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>RESULTADOS</h1>
    <table border="1">
        <th>TELÉFONO</th>
        <th>NOMBRE</th>
        <th>PUNTOS</th>
    <?php
    if(isset($info)){
        //Se leen los resultados del array de objetos resultante de la consulta
        foreach ($info as $cli){
            echo "<tr>";
            //Como los atributos de clientes son privados se llaman mediante los getter, si fueran public se llamarían cli->telefono
            echo "<td>".$cli->getTelefono()."</td>";
            echo "<td>".$cli->getNombre()."</td>";
            echo "<td>".$cli->getPuntos()."</td>";
            echo "</tr>";
        }
    }
    
    ?>
    </table>
</body>
</html>