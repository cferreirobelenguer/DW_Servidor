<?php
//punto 1 
class Usuario{
	private $id;
	private $nombre;
	private $apellidos;
	private $email;
	private $password;
	private $rol;
	private $imagen;
	private $db;
	
	public function __construct() {
		$this->db = Database::connect();
	}
	
	function getId() {
		return $this->id;
	}

	function getNombre() {
		return $this->nombre;
	}

	function getApellidos() {
		return $this->apellidos;
	}

	function getEmail() {
		return $this->email;
	}

	function getPassword() {
		return password_hash($this->db->real_escape_string($this->password), PASSWORD_BCRYPT, ['cost' => 4]);
	}

	function getRol() {
		return $this->rol;
	}

	function getImagen() {
		return $this->imagen;
	}
	
	public function getAll(){
		//En esta consulta muestro todos los datos de usuarios en la vista usuario/gestion más los pedidos pendientes y el coste total de los pedidos por usuario
		$usuarios = $this->db->query("SELECT usuarios.id,usuarios.nombre,usuarios.apellidos,usuarios.email,usuarios.rol,(SELECT COUNT(*) AS pendiente FROM pedidos WHERE pedidos.usuario_id=usuarios.id AND pedidos.estado='confirm')AS pendiente,(SELECT SUM(coste) FROM pedidos WHERE usuario_id=usuarios.id) AS total FROM usuarios ORDER BY usuarios.id DESC");
		return $usuarios;
	}
	

	function setId($id) {
		$this->id = $id;
	}

	function setNombre($nombre) {
		$this->nombre = $this->db->real_escape_string($nombre);
	}

	function setApellidos($apellidos) {
		$this->apellidos = $this->db->real_escape_string($apellidos);
	}

	function setEmail($email) {
		$this->email = $this->db->real_escape_string($email);
	}

	function setPassword($password) {
		$this->password = $password;
	}

	function setRol($rol) {
		$this->rol = $rol;
	}

	function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	public function save(){
		//Función que guarda usuarios en la bbdd
		$sql = "INSERT INTO usuarios VALUES(NULL, '{$this->getNombre()}', '{$this->getApellidos()}', '{$this->getEmail()}', '{$this->getPassword()}', 'user', null);";
		$save = $this->db->query($sql);
		
		$result = false;
		if($save){
			$result = true;
		}
		return $result;
	}
	
	public function login(){
		$result = false;
		$email = $this->email;
		$password = $this->password;
		
		// Comprobar si existe el usuario
		$sql = "SELECT * FROM usuarios WHERE email = '$email'";
		$login = $this->db->query($sql);
		
		
		if($login && $login->num_rows == 1){
			$usuario = $login->fetch_object();
			
			// Verificar la contraseña
			$verify = password_verify($password, $usuario->password);
			
			if($verify){
				$result = $usuario;
			}
		}
		
		return $result;
	}
	//Se obtienen los datos de los usuarios por id de usuario
	//Consulta con sentencia precompilada
	public function getOne(){
		$sql = "SELECT * FROM usuarios WHERE id = ?";
		$stmt=$this->db->prepare($sql);
		$id=$this->getId();
		$stmt->bind_param("i",$id);
		$stmt->execute();
		$result=$stmt->get_result();
		return $result->fetch_object();
	}
	public function delete(){
		//Borra usuarios por id
		$sql = "DELETE FROM usuarios WHERE id={$this->id}";
		$delete = $this->db->query($sql);
		
		$result = false;
		if($delete){
			$result = true;
		}
		return $result;
	}
	
	function chequear(){
		//Función que chequea si un usuario no tiene pedidos pendientes
		$Nopedidos=false;
		//Se buscan pedidos con el estado pendiente
		$sql="SELECT * FROM pedidos WHERE usuario_id= '{$this->getId()}' AND estado='sended';";
		$chequear = $this->db->query($sql);
		
		if($chequear->num_rows==0){
			$Nopedidos=true;
		}
		return $Nopedidos;
	}
	
	public function edit(){
		//Función de editar usuarios, todo menos el id
		$sql = "UPDATE usuarios SET nombre='{$this->getNombre()}', apellidos='{$this->getApellidos()}', email='{$this->getEmail()}', password='{$this->getPassword()}', rol='{$this->getRol()}', imagen='{$this->getImagen()}' ";
		
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

	
}