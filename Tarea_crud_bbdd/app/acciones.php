<?php
include_once "Producto.php";

function accionBorrar ($producto){    
    $db = AccesoDatos::getModelo();
    $tpro = $db->borrarProducto($producto);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function accionAlta(){
    $pro = new Producto();
    $pro->PRODUCTO_NO  = "";
    $pro->DESCRIPCION   = "";
    $pro->PRECIO_ACTUAL   = "";
    $pro->STOCK_DISPONIBLE = "";
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($producto){
    $db = AccesoDatos::getModelo();
    $pro = $db->getProducto($producto);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($producto){
    $db = AccesoDatos::getModelo();
    $pro = $db->getProducto($producto);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $pro = new Producto();
    $pro->PRODUCTO_NO  = $_POST['PRODUCTO_NO'];
    $pro->DESCRIPCION   = $_POST['DESCRIPCION'];
    $pro->PRECIO_ACTUAL   = $_POST['PRECIO_ACTUAL'];
    $pro->STOCK_DISPONIBLE = $_POST['STOCK_DISPONIBLE'];
    $db = AccesoDatos::getModelo();
    $db->addProducto($pro);
    
}

function accionPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $pro = new Producto();
    $pro->PRODUCTO_NO  = $_POST['PRODUCTO_NO'];
    $pro->DESCRIPCION   = $_POST['DESCRIPCION'];
    $pro->PRECIO_ACTUAL   = $_POST['PRECIO_ACTUAL'];
    $pro->STOCK_DISPONIBLE = $_POST['STOCK_DISPONIBLE'];
    $db = AccesoDatos::getModelo();
    $db->modProducto($pro);
    
}

