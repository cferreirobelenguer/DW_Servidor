<?php

class Producto{
	private $id;
	private $categoria_id;
	private $nombre;
	private $descripcion;
	private $precio;
	private $stock;
	private $oferta;
	private $fecha;
	private $imagen;
	
	

	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}

	function getId() {
		return $this->id;
	}

	function getCategoria_id() {
		return $this->categoria_id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getDescripcion() {
		return $this->descripcion;
	}

	function getPrecio() {
		return $this->precio;
	}

	function getStock() {
		return $this->stock;
	}

	function getOferta() {
		return $this->oferta;
	}

	function getFecha() {
		return $this->fecha;
	}

	function getImagen() {
		return $this->imagen;
	}

	function setId($id) {
		$this->id = $id;
	}

	function setCategoria_id($categoria_id) {
		$this->categoria_id = $categoria_id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setDescripcion($descripcion) {
		$this->descripcion = $this->db->real_escape_string($descripcion);
	}

	function setPrecio($precio) {
		$this->precio = $this->db->real_escape_string($precio);
	}

	function setStock($stock) {
		$this->stock = $this->db->real_escape_string($stock);
	}

	function setOferta($oferta) {
		$this->oferta = $this->db->real_escape_string($oferta);
	}

	function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	public function getAll(){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY id DESC");
		return $productos;
	}
	
	
	public function getAllCategory(){
		$sql = "SELECT p.*, c.nombre AS 'catnombre' FROM productos p "
				. "INNER JOIN categorias c ON c.id = p.categoria_id "
				. "WHERE p.categoria_id = {$this->getCategoria_id()} "
				. "ORDER BY id DESC";
		$productos = $this->db->query($sql);
		return $productos;
	}
	
	public function getRandom($limit){
		$productos = $this->db->query("SELECT * FROM productos ORDER BY RAND() LIMIT $limit");
		return $productos;
	}
	
	public function getOne(){
		$producto = $this->db->query("SELECT * FROM productos WHERE id = {$this->getId()}");
		return $producto->fetch_object();
	}
	
	public function save(){
		$sql = "INSERT INTO productos VALUES(NULL, {$this->getCategoria_id()}, '{$this->getNombre()}', '{$this->getDescripcion()}', {$this->getPrecio()}, {$this->getStock()}, null, CURDATE(), '{$this->getImagen()}');";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function edit(){
		$sql = "UPDATE productos SET nombre='{$this->getNombre()}', descripcion='{$this->getDescripcion()}', precio={$this->getPrecio()}, stock={$this->getStock()}, categoria_id={$this->getCategoria_id()}  ";
		
		if($this->getImagen() != null){
			$sql .= ", imagen='{$this->getImagen()}'";
		}
		
		$sql .= " WHERE id={$this->id};";
		
		
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function delete(){
		$sql = "DELETE FROM productos WHERE id={$this->id}";
		$delete = $this->db->query($sql);
		
		$result = false;
		if($delete){
			$result = true;
		}
		return $result;
	}
	//Funciones del punto 4
	//Muestra el total de ventas
	public function totalVentas(){
		//Función que calcula las ventas totales 
		$sql =$this->db->query ("SELECT SUM(unidades) as 'TOTAL' FROM lineas_pedidos" );
		$total=$sql->fetch_assoc();
		return $total['TOTAL'];
	}
	//Muestra el producto más vendido
	public function masVendido(){
		$masVendido=$this->db->query("SELECT productos.id,productos.nombre, SUM(lineas_pedidos.unidades) as ventas FROM productos, lineas_pedidos where lineas_pedidos.id=productos.id;");
		return $masVendido;

	}
	//Muestra los nombres de los productos sin venta
	public function noVenta(){
		$sinventa=$this->db->query("SELECT * FROM productos WHERE id NOT IN(SELECT producto_id FROM lineas_pedidos)");
		return $sinventa;
	}
	//Muestra los nombres de los productos sin stock
	public function sinStock(){
		$agotado=$this->db->query("SELECT * FROM `productos` WHERE stock LIKE 0");
		return $agotado;
	}
	//Funciones del punto 7
	//Función de paginación
	public function paginacion($limite,$offset){
		$productos=$this->db->query("SELECT * FROM productos LIMIT $limite OFFSET $offset");
		return $productos;
	}
	
	//Cuenta el número de productos totales para saber hasta donde llegan las páginas
	public function contarPaginas(){
		$contar=$this->db->query("SELECT count(*) AS contar FROM productos");
		$total=$contar->fetch_object()->contar;
		return $total;
	}
	
}