

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

    function setTelefono(string $telefono){
        $this->telefono=$telefono;
    }
    function setNombre(string $nombre){
        $this->nombre=$nombre;
    }
    function setPuntos(int $puntos){
        $this->puntos=$puntos;
    }
}