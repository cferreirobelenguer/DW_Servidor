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

<?php if (isset($_SESSION['identity'])) : ?>
	<div class="d-flex bg-dark justify-content-center ">
		<br>
	</div>
	<div class="d-flex bg-dark justify-content-center text-white">
		<h1>Hacer pedido</h1>
	</div>
	<div class="d-flex bg-dark justify-content-center ">
		<br>
	</div>
	<div class="d-flex  justify-content-center ">
		<br>
	</div>
	<p>
		<a class="btn btn-dark text-white" href="<?= base_url ?>carrito/index">Ver los productos y el precio del pedido</a>
	</p>
	<br />

	<h3>Dirección para el envio:</h3>
	<form action="<?= base_url . 'pedido/add' ?>" method="POST">
		<label for="provincia">Provincia</label>
		<input type="text" name="provincia" required />

		<label for="ciudad">Ciudad</label>
		<input type="text" name="localidad" required />

		<label for="direccion">Dirección</label>
		<input type="text" name="direccion" required />

		<input type="submit" value="Confirmar pedido" class="btn btn-dark text-white"/>
	</form>

<?php else : ?>
	<!--Punto 4 accesibilidad A mensaje de alerta en caso de error, se abre ventana con mensaje-->
	<div role="alertdialog" aria-labelledby="alertHearing" aria-describedby="alertText">
		<h1 class="text-dark" id="alertHearing">Necesitas estar identificado</h1>
		<div id="alertText">Necesitas estar logueado en la web para poder realizar tu pedido.</div>
	</div>

<?php endif; ?>
</body>
</html>