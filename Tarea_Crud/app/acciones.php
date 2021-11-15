<?php
function accionDetalles($id)
{
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario = $usuario[3];
    $orden = "Detalles";
    include_once "layout/formulario.php";
    exit();
}
//Funciones que dan de alta a nuevos usuarios
function accionAlta()
{
    $nombre  = "";
    $login   = "";
    $clave   = "";
    $comentario = "";
    $orden = "Nuevo";
    include_once "layout/formulario.php";
    exit();
}

function accionPostAlta()
{
    $repe = false;
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $nuevo = [$_POST['nombre'], $_POST['login'], $_POST['clave'], $_POST['comentario']];
    foreach ($_SESSION["tuser"] as $valor) {
        if (($_POST["login"]) == $valor[1]) {
            $repe = true;
        }
    }
    if ($repe == true) {
        echo "<center><h1 style='background-color:blue;color:white;margin-left:375px;margin-right:375px;padding:30px'>Ha introducido un login repetido</h1></center>";
    } else if ($repe == false) {
        $_SESSION['tuser'][] = $nuevo;
    }
}

function accionBorrar($id)
{
    //Función para borrar el id seleccionado
    unset($_SESSION['tuser'][$id]);
    $_SESSION['tuser'] = array_values($_SESSION['tuser']);
}

function accionModificar($id)
{
    $usuario = $_SESSION['tuser'][$id];
    $nombre  = $usuario[0];
    $login   = $usuario[1];
    $clave   = $usuario[2];
    $comentario = $usuario[3];
    $orden = "Modificar";
    include_once "layout/formulario.php";
    exit();
}
function accionTerminar()
{
    echo "<center><h1 style='background-color:blue;color:white;margin-left:375px;margin-right:375px;padding:30px'>Registro de datos finalizado</h1></center>";
    volcarDatos($_SESSION["tuser"]);
    session_destroy();
}
function accionPostModificar($id)
{
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $modificado = [$_POST['nombre'], $_POST['login'], $_POST['clave'], $_POST['comentario']];
    $_SESSION['tuser'][$id] = $modificado;
}
