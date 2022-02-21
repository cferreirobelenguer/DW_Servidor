<?php
require_once 'models/Categoria.php';
require_once 'models/Producto.php';
//Punto 3
class categoriaController{
	
	public function index(){
		Utils::isAdmin();
		$categoria = new Categoria();
		$categorias = $categoria->getAll();
		
		//Muestra productos por categoría y stock disponible
		$totalcategoria=new Categoria();
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		$totalcategoria->setId($id);
		$totalcategoria=$totalcategoria->totalProductosCategorias();
		}
		require_once 'views/categoria/index.php';
	}
	//Función que muestra los productos para poder comprar
	public function ver(){
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			
			// Conseguir categoria
			//Obtiene la información de la categoría
			$categoria = new Categoria();
			$categoria->setId($id);
			$categoria = $categoria->getOne();
			
			// Conseguir productos;
			//Coge los productos dentro de esa categoría
			$producto = new Producto();
			$producto->setCategoria_id($id);
			$productos = $producto->getAllCategory();

			
		}
		//Llama a la vista
		require_once 'views/categoria/ver.php';
	}
	//función que va a permitir borrar categorías
	public function borrar(){
		//Sólo si se es administrador
		
		Utils::isAdmin();
		
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$categoria = new Categoria();
			$categoria->setId($id);
			//Sabemos si existen productos con esa categoría que queremos borrar
			$productosCategoria=$categoria->productosPorCategoria();
			//Si no hay productos (el booleano es true) se elimina la categoría
			if($productosCategoria){
				$delete = $categoria->delete();
				if($delete){
					$_SESSION['delete'] = 'complete';
				}else{
					$_SESSION['delete'] = 'failed';
				}
			}else{
				//En caso de que si hay da fallo
				$_SESSION['delete'] = 'failed';
			}
		}else{
			header('Location:'.base_url.'producto/gestion');
			$_SESSION['delete'] = 'failed';
		}
		
		header('Location:'.base_url.'categoria/index');
	}

	public function crear(){
		Utils::isAdmin();
		//Llama a views categoría crear que a su vez llama a la función save del controlador y crea nuevos datos y los almacena
		require_once 'views/categoria/crear.php';
	}
	
	public function save(){
		//Función que almacena el nombre recogido al crear la categoría
		Utils::isAdmin();
	    if(isset($_POST) && isset($_POST['nombre'])){
			// Guardar la categoria en bd
			$categoria = new Categoria();
			$categoria->setNombre($_POST['nombre']);
			$save = $categoria->save();
		}
		header("Location:".base_url."categoria/index");
	}
	public function editar(){
		//Función de administrador
		Utils::isAdmin();
		//Lee el id y si existe se crea el objeto categoría y se busca por id esa categoría
		if(isset($_GET['id'])){
			$id = $_GET['id'];
			$categoria = new Categoria();
			$categoria->setId($id);
			//Se busca la categoría por id y se llama a views/crear para modificarla aplicando la función de guardar del controlador
			$categoria = $categoria->getOne();
			require_once 'views/categoria/crear.php';
			
		}else{
			header('Location:'.base_url.'producto/gestion');
		}
	}
	
}