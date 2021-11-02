?php
/* Cree una página dinámica en donde se declare una cookie con un tiempo de vigencia de cuatro horas.
Dicha cookie tendrá como objetivo almacenar el valor de código de empleado en el equipo cliente. El valor almacenado
será aleatorio ya que el objetivo es ver el mecanismo de registro de cookies. */
session_start();

//Número de empleado aleatorio almacenado en cookie
if(!isset($_COOKIE["empleado"])){
    $valor=random_int(100,1000);
    setcookie("empleado",$valor, time()+3600*4);
}else{
    $valor=$_COOKIE["empleado"];
}

//Nombre de empleado almacenado en sesión
if(!isset($_SESSION["empleado"])){
    $empleado=$_POST["empleado_"];
    $_SESSION["empleado"]=$empleado;
}else{
    $empleado=$_SESSION["empleado"];
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO DE EMPLEADOS</title>
</head>
<body>
    <?php
    //Si nombre de empleado está vacío se muestra el formulario introductorio del nombre
    if(empty($_SESSION["empleado"])){
        ?>
        <h3>FORMULARIO DE EMPLEADO</h3>
        <form action="#" method="POST">
            <p>
                <label for="">Introduzca su nombre</label>
                <input type="text" name="empleado_">
            </p>
            <input type="submit" name="validar" value="VALIDAR">
        </form>
        <?php
    //Si se pulsa validar se muestra el nombre del empleado y se da la opción de ver el número de empleado
    }elseif(isset($_POST["validar"])){
        ?>
        <h3>SU NOMBRE ES <?php echo $_SESSION["empleado"]?></h3>
        <form action="#" method="POST">
            
            <input type="submit" name="vernumero" value="VER NÚMERO DE EMPLEADO">
            <input type="submit" name="terminar" value="TERMINAR">
        </form>
        <?php
    }elseif(isset($_POST["vernumero"])){
                $departamentos=["rrhh","finanzas","marketing","comercial"];
                $departamentoAleatorio=array_rand($departamentos);
                $departamento_=$departamentos[$departamentoAleatorio];
                $_COOKIE["departamentoAsignado"]=$departamento_;
                setcookie("departamentoAsignado",$departamento_,time() +3600);
                if(isset($_COOKIE["departamentoAsignado"])){
                    $departamento_=$_COOKIE["departamentoAsignado"];
                }
                
            ?>
        
            <h3>SU NÚMERO DE EMPLEADO ES <?php echo $_COOKIE["empleado"]?></h3>
            <h3>SE LE HA ASIGNADO EL SIGUIENTE DEPARTAMENTO: <?php echo $_COOKIE["departamentoAsignado"]?></h3>
            <form action="#" method="POST">
                    <input type="submit" name="terminar" value="TERMINAR">
            </form>
            <?php
            
    }elseif(isset($_POST["terminar"])){
        ?>
        <h3>SU REGISTRO HA SIDO REALIZADO CORRECTAMENTE</h3>
        <?php echo "<input type='button' name='nuevo_registro' value='NUEVO REGISTRO' onclick='location.href=\"" . $_SERVER['PHP_SELF'] . "\"' >";?>
        <?php
        session_destroy();
        setcookie("empleado",$valor, time()-3600*4);
        setcookie("departamentoAsignado","departamento_",time() -3600);
    }

    
    
    ?>
</body>
</html>

