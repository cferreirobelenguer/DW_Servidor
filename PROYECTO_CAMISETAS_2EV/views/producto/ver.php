
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
<br>

<?php if (isset($product)): ?>
	<h1><?= $product->nombre ?></h1>
	<div id="detail-product">
		<div class="image">
			<?php if ($product->imagen != null): ?>
				<!-- punto 1 de accesibilidad dar descripción con alt a las imágenes-->
					<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" class="img-fluid" alt="imagen de producto" width="200" height="200"/>
				
					<?php else: ?>
				
					<img src="<?= base_url ?>assets/img/camiseta.png"  class="img-fluid" alt="imagen de producto" width="200" height="200"/>
				
			<?php endif; ?>
		</div>
		<div class="data">
			<p class="description"><?= $product->descripcion ?></p>
			<p class="price"><?= $product->precio ?>$</p>
			<?php if($product->stock==0):?>
				<p><span class="badge badge-secondary bg-dark lead">No disponible</span></p>
			<?php else:
				if($product->oferta=='si'):?>
				<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="btn btn-dark text-white">Comprar</a>
				<br><br><p><span class="badge badge-secondary bg-dark lead">Antes <?=$product->precio+round(($product->precio*0.10))?> €</span></p><br>
			<p><span class="badge badge-secondary bg-dark lead">Ahora <?=$product->precio?> €</span></p>
				<?php else:?>
				<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="btn btn-dark text-white">Comprar</a>
			<?php endif;?>
			<?php endif;?>
		</div>
	</div>
<?php else: ?>
	<!--Punto 4 accesibilidad A mensaje de alerta en caso de error, se abre ventana con mensaje-->
	<div role="alertdialog" aria-labelledby="alertHearing" aria-describedby="alertText">
		<h1 class="text-dark" id="alertHearing">Error</h1>
		<div id="alertText">El producto no existe</div>
	</div>

<?php endif; ?>
	
</body>
</html>