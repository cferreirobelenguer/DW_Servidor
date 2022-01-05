

<?php

//Conectar a la base de datos
$conexion=mysqli_connect("localhost","root","","phpmysql");

//Comprobar si la conexión es correcta
if(mysqli_connect_errno()){
  echo "La conexión a la base de datos MySQL ha fallado: ".mysqli_connect_error()."<br>";
}else{
    echo "Conexión realizada correctamente<br/>";
}

//Consulta para cofigurar la codificacion de caracteres
mysqli_query($conexion,"SET NAMES,'utf8'");

//consulta SELECT desde PHP
$query=mysqli_query($conexion,"SELECT*FROM notas");

//Array asociativo con el resultado de la consulta
//Con esto me devuelve sólo una nota
//$notas=mysqli_fetch_assoc($query);

//Si yo quiero que me devuelva todas las notas tendría que hacer un while
//Por cada iteración le doy un valor a $nota
while($nota=mysqli_fetch_assoc($query)){
    //var_dump($nota);
    echo "<h2>".$nota['titulo']."</h2><br/>";
    echo $nota['descripcion']."<br/>";
}


//Insertar en la base de datos desde PHP

$sql="INSERT INTO notas VALUES(null,'Nota desde PHP','Esto es una nota de PHP','green')";
$insert=mysqli_query($conexion,$sql);

//Con esto verificamos si la inserción se ha hecho correctamente
if($insert){
  echo "DATOS INSERTADOS CORRECTAMENTE";
}else{
  echo "Error: ".mysqli_error($conexion);
}



?>
