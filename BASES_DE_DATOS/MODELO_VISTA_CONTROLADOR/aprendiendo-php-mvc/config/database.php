<?php
class database{
    public static function conectar(){
        //Base de datos configurada
        //Se establece la conexión (localhost, usuario root, sin contraseña, y la bbdd notas_master)
        $conexion=new mysqli("localhost","root","","notas_master");
        //Se codifica la base de datos
        $conexion->query("SET NAMES 'utf8'");

        return $conexion;
    }
}

?>