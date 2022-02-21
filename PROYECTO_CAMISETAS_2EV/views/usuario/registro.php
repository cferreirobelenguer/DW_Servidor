
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
	<h1>Registrarse</h1>
</div>
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex  justify-content-center ">
	<br>
</div>

<?php 
//Punto 1
if(isset($_SESSION['register']) && $_SESSION['register'] == 'complete'): ?>
	<strong class="text-dark">Registro completado correctamente</strong>
<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] == 'failed'): ?>
	<strong class="text-dark">Registro fallido</strong>
<?php endif; ?>
<?php Utils::deleteSession('register'); ?>

<form action="<?=base_url?>usuario/save" method="POST">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" required/>
	
	<label for="apellidos">Apellidos</label>
	<input type="text" name="apellidos" required/>
	
	<label for="email">Email</label>
	<input type="email" name="email" required/>
	
	<label for="password">Contraseña</label>
	<input type="password" name="password" required/>
	
	<input type="submit"  value="Registrarse" class="btn btn-dark"/>
</form>
	
</body>
</html>
