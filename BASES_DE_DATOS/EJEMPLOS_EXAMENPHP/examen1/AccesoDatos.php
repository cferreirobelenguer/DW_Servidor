<?php

//el bind value solo se utiliza cuando se pasa un parámetro por ? (o sea POST o GET)

/*
 * Acceso a datos con BD y Patrón Singleton
 * Aquí van las consultas
 */
class AccesoDatos
{
    //Declaración del modelo de bbdd
    private static $modelo = null;
    //Declaración de la conexión a la bbss
    private $dbh = null;
    private $stmt = null;

    //Consultas
    //Se obtiene la tabla de clientes cuyo nombre y clave son unos determinados que introduce el usuario
    private static $getClientQuery = "SELECT * FROM clientes WHERE nombre = ? AND clave = ?";
    //Se obtiene la tabla de pedidos en función del código de cliente
    private static $getClientOrders = "SELECT * FROM pedidos WHERE cod_cliente = ?";
    //Se actualiza (se incrementa en 1) la columna veces cuando usuario introduce su número
    private static $updateClientTimes = "UPDATE clientes SET veces = veces+1 WHERE nombre = ?";

    //Creación de la base de datos
    public static function initModelo()
    {
        if (self::$modelo == null) {
            self::$modelo = new AccesoDatos();
        }
        return self::$modelo;
    }
    //Constructor que crea la conexión a la bbdd
    private function __construct()
    {

        try {
            //Se configura la conexión
            $dsn = "mysql:host=localhost;dbname=etienda;charset=utf8";
            $this->dbh = new PDO($dsn, "root", " ");
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //En caso de error se muestra mensaje
            echo "Error de conexión " . $e->getMessage();
            exit();
        }
    }
    //Método que configura la actualización de veces y obtiene los resultados de la consulta de obtener tabla de clientes
    public function getClient($nombre, $clave)
    {
        //Se llama a la consulta de actualización de veces tomando como parámetro el nombre introducido por el usuario
        $this->updateClientTimes($nombre);
        
        //Se llama a la consulta de obtener la tabla de clientes por nombre y clave
        $stmt = $this->dbh->prepare(self::$getClientQuery);
        //Se toman los parámetros de nombre y clave que se necesitan para obtener la tabla de clientes
        $stmt->bindParam(1, $nombre);
        $stmt->bindParam(2, $clave);

        $stmt->execute();
        //El registro es cada cliente, en este caso se pide un registro específico por eso se hace el while porque el while
        //lee una fila y todos los atributos correspondientes de la bbdd a esa fila.
        //Se lee el registro de ese cliente específico
        //Se pasa cada columna a un array asociativo
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            //Se crea un objeto de cliente
            $client = new Cliente();
            //Se van cogiendo los datos de cada fila (cod_cliente, nombre, veces, clave)
            $client->setCodCliente($row['cod_cliente']);
            $client->setNombre($row['nombre']);
            $client->setVeces($row['veces']);
            $client->setClave($row['clave']);
            //Devuelve los datos del array
            return $client;
        }
    }

    public function getClientOrders($codCliente)
    {
        //Se llama a la consulta de obtener los clientes por cod_cliente
        $stmt = $this->dbh->prepare(self::$getClientOrders);
        //Se coge como parámetro el codigo de cliente
        $stmt->bindParam(1, $codCliente);

        $stmt->execute();
        //Se pasa a array asociativo
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        //SE CREA EL ARRAY
        $orders = [];
        //Cuando se recorren varios registros se utiliza un foreach
        //Se recorre el array y se van metiendo los resultados de la consulta
        //Se buscan todos los datos de todos los atributos de la tabla pedidos que correspondan a un cod_cliente determinado
        //Son varios registros con lo cual se usa un foreach
        foreach ($result as $item) {
            $order = new Pedido();
            //Se recorre la tabla pedidos para ver cuántos clientes coinciden con el cod_cliente buscado
            $order->setNumPed($item['numped']);
            $order->setCodCliente($item['cod_cliente']);
            $order->setPrecio($item['precio']);
            $order->setProducto($item['producto']);
            //Se introducen los datos recogidos del recorrido del for en al array
            array_push($orders, $order);
        }

        return $orders;
    }
    //Se actualiza cogiendo como parámetro nombre las veces que el cliente entra
    public function updateClientTimes($nombre) {
        //Se llama a la consulta de actualizar veces
        $stmt = $this->dbh->prepare(self::$updateClientTimes);
        //Se toma como parámetro nombre
        $stmt->bindParam(1, $nombre);
        //Se ejecuta
        $stmt->execute();
    }



    // Evito que se pueda clonar el objeto.
    public function __clone()
    {
        trigger_error('La clonación no permitida', E_USER_ERROR);
    }
}
