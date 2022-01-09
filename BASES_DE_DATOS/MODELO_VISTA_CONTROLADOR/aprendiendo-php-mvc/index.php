
<h1>Bienvenido a mi web PHP con MVC</h1>
<?php
require_once 'autoload.php';

//Crea ficheros y muestra en función de lo que recibe en la url 

if(isset($_GET['controller'])){
    $nombre_controlador=$_GET['controller'].'Controller';
}else{
    echo "La página que buscas no existe";
    exit();
}

if (class_exists($nombre_controlador)) {
    
    $controlador = new $nombre_controlador();

    //En función de la acción me muestra una cosa u otra (crear o mostrar)
    //Si encuentra la acción y esta acción existe
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    } else {
        //En caso de que no exista muestra mensaje
        echo "La página que buscas no existe";
    }
} else {
     //En caso de que no exista muestra mensaje
    echo "La página que buscas no existe";
}
