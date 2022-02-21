<!DOCTYPE html>
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
	<h1>Gestionar categorías</h1>
</div>
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex  justify-content-center ">
	<br>
</div>


<a href="<?=base_url?>categoria/crear"  class="btn btn-dark text-white">
	Crear categoria
</a>
<br>
<br>
<!-- He metido estilo boostrap a las tablas-->
<table  class="table table-striped table-hover">
	<tr>
		<th>ID</th>
		<th>NOMBRE DE CATEGORÍA</th>
		<th>TOTAL DE UNIDADES</th>
		<th>VALOR DE STOCK EN ALMACÉN</th>
		
		
	</tr>
	<?php while($cat = $categorias->fetch_object()): ?>
		<tr>
			<td><?=$cat->id;?></td>
			<td><?=$cat->nombre;?></td>
			<td><?=$cat->cantidad;?></td>
			<td><?=$cat->stock;?></td>
			
			<td>
				<!--Botones para editar y eliminar categorías-->
				<a href="<?=base_url?>categoria/editar&id=<?=$cat->id?>"  class="btn btn-dark text-white">Editar</a><br>
				<br>
				<a href="<?=base_url?>categoria/borrar&id=<?=$cat->id?>"  class="btn btn-dark text-white">Borrar</a>
			</td>
		</tr>
	<?php endwhile; ?>
	
</a>
</table>
<br>
<br>
</body>
</html>