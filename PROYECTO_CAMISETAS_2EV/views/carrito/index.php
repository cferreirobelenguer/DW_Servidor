
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
	<h1>Carrito de la compra</h1>
</div>
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex  justify-content-center ">
	<br>
</div>

<?php if(isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1): ?>
<table>
	<tr>
		<th>Imagen</th>
		<th>Nombre</th>
		<th>Precio</th>
		<th>Unidades</th>
		<th>Eliminar</th>
	</tr>
	<?php 
		foreach($carrito as $indice => $elemento): 
		$producto = $elemento['producto'];
	?>
	
	<tr>
		<td>
			<?php if ($producto->imagen != null): ?>
				<!--Se añade at con descripción punto 1 accesibilidad A-->
				<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="productos de carrito" class="img-fluid" width="200" height="200"/>
			<?php else: ?>
				<img src="<?= base_url ?>assets/img/camiseta.png" class="productos de carrito" class="img-fluid" width="200" height="200"/>
			<?php endif; ?>
		</td>
		<td>
			<a class="text-dark text-decoration-none" href="<?= base_url ?>producto/ver&id=<?=$producto->id?>"><?=$producto->nombre?></a>
		</td>
		<td>
			<?=$producto->precio?>
			<?php if($producto->oferta=='si'){?>
			
			<?php
			//Precio al 10% cuando la columna oferta es si, si es no no tiene rebaja
			//Si tiene rebaja aparece el precio anterior y el actual?>
			<br><p class="text-dark">Producto rebajado al 10%<p>
			<p><span class="badge badge-secondary bg-dark lead">Antes <?=$producto->precio+round(($producto->precio*0.10))?> €</span></p><br>
			<p><span class="badge badge-secondary bg-dark lead">Ahora <?=$producto->precio?> €</span></p>
			
			
		<?php }
			?>
			
		</td>
		<td>
			<?=$elemento['unidades']?>
			<div class="updown-unidades">
				<a href="<?=base_url?>carrito/up&index=<?=$indice?>" class="btn btn-dark text-white">+</a>
				<a href="<?=base_url?>carrito/down&index=<?=$indice?>" class="btn btn-dark text-white"">-</a>
			</div>
		</td>
		<td>
			<a href="<?=base_url?>carrito/delete&index=<?=$indice?>" class="btn btn-dark text-white">Quitar producto</a>
		</td>
	</tr>
	
	<?php endforeach; ?>
</table>
<br/>
<div class="delete-carrito">
	<!--arial-label accesibilidad-->
	<a href="<?=base_url?>carrito/delete_all" arial-label="Vaciar carrito" class="btn btn-dark text-white">Vaciar carrito</a>
</div>
<div class="total-carrito">
	<!--PUNTO 10 SI PERSONALIZADO, SI LOS PEDIDOS SON SUPERIORES A 50 EUROS LOS GASTOS DE ENVÍO SON GRATIS
	SE MUESTRA EL DESCUENTO EN TODAS LAS VISTAS DE CARRITO INDEX Y PEDIDOS QUE AFECTEN AL TOTAL DEL PEDIDO-->
	<?php $stats = Utils::statsCarrito(); ?>
	<?php if($stats['total']>=50):?>
		<br><h3>Gatos de envío: -4 $ </h3><br>
		<strike>Precio total:<?=$stats['total']?> $</strike>
		<h3>Precio total: <?=$stats['total']-4?> $</h3>
	<?php else:?>
		<br><h3>Gatos de envío incluidos</h3><br>
		<h3>Precio total:<?=$stats['total']?> $</h3>
	<?php endif;?>
	
	<br>
	<h1>Elige un método de pago: </h1>
	<!--PUNTO 10 PERSONALIZADO AÑADO UN MÉTODO DE PAGO CON SESIÓN Y NO DEJA EFECTUAR EL PAGO HASTA QUE NO SE ELIGE,
	SE COGEN LOS DATOS POR CARRITO CONTROLER Y SE MUESTRA EL PAGO ELEGIDO POR CONSOLA-->
	<form action="<?=base_url?>carrito/index" method="POST">
	<!--Se añade at con descripción punto 1 accesibilidad A-->
	<!--Controles de formulario accesibles, la etiqueta for de label debe ser igual al id e identificativa con el contenido del input-->
			<p>
				<label for="Pago en tarjeta"></label>
				<img src="<?= base_url ?>assets/img/visa.png" id="Pago en tarjeta" alt="medio de pago" class="pago" class="img-fluid" width="70" height="50"/><br>
				<input type="radio" value="visa" name="pago"/>
			</p>
			<p>
				<label for="Pago en Paypal"></label>
				<img src="<?= base_url ?>assets/img/paypal.png" id="Pago en Paypal" alt="medio de pago" class="pago" class="img-fluid" width="70" height="50"/><br>
				<input type="radio" value="paypal" name="pago"/>
			</p>
			<input type="submit" value="Confirmar método de pago" class="btn btn-dark text-white text-decoration_none"/>
	</form>
	<br>
	<?php if(isset($_POST['pago'])):?>
	<!--PUNTO 10 PERSONALIZADO AÑADO UN MÉTODO DE PAGO LO LEO POR CARRITOCONTROLLER Y LO MUESTRO-->
	<!--No deja hacer el pedido hasta que no se elije un método de pago-->
	<p class="h3">Método de pago:</p><br><img src="<?= base_url ?>assets/img/<?=$pagos?>.png" class="pago" class="img-fluid" width="70" height="50"/><br>
	<br>
	<a href="<?=base_url?>pedido/hacer" class="btn btn-dark text-white">Hacer pedido</a>
	<?php else:?>
		<br>
		<h3>Debe de seleccionar un método de pago</h3>
		<br>
	<?php endif;?>
	
</div>

<?php else: ?>
	<p>El carrito está vacio, añade algun producto</p>
<?php endif; ?>
</body>
</html>