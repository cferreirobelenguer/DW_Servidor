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

<?php if(isset($edit) && isset($pro) && is_object($pro)): ?>
	<h1 class="text-dark" >Editar producto <?=$pro->nombre?></h1>
	<?php $url_action = base_url."producto/save&id=".$pro->id; ?>
	
<?php else: ?>
	<h1 class="text-dark">Crear nuevo producto</h1>
	<?php $url_action = base_url."producto/save"; ?>
<?php endif; ?>
	
<div class="form_container">
	
	<form action="<?=$url_action?>" method="POST" enctype="multipart/form-data">
		<label for="nombre">Nombre</label>
		<input type="text" name="nombre" value="<?=isset($pro) && is_object($pro) ? $pro->nombre : ''; ?>"/>

		<label for="descripcion">Descripción</label>
		<textarea name="descripcion"><?=isset($pro) && is_object($pro) ? $pro->descripcion : ''; ?></textarea>

		<label for="precio">Precio</label>
		<input type="text" name="precio" value="<?=isset($pro) && is_object($pro) ? $pro->precio : ''; ?>"/>

		<label for="stock">Stock</label>
		<input type="number" name="stock" value="<?=isset($pro) && is_object($pro) ? $pro->stock : ''; ?>"/>

		<label for="categoria">Categoria</label>
		<?php $categorias = Utils::showCategorias(); ?>
		<select name="categoria">
			<?php while ($cat = $categorias->fetch_object()): ?>
				<option value="<?= $cat->id ?>" <?=isset($pro) && is_object($pro) && $cat->id == $pro->categoria_id ? 'selected' : ''; ?>>
					<?= $cat->nombre ?>
				</option>
			<?php endwhile; ?>
		</select>
		
		<label for="imagen">Imagen</label>
		<?php if(isset($pro) && is_object($pro) && !empty($pro->imagen)): ?>
			<img src="<?=base_url?>uploads/images/<?=$pro->imagen?>" class="thumb" class="img-fluid"/> 
		<?php endif; ?>
		<input type="file" name="imagen" />
		
		<input type="submit"   value="Guardar" class="btn btn-dark text-white" />
	</form>
</div>
</body>
</html>
