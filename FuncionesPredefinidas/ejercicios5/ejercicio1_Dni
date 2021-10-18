


<?php
/* 1. Crea un archivo php llamado nif.php que solicite un número de de DNI y 
me muestre su letra NIF correspondiente, se tiene que comprobar tanto en la parte 
cliente como servidor que  elvalor introducido esta formado solo por dígitos. 
La primera vez se mostrará el formulario y tras rellenar campo DNI se invocará al propio 
script php por  el método POST para que muestre la letra del NIF correspondiente.

Para saber que letra le corresponde a un número, se obtiene el resto de dividir el 
número entre 23 , y la letra almacenada en la posición indicada por el resto será la buscada.
 */
if(empty($_POST["nombre"])){
    ?><!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 1 DNI</title>
    </head>
    <body>
        <form action="ejercicio1_DNI.php" method="post">
            <p>
                <input type="text" name="nombre">
            </p>
            <p>
                <input type="text" name="numero">
            </p>
            <p>
                <input type="submit" id="enviar">
            </p>
        </form>
        
    </body>
    </html><?php
}else if(!empty($_POST["nombre"])){
    function datosNombre(){
    echo "RESULTADO DE LOS DATOS: <br>";
    $nombre=$_POST["nombre"];
    //Elimina los espacios en blanco
    $nombre=trim($nombre);
    //Elimina las etiquetas html
    $nombre=strip_tags($nombre);
    //Evita que el navegador mal interprete una secuencia especial de caracteres
    $nombre=htmlspecialchars($nombre);

    echo "El nombre introducido es ".$nombre.'<br>';
    }
    function datosDNI(){
        $letras=["T","R","W","A","G","M","Y","F","P","D","X","B","N","J","Z","S","Q","V","H","L","C","K","E"];
        
        $numero=$_POST["numero"];
        $numero=trim($numero);
        $numero=strip_tags($numero);
        $numero=htmlspecialchars($numero);
        //Se calcula el resto del número de dni entre 23 y es la posición
        $posicion=fmod($numero,23);
        $letra=$letras[$posicion];
        echo "Su numero de DNI es ".$numero.$letra.'<br>';
    }
    
    datosNombre();
    datosDNI();
}



?>
