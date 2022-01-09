<?php

require_once 'ModeloBase.php';
//Objetos de clase Usuario con atributos nombre, apellidos,email y password
class Usuario extends ModeloBase{
    public $nombre;
    public $apellidos;
    public $email;
    public $password;

    public function __construct(){
        //Constructor que hereda del padre
        parent::__construct();
    }
//Métodos getter y setter
function getNombre(){
    return $this->nombre;
}
function getApellidos(){
    return $this->apellidos;
}
function getPassword(){
    return $this->password;
}
function getEmail(){
    return $this->email;
}
function setNombre($nombre){
    $this->nombre=$nombre;
}
function setApellidos($apellidos){
    $this->apellidos=$apellidos;
}
function setPassword($password){
    $this->password=$password;
}
function setEmail($email){
    $this->email=$email;
}


}

?>