<?php
//El autoload permite hacer require mediante esta función de todos los controladores que hay
function autocargar($classname){
    //Para que funcione es necesario poner el directorio del controlador, y se coge por parámetro el nombre del controlador concatenado con .php
    
    include 'controllers/'.$classname.'.php';
}

spl_autoload_register('autocargar');