<?php

class Categoria{
	private $id;
	private $nombre;
	private $db;
	private $venta;
	private $stock;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	function getVenta(){
		return $this->venta;
	}
	function getStock(){
		return $this->stock;
	}
	function setVenta($venta){
		$this->venta=$venta;
	}
	function setStock($stock){
		$this->stock=$stock;
	}
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}
	//punto 3
	public function getAll(){
		//Devuelve todas las categorías con los datos de id, nombre, total de productos por categoria y valor stock
		$categorias = $this->db->query("SELECT * , (SELECT SUM(unidades) FROM lineas_pedidos l, productos p WHERE l.producto_id=p.id AND p.categoria_id = c.id) AS 'venta', (SELECT SUM(stock*precio) FROM productos WHERE categoria_id = c.id) AS 'stock', (SELECT SUM(stock) FROM productos WHERE categoria_id = c.id) as cantidad FROM categorias c ORDER BY id DESC ");
		return $categorias;
	}
	
	public function getOne(){
		//Devuelve una categoría
		$categoria = $this->db->query("SELECT * FROM categorias WHERE id={$this->getId()}");
		return $categoria->fetch_object();
	}
	//Punto 3
	public function productosPorCategoria(){
		//Consulta para saber si hay productos en esa categoría, devuelve los id de esos productos
		$Noproductos = false;
		$query =  $this->db->query("SELECT id FROM productos WHERE categoria_id= '{$this->getId()}';");
		if($query->num_rows == 0){
			//Si las filas son 0, no hay productos y devuelve true
			$Noproductos = true;
		}
		return $Noproductos;
	}
	//Punto 3
	public function save(){
		//Función para crear categorías y almacenarlas
		$sql = "INSERT INTO categorias VALUES(NULL, '{$this->getNombre()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	//Punto 3
	public function delete(){
		//Función para borrar categorías a través del id
		$sql = "DELETE FROM categorias WHERE id={$this->id}";
		$delete = $this->db->query($sql);
		
		$result = false;
		//Si existe la eliminación devuelve true, en cuyo caso categorías no tenga productos,sino devuelve false
		if($delete){
			$result = true;
		}
		return $result;
	}
	//Punto 3
	public function totalProductosCategorias(){
		//Función para mostrar el total de productos por categoría y el stock disponible
		$info = $this->db->query("SELECT productos.nombre, productos.stock FROM productos, categorías where id={$this->getId()}");
		return $info->fetch_object();

	}
	
	

}