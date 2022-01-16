
<?php
//Se llama a la bbdd y al objeto de Pedidos
require_once 'models.php';
require_once 'accesodatos.php';

//Se llama a la base de datos
$connection=accesodatos::initModelo();

//Se llama a la función getPedidos y al cod_cliente mediante petición POST

$orders=$connection->getPedidos($_POST['codigo']);

//Se llama a la vista para que muestre los resultados
include_once 'vista.php';



?>