
<!--Introducir datos de atletas, pasar el dato introducido a string
y copiarlo en un fichero de texto,csv y json. Limpiar los datos introducidos de código.
Y mostrar mensaje de que los datos se han introducido, dejar seguir metiendo datos.-->
<?php
if(empty($_POST["nombre"])){
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ficha de atletas</title>
</head>
<body>
    <form action="atleta_datos.php" method="POST">
        <p>
            <label for="">Nombre: </label>
            <input type="text" name="nombre">
        </p>
        <p>
            <label for="">Categoría: </label>
            Atletismo<input type="radio" name="categoria" value="atletismo">
            Natación<input type="radio" name="categoria" value="natación">
            Baloncesto<input type="radio" name="categoria" value="baloncesto">
            Waterpolo<input type="radio" name="categoria" value="waterpolo">
        </p>
        <p>
            <label for="">Marca: </label>
            <select name="marca">
                <option selected="selected" value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </p>
        <input type="submit" name="boton" value="ENVIAR">
    </form>
</body>
</html>
<?php
}
?>