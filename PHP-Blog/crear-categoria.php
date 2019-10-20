<?php require_once 'includes/redireccion.php<' ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
<div id="principal">
	<h1>Crear categorias</h1>
	
	<form action="guardar-categoria.php" method="POST">
		<p>Añade nuevas categorias al blog para que los usuarios puedan usarlas al crear sus entradas</p><br>
		<label for="">Nombre de la categoria</label>
		<input type="text" name="nombre">
		<input type="submit" value="Guardar">
	</form>
</div><!--FIN PRINCIPAL-->
		
	<!--PIE DE PAGINA-->
	<?php require_once 'includes/pie.php';?>