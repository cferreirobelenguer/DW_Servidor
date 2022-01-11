<?php

/*Acceso a bbdd de telefonia*/

class verpuntos{
    private static $modelo=null;
    private $dbh=null;
    private $stmt=null;

    /* MOSTRAR LOS NOMBRES Y PUNTOS DE LOS CLIENTES QUE TIENEN IGUAL O MAYOR CANTIDAD DE PUNTOS QUE LOS SOLICITADOS.
    MOSTRANDO ERROR SI NO HAY NINGÚN CLIENTE QUE TENGA ESA CANTIDAD IGUAL O SUPERIOR*/
    private static $select1=("SELECT * FROM clientes WHERE puntos>=?");
    public static function initModelo(){
        if(self::$modelo==null){
            self::$modelo=new verpuntos();
        }
        return self::$modelo;
    }

    private function __construct(){
        try{
        $dsn="mysql:host=localhost;dbname=telefonia;charset=utf8";
        //Conexión a la bbdd
        $this->dbh=new PDO($dsn,"root","");
        $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            //Mensaje en caso de error de conexión
            echo "Error de conexión ".$e->getMessage();
            exit();
        }

    }
    public function consulta1(int $puntos):array{
        $resu=[];
        //Preparo la consulta
        $stmt=$this->dbh->prepare(self::$select1);
        //Le doy unos valores
        $stmt->bindValue(1,$puntos);
        //Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if($stmt->execute()){
            while($fila =$stmt->fetch()){
                $resu[]=$fila;
            }
        }
        //Obtengo un valor que es el resultado de recorrer las filas de la consulta
        return $resu;
    }
    //Evito que se pueda clonar el objeto
    public function __clone(){
        trigger_error('La clonación no permitida',E_USER_ERROR);
    }
}