<?php

include_once 'clientes.php';
class accesodatos{
    private static $modelo=null;
    private $dbh=null;
    private $stmt=null;


    public static function initModelo(){
        //Creación de la bbdd
        if(self::$modelo==null){
            self::$modelo=new accesodatos();
        }
        return self::$modelo;
    }

    public function __construct(){
        //Configuración de la conexión a la bbdd
        try{
            $dsn="mysql:host=localhost;dbname=telefonia;charset=utf8";
            $this->dbh=new PDO($dsn,"root","");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        $this->stmt=$this->dbh->prepare("SELECT * FROM clientes WHERE puntos>=?");
    }

    public function consulta_(int $puntos):array{
        
        $resu=[];
        //Parámetro de puntos
        $this->stmt->bindValue(1,$puntos);
        //Fetch_class porque es una clase clientes
        $this->stmt->setFetchMode(PDO::FETCH_CLASS,'clientes');
        $this->stmt->execute();
            while($cli=$this->stmt->fetch()){
                $resu[]=$cli;
            }
        return $resu;
    }

    public function clone(){
        die("No se puede clonar la conexion a BD");
    }
    public function close(){
        $this->dbh=null;
    }
}