<?php
//Estas son las acciones mostrarTodos y crear
//En controlador tendremos las funciones de crear usuario, modificar usuario, etc

class UsuarioController{
    
    public function mostrarTodos(){
        //Cargo mi modelo de Usuario
        require_once 'models/usuario.php';

        $usuario=new Usuario();
        $todos_los_usuarios=$usuario->conseguirTodos('usuarios');
        require_once 'views/usuarios/mostrar-todos.php';

    }

    public function crear(){
        require_once('views/usuarios/crear.php');
    }

}