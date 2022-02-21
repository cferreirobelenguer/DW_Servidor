<?php
//Punto 1
//Se descargan los modelos de las bbdd de pedido y usuario
require_once 'models/Pedido.php';
require_once 'models/Usuario.php';


class usuarioController{
	
	public function index(){
		echo "Controlador Usuarios, Acción index";
	}
	
	public function registro(){
		require_once 'views/usuario/registro.php';
	}
	
	public function save(){
		if(isset($_POST)){
			
			$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
			$apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
			$email = isset($_POST['email']) ? $_POST['email'] : false;
			$password = isset($_POST['password']) ? $_POST['password'] : false;
			$rol = isset($_POST['rol']) ? $_POST['rol'] : false;

			if($nombre && $apellidos && $email && $password &&$rol){
				$usuario = new Usuario();
				$usuario->setNombre($nombre);
				$usuario->setApellidos($apellidos);
				$usuario->setEmail($email);
				$usuario->setPassword($password);
				$usuario->setRol($rol);

				//Se agrega opción para descargar imagen
				if(isset($_FILES['imagen'])){
					$file = $_FILES['imagen'];
					$filename = $file['name'];
					$mimetype = $file['type'];

					if($mimetype == "image/jpg" || $mimetype == 'image/jpeg' || $mimetype == 'image/png' || $mimetype == 'image/gif'){

						if(!is_dir('uploads/images')){
							mkdir('uploads/images', 0777, true);
						}

						$usuario->setImagen($filename);
						move_uploaded_file($file['tmp_name'], 'uploads/images/'.$filename);
					}
				}

				if(isset($_GET['id'])){
					$id = $_GET['id'];
					$usuario->setId($id);
					
					$save = $usuario->edit();
				}else{
					$save = $usuario->save();
				}//hasta aqui

				if($save){
					$_SESSION['register'] = "complete";
				}else{
					$_SESSION['register'] = "failed";
				}
			}else{
				$_SESSION['register'] = "failed";
			}
		}else{
			$_SESSION['register'] = "failed";
		}
		header("Location:".base_url.'usuario/crear');
	}
	
	public function login(){
		if(isset($_POST)){
			// Identificar al usuario
			// Consulta a la base de datos
			$usuario = new Usuario();
			$usuario->setEmail($_POST['email']);
			$usuario->setPassword($_POST['password']);
			
			$identity = $usuario->login();
			
			if($identity && is_object($identity)){
				$_SESSION['identity'] = $identity;
				
				if($identity->rol == 'admin'){
					$_SESSION['admin'] = true;
				}
				
			}else{
				$_SESSION['error_login'] = 'Identificación fallida !!';
			}
		
		}
		header("Location:".base_url);
	}
	//He creado función de gestión de usuarios
	public function gestion(){
		//Únicamente pueden acceder los administradores a la gestión de usuario
		Utils::isAdmin();
		
		$usuario = new Usuario();
		$usuarios = $usuario->getAll();
		
		
		require_once 'views/usuario/gestion.php';
	}
	public function crear(){
		Utils::isAdmin();
		require_once 'views/usuario/crear.php';
	}
	public function editar(){
		Utils::isAdmin();
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$edit = true;
			
			$usuario = new Usuario();
			$usuario->setId($id);
			
			$usu = $usuario->getOne();
			
			require_once 'views/usuario/crear.php';
			
		}else{
			header('Location:'.base_url.'usuario/gestion');
		}
	}
	
	public function eliminar(){
		Utils::isAdmin();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$usuario = new Usuario();
			$usuario->setId($id);
			//Llamo al chequeo de pedidos para ver si puedo borrar o no el usuario
			$chequeoPedidos=$usuario->chequear();
			
			if($chequeoPedidos){
				$delete = $usuario->delete();
				if($delete){
					$_SESSION['delete'] = 'complete';
				}else{
					$_SESSION['delete'] = 'failed';
				}
			}else{
				$_SESSION['delete'] = 'failed';
			}
		}else{
			$_SESSION['delete'] = 'failed';
		}
		
		header('Location:'.base_url.'Usuario/gestion');
	}
	
	public function logout(){
		if(isset($_SESSION['identity'])){
			unset($_SESSION['identity']);
		}
		
		if(isset($_SESSION['admin'])){
			unset($_SESSION['admin']);
		}
		//Se borra la sesión del carrito
		session_destroy();
		
		header("Location:".base_url);
	}
	
} // fin clase