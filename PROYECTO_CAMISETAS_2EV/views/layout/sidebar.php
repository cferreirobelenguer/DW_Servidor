<!-- 
En layout se encuentra todo el html de la web exterior
BARRA LATERAL -->
<aside id="lateral">

<div id="carrito" class="block_aside">
	<h3 class="d-flex justify-content-center bg-dark text-white">Mi carrito</h3>
	<ul>
		<?php $stats = Utils::statsCarrito(); ?>
		<li><a class="d-flex  bg-white  text-decoration-none text-dark" href="<?=base_url?>carrito/index">Productos (<?=$stats['count']?>)</a></li>
		<li><a class="d-flex  bg-white text-decoration-none text-dark" href="<?=base_url?>carrito/index">Total: <?=$stats['total']?> $</a></li>
		<li><a class="d-flex  bg-white text-decoration-none text-dark" href="<?=base_url?>carrito/index">Ver el carrito</a></li>
	</ul>
</div>
<!--Controles de formulario accesibles, la etiqueta for de label debe ser igual al id e identificativa con el contenido del input-->
<div id="login" class="block_aside">
	<!--Input groups con bootstrap-->
	<?php if(!isset($_SESSION['identity'])): ?>
		<h3 class="d-flex justify-content-center bg-dark text-white">Entrar a la web</h3>
		<form action="<?=base_url?>usuario/login" method="post">
			<label for="Correo"></label>
			<div class="input-group">
				
				<span class="input-group-addon" id="basic-addon1">@</span>
				<input type="email" id="correo" name="email"  class="form-control" placeholder="Introduce email" aria-describedby="basic-addon1"/>
			</div>
			<label for="Contraseña"></label>
			<div class="input-group">
			
			<input type="password" id="contraseña" name="password" class="form-control" placeholder="Contraseña" aria-describedby="basic-addon3"/>
			</div>
			<input type="submit" value="Enviar" />
		</form>
	<?php else: ?>
		<h3><?=$_SESSION['identity']->nombre?> <?=$_SESSION['identity']->apellidos?></h3>
	<?php endif; ?>

	<ul>
		<?php if(isset($_SESSION['admin'])): ?>
			
			<li><a class="d-flex  bg-white text-decoration-none text-dark" href="<?=base_url?>categoria/index">Gestionar categorias</a></li>
			<li><a class="d-flex  bg-white text-decoration-none text-dark" href="<?=base_url?>producto/gestion">Gestionar productos</a></li>
			<li><a class="d-flex  bg-white text-decoration-none text-dark" href="<?=base_url?>pedido/gestion">Gestionar pedidos</a></li>
			<li><a class="d-flex  bg-white text-decoration-none text-dark" href="<?=base_url?>usuario/gestion">Gestionar Usuario</a></li>
			<?php endif; ?>
		
		<?php if(isset($_SESSION['identity'])): ?>
			<li><a class="d-flex  bg-white text-decoration-none text-dark" href="<?=base_url?>pedido/mis_pedidos">Mis pedidos</a></li>
			<li><a class="d-flex  bg-white text-decoration-none text-dark" href="<?=base_url?>usuario/logout">Cerrar sesión</a></li>
		<?php else: ?> 
			<li><a class="d-flex bg-white text-decoration-none text-dark" href="<?=base_url?>usuario/registro">Registrate aqui</a></li>
		<?php endif; ?> 
	</ul>
</div>

</aside>

<!-- CONTENIDO CENTRAL -->
<div id="central">