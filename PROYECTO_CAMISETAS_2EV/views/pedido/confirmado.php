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
	
<?php if (isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
	<div class="mt-4 p-5 bg-dark text-white rounded">
	<h1>Tu pedido se ha confirmado</h1>
	<p>
		Tu pedido ha sido guardado con exito, una vez que realices la transferencia
		bancaria a la cuenta 7382947289239ADD con el coste del pedido, será procesado y enviado.
	</p>
	</div>
	<br/>
	<?php if (isset($pedido)): ?>
		<h3>Datos del pedido:</h3>

		Número de pedido: <?= $pedido->id ?>   <br/>
		<?php 
		//PUNTO 10 PERSONALIZADO SI LOS PEDIDOS SON SUPERIORES A 50 SE DESCUENTAN 4 EUROS DE TRANSPORTE DEL PEDIDO 
		if($pedido->coste>=50):?>
			<br><h3>Gatos de envío: -4 $ </h3><br>
			<strike>Total a pagar:<?= $pedido->coste ?> $</strike>
			<h3>Precio total: <?= $pedido->coste -4?> $</h3>
		<?php else:?>
			<br><h3>Gatos de envío incluidos</h3><br>
			Total a pagar: <?= $pedido->coste ?> $ <br/>
		<?php endif;?>
		
		</br>
		Productos:

		<!-- He metido estilo boostrap a las tablas-->
		<table  class="table table-striped table-hover">
			<tr>
				<th>Imagen</th>
				<th>Nombre</th>
				<th>Precio</th>
				<th>Unidades</th>
			</tr>
			<?php while ($producto = $productos->fetch_object()): ?>
				<tr>
					<td>
						<?php if ($producto->imagen != null): ?>
							<!--La imagen lleva alt con descripción como punto 1 de accesibilidad A-->
							<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="productos_carrito" width="200" height="200"/>
						<?php else: ?>
							<!--La imagen lleva alt con descripción como punto 1 de accesibilidad A-->
							<img src="<?= base_url ?>assets/img/camiseta.png" class="productos_carrito" width="200" height="200"/>
						<?php endif; ?>
					</td>
					<td>
						<a class="text-decoration-none text-dark" href="<?= base_url ?>producto/ver&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
					</td>
					<td>
						<?= $producto->precio ?>
					</td>
					<td>
						<?= $producto->unidades ?>
					</td>
				</tr>
			<?php endwhile; ?>
		</table>
		<!--He incluido generar pdf en pedido confirmado y en pedido detalle. En pedido confirmado los usuarios pueden imprimir sus tickets
	y en pedido detalle la funcionalidad es sólo para administrador-->
		<br>
			<a href="<?=base_url?>pedido/generar&id=<?=$pedido->id?>" class="btn btn-dark text-white">Generar pdf</a>
		<br>
		<br>
	
		<div class="delete-carrito">
			<a href="<?=base_url?>" class="btn btn-dark text-white">Aceptar</a>
		</div>

	<?php endif; ?>

<?php else: ?>
	<!--Punto 4 accesibilidad A mensaje de alerta en caso de error, se abre ventana con mensaje-->
	<div role="alertdialog" aria-labelledby="alertHearing" aria-describedby="alertText">
		<h1 class="text-dark" id="alertHearing">Error<</h1>
		<div id="alertText">Tu pedido no se ha podido procesar</div>
		
	</div>

<?php endif; ?>
</body>
</html>