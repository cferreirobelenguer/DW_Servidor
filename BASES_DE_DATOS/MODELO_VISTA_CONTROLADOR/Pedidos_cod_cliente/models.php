
<?php

class Pedidos{
    //Declaración de atributos que son cada columna de la tabla pedidos
    private $numped;
    private $cod_cliente;
    private $producto;
    private $precio;
    //Getter y Setter de cada uno de los atributos
    function getNumped(){
        return $this->numped;
    }
    function getCod_cliente(){
        return $this->cod_cliente;
    }
    function getProducto(){
        return $this->producto;
    }
    function getPrecio(){
        return $this->precio;
    }

    function setNumped($numped){
        $this->numped=$numped;
    }
    function setCod_cliente($cod_cliente){
        $this->cod_cliente=$cod_cliente;
    }
    function setProducto($producto){
        $this->producto=$producto;
    }
    function setPrecio($precio){
        $this->precio=$precio;
    }
    
}