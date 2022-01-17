
<?php

require_once 'accesodatos.php';

$db=accesodatos::initModelo();

//Se recoge por petición get los puntos que introduce usuario
$puntos=$_GET['puntos'];

//Se llama a la función de la consulta con el parámetro de los puntos
$info=$db->consulta_($puntos);


//Se cierra la bbdd
$db->close();
//Se llama a la vista
require_once 'verpuntos.php';