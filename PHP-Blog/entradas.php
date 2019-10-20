<?php require_once 'includes/cabecera.php'; ?>
<?php require_once'includes/lateral.php'; ?>

<!--CAJA PRINCIPAL-->
			<div id="principal">
				<h1>Todas las entradas</h1>


				<?php 
					$entradas = conseguirEntradas($db, null);
					if(!empty($entradas)) :
							while($entrada = mysqli_fetch_assoc($entradas)):		
				 ?>
					
				 <article class="entrada">
					<a href="entradas.php?id=<?=$entrada['id']?>">
						<h2> <?=$entrada['titulo']?> </h2>
						<span class= "fecha"> <?= $entrada['categoria'].' | '.$entrada['fecha']?> </span>
						<p>
							 <?=substr($entrada['descripcion'], 0, 180)."..." ?>
						</p>
					</a>

				 <?php 
				 			endwhile;
				 	endif;
				 	
				  ?>
				
		
		</div><!--FIN PRINCIPAL-->
		

		
	
		
	
	<!--PIE DE PAGINA-->
	<?php require_once 'includes/pie.php';?>
