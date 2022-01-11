<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TELEFONIA</title>
</head>
<body>
<?php
//Recogemos los datos de puntos por GET
if(isset($_GET['puntos']) && is_numeric($_GET['puntos'])){
    $puntos=$_GET['puntos'];
}else{
    echo "<h1>Debe introducir un dato correcto</h1></br>";
    exit();
}

//Establecemos la conexión a la bbdd
$conexion=mysqli_connect("localhost","root","","telefonia");

//Se comprueba si la conexión es correcta
if(mysqli_connect_errno()){
    echo "La conexión a la base de datos ha fallado</br>";
}else{
    echo "Conexión correcta</br>";
}

//Consulta para configurar la codificación de caracteres
mysqli_query($conexion,"SET NAMES,'utf8'");

//Consulta SELECT desde PHP
$stmt=$conexion->prepare("SELECT * FROM clientes WHERE puntos>=?");

$stmt->bind_param("i",$puntos);

$stmt->execute();
$result=$stmt->get_result();
if($result){
    if($result->num_rows>0){
        echo "<table border=1><th>TELEFONO</th><th>NOMBRE</th><th>PUNTOS</th>";
        while($fila=$result->fetch_array()){
            echo "<tr>";
            echo "<td>".$fila[0]."</td>";
            echo "<td>".$fila[1]."</td>";
            echo "<td>".$fila[2]."</td";
            echo "</tr>";
        }
        echo "</table>";
    }else{
            echo "No se encuentran clientes con esos puntos</br>";
    }
}


?>
</body>
</html>