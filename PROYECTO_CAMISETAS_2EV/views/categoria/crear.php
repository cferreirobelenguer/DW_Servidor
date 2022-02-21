<h1>Crear nueva categoria</h1>
<!--Se crea una nueva categoría y se guarda,
esta web es llamada tanto para crear nuevas categorías como para editarlas en controller editar y controller crear-->
<form action="<?=base_url?>categoria/save" method="POST">
	<label for="nombre">Nombre</label>
	<input type="text" name="nombre" required/>
	
	<input type="submit" value="Guardar" />
</form>