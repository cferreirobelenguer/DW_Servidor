<?php
require_once 'models/Pedido.php';
require_once 'models/Usuario.php';

class pedidoController{
	
	public function hacer(){
		
		require_once 'views/pedido/hacer.php';
	}
	
	public function add(){
		if(isset($_SESSION['identity'])){
			$usuario_id = $_SESSION['identity']->id;
			$provincia = isset($_POST['provincia']) ? $_POST['provincia'] : false;
			$localidad = isset($_POST['localidad']) ? $_POST['localidad'] : false;
			$direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
			
			$stats = Utils::statsCarrito();
			$coste = $stats['total'];
				
			if($provincia && $localidad && $direccion){
				// Guardar datos en bd
				$pedido = new Pedido();
				$pedido->setUsuario_id($usuario_id);
				$pedido->setProvincia($provincia);
				$pedido->setLocalidad($localidad);
				$pedido->setDireccion($direccion);
				$pedido->setCoste($coste);
				
				$save = $pedido->save();
				
				// Guardar linea pedido
				$save_linea = $pedido->save_linea();
				
				if($save && $save_linea){
					$_SESSION['pedido'] = "complete";
					
				}else{
					$_SESSION['pedido'] = "failed";
				}
				
			}else{
				$_SESSION['pedido'] = "failed";
			}
			
			header("Location:".base_url.'pedido/confirmado');			
		}else{
			// Redigir al index
			header("Location:".base_url);
		}
	}
	
	public function confirmado(){
		if(isset($_SESSION['identity'])){
			$identity = $_SESSION['identity'];
			$pedido = new Pedido();
			$pedido->setUsuario_id($identity->id);
			
			$pedido = $pedido->getOneByUser();
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($pedido->id);
			//Se borra el carrito
			unset($_SESSION['carrito']);
		}
		require_once 'views/pedido/confirmado.php';
	}
	
	public function mis_pedidos(){
		Utils::isIdentity();
		$usuario_id = $_SESSION['identity']->id;
		$pedido = new Pedido();
		
		// Sacar los pedidos del usuario
		$pedido->setUsuario_id($usuario_id);
		$pedidos = $pedido->getAllByUser();
		
		require_once 'views/pedido/mis_pedidos.php';
	}
	
	public function detalle(){
		Utils::isIdentity();
			
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Sacar el pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			//Devuelvo objetos de pedido de clase única
			$pedido = $pedido->getOne();

			//Sacar info del usuario
			$usuario=new Usuario();
			$usuario ->setId($pedido->usuario_id);
			$usuario = $usuario->getOne();
			
			// Sacar los poductos
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($id);
			
			require_once 'views/pedido/detalle.php';
		}else{
			header('Location:'.base_url.'pedido/mis_pedidos');
		}
	}
	
	public function gestion(){
		Utils::isAdmin();
		$gestion = true;
		
		$pedido = new Pedido();
		$pedidos = $pedido->getAll();
		
		require_once 'views/pedido/mis_pedidos.php';
	}
	//Punto 9
	public function estado(){
		Utils::isAdmin();
		if(isset($_POST['pedido_id']) && isset($_POST['estado'])){
			// Recoger datos form
			$id = $_POST['pedido_id'];
			$estado = $_POST['estado'];
			
			// Upadate del pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			$pedido->setEstado($estado);
			$pedido->edit();
			
			header("Location:".base_url.'pedido/detalle&id='.$id);
		}else{
			header("Location:".base_url);
		}
	}
	//Punto 9
	//Función que cancela el pedido cuando aún no está enviado
	public function borrar(){
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			$pedido = new Pedido();
			$pedido->setId($id);
			//Cuando se pulsa cancelar pedido se cambia el atributo estado a Cancelado
			$pedido->setEstado("Cancelado");
			$pedido->edit();
			
			
			if($pedido){
				$_SESSION['delete'] = 'complete';
			}else{
				$_SESSION['delete'] = 'failed';
			}
			//Se llama a la vista para mostrar el cambio a Cancelado
			header("Location:".base_url.'pedido/detalle&id='.$id);
		}else{
			$_SESSION['delete'] = 'failed';
		}
		
		
	}
	//Punto 8
	//Función que genera pdf de los datos del pedido, uso dompdf
	public function generar(){
		//Vamos a mostrar los datos de pedido, usuario por id de pedido
		//para generar un ticket de compra en pdf cuando administrador lo solicite
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Sacar el pedido
			$pedido = new Pedido();
			$pedido->setId($id);
			//Devuelvo objetos de pedido de clase única
			$pedido = $pedido->getOne();

			//Sacar info del usuario
			$usuario=new Usuario();
			$usuario ->setId($pedido->usuario_id);
			$usuario = $usuario->getOne();
			
			// Sacar los poductos
			$pedido_productos = new Pedido();
			$productos = $pedido_productos->getProductosByPedido($id);
			
			require_once 'views/pedido/generar.php';
		}else{
			header('Location:'.base_url.'pedido/mis_pedidos');
		}
	}
	
}