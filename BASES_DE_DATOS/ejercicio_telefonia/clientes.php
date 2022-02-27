
<?php

class clientes{
    private $telefono;
    private $nombre;
    private $puntos;

    function getTelefono(){
        return $this->telefono;
    }
    function getNombre(){
        return $this->nombre;
    }
    function getPuntos(){
        return $this->puntos;
    }
    function setTelefono($telefono){
        $this->telefono=$telefono;
    }
    function setNombre($nombre){
        $this->nombre=$nombre;
    }
    function setPuntos($puntos){
        $this->puntos=$puntos;
    }
}
