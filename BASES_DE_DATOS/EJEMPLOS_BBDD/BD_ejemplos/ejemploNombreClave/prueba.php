
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 <h1>Resultados</h1>
        <?php
        //Si existe nombre y clave que se introducen por get
        if((isset($_GET['nombre']))&&(isset($_GET['clave']))){
            
            //Se recogen los datos de get en variables 
            $cliente=$_GET['nombre'];
            $valor=$_GET['clave'];
            //Se establece la conexión a la bbdd etienda
            $conexion=mysqli_connect('localhost','root','','etienda');
            
            mysqli_query($conexion,"SET NAMES,'utf8'");
            //Se busca el registro de la tabla de clientes cuyo nombre y clave es el introducido por el usuario mediante get
            $query=mysqli_query($conexion,"SELECT * FROM clientes where nombre LIKE '%$cliente%' and clave LIKE '%$valor%'");
            ?>
            <table border="1">
                <th>CÓDIGO DE CLIENTE</th>
                <th>NOMBRE</th>
                <th>CLAVE</th>
                <th>VECES</th>
            <tr>

            <?php
            //Se pasa la consulta a array asociativo y se imprimen los resultados
            while($datos=mysqli_fetch_assoc($query)){
                ?>
                <td><?=$datos['cod_cliente']?></td>
                <td><?=$datos['nombre']?></h2>
                <td><?=$datos['clave']?></h2>
                <td><?=$datos['veces']?></h2>
                <?php
            }
            ?>
            </tr>
        </table>
        <?php
        }else{
            echo "<p>No se han introducido datos</p></br>";
        }


        ?>
</body>
</html>