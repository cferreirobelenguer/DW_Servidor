
<?php

include_once("ejemploObjetos_pildores.php");

$mazda=new Coche();
$pegaso=new Camion();
//Se llama a la función get para ver la propiedad encapsulada ruedas
echo "El mazda tiene ".$mazda->get_ruedas()." ruedas";
echo "El pegaso tiene ".$pegaso->get_ruedas()." ruedas";

$pegaso->$frenar;
$pegaso->set_color("azul","tornado");
$pegaso->arrancar();

//Estoy modificando el valor de tapicería
Coche::$tapiceria="tela";
//Muestra el valor de tapicería que es estático para todas las clases
$pegaso->mostrarTapiceria();




?>