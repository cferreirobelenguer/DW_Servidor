<?php
/* CONTROL DE ACCESO A UNA APLICACIÓN
*  - Valida contra la base de datos
*  - Desconexta pasado 60 segundo sin volver a acceder
*  - Bloquea el acceso tras más de tres fallos consecutivos
*/

session_start();
$mensaje = "";

// Control de tiempo de la sesión 
if ( isset($_SESSION['timeout'])) {
    $horaActual = time();
    // Si han pasado 60 sg cierra la sesión
    if ( ($horaActual - $_SESSION['timeout']) > 60 ){
        session_destroy();
        header("refresh:0");
        exit();
    }
}

// HA ENTRADO EN LA APLICACIÓN Y NO PULSA SALIR

if ( isset($_SESSION['Nombre']) &&  $_SERVER['REQUEST_METHOD'] == "GET") {
    $mensaje = " $_SESSION[Nombre] Bienvenido al sistema <br>";
    $mensaje .= " Has entrado $_SESSION[accesos] veces <br>";
    $_SESSION['timeout'] = time(); // Actualizo la temporización
    include_once 'vistaapp.php';
    exit();
}

// EJEMPLO DE CONEXIÓN A LA BASE DE DATOS
// Utilizando el interfaz PDO

if ( $_SERVER['REQUEST_METHOD'] == "POST"){

    if ($_POST['orden'] == "Salir"){
        session_destroy();
        header("refresh:0");
        exit();
    }
    
    try {
        $dsn = "mysql:host=localhost;dbname=Prueba";
        $dbh = new PDO($dsn, "root", "root");
        // $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e){
        echo "Error de conexión ".$e->getMessage();
        exit();
    }
    
    
    // Filtro escapa caracteres peligrosos
    $login=   ($_POST['login']);
    $passwd = ($_POST['passwd']);
    
    // Sentencia preparada
    $stmt = $dbh->prepare("SELECT * FROM Usuario WHERE login = ?");
    $stmt->bindValue(1,$login);
    // Devuelvo una tabla asociativa
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    if ( $stmt->execute() ){
        if ( $fila = $stmt->fetch()) {
            // Si la password es correcta
            if ( $passwd == $fila['passwd']){
            unset($_SESSION['NombreError']); // No hay usuario con error
            if ( $fila['bloqueo']==0){
            $_SESSION['Nombre'] = $fila['Nombre'];
            $_SESSION['accesos'] =$fila['accesos'];
            $fila['accesos']++;
            $consulta = "UPDATE Usuario SET accesos = $fila[accesos] where login ='$_POST[login]'";
            // Consulta directa
            if ($dbh->exec($consulta) == 0){
                $mensaje = " ERROR UPDATE en la BD ".print_r($dbh->errorInfo())."<br>";
            } else {
                header("refresh:0");
            }
        } else {
               $mensaje = " Lo sentimos la cuenta $login está bloqueada ";
        }
          // Login Ok password error
          } else {
            $mensaje = "El identificador y/o la contraseña no son correctos**.<br>";
            // Si ha fallado en el mismo usuario 
            if (isset ($_SESSION['NombreError']) && $_SESSION['NombreError'] == $login){
                $_SESSION['errorPassword']++;
                if ( $_SESSION['errorPassword'] > 3){
                    $stmt = $dbh->prepare("UPDATE Usuario SET bloqueo = 1 where login =:login");
                    $stmt->bindValue(":login",$login);
                    $stmt->execute();
                    $mensaje =  " la cuenta $login ha sido bloqueada pongase en contacto con el administrador.";
                 
                }    
            } else {
                $_SESSION['NombreError'] = $login;
                $_SESSION['errorPassword'] = 1;
            }

          } 

        } else {
            $mensaje = "El identificador y/o la contraseña no son correctos.<br>";
            // Incluir mejora bloqueo de cuenta tras 3 fallos consecutivos !!!
                
        }
    } else {
        $mensaje = " ERROR de consulta a la BD ".print_r($dbh->errorInfo())."<br>";
    }
    
}

include_once 'vistaloginapp.php';