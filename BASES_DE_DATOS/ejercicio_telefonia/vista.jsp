<?php include_once "clientes.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>LISTADO DE CLIENTES CON IGUAL O MAYOR Nº DE PUNTOS</h2>
    <table border="1">
    <th>TELEFONO</th>
    <th>NOMBRE</th>
    <th>PUNTOSS</th>
    
    <?php
    
    while($i=$resultados->fetch(PDO::FETCH_OBJ)):
        ?>
    <tr>    
    <td><?php echo $i->telefono?></td>
    <td><?php echo $i->nombre?></td>
    <td><?php echo $i->puntos?></td>
    </tr> 
    
    <?php
    endwhile;
    ?>
    </table>
    <h2>VALOR MÍNIMO DE PUNTOS EN TODA LA TABLA</h2>
    <?php
    while($j=$menor->fetch(PDO::FETCH_OBJ)):
        ?>
        <p><?php echo $j->minimo?></p>
    <?php
    endwhile;
    ?>

    
</body>
</html>
