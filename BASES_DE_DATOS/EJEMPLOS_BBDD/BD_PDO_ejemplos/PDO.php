
<!--EJERCICIO DE PDO QUE MUESTRA TODOS LOS REGISTROS DE LA TABLA DE PEDIDOS
DE LA BASE DE DATOS ETIENDA-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php

    //Configuramos la conexión
    $conexion=new mysqli("localhost","root","","etienda");
    //Comprobamos la conexión
    if($conexion->connect_errno){
        echo "Falló la conexion".$conexion->connect_errno;
    }
    //Configuramos el utf8
    $conexion->set_charset("utf8");
    //Se crea la consulta y se ejecuta
    $sql="SELECT * FROM pedidos";

    $resultados=$conexion->query($sql);
    //Se comprueba si hay error y en caso de que exista el error lo mata
    if($conexion->errno){
        die($conexion->error);
    }
    ?>
    <table>
        <th>NÚMERO DE PEDIDO</th>
        <th>CÓDIGO DE CLIENTE</th>
        <th>PRODUCTO</th>
        <th>PRECIO</th>
        <?php
    
    while($fila=$resultados->fetch_assoc()){
        ?>
        <tr>
            <td><?=$fila['numped']?></td>
            <td><?=$fila['cod_cliente']?></td>
            <td><?=$fila['producto']?></td>
            <td><?=$fila['precio']?></td>
        </tr>
        <?php
    }
    $conexion->close();
    ?>
    </table>
</body>
</html>