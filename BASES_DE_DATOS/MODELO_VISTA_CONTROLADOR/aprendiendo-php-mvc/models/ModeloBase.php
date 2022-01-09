<?php
require_once 'config/database.php';
//Como modeloBase se incluye en el index.php, desde el index.php tengo acceso a todos los archivos
//De esta manera tengo disponible la conexión a la base de datos desde cualquier lugar

class ModeloBase{

    public $db;

    public function __construct(){
        $this->db=database::conectar();
    }
    //Función para conseguir todos los usuarios
    public function conseguirTodos($tabla){
        //Esto me sirve para cualquier tabla o modelo sobre el que quiera hacer consulta
        $query=$this->db->query("SELECT * FROM $tabla ORDER BY id DESC");
        return $query;
    }


}