<?php require_once('../../layout/header.php'); 
$pagina = new ajaxCRUD("Total", "paginas", '', "./");
$sucursal = $pagina->getQuery("SELECT * FROM paginas WHERE tipo=2 AND id_empresa = ".$_SESSION['empresa']." AND deleted = 0");
?>
		<div id="contenedor-central">
			<div id="col-centro" class="col-contenido">
				<div class="contendor-publicacion">
					<h2><?php echo $sucursal[0]['titulo']; ?></h2>
						<?php echo $sucursal[0]['texto']; ?>
				</div>
			</div>
		</div>