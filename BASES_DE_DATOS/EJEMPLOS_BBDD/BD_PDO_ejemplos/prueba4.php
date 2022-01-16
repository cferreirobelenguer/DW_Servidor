<!--EJEMPLO DE CONSULTA DE TIENDA_MASTER EN LA QUE SE PIDE LA LOCALIDAD, PROVINCA,DIRECCION, ESTADO Y FECHA DE LOS PEDIDOS DE UN
CLIENTE CON UN NOMBRE Y UN EMAIL QUE INTRODUCE EL USUARIO POR PETICIÓN GET
HACERLO POR MÉTODO PDO-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>REGISTRO DE USUARIO</h1>
    <form action="prueba4.php" method="GET">
        <p>
            <label for="">Usuario:</label>
            <input type="text" name="usuario"/>
        </p>
        <p>
            <label for="">Email:</label>
            <input type="text" name="email"/>
        </p>
        <input type="submit" value="ENTRAR EN EL SISTEMA"/>
    </form>
    </body>
</html>

<?php
    if((isset($_GET['usuario'])&&(isset($_GET['email'])))){

        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
        </head>
        <body>
    <?php
    //CONEXION
    try{
        $dsn=("mysql:host=localhost;dbname=tienda_master");
        $base=new PDO($dsn,'root','');
        //echo 'Conexión OK';

        $base->exec("SET CHARACTER SET utf8");
        $sql="SELECT pedidos.provincia, pedidos.localidad,pedidos.direccion,pedidos.estado,pedidos.fecha FROM pedidos,usuarios where usuarios.nombre= ? and usuarios.email= ? and pedidos.id=usuarios.id";
        $resultado=$base->prepare($sql);

        $resultado->execute(array($_GET['usuario'],$_GET['email']));
        echo "<br>";
        echo "<table border='1'>";
        echo "<th>PROVINCIA</th>";
        echo "<th>LOCALIDAD</th>";
        echo "<th>DIRECCION</th>";
        echo "<th>ESTADO</th>";
        echo "<th>FECHA</th>";
        while($registro=$resultado->fetch(PDO::FETCH_ASSOC)){
            echo "<tr>";
            echo "<td>".$registro['provincia']."</td>";
            echo "<td>".$registro['localidad']."</td>";
            echo "<td>".$registro['direccion']."</td>";
            echo "<td>".$registro['estado']."</td>";
            echo "<td>".$registro['fecha']."</td>";
            echo "</tr>";
        }
        echo "</table>";

        $resultado->closeCursor();
    }catch(Exception $e){
        die('Error: '.$e->GetMessage());
        }
    }



?>
</body>
</html>
