<?php
include_once "Producto.php";

function accionBorrar($producto)
{
    $db = AccesoDatos::getModelo();
    $tpro = $db->borrarProducto($producto);
}

function accionTerminar()
{
    AccesoDatos::closeModelo();
    session_destroy();
}

function accionAlta()
{
    $pro_ = new Producto();
    $pro_->PRODUCTO_NO= "";
    $pro_->DESCRIPCION   = "";
    $pro_->PRECIO_VALOR   = "";
    $pro_->STOCK_DISPONIBLE = "";
    $orden = "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($producto)
{
    $db = AccesoDatos::getModelo();
    $pro = $db->getProducto($producto);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($producto)
{
    $db = AccesoDatos::getModelo();
    $pro = $db->getProducto($producto);
    $orden = "Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta()
{
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $pro = new Producto();
    $pro->PRODUCTO_NO   = $_POST['PRODUCTO_NO'];
    $pro->DESCRIPCION  = $_POST['DESCRIPCION'];
    $pro->PRECIO_VALOR   = $_POST['PRECIO_VALOR'];
    $pro->STOCK_DISPONIBLE = $_POST['STOCK_DISPONIBLE'];
    $db = AccesoDatos::getModelo();
    $db->addProducto($pro);
}

function accionPostModificar()
{
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $product = new Producto();
    $product->PRODUCTO_NO   = $_POST['PRODUCTO_NO'];
    $product->DESCRIPCION  = $_POST['DESCRIPCION'];
    $product->PRECIO_VALOR   = $_POST['PRECIO_VALOR'];
    $product->STOCK_DISPONIBLE = $_POST['STOCK_DISPONIBLE'];
    $db = AccesoDatos::getModelo();
    $db->modProducto($product);
}
