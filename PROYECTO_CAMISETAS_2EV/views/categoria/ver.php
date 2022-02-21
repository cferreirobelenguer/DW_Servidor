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

	<?php
	//Punto 5 ofertas y punto 6 No disponible por no stock
	if (isset($categoria)) : ?>
		<p class="h1 text-center text-dark fw-bold"><?= $categoria->nombre ?></p>
		<br>
		<!-- Carousel -->
		<div id="demo" class="carousel slide" data-bs-ride="carousel">

			<div class="d-flex justify-content-center bg-dark">
				<br>
				<br>
				<!--carousel -->
				<div class="carousel-inner">
					<div class="carousel-item active">
						<a href="<?= base_url ?>"><img src="<?= base_url ?>assets/img/Tienda online.gif" class="img-fluid" alt="Portada" width="800" height="800" />
					</div>
					<div class="carousel-item">
						<a href="<?= base_url ?>"><img src="<?= base_url ?>assets/img/Tirantes.gif" class="img-fluid" alt="Portada" width="800" height="800" />
					</div>
					<div class="carousel-item">
						<a href="<?= base_url ?>"><img src="<?= base_url ?>assets/img/POP.gif" class="img-fluid" alt="Portada" width="800" height="800" />
					</div>
					<div class="carousel-item">
						<a href="<?= base_url ?>"><img src="<?= base_url ?>assets/img/Sudaderas.gif" class="img-fluid" alt="Portada" width="800" height="800" />
					</div>
					<div class="carousel-item">
						<a href="<?= base_url ?>"><img src="<?= base_url ?>assets/img/Manga larga.gif" class="img-fluid" alt="Portada" width="800" height="800" />
					</div>
					<div class="carousel-item">
						<a href="<?= base_url ?>"><img src="<?= base_url ?>assets/img/Manga corta.gif" class="img-fluid" alt="Portada" width="800" height="800" />
					</div>
				</div>

			</div>

			<!-- Left and right controls/icons -->
			<button class="carousel-control-prev" type="button" data-bs-target="#demo" data-bs-slide="prev">
				<span class="carousel-control-prev-icon"></span>
			</button>
			<button class="carousel-control-next" type="button" data-bs-target="#demo" data-bs-slide="next">
				<span class="carousel-control-next-icon"></span>
			</button>
		</div>

		<br>
		<br>
		<br>
		<?php if ($productos->num_rows == 0) : ?>
			<p class="text-dark">No hay productos para mostrar</p>
		<?php else : ?>

			<?php while ($product = $productos->fetch_object()) : ?>
				<div class="product">
					<a href="<?= base_url ?>producto/ver&id=<?= $product->id ?>">
						<?php if ($product->imagen != null) : ?>
							<img src="<?= base_url ?>uploads/images/<?= $product->imagen ?>" class="img-fluid" />
						<?php else : ?>
							<img src="<?= base_url ?>assets/img/camiseta.png" class="img-fluid" />
						<?php endif; ?>
						<h2><?= $product->nombre ?></h2>
					</a>
					<p><?= $product->precio ?></p>
					<?php if ($product->stock == 0) { ?>
						<p><span class="badge badge-secondary bg-dark lead">No disponible</span></p>
					<?php } else if ($product->oferta == 'si') { ?>
						<a href="<?= base_url ?>carrito/add&id=<?= $product->id ?>" class="btn btn-dark text-white">Comprar</a>
						<?php
						//Precio al 10% cuando la columna oferta es si, si es no no tiene rebaja
						//Si tiene rebaja aparece el precio anterior y el actual
						?>

						<br><br>
						<p><span class="badge badge-secondary bg-dark lead">Antes <?= $product->precio + round(($product->precio * 0.10)) ?> €</span></p><br>
						<p><span class="badge badge-secondary bg-dark lead">Ahora <?= $product->precio ?> €</span></p>

					<?php } else {
					?>
						<a href="<?= base_url ?>carrito/add&id=<?= $product->id ?>" class="btn btn-dark text-white">Comprar</a><br>
					<?php
					} ?>
				</div>
			<?php endwhile; ?>

		<?php endif; ?>
	<?php else : ?>
		<h1 class="text-dark">La categoría no existe</h1>
	<?php endif; ?>
</body>

</html>