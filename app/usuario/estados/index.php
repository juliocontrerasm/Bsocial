<?php require_once('../../layout/header.php'); 
	//session_save_path(dirname($_SERVER['DOCUMENT_ROOT']).'/public_html/tmp');
	//require_once('../../core/config.php');
	$publicacion = new ajaxCRUD("Total", "publicaciones", '', "./");
	$comentario = new ajaxCRUD("Total", "comentarios", '', "./");
	$grupo = new ajaxCRUD("Total", "grupos", '', "./");
	$like = new ajaxCRUD("Total", "likes", '', "./");
	$persona = new ajaxCRUD("Total", "personas", '', "./");
	if($_POST['nuevo_comentario']!=null){
		$texto = addslashes(strip_tags($_POST['nuevo_comentario']));
		$comentario->getQuery("INSERT INTO  `comentarios` (`id`,`id_publicacion`,`id_usuario`,`texto` ,`created` ,`deleted`)
		VALUES (NULL , '".$_POST['id_publicacion']."',  '".$_SESSION['id_usuario']."', '".$texto."', CURRENT_TIMESTAMP ,  '0');");
	}
	if($_POST['nuevo_publicacion']!=null){
		$texto = addslashes(strip_tags($_POST['nuevo_publicacion']));
		if($_GET['categoria']!=null){
			$publicacion->getQuery("INSERT INTO  `publicaciones` (`id`,`id_categoria`,`id_usuario` ,`id_grupo` ,`id_tipo` ,`texto` ,`created` ,`deleted`)
		VALUES (NULL , '".$_GET['categoria']."',  '".$_SESSION['id_usuario']."',  '".$_POST['grupo_oculto']."',  0,  '".$texto."', CURRENT_TIMESTAMP ,  '0');");
		
		}else{
		$publicacion->getQuery("INSERT INTO  `publicaciones` (`id`,`id_categoria`,`id_usuario` ,`id_grupo` ,`id_tipo` ,`texto` ,`created` ,`deleted`)
		VALUES (NULL , 1,  '".$_SESSION['id_usuario']."',  '".$_POST['grupo_oculto']."',  0,  '".$texto."', CURRENT_TIMESTAMP ,  '0');");
		}
		// echo "se guardo";
	}
		// echo  $_SESSION['id_usuario']. '<br />';
		// echo  $_SESSION['usuario']. '<br />';
		// echo  $_SESSION['empresa'].'<br />';
		$publicaciones = $publicacion->getQuery("SELECT es.* FROM publicaciones as es, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE us.id_empresa = ".$_SESSION['empresa']." AND us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id GROUP BY es.id ORDER BY es.created DESC");
		$grupos = $grupo->getQuery("SELECT gr.id, gr.nombre FROM grupos gr, usuarios us, grupo_usuario gr_us, empresas en WHERE us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id  GROUP BY gr.id ORDER BY gr.id");
	if($_GET['categoria']!=null && $_GET['categoria']!=1){
		$publicaciones = $publicacion->getQuery("SELECT es.* FROM publicaciones as es, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE us.id_empresa = ".$_SESSION['empresa']." AND us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id AND es.id_categoria = ".$_GET['categoria']." GROUP BY es.id ORDER BY es.created DESC");
	}
	if($_GET['grupo']!=null){
		$publicaciones = $publicacion->getQuery("SELECT pu.* FROM publicaciones as pu, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE en.id= ".$_SESSION['empresa']." AND us.id_empresa = ".$_SESSION['empresa']." AND gr.id_empresa =".$_SESSION['empresa']." AND gr_us.id_usuario = ".$_SESSION['id_usuario']." AND gr_us.id_usuario = us.id AND pu.id_usuario = us.id AND pu.id_grupo = ".$_GET['grupo']."  GROUP BY pu.id ORDER BY pu.created DESC");
	}
		// htmlspecialchars()
		//pr($publicaciones);
		//pr($grupo_usuarios);
		//pr($categorias);
	$i=1;
	$z=1;
?>
		<div id="col-centro" class="col-contenido">
			<?php if($_GET['categoria']!=8 ){?>
				<div id="contenedor-estado">
					<form id="estado" method="POST" action="">
						<textarea name="nuevo_publicacion" placeholder="¿Qué quieres publicar?"></textarea>
						<input type ="hidden" value="1" name="grupo_oculto" id="grupo_oculto" />
						<?php if ($cargando == 1){?>
								<div id="contenedor-fotos-adjuntas">
									<ul>
										<li> 
											<a class="btn-borrar-img" title="Borrar imagen">Borrar imagen</a>
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
										<li id="contenedor-flecha-gris"><span class="flecha-up"></span><a href="#" title="Todos los grupos" value="1">Todos</a></li>
										<?php foreach($grupos as $g){?>
												<li><a href="#" title="<?php echo $g['nombre']?>" value="<?php echo $g['id'];?>" id="grupo-<?php echo $g['id'];?>"><?php echo $g['nombre']?></a></li>
										<?php }?>
										<script type="text/javascript">
												$("#dropdown-visiblepor li a").click(function(){

													var valor = $(this).attr("value");
													$("#grupo_oculto").attr("value",valor);
													// alert(valor);

												});
										</script>
									</ul>
								</li>
							</ul>
							<p class="btn"><a title="Publicar" id="publicar">Publicar</a>
							</p>
						</div>
					</form>
					<script type="text/javascript">
							$("#publicar").click(function(){
								$("#estado").submit();
							});
					</script>
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
						$nombre_usuario = $persona->getQuery("SELECT nombre FROM personas WHERE id in (SELECT id_persona FROM usuarios WHERE id=".$publicacion['id_usuario'].")");
						// pr($publicacion);
					?>
				<div class="contendor-publicacion">
					<div class="foto-perfil">
						<?php 
						$url_imagen = '../../usuario/perfil/img/'.$_SESSION['empresa'].'/'.$publicacion['id_usuario'].'.jpg';
						if( file_exists($url_imagen) ){ ?>
						<p><a href="<?php echo $url.'usuario/perfil/?usuario='.$publicacion['id_usuario'];?>" title="Ir al perfil <?php echo $nombre_usuario[0]['nombre'];?>"><img src="<?php echo $url_imagen;?>" alt="Imagen perfil" /></a></p>
						<?php } else { ?>
						<p><a href="<?php echo $url.'usuario/perfil/?usuario='.$publicacion['id_usuario'];?>" title="Ir al perfil <?php echo $nombre_usuario[0]['nombre'];?>"><img src="<?php echo $url;?>/css/img/avatar.jpg" alt="Imagen perfil" /></a></p>
						<?php } ?>
					</div>
					<div class="datos-publicacion">
					<h3><?php echo '<a href="'.$url.'usuario/perfil/?usuario='.$publicacion['id_usuario'].'" title="Ir al perfil '.$nombre_usuario[0]['nombre'].'">'.$nombre_usuario[0]['nombre'].'</a>';?></h3>
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
								<form id="form-comentar-publicacion<?php echo $i;?>" class="form-comentar-publicacion" method="POST" action="">
									<input type="hidden" value="<?php echo $publicacion['id'];?>" name="id_publicacion" id="id_publicacion" >
									<textarea name="nuevo_comentario" placeholder="Escribe un comentario..."></textarea>
								</form>
							</div>

							<ul>
								<li class="btn comentar"><a id="publica-comentario-<?php echo $i;?>" title="Comentar">Comentar</a></li>
								<li class="btn megusta">
									<!-- La clase del span debe cambiar segun los numeros que tenga: "un-numero", "dos-numeros" o "tres-numeros" -->
									<span class="globo-megusta <?php if($like_estado[0]['count']>9){ echo 'un-numero'; }else if($like_estado[0]['count']>99){ echo 'dos-numeros'; } else { echo 'tres-numeros'; }?>dos-numeros" id="like-count-<?php echo $i; ?>" title="1"><?php echo $like_estado[0]['count'];?></span>
									<a id="like-publicacion-<?php echo $i; ?>" title="¡Me gusta!">¡Me gusta!</a>
								</li>
							</ul>	
						</div>	
					</div>
					<script type="text/javascript">
							
			jQuery(document).ready(function ($){
				//publicacion de los comentarios
				$("#publica-comentario-<?php echo $i;?>").click(function(){
					$("#form-comentar-publicacion<?php echo $i;?>").submit();
				});
				//likes 
				$("#like-publicacion-<?php echo $i;?>").click(function() {
					var like= $("#like-count-<?php echo $i;?>").html();
					var like_text=$("#like-publicacion-<?php echo $i;?>").html();
					if(like_text =='¡Me gusta!'){
					like = parseInt(like)+1;
					like_text ='¡Ya no me gusta!';
					$("#like-publicacion-<?php echo $i;?>").html(like_text);
					$("#like-publicacion-<?php echo $i;?>").attr( "title", like_text );
					$("#like-count-<?php echo $i;?>").html(like);
				}else{
					like = parseInt(like)-1;
					like_text ='¡Me gusta!';
					$("#like-publicacion-<?php echo $i;?>").html(like_text);
					$("#like-publicacion-<?php echo $i;?>").attr( "title", like_text );
					$("#like-count-<?php echo $i;?>").html(like);
				}
					$.ajax({
                        url:'likes.php', 
                        data:{ 
                        id_publicacion: <?php echo $publicacion['id'];?>,
                        id_usuario: <?php echo $_SESSION['id_usuario'];?>,
                    	},
                        type: 'POST',
                        async: true,
                        cache: false,
                        success: function(responsetext,textStatus,xhr,data,callback,result) {},
                        error: function (xhr, ajaxOptions, thrownError,data) {}
                      });
				});
			});

			</script>
					<!-- La class "bg-linea" imprime la línea gris debajo de cada div. Si se trata del último div de comentario, no debe llevar esta class -->
					<?php 

					if($comentarios != null){ 
						$contador = 0;
						foreach($comentarios as $con){
							$nombre_usuario_comentario = $usuario->getQuery("SELECT nombre FROM personas WHERE id in (SELECT id_persona FROM usuarios WHERE id=".$con['id_usuario'].")");
						if($contador == 0){
						?>
							<div class="publicacion-comentario">
						<?php $contador=1; 
						}else {?>
						<div class="publicacion-comentario bg-linea">
							<?php }?>
						<div class="foto-perfil">
							<p><a href="<?php echo $url.'usuario/perfil/?usuario='.$publicacion['id_usuario'];?>" title="Ir al perfil <?php echo $nombre_usuario[0]['nombre'];?>"><img src="<?php echo $url;?>/usuario/perfil/img/1/<?php echo $publicacion['id_usuario'];?>.jpg" alt="Imagen perfil" /></a></p>
						</div>
						<div class="datos-publicacion">
							<h3><?php echo '<a href="'.$url.'usuario/perfil/?usuario='.$con['id_usuario'].'" title="Ir al perfil '.$nombre_usuario_comentario[0]['nombre'].'">'.$nombre_usuario_comentario[0]['nombre'].'</a>';?></h3>
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
				<?php $i++; } 
					}?>
					<?php if($_GET['categoria']==8){
						echo "<div id='contenedor-contenido'>
					<h3>Descarga tus liquidaciones de sueldo</h3>
					<ul id='lista-con-pdf'>";
					$mes_numero = 0;	
					setlocale (LC_TIME,"spanish");
					while($mes_numero != 6){
						$mes_letras= ucwords(strftime('%B',strtotime('-'.$mes_numero.' month')));
						$url_pdf = '../liquidaciones/'.$_SESSION['empresa'].'/'.date('mY',strtotime('-'.$mes_numero.' month')).'/'.$_SESSION['rut'].'.pdf';
						if(file_exists($url_pdf)){
							echo '<li><a href="'.$url_pdf.'" target="_blank" title ="Liquidaciones de '.$mes_letras.'"><span>Liquidación de '.$mes_letras.'</span></a></li>';
						}else {
							echo '<li class="no-bg"><a><span>No se encontro la liquidación de '.$mes_letras.'.</a></span></li>';
						}
						$mes_numero++;
					}
					echo '</ul>
				</div>';
				}?>
				<!-- termino de publicaciones -->
			</div>
<?php require_once('../../layout/footer.php'); 