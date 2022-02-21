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
<div class="container-fluid">
<br>
<!--ICONOS EN BOOTSTRAP-->
<small><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-handbag-fill" viewBox="0 0 16 16">
				<path d="M8 1a2 2 0 0 0-2 2v2H5V3a3 3 0 1 1 6 0v2h-1V3a2 2 0 0 0-2-2zM5 5H3.36a1.5 1.5 0 0 0-1.483 1.277L.85 13.13A2.5 2.5 0 0 0 3.322 16h9.355a2.5 2.5 0 0 0 2.473-2.87l-1.028-6.853A1.5 1.5 0 0 0 12.64 5H11v1.5a.5.5 0 0 1-1 0V5H6v1.5a.5.5 0 0 1-1 0V5z" />
			</svg> Gastos de envío gratis en pedidos superiores a 50 $</small>
</br>
</br>
<!-- Carousel -->
<div id="demo" class="carousel slide" data-bs-ride="carousel">

  <!-- Indicators/dots -->
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#demo" data-bs-slide-to="0" class="active"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
    <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
  </div>
<div class="d-flex justify-content-center bg-dark">
	<br>
	<br>
	<!--La imagen lleva alt con descripción como punto 1 de accesibilidad A-->
  <!--carousel -->
  <div class="carousel-inner">
    <div class="carousel-item active">
	<a href="<?=base_url?>"><img src="<?=base_url?>assets/img/portada2.gif" class="img-fluid" alt="Portada" width="1000" height="500"/>
    </div>
    <div class="carousel-item">
	<a href="<?=base_url?>"><img src="<?=base_url?>assets/img/coleccion.png" class="img-fluid" alt="Portada" width="1000" height="500"/>
    </div>
    <div class="carousel-item">
	<a href="<?=base_url?>"><img src="<?=base_url?>assets/img/new.gif" class="img-fluid" alt="Portada" width="1000" height="500"/>
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

<table>
	<div class="btn-group-vertical">
				<tr>
					<!--En caso de que estemos en una página superior a la primera podemos ir atrás-->
					<?php 
					//Punto 7 paginación
					if($primera>1){?>
						<td>
							<!--Enlace que cambia de página por petición GET-->
							<a href="<?=base_url?>?enlacePagina=<?php echo $primera-1?>"  class="btn btn-dark text-white" >Anterior página</a>
			
						</td>
						<?php }?>
						<!--Mientras que no se llegue al total de páginas se puede pulsar la siguiente página-->
						<?php if($primera<$paginasTotales){?>
						<td>
							<!--Enlace que cambia de página por petición GET-->
							<a href="<?=base_url?>?enlacePagina=<?php echo $primera+1?>"  class="btn btn-dark text-white">Siguiente página</a>
							
						</td>
						<?php }?>
				</tr>
	</div>
			</table>
			<br>
			<br>
<?php 
while($product = $productos->fetch_object()): ?>
	<div class="product">
	<!--La imagen lleva alt con descripción como punto 1 de accesibilidad A-->
		<a href="<?=base_url?>producto/ver&id=<?=$product->id?>">
			<?php if($product->imagen != null): ?>
				<img src="<?=base_url?>uploads/images/<?=$product->imagen?>" class="img-fluid" class="productos tienda online" width="150" height="150"/>
			<?php else: ?>
				<img src="<?=base_url?>assets/img/camiseta.png" class="img-fluid" class="productos tienda online" width="150" height="150"/>
			<?php endif; ?>
			<h2><?=$product->nombre?></h2>
		</a>
		<p><?=$product->precio?></p>
		<?php 
		//Punto 5 productos en oferta y punto 6 NO DISPONIBLE POR NO HABER STOCK
		if($product->stock==0){?>
			<p><span class="badge badge-secondary bg-dark lead">No disponible</span></p>
		<?php }else if($product->oferta=='si'){?>
			<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="btn btn-dark text-white">Comprar</a>
			<?php
			//Precio al 10% cuando la columna oferta es si, si es no no tiene rebaja
			//Si tiene rebaja aparece el precio anterior y el actual?>
			<br>
			<br>
			<p><span class="badge badge-secondary bg-dark lead">Antes <?=$product->precio+round(($product->precio*0.10))?> €</span></p><br>
			<p><span class="badge badge-secondary bg-dark lead">Ahora <?=$product->precio?> €</span></p>
			
			
		<?php }else{
			?>
			
			<a href="<?=base_url?>carrito/add&id=<?=$product->id?>" class="btn btn-dark text-white">Comprar</a><br><br>
			<p><span class="badge badge-secondary bg-dark lead">Nueva colección</span></p>
			<?php	
		}
		?>
		
	
	</div>
	<?php endwhile; ?>
	</div>
			</body>
</html>
