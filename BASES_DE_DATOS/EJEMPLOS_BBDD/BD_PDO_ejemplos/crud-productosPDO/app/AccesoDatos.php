<?php
include_once "Producto.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos {
    

    private static $modelo = null;
    private $dbh = null;
    
    public static function getModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    

   // Constructor privado  Patron singleton
   
    private function __construct(){
        
       
         $this->dbh = new mysqli(DB_SERVER,DB_USER,DB_PASSWD,DATABASE);
         
        if ( $this->dbh->connect_error){
         die(" Error en la conexión ".$this->dbh->connect_errno);
        } 

        try {
            $dsn = "mysql:host=".DB_SERVER.";dbname=".DATABASE.";charset=utf8";
            $this->dbh = new PDO($dsn,DB_USER,DB_PASSWD);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            echo "Error de conexión ".$e->getMessage();
            exit();
        }

    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo(){
        if (self::$modelo != null){
            // Cierro la base de datos
            self::$dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // SELECT Devuelvo la lista de Producto
    public function getProductos ():array {
        $tpro = [];
        // Crea la sentencia preparada
        $stmt_productos  = $this->dbh->prepare("select * from PRODUCTOS");
        $stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        // Si falla termian el programa
        if ( $stmt_productos == false) die (__FILE__.':'.__LINE__.$this->dbh->error);
        // Ejecuto la sentencia y compruebo si ha sido existosa
        if (  $stmt_productos->execute() ){
            // Obtengo cada fila de la respuesta como un objeto de tipo Usuario
            while ( $pro = $stmt_productos->fetch()){
               $tpro[]= $pro;
            }
        }
        // Devuelvo el array de objetos
        return $tpro;
    }
    
    // SELECT Devuelvo un Producto o false
    public function getProducto (String $npro) {
        $pro = false;
        
        $stmt_productos   = $this->dbh->prepare("select * from PRODUCTOS where PRODUCTO_NO = ?");
        $stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Producto'); 
        if ( $stmt_productos == false) die ($this->dbh->error);

        // Enlazo $npro con el primer ? 
        $stmt_productos->bindValue(1,$npro);
     
        // Ejecuto la sentencia y compruebo si ha sido existosa
        if ( $stmt_productos->execute() ){
            $pro = $stmt_productos->fetch();
            }
        
        return $pro;
    }
    
    // UPDATE
    public function modProducto($pro):bool{

        $stmt_modpro = $this->dbh->prepare("update PRODUCTOS set DESCRIPCION=:DESCRIPCION, PRECIO_ACTUAL=:PRECIO_ACTUAL, STOCK_DISPONIBLE=:STOCK_DISPONIBLE where PRODUCTO_NO=:PRODUCTO_NO");
        if ( $stmt_modpro == false) die ($this->dbh->error);

        $stmt_modpro->execute( (array) $pro );
        $resu = ($stmt_modpro->rowCount () == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($pro):bool{
       
        $stmt_creapro  = $this->dbh->prepare("insert into PRODUCTOS (PRODUCTO_NO,DESCRIPCION, PRECIO_ACTUAL, STOCK_DISPONIBLE) Values(?,?,?,?)");
        if ( $stmt_creapro == false) die ($this->dbh->error);

        $stmt_creapro->bindValue(1, $pro->PRODUCTO_NO);
        $stmt_creapro->bindValue(2, $pro->DESCRIPCION);
        $stmt_creapro->bindValue(3, $pro->PRECIO_ACTUAL);
        $stmt_creapro->bindValue(4, $pro->STOCK_DISPONIBLE);
        $stmt_creapro->execute();
        $resu = ($stmt_creapro->rowCount() == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto(String $npro):bool {
        $stmt_borpro  = $this->dbh->prepare("delete from PRODUCTOS where PRODUCTO_NO =?");
        if ( $stmt_borpro == false) die ($this->dbh->error);
       
        $stmt_borpro->bindValue(1, $npro);
        $stmt_borpro->execute();
        $resu = ($stmt_borpro->rowCount()  == 1);
        return $resu;
    }   
    
     // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}

