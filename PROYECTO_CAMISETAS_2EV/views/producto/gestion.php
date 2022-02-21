<!DOCTYPE html>
<!-- Acessibilidad punto 3  el idioma debe ser determinado en el html mediante programación-->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<!--BOOTSTRAP -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- BOOTSTRAP -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex bg-dark justify-content-center text-white">
	<h1>Gestión de Productos<!--  --></h1>
</div>
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex  justify-content-center ">
	<br>
</div>

<a href="<?=base_url?>producto/crear" class="btn btn-dark text-white">
	Crear producto
</a>

<?php if(isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete'): ?>
	<strong class="text-dark">El producto se ha creado correctamente</strong>
<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>	
	<strong class="text-dark">El producto NO se ha creado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('producto'); ?>
	
<?php if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="text-dark">El producto se ha borrado correctamente</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>	
	<strong class="text-dark">El producto no se ha borrado correctamente</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
<h1 class="fw-bold text-dark">Datos de ventas: </h1>

<!-- He metido estilo boostrap a las tablas-->
<table  class="table table-striped table-hover">
	<th>TOTAL VENTAS</th>
	<th>PRODUCTO MÁS VENDIDO</th>
	<th>PRODUCTOS SIN VENTAS</th>
	<th>PRODUCTOS SIN EXISTENCIAS</th>
	</tr>
		<td><?=$totalVentas?></td>

		<td><table>
			<tr>
		<?php while($max=$masVendido_->fetch_object()):?>
		<td><?=$max->nombre?></td>
		<?php endwhile;?>
			</tr>
		</table></td>

		<td><table>
		
		<?php while($ve=$noVentas->fetch_object()):?>
		<tr>
		<td><?=$ve->nombre?></td>
		</tr>
		<?php endwhile;?>
		
		</table></td>

		<td><table>
			<tr>
		<?php while($sin=$noStock->fetch_object()):?>
		<tr>
		<td><?=$sin->nombre?></td>
		</tr>	
		<?php endwhile;?>
		
		</table></td>
	</tr>
	</table>
<!-- He metido estilo boostrap a las tablas-->
<table  class="table table-striped table-hover">

	<br>
	<br>
	<br>
	<br>
	<br>

	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>PRECIO</th>
		<th>STOCK</th>
		
	</tr>
	<?php while($pro = $productos->fetch_object()): ?>
		<tr>
			<td><?=$pro->id;?></td>
			<td><?=$pro->nombre;?></td>
			<td><?=$pro->precio;?></td>
			<td><?=$pro->stock;?></td>
			
			<td>
				<a href="<?=base_url?>producto/editar&id=<?=$pro->id?>" class="btn btn-dark text-white">Editar</a><br><br>
				<a href="<?=base_url?>producto/eliminar&id=<?=$pro->id?>" class="btn btn-dark text-white">borrar</a><br><br>
			</td>
		</tr>

	<?php endwhile; ?>
</table>
	<br>
	<br>
	<br>
	<br>
	<br>
	</body>
</html>