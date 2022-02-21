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
	
<?php 
//Punto 1
if (isset($edit) && isset($user) && is_object($user)) : ?>
	<h1 class="text-dark">Editar Usuario: <?= $user->nombre ?></h1>
	<?php $url_action = base_url . "usuario/save&id=" . $user->id; ?>

<?php else : ?>
	<div class="d-flex bg-dark justify-content-center text-white">
		<br>
	</div>
	<div class="d-flex bg-dark justify-content-center text-white">
		<h1>Crear Usuario</h1>
	</div>
	<div class="d-flex bg-dark justify-content-center text-white">
		<br>
	</div>
	<div class="d-flex  justify-content-center">
		<br>
	</div>
	<?php $url_action = base_url . "usuario/save"; ?>
	<!--agregue estas lineas-->
	<?php if (isset($_SESSION['register']) && $_SESSION['register'] == 'complete') : ?>
		<strong class="alert_green">Registro completado</strong>
	<?php elseif (isset($_SESSION['register']) && $_SESSION['register'] == 'failed') : ?>
		<strong class="alert_red">Registro fallido</strong>
	<?php endif; ?>
	<?php Utils::deleteSession('register'); ?>
<?php endif; ?>

<div class="form_container">

	<form action="<?= $url_action ?>" method="POST" enctype="multipart/form-data">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?= isset($user) && is_object($user) ? $user->nombre : ''; ?>" />

		<label for="apellidos">Apellidos</label>
		<textarea name="apellidos"><?= isset($user) && is_object($user) ? $user->apellidos : ''; ?></textarea>

		<label for="email">Email</label>
		<input type="text" name="email" value="<?= isset($user) && is_object($user) ? $user->email : ''; ?>" />

		<label for="password">Password</label>
		<input type="text" name="password" value="<?= isset($user) && is_object($user) ? $user->password : ''; ?>" />

		<label for="rol">Rol</label>
		<input type="text" name="rol" value="<?= isset($user) && is_object($user) ? $user->rol : ''; ?>" />


		<label for="imagen">Imagen</label>
		<?php if (isset($user) && is_object($user) && !empty($user->imagen)) : ?>
			<img src="<?= base_url ?>uploads/images/<?= $user->imagen ?>" class="thumb" class="img-fluid" alt="imagen de usuario" width="150" height="150"/>
		<?php endif; ?>
		<input type="file" name="imagen" />

		<input type="submit"  value="Guardar" class="btn btn-dark" />
	</form>
</div>
</body>
</html>
