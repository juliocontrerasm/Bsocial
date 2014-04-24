<?php require_once('../../layout/header.php'); 
	//session_save_path(dirname($_SERVER['DOCUMENT_ROOT']).'/public_html/tmp');
	//require_once('../../core/config.php');
	$publicacion = new ajaxCRUD("Total", "publicaciones", '', "./");
	$comentario = new ajaxCRUD("Total", "comentarios", '', "./");
	$grupo = new ajaxCRUD("Total", "grupos", '', "./");
	$like = new ajaxCRUD("Total", "likes", '', "./");
	$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
	if($_POST['nuevo_comentario']!=null){
		$texto = addslashes(strip_tags($_POST['nuevo_comentario']));
		$comentario->getQuery("INSERT INTO  `comentarios` (`id`,`id_publicacion`,`id_usuario`,`texto` ,`created` ,`deleted`)
		VALUES (NULL , '".$_POST['id_publicacion']."',  '".$_SESSION['id_usuario']."', '".$texto."', CURRENT_TIMESTAMP ,  '0');");
	}
	if($_POST['nuevo_publicacion']!=null){
		$texto = addslashes(strip_tags($_POST['nuevo_publicacion']));
		$publicacion->getQuery("INSERT INTO  `publicaciones` (`id`,`id_categoria`,`id_usuario` ,`id_grupo` ,`id_tipo` ,`texto` ,`created` ,`deleted`)
		VALUES (NULL , '".$_POST['categoria']."',  '".$_SESSION['id_usuario']."',  '".$_POST['grupo_publicacion']."',  '".$_POST['tipo_publicacion']."',  '".$texto."', CURRENT_TIMESTAMP ,  '0');");
	}
		// echo  $_SESSION['id_usuario']. '<br />';
		// echo  $_SESSION['usuario']. '<br />';
		// echo  $_SESSION['empresa'].'<br />';
		$publicaciones = $publicacion->getQuery("SELECT es.* FROM publicaciones as es, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE us.id_empresa = ".$_SESSION['empresa']." AND us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id GROUP BY es.id ORDER BY es.created DESC");
		$grupos = $grupo->getQuery("SELECT gr.id, gr.nombre FROM grupos gr, usuarios us, grupo_usuario gr_us, empresas en WHERE us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id  GROUP BY gr.id ORDER BY gr.id");
	if($_GET['categoria']!=null){
		$publicaciones = $publicacion->getQuery("SELECT es.* FROM publicaciones as es, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE us.id_empresa = ".$_SESSION['empresa']." AND us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id AND es.id_categoria = ".$_GET['categoria']." GROUP BY es.id ORDER BY es.created DESC");
	}
		// htmlspecialchars()
		//pr($publicaciones);
		//pr($grupo_usuarios);
		//pr($categorias);
	$i=1;
	$z=1;
?>
		<div id="col-centro" class="col-contenido">
				<div id="contenedor-estado">
					<form id="estado">
						<textarea name="nueva_publicacion" placeholder="¿Qué quieres publicar?"></textarea>
						<?php if ($cargando == 1){?>
								<div id="contenedor-fotos-adjuntas">
									<ul>
										<li> <a class="btn-borrar-img" title="Borrar imagen">Borrar imagen</a>
											<img src="css/img/domi.jpg" />
										</li>
									</ul>	
								</div>
						<?php } ?>
						<div id="btns-estado">
							<p id="contenedor-subir-foto">
								<a title="Adjuntar imagen"><input type="file" id="btn-subir-foto"/></a>
							</p>
							<p id="contenedor-subir-video">
								<a title="Adjuntar video" rel="#modal-adjuntar-video">Adjuntar video</a>
							</p>
							<ul id="btn-visiblepor">
								<li id="contenedor-drop-visible">
									<a id="visiblepor-selected">Visible por</a>
									<ul id="dropdown-visiblepor">
										<li id="contenedor-flecha-gris"><span class="flecha-up"></span><a href="#" title="Todos los grupos">Todos</a></li>
										<?php foreach($grupos as $g){?>
												<li><a href="#" title="<?php echo $g['nombre']?>"><?php echo $g['nombre']?></a></li>
										<?php }?>
									</ul>
								</li>
							</ul>
							<p class="btn"><a title="Publicar">Publicar</a>
							</p>
						</div>
					</form>
					<style>
					/* Este valor debe cambiar conforme aumenta el % de carga de la foto */
					#barra-carga-foto{
						width:180px;
					}
					</style>
					<?php if ($cargando == 1){?>
					<div id="barra-carga-foto">
					</div>
					<?php } ?>
				</div>
				<!-- publicaciones  -->
				<?php foreach($publicaciones as $publicacion){ 
						$comentarios = $comentario->getQuery("SELECT id,id_usuario, texto, created FROM comentarios WHERE id_publicacion =".$publicacion['id']." ORDER BY created DESC");
						$like_estado = $like->getQuery("SELECT count(id) as count FROM likes WHERE id_publicacion = ".$publicacion['id']." AND id_comentario='0' AND deleted = 0");
						$like_estado_usuario = $like->getQuery("SELECT count(id) as count FROM likes WHERE id_publicacion = ".$publicacion['id']." AND id_usuario=".$_SESSION['id_usuario']." AND id_comentario='0' AND deleted = 0");
						$nombre_usuario = $usuario->getQuery("SELECT nombre FROM usuarios WHERE id = ".$publicacion['id_usuario']."");
						// pr($publicacion);
					?>
				<div class="contendor-publicacion">
					<div class="foto-perfil">
						<p><img src="css/img/<?php echo $publicacion['id_usuario'];?>-perfil.jpg" alt="Imagen perfil" /></p>
					</div>
					<div class="datos-publicacion">
					<h3><?php echo $nombre_usuario[0]['nombre']?></h3>
					<p class="fecha-publicacion">Hace <?php echo fecha_pro($publicacion['created']);?></p>
					</div>
					<div class="publicacion">
						<?php if($publicacion['video']!=null){?>
						<div class="publicacion-video">
							<?php echo $publicacion['video'];?>
							<!-- <iframe src="//player.vimeo.com/video/58898148?title=0&amp;byline=0&amp;portrait=0" width="380" height="214" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->
						</div>
						<?php } ?>
						<?php if($publicacion['foto']!=null){?>
						<div class="publicacion-video">
							<img src="<?php echo $publicacion['foto'];?>.jpg" alt="Imagen" /></p>
							<!-- <iframe src="//player.vimeo.com/video/58898148?title=0&amp;byline=0&amp;portrait=0" width="380" height="214" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe> -->
						</div>
						<?php } ?>
						<div class="publicacion-texto">
							<p><?php echo $publicacion['texto'];?></p>
						</div>
						<div class="contenedor-escribir-comentario">
							<div class="escribir-comentario">
								<form class="form-comentar-publicacion">
									<input type="hidden" value="<?php echo $publicacion['id'];?>" name="id_publicacion" id="id_publicacion" >
									<textarea name="nuevo_comentario" placeholder="Escribe un comentario..."></textarea>
								</form>
							</div>
							<ul>
								<li class="btn comentar"><a title="Comentar">Comentar</a></li>
								<li class="btn megusta">
									<!-- La clase del span debe cambiar segun los numeros que tenga: "un-numero", "dos-numeros" o "tres-numeros" -->
									<span class="globo-megusta dos-numeros" title="1">99</span>
									<a title="¡Me gusta!">¡Me gusta!</a>
								</li>
							</ul>	
						</div>	
					</div>
					<!-- La class "bg-linea" imprime la línea gris debajo de cada div. Si se trata del último div de comentario, no debe llevar esta class -->
					<?php if($comentarios != null){ 
						$con = 0;
						foreach($comentarios as $con){
							// $like_comentario = $like->getQuery("SELECT count(id) as count FROM likes WHERE id_publicacion = ".$publicacion['id']." AND id_comentario = ".$con['id']." AND deleted = 0");
							// $like_comentario_usuario = $like->getQuery("SELECT count(id) as count FROM likes WHERE id_publicacion = ".$publicacion['id']." AND id_usuario=".$_SESSION['id_usuario']." AND id_comentario = ".$con['id']." AND deleted = 0");
							$nombre_usuario_comentario = $usuario->getQuery("SELECT nombre FROM usuarios WHERE id = ".$con['id_usuario']."");
						if($con == 0){
						?>
							<div class="publicacion-comentario bg-linea">
						<?php $con=1; } 
							  else {?>
						<div class="publicacion-comentario">
							<?php }?>
						<div class="foto-perfil">
							<p><img src="css/img/<?php echo $con['id_usuario'];?>-perfil.jpg" alt="Imagen perfil" /></p>
						</div>
						<div class="datos-publicacion">
							<h3><?php echo $nombre_usuario_comentario[0]['nombre'];?></h3>
							<p class="fecha-publicacion">Hace <?php echo fecha_pro($con['created']);?></p>
						</div>
						<div class="publicacion-texto comentario">
							<p><?php echo $con['texto'] ;?></p>
						</div>
					</div>
					<?php 
							}
						} ?>
				</div>
				<?php } ?>
				<!-- termino de publicaciones -->
			</div>
<?php require_once('../../layout/footer.php'); 