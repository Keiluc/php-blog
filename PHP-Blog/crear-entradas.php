<?php require_once 'includes/redireccion.php<' ?>
<?php require_once 'includes/cabecera.php'; ?>
<?php require_once'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
<div id="principal">
	<h1>Crear entradas</h1>
	
	<form action="guardar-entrada.php" method="POST">
		<p>Añade nuevas categorias al blog para que los usuarios puedan leerlas y disfrutar del contenido</p><br>
		<label for="titulo">Titulo:</label>
		<input type="text" name="titulo">
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'titulo') : ''; ?>


		<label for="descripcion">Descripción:</label>
		<textarea name="descripcion"></textarea>
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'descripcion') : ''; ?>

		<label for="categoria">Categoria</label>
		<select name="categoria">
			<?php $categorias = conseguirCategorias($db);
			if (!empty($categorias)) :
				while ($categoria = mysqli_fetch_assoc($categorias)) :
			 ?>			
			<option value="<?=$categoria['id'] ?>">
				<?=$categoria['nombre'] ?>
			</option>
			<?php 
				endwhile;
			endif;
			 ?>
		</select>	
		<?php echo isset($_SESSION['errores_entrada']) ? mostrarError($_SESSION['errores_entrada'],'categoria') : ''; ?>

		
		<input type="submit" value="Guardar">
	
	</form>
	<?php borrarErrores(); ?>

</div><!--FIN PRINCIPAL-->
		
	<!--PIE DE PAGINA-->
	<?php require_once 'includes/pie.php';?>