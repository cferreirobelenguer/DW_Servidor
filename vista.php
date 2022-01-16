<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DATOS PEDIDOS</title>
</head>
<body>
    <h1>DATOS PEDIDOS POR CÓDIGO DE CLIENTE</h1>
    <?php 
    //Se verifica si existe el array y conttiene datos,
    //En caso de que se muestra mensaje
    if(empty($orders)){
        echo "<p> No existen datos </p></br>";
    }else{
        ?>
        <table>
            <th>NÚMERO DE PEDIDO</th>
            <th>CÓDIGO DE CLIENTE</th>
            <th>PRODUCTO</th>
            <th>PRECIO</th>
            
                <?php 
                //En caso de que si se leen los datos mediante los getter de cada columna de la tabla
                foreach ($orders as $order){
                    ?>
            <tr> 
                <td><?php echo $order->getNumPed()?></td>
                <td><?php echo $order->getCod_cliente()?></td>
                <td><?php echo $order->getProducto()?></td>
                <td><?php echo $order->getPrecio()?></td>
                <?php
                }
                ?>
            </tr>
        </table>
        <?php
    }
    ?>
</body>
</html>