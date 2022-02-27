<?php
include_once 'AccesoDatos.php';

// CONTROLADOR

if (isset ($_POST['puntos'])){
    $puntos= $_POST['puntos'];
} else {

    include_once 'error.php';
    exit();
}

// Accedo al Modelo
$conexdb = AccesoDatos::initModelo();
$resultados = $conexdb->consultarPuntos($puntos);
$menor=$conexdb->consultarmenor();

include_once 'vista.php';


?>
