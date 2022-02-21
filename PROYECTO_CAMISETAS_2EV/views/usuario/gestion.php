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
	<h1>Gestión de Usuarios</h1>
</div>
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex  justify-content-center ">
	<br>
</div>

<a href="<?=base_url?>usuario/crear" class="btn btn-dark text-white">Crear</a>

<?php if(isset($_SESSION['registro']) && $_SESSION['registro'] == 'complete'): ?>
	<strong class="text-dark">Usuario creado</strong>
<?php elseif(isset($_SESSION['registro']) && $_SESSION['registro'] != 'complete'): ?>	
	<strong class="text-dark">Usuario creado</strong>
<?php endif; ?>
<?php Utils::deleteSession('registro'); ?>
<br>
<br>
<?php 
//Punto 1
if(isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete'): ?>
	<strong class="text-dark">Usuario borrado</strong>
<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>	
	<strong class="text-dark">Usuario no borrado</strong>
<?php endif; ?>
<?php Utils::deleteSession('delete'); ?>
	<!-- He metido estilo boostrap a las tablas-->
<table  class="table table-striped table-hover">
	<tr>
		<th>ID</th>
		<th>NOMBRE</th>
		<th>APELLIDOS</th>
		<th>EMAIL</th>
		<th>ROL</th>
		<th>PEDIDOS PENDIENTES</th>
		<th>TOTAL</th>
	</tr>
	<?php while($user = $usuarios->fetch_object()): ?>
		<tr>
		<td><?=$user->id;?></td>
			<td><?=$user->nombre;?></td>
			<td><?=$user->apellidos;?></td>
			<td><?=$user->email;?></td>
			<td><?=$user->rol;?></td>
			<!--Se muestra mº de pedidos pendientes y total de pedidos por usuario-->
			<td><?=$user->pendiente?></td>
			<td><?=$user->total?></td>
			<td>
				<a href="<?=base_url?>usuario/editar&id=<?=$user->id?>" class="btn btn-dark text-white">Editar</a>
				<br>
				<br>
				<a href="<?=base_url?>usuario/eliminar&id=<?=$user->id?>" class="btn btn-dark text-white">Borrar</a>
				<br>
				<br>
			</td>
		</tr>
	<?php endwhile; ?>
</table>
<br>
<br>
</body>
</html>