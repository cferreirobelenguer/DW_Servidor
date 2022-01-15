<?php
//Se importan los modelos y la conexión a la bbdd
require_once('Cliente.php');
require_once('Pedido.php');
require_once('AccesoDatos.php');

//Se llama a la conexión
$connection = AccesoDatos::initModelo();
//Se llama a getClient que es un método de AccesoDatos que recorre los datos de un cliente a través de su nombre y clave como 
//parámetros mediante un get
$cliente = $connection->getClient($_GET['nombre'], $_GET['clave']);

//Se llama a la función de buscar los datos de pedidos a través de un 
//código de cliente que se obtiene mediante la función getCodCliente() en Cliente.php
$orders = $connection->getClientOrders($cliente->getCodCliente());

//Se llama a la vista para que muestre los datos
include_once "vistaPedidos.php";