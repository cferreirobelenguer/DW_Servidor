<?php
include_once "Producto.php";
include_once "config.php";

/*
 * Acceso a datos con BD Usuarios y Patrón Singleton 
 * Un único objeto para la clase
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

        try {
            $dsn = "mysql:host=" . SERVER_DB . ";dbname=Empresa;charset=utf8";
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
        // Construyo las consultas
        $this->stmt_productos  = $this->dbh->prepare("select * from PRODUCTOS");
        $this->stmt_producto   = $this->dbh->prepare("select * from PRODUCTOS where PRODUCTO_NO=:PRODUCTO_NO");
        $this->stmt_borpro   = $this->dbh->prepare("delete from PRODUCTOS where PRODUCTO_NO =:PRODUCTO_NO");
        $this->stmt_modpro  = $this->dbh->prepare("update PRODUCTOS set DESCRIPCION=:DESCRIPCION, PRECIO_ACTUAL=:PRECIO_ACTUAL, STOCK_DISPONIBLE=:STOCK_DISPONIBLE where PRODUCTO_NO=:PRODUCTO_NO");
        $this->stmt_creapro  = $this->dbh->prepare("insert into PRODUCTOS (PRODUCTO_NO,DESCRIPCION,PRECIO_ACTUAL,STOCK_DISPONIBLE) Values(?,?,?,?)");
    }


    // Devuelvo la lista de Productos
    public function getProductos(): array
    {
        $tpro = [];
        $this->stmt_productos->setFetchMode(PDO::FETCH_CLASS, 'Producto');

        if ($this->stmt_productos->execute()) {
            while ($pro = $this->stmt_productos->fetch()) {
                $tpro[] = $pro;
            }
        }
        return $tpro;
    }

    // Devuelvo un producto o false
    public function getProducto(String $producto)
    {
        $user = false;

        $this->stmt_producto->setFetchMode(PDO::FETCH_CLASS, 'Producto');
        $this->stmt_producto->bindParam(':PRODUCTO_NO', $producto);
        if ($this->stmt_producto->execute()) {
            if ($obj = $this->stmt_producto->fetch()) {
                $pro = $obj;
            }
        }
        return $pro;
    }

    // Cierro la conexión anulando todos los objectos relacioanado con la conexión PDO (stmt)
    public static function closeModelo()
    {
        if (self::$modelo != null) {
            $obj = self::$modelo;
            $obj->stmt_productos = null;
            $obj->stmt_producto  = null;
            $obj->stmt_borpro  = null;
            $obj->stmt_modpro = null;
            $obj->stmt_creapro = null;
            $obj->dbh = null;
            self::$modelo = null; // Borro el objeto.
        }
    }


    // UPDATE
    public function modProducto($pro): bool
    {

        $this->stmt_modpro->bindValue(':PRODUCTO_NO', $pro->PRODUCTO_NO);
        $this->stmt_modpro->bindValue(':DESCRIPCION ', $pro->DESCRIPCION);
        $this->stmt_modpro->bindValue(':PRECIO_VALOR ', $pro->PRECIO_ACTUAL);
        $this->stmt_modpro->bindValue(':STOCK_DISPONIBLE ', $pro->STOCK_DISPONIBLE);
        $this->stmt_modpro->execute();
        $resu = ($this->stmt_modpro->rowCount() == 1);
        return $resu;
    }

    //INSERT
    public function addProducto($pro): bool
    {

        $this->stmt_creapro->execute([$pro->PRODUCTO_NO, $pro->DESCRIPCION, $pro->PRECIO_ACTUAL, $pro->STOCK_DISPONIBLE]);
        $resu = ($this->stmt_creapro->rowCount() == 1);
        return $resu;
    }

    //DELETE
    public function borrarProducto(String $producto): bool
    {
        $this->stmt_borpro->bindParam(':PRODUCTO_NO', $producto);
        $this->stmt_borpro->execute();
        $resu = ($this->stmt_borpro->rowCount() == 1);
        return $resu;
    }

    // Evito que se pueda clonar el objeto. (SINGLETON)
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
