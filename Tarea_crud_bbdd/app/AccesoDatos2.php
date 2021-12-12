<?php
include_once "Producto.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios : 
 * Usando la librería mysqli
 * Uso el Patrón Singleton :Un único objeto para la clase
 * Constructor privado, y métodos estáticos 
 */
class AccesoDatos
{

    private static $modelo = null;
    private $dbh = null;
    private $stmt_productos = null;
    private $stmt_producto  = null;
    private $stmt_borpro  = null;
    private $stmt_modpro  = null;
    private $stmt_creapro = null;

    public static function getModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }



    // Constructor privado  Patron singleton

    private function __construct()
    {


        $this->dbh = new mysqli(DB_SERVER, DB_USER, DB_PASSWD, DATABASE);

        if ($this->dbh->connect_error) {
            die(" Error en la conexión " . $this->dbh->connect_errno);
        }

        // Construyo las consultas previamente

        $this->stmt_productos  = $this->dbh->prepare("select * from PRODUCTOS");
        if ($this->stmt_productos == false) die(__FILE__ . ':' . __LINE__ . $this->dbh->error);

        $this->stmt_producto   = $this->dbh->prepare("select * from PRODUCTOS where PRODUCTO_NO =?");
        if ($this->stmt_producto == false) die($this->dbh->error);

        $this->stmt_borpro   = $this->dbh->prepare("delete from PRODUCTOS where PRODUCTO_NO =?");
        if ($this->stmt_borpro == false) die($this->dbh->error);

        $this->stmt_modpro   = $this->dbh->prepare("update PRODUCTOS set DESCRIPCION=?, PRECIO_ACTUAL=?, STOCK_DISPONIBLE=? where PRODUCTO_NO=?");
        if ($this->stmt_modpro == false) die($this->dbh->error);

        $this->stmt_creapro  = $this->dbh->prepare("insert into PRODUCTOS (PRODUCTO_NO,DESCRIPCION,PRECIO_ACTUAL,STOCK_DISPONIBLE) Values(?,?,?,?)");
        if ($this->stmt_creapro == false) die($this->dbh->error);
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo()
    {
        if (self::$modelo != null) {
            $obj = self::$modelo;
            // Cierro la base de datos
            $obj->dbh->close();
            self::$modelo = null; // Borro el objeto.
        }
    }


    // SELECT Devuelvo la lista de Usuarios
    public function getProductos(): array
    {
        $tpro = [];

        $this->stmt_productos->execute();

        $result = $this->stmt_productos->get_result();
        if ($result) {
            while ($pro = $result->fetch_object('Producto')) {
                $tpro[] = $pro;
            }
        }
        return $tpro;
    }

    // SELECT Devuelvo un usuario o false
    public function getProducto(String $producto)
    {
        $pro = false;

        $this->stmt_producto->bind_param("s", $producto);
        $this->stmt_producto->execute();
        $result = $this->stmt_producto->get_result();
        if ($result) {
            $pro = $result->fetch_object('Producto');
        }

        return $pro;
    }

    // UPDATE
    public function modProducto($pro): bool
    {


        $this->stmt_modpro->bind_param(
            "ssss",
            $pro->DESCRIPCION,
            $pro->PRECIO_ACTUAL,
            $pro->STOCK_DISPONIBLE,
            $pro->PRODUCTO_NO
        );
        $this->stmt_modpro->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($pro): bool
    {

        $this->stmt_creapro->bind_param("ssss", $pro->PRODUCTO_NO, $pro->DESCRIPCION, $pro->PRECIO_ACTUAL, $pro->STOCK_DISPONIBLE);
        $this->stmt_creapro->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto(String $producto): bool
    {
        $this->stmt_borpro->bind_param("s", $producto);
        $this->stmt_borpro->execute();
        $resu = ($this->dbh->affected_rows  == 1);
        return $resu;
    }

    // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
