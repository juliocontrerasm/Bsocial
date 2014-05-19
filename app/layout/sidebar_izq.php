<?php 
$categoria = new ajaxCRUD("Total", "categorias", '', "./");
$publicacion = new ajaxCRUD("Total", "publicaciones", '', "./");
$grupo = new ajaxCRUD("Total", "grupos", '', "./");
$categorias = $categoria->getQuery("SELECT id, nombre, icono FROM categorias WHERE id_empresa =".$_SESSION['empresa']." GROUP BY id ORDER BY id_empresa"); 
$grupos = $grupo->getQuery("SELECT gr.id, gr.nombre FROM grupos gr, usuarios us, grupo_usuario gr_us, empresas en WHERE us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id  GROUP BY gr.id ORDER BY gr.id");
?>
<div id="col-izquierda" class="col-contenido">
				<form id="form-buscador">
					<p><input type="text" id="buscar-sidebar" placeholder="Buscar grupo o persona"/><a id="btn-lupita" title="Buscar">Buscar</a>
					</p>
				</form>	
				<ul class="menu-troncal menu-bsocial">
				<?php foreach ($categorias as $c){ 
						$publicaciones = $publicacion->getQuery("SELECT count(id) as count FROM `publicaciones` WHERE id_categoria = ".$c['id']." AND id_usuario in(SELECT id_usuario FROM grupo_usuario WHERE id_grupo in (SELECT id_grupo FROM grupo_usuario WHERE id_usuario = ".$_SESSION['id_usuario']." )) AND DATE_FORMAT(created,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d')");
						 // pr($publicaciones);
						if($_GET['categoria']==$c['id']){
					?>
					<li><a href="<?php echo $url;?>usuario/estados/?categoria=<?php echo $c['id']?>"  title="<?php echo $c['nombre'];?>" id="<?php echo $c['icono']?>" class="current"> <?php echo $c['nombre']; if($publicaciones[0]['count'] != 0){?><span class="globo"><?php echo $publicaciones[0]['count'];?></span><?php }?></a></li>
				<?php }else{ ?>
					<li><a href="<?php echo $url;?>usuario/estados/?categoria=<?php echo $c['id']?>"  title="<?php echo $c['nombre'];?>" id="<?php echo $c['icono']?>"> <?php echo $c['nombre']; if($publicaciones[0]['count'] != 0){?><span class="globo"><?php echo $publicaciones[0]['count'];?></span><?php }?></a></li>
				<?php }
				} ?>
				</ul>
				<div id="grupos-sidebar">
					<h4>Grupos</h4>
					<ul class="menu-troncal menu-grupos">
						<?php 
							$conntador = 0;
							foreach ($grupos as $g) {
								if($_GET['grupo']==$g['id']){
									echo '<li><a href="?grupo='.$g['id'].'" title="'.$g['nombre'].'" class="current">'.$g['nombre'].'</a></li>';
								}
								else {
									echo '<li><a href="?grupo='.$g['id'].'" title="'.$g['nombre'].'">'.$g['nombre'].'</a></li>';
								}
								$conntador++;
							}
						?>
					</ul>
					<?php if($contador > 4) { ?>
					<p><a href="" title="Ver más grupos">+ Ver más grupos</a></p>
					<?php } ?>
				</div>
				<div id="logo-h2">
					<h2><a href="http:/www.bsocial.cl" title="B-Social - La Red Social para Empresas" target="_blank">B-Social - La Red Social para Empresas</a></h2>
				</div>
				<ul class="menu-troncal menu-adicional">
					<li><a href="../empresa/misionyvision.php" title="Misión y Visión">Misión y Visión</a></li>
					<li><a href="../empresa/sucursales.php" title="Sucursales">Sucursales</a></li>
				</ul>
			</div>