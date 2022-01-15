<?php
include_once "Producto.php";
/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    //Variable de bbdd
    private $dbh = null;
    private $stmt = null;
    
    //Se declara la bbdd
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    // Creo un lista de alimentos, podría obtenerse de una base de datos
    private function __construct(){
        //Se crea la conexión a la bbdd
        
        try {
            $dsn = "mysql:host=localhost;dbname=Empresa;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            //En caso de que no se pueda muestra error
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
        
        
        
    }
    // Construyo la consulta
    // Devuelvo la lista de Productos 
    public function obtenerListaProductos ():array {
        $tobjproductos= [];
        // Todos los productos
        $stmt = $this->dbh->prepare("select * from PRODUCTOS");
        // Todos los productos que no tienen pedidos, cuando producto_no no se encuentra en la consulta de producto_no en pedidos
        $stmt = $this->dbh->prepare("select * from PRODUCTOS where PRODUCTO_NO NOT IN "
                                    ."(SELECT PRODUCTO_NO FROM PEDIDOS) " );

        // Devuelvo una tabla de objetos al ser varios registros
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $tobjproductos=[];
        if ( $stmt->execute() ){
            $tobjproductos = $stmt->fetchAll();
        }
        return $tobjproductos;
    }
    //Se actualizan los precios de los productos de un número de producto específico
    public function actualizarPrecios($lista):int{
        $cont =0;
        $stmt = $this->dbh->prepare("UPDATE PRODUCTOS SET PRECIO_ACTUAL=PRECIO_ACTUAL*0.9 where PRODUCTO_NO = ?");
        // Devuelvo una tabla de objetos
        //Al ser precios de varios registros se usa foreach para recorrerlos
        foreach ($lista as $producto_no){
            //Se usa como parámetro producto_no
             $stmt->bindValue(1, $producto_no);
             if ( $stmt->execute() ){
                 $cont++;
                }
             }
        return $cont;
    }
    
     // Evito que se pueda clonar el objeto.
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}