
<?php

class accesodatos{

    //Declaración de variables
    private static $modelo=null;
    private $dbh=null;
    private $stmt=null;
    //consulta
    private static $cosulta="SELECT * FROM PEDIDOS WHERE cod_cliente=?";

    //Se crea la bbdd
    public static function initModelo(){
        if(self::$modelo==null){
            self::$modelo=new accesodatos();
        }
        return self::$modelo;
    }
    //Se crea la conexión a la bbdd
    private function __construct(){
        try{
            $dsn="mysql:host=localhost;dbname=etienda;charset=utf8";
            $this->dbh=new PDO($dsn,"root","");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        }catch(PDOException $e){
            //Se comprueba la conexión y si da error muestra mensaje de error
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
    }
    //Función que muestra la tabla de pedidos  en función de un cod_cliente que introduce usuario por post
    //Se muestran varios registros, ya que puede haber varios pedidos de un mismo cliente con lo cual se usa fetchAll y foreach
    public function getPedidos($cod_cliente){
        //Se prepara la consulta
        $stmt=$this->dbh->prepare(self::$cosulta);
        //Se coge un parámetro de cod_cliente
        $stmt->bindParam(1,$cod_cliente);
        //Se ejecuta la consulta evitando la inyección de código SQL
        $stmt->execute();
        //Se hace fetchAll ya que son varios registros los resultados
        $result=$stmt->fetchAll(PDO::FETCH_ASSOC);
        //Se crea array
        $orders=[];
        //Se recorre consulta y se meten datos en array
        foreach($result as $item){
            //Se crea objeto pedidos
            $order= new Pedidos();
            //Se van modificando todos los datos en función de como se leen en la consulta
            $order->setNumped($item['numped']);
            $order->setCod_cliente($item['cod_cliente']);
            $order->setProducto($item['producto']);
            $order->setPrecio($item['precio']);
            array_push($orders,$order);
        }
    return $orders;

    }
    public function _clone(){
        //Evito la clonación
        trigger_error('Laclonación no permitida ',E_USER_ERROR);
    }
}


