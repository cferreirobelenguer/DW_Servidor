<?php
include_once "clientes.php";
include_once "controlador.php";

class AccesoDatos{
    private static $modelo=null;
    private $dbh=null;
    private $stmt=null;
    //Se declara la conexión
    public static function initModelo(){
        if(self::$modelo==null){
            self::$modelo=new AccesoDatos();
        }
        return self::$modelo;
    }
    //Se establece la conexión
    private function __construct(){
        try{
            $dsn="mysql:host=localhost;dbname=telefonia;charse=utf8";
            $this->dbh=new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
    }
    function consultarPuntos($puntos){
        $consulta = $this->dbh->prepare("SELECT * FROM `clientes` WHERE puntos>=?");
        $consulta->bindParam(1,$puntos);
        $consulta->execute();
        return $consulta;
    }
    function consultarmenor(){
        $consulta2=$this->dbh->prepare("SELECT min(puntos) as minimo from clientes");
        $consulta2->execute();
        return $consulta2;
    }


}
