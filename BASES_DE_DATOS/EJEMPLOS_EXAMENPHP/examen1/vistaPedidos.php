<!DOCTYPE html>
<html>

<head>
   <meta charset="UTF-8">
   <link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>
   <div id="container" style="width: 380px;">
      <div id="header">
         <h1>CLIENTESPLUS MVC</h1>
      </div>
      <div id="content">
         <!-- Si no existe cliente-->
         <?php if ($cliente === null) { ?>
            <p>No estás registrado</p>
         <?php } else { ?>
            <!-- Si usuario existe se muestra, su nombre y las veces que ha entrado mediante getNombre y getVeces que vienen de Cliente.php-->
            <h3>Bienvenido usuario: <?php echo $cliente->getNombre() ?>. Has entrado <?php echo $cliente->getVeces() ?> veces en nuestra web</h3>
            <?php if (empty($orders)) { ?>
               <p>No existen pedidos para este cliente.</p>
            <?php } else { ?>
               <?php $total = 0; ?>
               <table>
               <?php foreach ($orders as $order) { ?>    
                  <tr>
                     <!-- Se recorre el array asociativo creado en AccesoDatos.php llamado orders que recoge los datos de la tabla pedidos
                     correspondientes a ese cod_cliente, y se obtienen los datos mediante getProductos y getPrecio métodos de Pedido.php-->
                     <td><?php echo $order->getProducto() ?></td>
                     <td><?php echo $order->getPrecio() ?></td>
                  </tr>
                  <!--Se calcula el total del precio de todos los pedidos-->
                  <?php $total += $order->getPrecio(); ?>
               <?php } ?>
                  <tr>
                     <td>TOTAL PEDIDOS</td>
                     <td><?php echo $total ?></td>
                  </tr>
               </table>
            <?php } ?>
         <?php } ?>
      </div>
   </div>
</body>

</html>