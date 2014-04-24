<?php require_once('../../layout/header.php'); 
$pagina = new ajaxCRUD("Total", "paginas", '', "./");
$myv = $pagina->getQuery("SELECT * FROM paginas WHERE tipo=1 AND id_empresa = ".$_SESSION['empresa']." AND deleted = 0");
?>

			<div id="col-centro" class="col-contenido">
				<div class="contendor-publicacion">
					<h2><?php echo $myv[0]['titulo']; ?></h2>
						<?php echo $myv[0]['texto']; ?>
				</div>
			</div>
<?php require_once('../../layout/footer.php'); 

				