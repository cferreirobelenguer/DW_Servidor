
<!--En layout se encuentra todo el html de la web exterior-->
<!DOCTYPE HTML>
<!-- Acessibilidad punto 3  el idioma debe ser determinado en el html mediante programación-->
<html lang="es">
	<head>
		<meta charset="utf-8" />
		<title>Tienda de Camisetas</title>
		<link rel="stylesheet" href="<?=base_url?>assets/css/styles.css" />
		<!--BOOTSTRAP -->
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    	<!-- BOOTSTRAP -->
    	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		  <!--favicon-->
		  <link href="<?=base_url?>assets/img/corazon.jpg"  rel="shortcut icon" type="image/x-icon" />
	</head>
	<body>
		
			<!-- CABECERA -->
			<!--punto 1 accesibilidad la imágen tiene una descripción con alt-->
			<header id="header">
			<div id="logo">	
				<a href="<?=base_url?>"><img src="<?=base_url?>assets/img/noa.jpg"  class="img-fluid" alt="Logo" width="200" height="1000"/></a>
			</div>
			</header>
			<br>

			<!-- MENU -->
			<?php $categorias = Utils::showCategorias(); ?>
			<nav  class="navbar navbar-expand-sm bg-dark navbar-dark">
				<div class="container">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url?>">Inicio</a>
					</li>
					<?php while($cat = $categorias->fetch_object()): ?>
					<li class="nav-item">
						<a class="nav-link" href="<?=base_url?>categoria/ver&id=<?=$cat->id?>"><?=$cat->nombre?></a>
					</li>
					<?php endwhile; ?>
				</ul>
				</div>
				
			</nav>
			
			<div id="content">