

<?php
/* 2.  Realizar el programa registrar.php que sirva para dar de alta usuarios en el sistema. El programa mostrará un formulario donde se solicitará un nombre, un correo electrónico y la contraseña dos veces. El programa comprobará que ningún campo está vacío que el correo tiene un valor correcto de email y que los dos valores de la contraseña coinciden.
La contraseña tiene que ser segura para ello tiene que cumplir las siguientes reglas:
1º Tamaño  igual o superior a 8 caracteres en total.
2º Contiene  caracteres alfabéticos donde hay mayúsculas o minúsculas (una como mínimo de cada).
3º Contiene algún dígito.
4º Contiene algún carácter no alfanumérico ni dígito ni alfabético.

El programa mostrará en mensaje: Usuario registrado o error indicado el tipo de error producido debido a que falta un dato, la contraseñas no coinciden o no cumplen alguna de las reglas de seguridad.
Nota: Si es posible el chequeo también se hará, por lo menos lo más sencillo, en la parte cliente (javascripts)
*/
if(empty($_POST["nombre"])){
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Ejercicio 2 registro</title>
    </head>
    <body>
        <form action="registrar.php" method="post">
            <p>
                <label for="nombre_">Nombre: </label>
                <input type="text" name="nombre">
            </p>
            <p>
            <label for="nombre_">Correo: </label>
                <input type="text" name="correo">
            </p>
            <p>
                <label for="nombre_">Contraseña: </label>
                <input type="text" name="contraseña">
            </p>
            <p>
                <label for="nombre_">Repita contraseña: </label>
                <input type="text" name="contraseña2">
            </p>
            <input type="submit" id="enviar">
        </form>
    </body>
    </html>
    <?php
}else if(!empty($_POST["nombre"])){
    echo "FORMULARIO DE REGISTRO:<br>";
    function nombre(){
        //Limpiar nombre
        $nombre=$_POST["nombre"];
        $nombre=trim($nombre);
        $nombre=strip_tags($nombre);
        $nombre=htmlspecialchars($nombre);
        echo "NOMBRE: ".$nombre.'<br>';
    }
    function correo(){
        //Limpiar correo
        $correo=$_POST["correo"];
        $correo=trim($correo);
        $correo=strip_tags($correo);
        $correo=htmlspecialchars($correo);
        //Validar correo
        if(filter_var($correo,FILTER_VALIDATE_EMAIL)){
            
            echo "Correo validado<br>";
            echo "CORREO: ".$correo.'<br>';
        }else{
            
            echo "Debe introducir un correo en el formato correcto<br>";
        }
        
    }
    function contraseña(){
        $contraseña=$_POST["contraseña"];
        //Limpiar contraseña
        $contraseña=trim($contraseña);
        $contraeña=strip_tags($contraseña);
        $contraseña=htmlspecialchars($contraseña);
        //Limpiar contraseña repetida
        $contraseña2=$_POST["contraseña2"];
        $contraseña2=trim($contraseña2);
        $contraseña2=strip_tags($contraseña2);
        $contraseña2=htmlspecialchars($contraseña2);
        //Longitud de la cotraseña
        $longitud=strlen($contraseña);
        //Validación de la contraseña
        if($longitud>=8){
            if (preg_match('`[a-z]`',$contraseña)){
                if (preg_match('`[A-Z]`',$contraseña)){
                    if (preg_match('`[0-9]`',$contraseña)){
                        if (preg_match('`[!@#$%*()?¿"´¨Ç]`',$contraseña)){
                            if($contraseña==$contraseña2){
                                echo "Contraseña validada<br>";
                                echo "CONTRASEÑA: ".$contraseña.'<br>';
                            }else{
                                echo "Ambas contraseñas deben ser iguales<br>";
                            }
                
                        }else{
                            echo "La contraseña debe tener al menos un caracter no alfanumérico ni dígito ni número<br>";
                        }

                    }else{
                        echo "La contraseña debe tener al menos un caracter numérico<br>";
                    }
                }else{
                    echo "La contraseña debe tener al menos una mayúscula<br>";
                }

            }else{
                echo "La contraseña debe tener al menos una minúscula<br>";
            }

        }else{
            echo "La contraseña debe ser igual o mayor a 8 caracteres<br>";
        }

        
        

    }
    nombre();
    correo();
    contraseña();
}




?>
