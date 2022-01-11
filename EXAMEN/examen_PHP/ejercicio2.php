

<!DOCTYPE html>
<head>
<meta charset="UTF-8">
<title> Agenda App </title>
</head>
<body>
<form action="#" method="POST">
<fieldset>
<legend>Su agenda personal</legend>
    <label for="nombre">Nombre:</label><br>
    <input type='text' name='nombre' size=20
    value ="Luis">
    <input type='submit' name="orden" value="Consultar"><br>
    <label for="telefono">Teléfono:</label><br>
    <input type='tel' name='telefono' size=20
    value ="93994884">
    <input type='submit' name="orden" value="Añadir">
</fieldset>
</form>
</body>
</html>
<?php
if( ($_SERVER['REQUEST_METHOD'] == "POST")){
    //Se limpia de posible inyección de código los datos del post
    function limpiarEntrada(string $entrada): string{
        $salida = trim($entrada); 
        $salida = stripslashes($salida);
        $salida = htmlspecialchars($salida);
        return $salida;
    }
    //Comprobamos si nonbre contiene letras mayúsculas y minúsculas
    //Y si teléfono contiene números
    $nombre2="";
    $telefono2="";
    $nombre=limpiarEntrada($_POST["nombre"]);
    if (preg_match('`[a-z]`',$nombre)){
        if (preg_match('`[A-Z]`',$nombre)){
            $nombre2=$nombre;
        }
    }
    //echo $nombre2;
    $telefono=limpiarEntrada($_POST["telefono"]);
    if (preg_match('`[0-9]`',$telefono)){
        $telefono2=$telefono;
    }
    //echo $telefono2;
    
    
    switch ($_POST['orden']) {
        case "Consultar":
            //se comprueba si los datos están en el documento
            define ('FICHERO','contactos.txt');
            $encontradoNombre=false;
            $encontradoTelefono=false;
            $fichero = file(FICHERO);
            $datos_=[];
            foreach ($fichero as $linea) {
                
                if(strpos($linea,"\n")){
                    str_replace("\n",",",$linea);
                    if(str_contains($linea,$nombre2)){
                        $encontradoNombre=true;
                    }elseif(str_contains($linea,$telefono2)){
                        $encontradoTelefono=true;
                    }
                }
                
            }
            
        
            if(($encontradoNombre==true)&&($encontradoTelefono==true)){
                echo "El telefono de ".$nombre." es ".$telefono;
            }else{
                echo "No se han encontrado los datos";
            }
            

            break;
        case "Añadir":
            //se añaden al documento
            $resultado="";
            $resultado="\n".$nombre2.",".$telefono2;
            $resultado = @file_put_contents("contactos.txt",$resultado, FILE_APPEND);
            echo "Contacto anotado";
            break;
    }
}

?>