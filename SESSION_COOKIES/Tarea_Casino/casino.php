

<?php
/*EJERCICIO CASINO:
1 FORMULARIO: SE APUESTA DINERO INICIAL
2 FORMULARIO INFORMA DEL DINERO QUE SE TIENE PARA APOSTAR Y SE PIDE CANTIDAD A POSTAR, SE ELIGE ENTRE PAR O IMPAR Y DA OPCIÓN DE APOSTAR CANTIDAD O ABANDONAR CASINO
3 PÁGINA INFORMA DE SI SE GANA O SE PIERDE Y DA OPCIÓN DE APOSTAR CANTIDAD O ABANDONAR CASINO
4 PÁGINA SI NO SE DISPONE DE CRÉDITO SUFICIENTE PARA LA APUESTA INFORMA DE ERROR Y DA LA POSIBILIDAD DE VOLVER A APOSTAR CON APOSTAR CANTIDAD Y ABANDONAR CASINO
5 PÁGINA MUCHAS GRACIAS POR JUGAR CON NOSOTROS SU CANTIDAD ES DE LO QUE SEA, ESTO ES AL PULSAR ABANDONAR CASINO*/

//Se inicia la sesión
session_start();
//Se inicia el contador de visitas a 1 que es la primera visita
$contador=1;
//DINERO APOSTADO
//Si no existe la sesión de dinero se crea y se limpia los datos del formulario, el dinero tiene que ser mayor a 0
if(isset($_POST["dinero_"])){
    $dinero=$_POST["dinero"];
    if($dinero>0){
        $dinero=htmlspecialchars($dinero);
        $dinero=trim($dinero);
        $dinero=stripslashes($dinero);
        $_SESSION["dinero_"]=$dinero;  
    }
    
}
// Si existe el cookie lo muestro
if(isset($_COOKIE["veces"])){
    $contador=$_COOKIE["veces"];

}
$contador++;
// Incremento el contador y vuelvo a fijar el valor de cookie válido por un mes
setcookie("veces", $contador, time() +30*24*3600);

    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>CASINO</title>
    </head>
    <body>
<?php


//Si botón es apostar se genera random de par o impar y se comparar la apuesta del usuario con el random
if(isset($_POST["apostar"])){
    if(isset($_POST["opcion"])){
        $numeroGenerado=random_int(1,2);
        $apuesta="";
        $resultado="";
        $dineroApostado=$_POST["apuesta"];
        if($numeroGenerado==1){
            $apuesta="PAR";
        }elseif($numeroGenerado==2){
            $apuesta="IMPAR";
        }
        $_SESSION["apuesta"]=$_POST["opcion"];
        if($_SESSION["apuesta"]==$apuesta){
            $resultado="GANASTE";
            $_SESSION["dinero_"]=$_SESSION["dinero_"]+$dineroApostado;
        }else{
            $resultado="PERDISTE";
            $_SESSION["dinero_"]=$_SESSION["dinero_"]-$dineroApostado;
        }
    
    }
    //Si el dinero apostado es menor o igual al dinero disponible se muestran los datos de la apuesta si no error
        if($dineroApostado<=$_SESSION["dinero_"]){
            ?>
            <h3>RESULTADO DE LA APUESTA:  <?php echo $_SESSION["apuesta"]?> , <?php echo $resultado?></h3>
            <h3>DISPONE DE  <?php echo $_SESSION["dinero_"]?> € PARA JUGAR</h3>
            <?php
        }else{
        ?>
            <h3>ERROR, NO DISPONE DE <?php echo $_POST["apuesta"]?> € DISPONIBLES</h3>
        <?php
        }?>
        
<form action="#" method=POST>
<p>
    <label for="" >Cantidad a apostar</label>
    <input type="text" name="apuesta">
</p>
<p>
    <label for="">PAR</label>
    <input type="radio" name="opcion" value="PAR">
    <label for="">IMPAR</label>
    <input type="radio" name="opcion" value="IMPAR">
</p>
<input type="submit" name="apostar" value="APOSTAR CANTIDAD">
<input type="submit" name="abandonar" value="ABANDONAR EL CASINO">

</form>

    <?php
    
}
//Si no existe dinero se muestra el formulario de inicio mostrando número de visitas
elseif(empty($_POST["dinero"])){

    ?>
        <h3>Esta es su <?php echo $_COOKIE["veces"]?>º visita</h3>
        <form action="#" method=POST>
            <p>
                <label for="" >Introduzca el dinero con el que va a jugar</label>
                <input type="text" name="dinero">
            </p>
        </form>
    <?php
    
    }else{
//El formulario de opción y los botones se muestran tanto si hay dinero como si se pulsa apostar
?><h3>DISPONE DE  <?php echo $_SESSION["dinero_"]?> € PARA JUGAR</h3>
<form action="#" method=POST>
<p>
    <label for="" >Cantidad a apostar</label>
    <input type="text" name="apuesta">
</p>
<p>
    <label for="">PAR</label>
    <input type="radio" name="opcion" value="PAR">
    <label for="">IMPAR</label>
    <input type="radio" name="opcion" value="IMPAR">
</p>
<input type="submit" name="apostar" value="APOSTAR CANTIDAD">
<input type="submit" name="abandonar" value="ABANDONAR EL CASINO">

</form>
<?php
    }
//Si se pulsa abandonar se refresca al menú inicial
if(isset($_POST["abandonar"])){
   
    echo "Muchas gracias por jugar con nosotros.<br>";
    echo "Su resultado final es de ".$_SESSION["dinero_"]." euros."; 
    header ('Refresh: 3; URL=casino.php');
    session_destroy();
}
    

?>
 </body>
</html>
