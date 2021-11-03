<?php
/*  Realizar el programa perfil.php que haciendo uso de cookies guarde en el navegador 
     la edad, sexo y deportes preferidos de un usuario durante una semana. 
     El programa mostrará los valores almacenados mediante un formulario para que el usuario pueda modificarlos o borrarlos. 
     Si no existen los cookies se mostrará los campos en blanco.*/
//Datos de nombre guardados en cookie
if (isset($_COOKIE["nombre"])) {
    $nombre = $_COOKIE["nombre"];
}
$nombre = $_POST["nombre_"];
$_COOKIE["nombre"] = $nombre;
setcookie("nombre", $nombre, time() + 3600);



//Datos de edad guardados en cookie
if (isset($_COOKIE["edad"])) {
    $edad = $_COOKIE["edad"];
}
$edad = $_POST["edad_"];
$_COOKIE["edad"] = $edad;
setcookie("edad", $edad, time() + 3600);


//Datos de sexo guardados en cookie
if (isset($_COOKIE["sexo_"])) {
    $sexo = $_COOKIE["sexo_"];
}
$sexo = $_POST["sexo"];
$_COOKIE["sexo_"] = $sexo;
setcookie("sexo_", $sexo, time() + 3600);

//Datos de deportes guardados en cookie, se pasa el array a string y se almacena la cadena en cookie
if (isset($_COOKIE["deportes"])) {
    $cadena = $_COOKIE["deportes"];
}
$cadena = "";
$deportesTotales = $_POST["deportesTotales"];
foreach ($deportesTotales as $clave => $valor) {
    $cadena = $cadena . $valor . " ";
}
$_COOKIE["deportes"] = $cadena;
setcookie("deportes", $cadena, time() + 3600);

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORMULARIO DEPORTES</title>
    <style>
        .encabezado {
            margin: auto;
            padding: 30px;
            text-align: center;
            background-color: "blue";
            color: aliceblue;
        }
    </style>
</head>

<body>
    <div class="encabezado">
        <h1>SUS DATOS ALMACENADOS</h1>
    </div>
    <?php

    //Si no existen los datos se muestra el formulario
    if (empty($_POST["nombre_"])) {
    ?>
        ?>
        <form action="#" method=POST>
            <p>
                <label for="">NOMBRE: </label>
                <input type="text" name="nombre_">
            </p>
            <p>
                <label for="">EDAD: </label>
                <input type="number" name="edad_">
            </p>
            <p>
                <label for="">SEXO: </label>
                MUJER<input type="radio" name="sexo" value="MUJER">
                HOMBRE<input type="radio" name="sexo" value="HOMBRE">
            </p>
            <p>
                <label for="">DEPORTES: </label>
                <!--Variable deportes en array-->
                <select name="deportesTotales[]" multiple size=4>
                    <option>Fúlbol</option>
                    <option selected="selected">Tennis</option>
                    <option selected="selected">Ciclismo</option>
                    <option>Otro</option>
                </select>
            </p>
            <input type="submit" name="almacenar" value="ALMACENAR VALORES">
            <input type="submit" name="eliminar" value="ELIMINAR VALORES">
        </form>

        <?php

    } else {
        if (isset($_POST["almacenar"])) {
            //Si se pulsa el botón almacenar se muestran los datos de todas las cookies
            var_dump($deportesTotales);
        ?>
            <ul>
                <li>
                    <h1>NOMBRE: <?php echo $_COOKIE["nombre"] ?></h1>
                </li>

                <li>
                    <h1>EDAD: <?php echo $_COOKIE["edad"] ?></h1>
                </li>

                <li>
                    <h1>SEXO: <?php echo $_COOKIE["sexo_"] ?></h1>
                </li>

                <li>
                    <h1>DEPORTES: <?php echo $_COOKIE["deportes"] ?></h1>
                </li>
            </ul>
            <?php
            //Botón de reseteo que vuelve al inicio
            echo "<input type='button' name='nuevo_registro' value='NUEVO REGISTRO' onclick='location.href=\"" . $_SERVER['PHP_SELF'] . "\"' >"; ?>

        <?php
        }
        if (isset($_POST["eliminar"])) {
            //Si se pulsa el botón terminar se eliminan las cookies, se muestra gracias y se muestra botón de reseteo
            setcookie("nombre", $nombre, time() - 3600);
            setcookie("edad", $edad, time() - 3600);
            setcookie("sexo", $sexo, time() - 3600);
            setcookie("deportes", $deportes, time() - 3600);
        ?>
            <h1>GRACIAS POR REGISTRARTE</h1>

            <?php
            //Botón de reseteo que vuelve al inicio
            echo "<input type='button' name='nuevo_registro' value='NUEVO REGISTRO' onclick='location.href=\"" . $_SERVER['PHP_SELF'] . "\"' >"; ?>
    <?php
        }
    }
    ?>
</body>

</html>
