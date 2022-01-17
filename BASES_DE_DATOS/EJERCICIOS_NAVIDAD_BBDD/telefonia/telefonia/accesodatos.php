<?php


class accesodatos{
    private static $modelo=null;
    private $dbh=null;
    private $stmt=null;

    private static $consulta="SELECT nombre,puntos FROM clientes where puntos>=?";

    public static function initModelo(){
        if(self::$modelo==null){
            self::$modelo=new accesodatos();
        }
        return self::$modelo;
    }

    public function __construct(){
        try{
            $dsn="mysql:host=localhost;dbname=telefonia;charset=utf8";
            $this->dbh=new PDO($dsn,"root","");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
    }

    public function consulta_(int $puntos):array{
        $resu=[];
        $stmt=$this->dbh->prepare(self::$consulta);
        $stmt->bindValue(1,$puntos);
        //Se devuelven los resultados en un array asociativo
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if($stmt->execute()){
            while($fila=$stmt->fetch()){
                $resu[]=$fila;
            }
        }
        return $resu;
    }


}