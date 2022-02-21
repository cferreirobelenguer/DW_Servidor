

<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex bg-dark justify-content-center text-white">
	<h1>Detalle del pedido</h1>
</div>
<div class="d-flex bg-dark justify-content-center ">
	<br>
</div>
<div class="d-flex  justify-content-center ">
	<br>
</div>
<?php 
//Punto 8 PDF
if((Utils::isAdmin())&&($pedido->estado!='Cancelado')){
	?>
	
	<a href="<?=base_url?>pedido/generar&id=<?=$pedido->id?>" class="btn btn-dark text-white">Generar pdf</a>
	<br>
	<br>
	<?php
}
//Punto 9
if (isset($pedido)): ?>
		<?php if(isset($_SESSION['admin'])): ?>
			<h3 clas="fw-bold text-dark text-center">Cambiar estado del pedido</h3>
			<form action="<?=base_url?>pedido/estado" method="POST">
				<input type="hidden" value="<?=$pedido->id?>" name="pedido_id"/>
				<select name="estado">
					<option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '';?>>Pendiente</option>
					<option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : '';?>>En preparación</option>
					<option value="ready" <?=$pedido->estado == "ready" ? 'selected' : '';?>>Preparado para enviar</option>
					<option value="sended" <?=$pedido->estado == "sended" ? 'selected' : '';?>>Enviado</option>
				</select>
				<input type="submit" value="Cambiar estado" class="btn btn-dark text-white"/>
			</form>
			<br/>
		<?php endif;
		//Concateno los resultados del pedido en una variable
		?>
		<div class="mt-4 p-5 bg-dark text-white rounded">
		<h3>Datos de cliente</h3>
		Nombre :<?=$usuario->nombre." ".$usuario->apellidos ?></br>
		Email :<?=$usuario->email ?></br>
		<br>
		<br>
		<h3>Dirección de envio</h3>
		Provincia:<?= $pedido->provincia ?>   <br/>
		Cuidad:<?= $pedido->localidad ?> <br/>
		Direccion:<?= $pedido->direccion ?>   <br/><br/>
		<br>
		<br>
		<h3>Datos del pedido:</h3>
		Id de pedido:<?=$pedido->id?><br/>
		Estado:<?=$pedido->estado?> <br/>
		<?php
		//Punto 9
		//Si el pedido se cancela no se muestra fecha de pedido ni envío
			if($pedido->estado=="Cancelado"){
				echo "";
			}else
			if($pedido->estado=="sended"){
				//Si el pedido es enviado se muestra la fecha de entrega
				echo "<p>Tu pedido está de camino, pronto llegará a tu destino, esperamos verte pronto</p>";
				echo "<p>Fecha de entrega: ".$pedido->fecha."</p></br>";
			}else{
				//En los casos en los que el pedido no es enviado, pero no es cancelado se muestra la fecha de pedido
				echo "<p>Fecha de pedido: ".$pedido->fecha."</p></br>";
			}
			?>
		</div>
		<br>
		<?php
		if($pedido->estado=='confirm'){
			?><!--Se cancela el pedido si el usuario lo selecciona, cambia el estado a Cancelado-->
			<a href="<?=base_url?>pedido/borrar&id=<?=$pedido->id?>" class="btn btn-dark text-white">Cancelar pedido</a> <br>
			<?php

		}else if($pedido->estado=='preparation'){
			?><!--Se cancela el pedido si el usuario lo selecciona, cambia el estado a Cancelado-->
			<a href="<?=base_url?>pedido/borrar&id=<?=$pedido->id?>" class="btn btn-dark text-white">Cancelar pedido</a>
			
			<?php
		}else if($pedido->estado=='ready'){
			?><!--Se cancela el pedido si el usuario lo selecciona, cambia el estado a Cancelado-->
			<a href="<?=base_url?>pedido/borrar&id=<?=$pedido->id?>" class="btn btn-dark text-white">Cancelar pedido</a>
			
			<?php
		}
		//Cuando el pedido es "sended" no se muestra opción de Cancelar pdido
	?>
	<?php if($pedido->estado=="Cancelado"){
		//En caso de que el estado sea Cancelado se muestra mensaje a usuario de cancelación,
		//Y no se muestra la compra
				echo "<p>Sentimos que canceles tu pedido, te esperamos en tu próxima compra</p>";
			}else{
		//En caso de que el pedido no sea cancelado se muestra la compra?>
		<br>
		<br>
		<?php
		//PUNTO 10 PERSONALIZADO SI LOS PEDIDOS SON SUPERIORES A 50 SE DESCUENTAN 4 EUROS DE TRANSPORTE DEL PEDIDO 
		if($pedido->coste>=50):?>
			<br><h3>Gatos de envío: -4 $ </h3><br>
			<strike>Total a pagar:<?= $pedido->coste ?> $</strike>
			<p class="h5 text-dark lead">Total a pagar: <?= $pedido->coste-4?> $ </p><br/>
		<?php else:?>
			<br><h3>Gatos de envío incluidos</h3><br>
			<p class="h5 text-dark lead">Total a pagar: <?= $pedido->coste ?> $ </p><br/>
		<?php endif;?>
		
		<br>
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
				<!--Se muestra el listado del pedido-->
				<tr>
					<td>
						<!--Se añade at con descripción punto 1 accesibilidad A-->
						<?php if ($producto->imagen != null): ?>
							<img src="<?= base_url ?>uploads/images/<?= $producto->imagen ?>" class="productos del pedido" class="img-fluid" width="200" height="200"/>
						<?php else: ?>
							<img src="<?= base_url ?>assets/img/camiseta.png" class="productos del pedido" class="img-fluid" width="200" height="200"/>
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
			<?php endwhile;
			} ?>
		</table>

	<?php endif; ?>
