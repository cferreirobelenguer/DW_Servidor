


<?php

//EJEMPLO DE CONEXIÓN A BBDD CON FUNCIONES EN PHP

//Creamos la conexión
$conexion=mysqli_connect('localhost','root','','phpmysql');

//Comprobamos si la conexión es correcta
if(mysqli_connect_errno()){
    echo "La conexión a la base de datos ha fallado ".mysqli_connect_errno()."</br>";
}else{
    echo "Conexión realizada correctamente";
}
//Consulta para cofigurar la codificacion de caracteres
mysqli_query($conexion,"SET NAMES,'utf8'");

//Se crea la consulta y se llevan los datos a un array asociativo para mostrarlos en el servidor
//Se realiza consulta de las notas aprobadas
echo "<h1>LISTA DE NOTAS APROBADAS<h1>";
$query=mysqli_query($conexion,"SELECT*FROM notas WHERE descripcion>='5'");

while($nota=mysqli_fetch_assoc($query)){
    echo "<h2>".$nota['descripcion']."<h2/><br/>";
}

//Insertar en la base de datos desde PHP, vamos a insertar las notas de la asignatura programación
$sql="INSERT notas VALUES(null,'PROGRAMACIÓN','8','AULA MORADA')";
$insert=mysqli_query($conexion,$sql);

if($insert){
    echo "Datos insertados correctamente<br/>";
}else{
    echo "Ha habido un fallo ".mysqli_error($conexion)."<br/>";
}
