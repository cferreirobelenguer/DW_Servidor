<?php

/*
 * Acceso a datos con BD y Patrón Singleton
 */
class AccesoDatos {
    
    private static $modelo = null;
    private $dbh = null;
    private $stmt = null;
    
    // Auxiliar para genera el formulario consulta 1 de clientes
    private static $select0 = " SELECT CLIENTE_NO, NOMBRE FROM CLIENTES";
        
    //Mostrar productos con precio superior un valor ordenado por descripción.
    private static $select1 = "select * from PRODUCTOS where PRECIO_ACTUAL >= ? ORDER BY DESCRIPCION ";
    
    // Mostrar Total de pedidos y unidades pedidas por producto 
    private static $select2 = "SELECT PRODUCTO_NO,COUNT(*) AS CANTIDAD, SUM(UNIDADES) AS TOTAL FROM PEDIDOS GROUP BY PRODUCTO_NO";
    // Mostrar el departamento con mayor número de empleados.
    private static $select3 = "SELECT EMPLEADOS.EMP_NO, departamentos.DNOMBRE,COUNT(*) AS NEMPLEADOS FROM empleados,departamentos WHERE empleados.DEP_NO=departamentos.DEP_NO GROUP BY empleados.DEP_NO ORDER BY COUNT(*) DESC LIMIT 1";
    // Mostrar Código y apellido de TODOS los empleados y ciudad donde trabajan.
    private static $select4 = "SELECT EMPLEADOS.EMP_NO, EMPLEADOS.APELLIDO, DEPARTAMENTOS.LOCALIDAD FROM EMPLEADOS,DEPARTAMENTOS WHERE EMPLEADOS.DEP_NO=DEPARTAMENTOS.DEP_NO";

    // Mostrar productos no pedidos por un cliente determinado
    private static $select5 = "SELECT PRODUCTOS.PRODUCTO_NO, PRODUCTOS.DESCRIPCION, PRODUCTOS.PRECIO_ACTUAL FROM PRODUCTOS ".
    " where  PRODUCTOS.PRODUCTO_NO NOT IN ( SELECT  PEDIDOS.PRODUCTO_NO FROM PEDIDOS WHERE PEDIDOS.CLIENTE_NO = ?)";
    
    
    public static function initModelo(){
        if (self::$modelo == null){
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    
    private function __construct(){
        
        try {
            $dsn = "mysql:host=localhost;dbname=Empresa;charset=utf8";
            //Conexión a la bbdd
            $this->dbh = new PDO($dsn, "root", "");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e){
            //Mensaje en caso de error de conexión
            echo "Error de conexión ".$e->getMessage();
            exit();
        }
    }
    


    public function consulta0 ():array{
        $resu = [];
        //Preparo la consulta
        $stmt = $this->dbh->prepare(self::$select0);
        // Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ( $stmt->execute() ){
            while ( $fila = $stmt->fetch()){
                $resu[]= $fila;
            }
        }
        //Obtengo un valor que es el resultado de recorrer las filas de la consulta
        return $resu;
    }
    
    
    
    public function consulta1 (int $precio):array{
        $resu = [];
        //Preparo la consulta
        $stmt = $this->dbh->prepare(self::$select1);
        //Le doy unos valores
        $stmt->bindValue(1,$precio);
        // Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ( $stmt->execute() ){
            while ( $fila = $stmt->fetch()){
                $resu[]= $fila;
            }
        }
        //Obtengo un valor que es el resultado de recorrer las filas de la consulta
        return $resu;
    }
    
    public function consulta2 ():array {
        $resu=[];
        //Preparo la consulta
        $stmt=$this->dbh->prepare(self::$select2);
        //Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if($stmt->execute()){
            while($fila=$stmt->fetch()){
                $resu[]=$fila;
            }
        }
        return $resu;
    }
    
    public function consulta3 ():array {
        $resu=[];
        //Preparo la consulta
        $stmt=$this->dbh->prepare(self::$select3);
        //Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if($stmt->execute()){
            while($fila=$stmt->fetch()){
                $resu[]=$fila;
            }
        }
        return $resu;
    }
    public function consulta4 ():array {
        $resu=[];
        //Preparo la consulta
        $stmt=$this->dbh->prepare(self::$select4);
        //Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if($stmt->execute()){
            while($fila=$stmt->fetch()){
                $resu[]=$fila;
            }
        }
        return $resu;
    }
    public function consulta5 (int $cliente_num):array {
        $resu=[];
        //Preparo la consulta
        $stmt = $this->dbh->prepare(self::$select5);
        //Le doy unos valores
        $stmt->bindValue(1,$cliente_num);
        // Devuelvo una tabla asociativa
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        if ( $stmt->execute() ){
            while ( $fila = $stmt->fetch()){
                $resu[]= $fila;
            }
        }
        //Obtengo un valor que es el resultado de recorrer las filas de la consulta
        return $resu;
    }
    
     // Evito que se pueda clonar el objeto.
    public function __clone()
    { 
        trigger_error('La clonación no permitida', E_USER_ERROR); 
    }
}
