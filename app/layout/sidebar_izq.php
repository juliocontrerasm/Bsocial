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
					?>
					<li><a href="<?php echo $url;?>usuario/estados/?categoria=<?php echo $c['id']?>"  title="Novedades" id="<?php echo $c['icono']?>"> <?php echo $c['nombre']; if($publicaciones[0]['count'] != 0){?><span class="globo"><?php echo $publicaciones[0]['count'];?></span><?php }?></a></li>
				<?php } ?>
					
					<!-- <li><a href="#" title="Novedades" id="icn-novedades">Novedades</a></li>
					<li><a href="#" title="Avisos" id="icn-avisos">Avisos <span class="globo">1</span></a></li>
					<li><a href="#" title="Encuestas" id="icn-encuestas">Encuestas</a></li>
					<li><a href="#" title="Mercadito" id="icn-mercadito">Mercadito <span class="globo">99</span></a></li>
					<li><a href="#" title="Cumpleaños" id="icn-cumpleanos">Cumpleaños</a></li>
					<li><a href="#" title="Elige al mejor" id="icn-elige">Elige al mejor</a></li>
					<li><a href="#" title="Beneficios" id="icn-beneficios">Beneficios</a></li>
					<li><a href="#" title="Liquidaciones" id="icn-liquidaciones">Liquidaciones</a></li> -->

				</ul>
				<div id="grupos-sidebar">
					<h4>Grupos</h4>
					<ul class="menu-troncal menu-grupos">
						<?php 
							$con = 0;
							foreach ($grupos as $g) {
								echo '<li><a href="?grupo='.$g['id'].'" title="'.$g['nombre'].'">'.$g['nombre'].'</a></li>';
								$con++;
							}
						?>
						<!-- <li><a href="#" title="Sucursal Norte">Sucursal Norte <span class="globo">2</span></a></li>
						<li><a href="#" title="Amigo Secreto">Amigo Secreto <span class="globo">10</span></a></li> -->
					</ul>
					<?php if($con > 4) { ?>
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