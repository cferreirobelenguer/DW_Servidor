
<?php
if(isset($_POST["listafrutas"])){

if (isset($_COOKIE["galletadefrutas"])) {
    $cadena = $_COOKIE["galletadefrutas"];
}
$cadena = "";
$frutas=[];
$frutas = $_POST["listafrutas"];
foreach ($frutas as $clave => $valor) {
    $cadena = $cadena . $valor . " ";
}
$_COOKIE["galletadefrutas"] = $cadena;
setcookie("galletadefrutas", $cadena, time() + 3600);
$listado=[];
$listado = explode(" ", $cadena);
//Comprobaciones
print_r($listado);
echo ($_COOKIE["galletadefrutas"]);
?>
<legend>Sus frutas preferidas </legend>
<label for="nombre">Lista de frutas:</label><br>
<select>
    <?php
    
    foreach($listado as $clave=>$valor){  
    ?>
    <option value="<?php $listado[$clave]?>"></option>
    <?php
    }
    ?>

</select>
<?php


}else{
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> las frutas </title>
</head>
<body>
<form action="#" method=POST>
<fieldset>
<legend>Sus frutas preferidas </legend>
<label for="nombre">Lista de frutas:</label><br>
<select name="listafrutas[]" multiple >
<option value="Platano">Platano</option>
<option value="fresa" selected >fresa</option>
<option value="Naranja">Naranja</option>
<option value="Melón" selected >Melón</option>
<option value="Manzana">Manzana</option>
</select>
<input type="submit" value=" Cambiar ">
</fieldset>
</form>
</body>
</html>
<?php
}
?>