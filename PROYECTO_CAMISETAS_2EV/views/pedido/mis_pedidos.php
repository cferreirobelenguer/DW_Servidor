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

<?php if (isset($gestion)): ?>
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex bg-dark justify-content-center text-white">
	<br>
	<h1>Gestión de Pedidos</h1>
</div>
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex  justify-content-center ">
	<br>
</div>
<?php else: ?>
<div class="d-flex  justify-content-center ">
<br>
</div>
<div class="d-flex bg-dark justify-content-center text-white">
	<br>
	<h1>Mis pedidos</h1>
</div>
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>

<?php endif; ?>
<!-- He metido estilo boostrap a las tablas-->
<table  class="table table-striped table-hover">
	<tr>
		<th>Nº Pedido</th>
		<th>Coste</th>
		<th>Fecha</th>
		<th>Estado</th>
	</tr>
	<?php
	while ($ped = $pedidos->fetch_object()):
		?>

		<tr>
			<td>
				<a class="text-decoration-none lead text-dark" href="<?= base_url ?>pedido/detalle&id=<?= $ped->id ?>"><?= $ped->id ?></a>
			</td>
			<td>
			<!--PUNTO 10 PERSONALIZADO SI LOS PEDIDOS SON SUPERIORES A 50 SE DESCUENTAN 4 EUROS DE TRANSPORTE DEL PEDIDO -->
			<?php if($ped->coste>=50):?>
				<strike class="text-decoration-none lead text-dark"><?= $ped->coste ?> /$</strike>
				<p class="text-decoration-none lead text-dark"><?= $ped->coste-4 ?> $</p>
			<?php else:?>
				<p class="text-decoration-none lead text-dark"><?= $ped->coste ?> $</p>
			<?php endif;?>
				
			</td>
			<td>
			<p class="text-decoration-none lead text-dark"><?= $ped->fecha ?></p>
			</td>
			<td>
				<?=Utils::showStatus($ped->estado)?>
			</td>
		</tr>

	<?php endwhile; ?>
	
</table>
</body>
</html>