<?php
	require_once('../../core/config.php');
	require_once('../../layout/prueba.php');
	if(!$_SESSION['empresa'] && !$_SESSION['nombre']){
		header('Location: ../login/?error=2');
	}
	$publicacion = new ajaxCRUD("Total", "publicaciones", '', "./");
	$comentario = new ajaxCRUD("Total", "comentarios", '', "./");
	$grupo = new ajaxCRUD("Total", "grupos", '', "./");
	$categoria = new ajaxCRUD("Total", "categorias", '', "./");
	$like = new ajaxCRUD("Total", "likes", '', "./");
	if($_POST['nuevo_comentario']!=null){
		$texto = addslashes(strip_tags($_POST['nuevo_comentario']));
		$comentario->getQuery("INSERT INTO  `comentarios` (`id`,`id_publicacion`,`id_usuario`,`texto` ,`created` ,`deleted`)
		VALUES (NULL , '".$_POST['id_publicacion']."',  '".$_SESSION['id_usuario']."', '".$texto."', '".date("Y-m-d H:i:s")."' ,  '0');");
	}
	if($_POST['nueva_publicacion']!=null){
		$texto = addslashes(strip_tags($_POST['nueva_publicacion']));
		$publicacion->getQuery("INSERT INTO  `publicaciones` (`id`,`id_categoria`,`id_usuario` ,`id_grupo` ,`id_tipo` ,`texto` ,`created` ,`deleted`)
		VALUES (NULL , '".$_POST['categoria']."',  '".$_SESSION['id_usuario']."', '".$_POST['grupo_estado']."',  '".$_POST['tipo_estado']."',  '".$texto."', '".date("Y-m-d H:i:s")."' ,  '0');");
	}
		echo  $_SESSION['id_usuario']. '<br />';
		echo  $_SESSION['usuario']. '<br />';
		echo  $_SESSION['empresa'].'<br />';
		$publicaciones = $publicacion->getQuery("SELECT pu.* FROM publicaciones as pu, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE en.id= ".$_SESSION['empresa']." AND us.id_empresa = ".$_SESSION['empresa']." AND gr.id_empresa =".$_SESSION['empresa']." AND gr_us.id_usuario = ".$_SESSION['id_usuario']." AND gr_us.id_usuario = us.id AND pu.id_usuario = us.id OR pu.id_usuario_etiquetado IN (SELECT id FROM usuarios WHERE id_empresa = ".$_SESSION['empresa'].") GROUP BY pu.id ORDER BY pu.created DESC ");	
		$grupos = $grupo->getQuery("SELECT gr.id, gr.nombre FROM grupos gr, usuarios us, grupo_usuario gr_us, empresas en WHERE us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id  GROUP BY gr.id ORDER BY gr.id");
		$categorias = $categoria->getQuery("SELECT id, nombre FROM categorias WHERE id_empresa =".$_SESSION['empresa']." GROUP BY id ORDER BY id_empresa");		
	if($_GET['categoria']!=null and $_GET['categoria']!=1 ){
		$publicaciones = $publicacion->getQuery("SELECT pu.* FROM publicaciones as pu, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE en.id= ".$_SESSION['empresa']." AND us.id_empresa = ".$_SESSION['empresa']." AND gr.id_empresa =".$_SESSION['empresa']." AND gr_us.id_usuario = ".$_SESSION['id_usuario']." AND gr_us.id_usuario = us.id AND pu.id_usuario = us.id AND pu.id_categoria = ".$_GET['categoria']." OR pu.id_usuario_etiquetado IN ( SELECT us.id FROM usuarios as us, publicaciones as pu WHERE us.id_empresa = ".$_SESSION['empresa']." AND pu.id_categoria = ".$_GET['categoria']."  ) GROUP BY pu.id ORDER BY pu.created DESC");
	}
	if($_GET['grupo']!=null){
		$publicaciones = $publicacion->getQuery("SELECT pu.* FROM publicaciones as pu, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE en.id= ".$_SESSION['empresa']." AND us.id_empresa = ".$_SESSION['empresa']." AND gr.id_empresa =".$_SESSION['empresa']." AND gr_us.id_usuario = ".$_SESSION['id_usuario']." AND gr_us.id_usuario = us.id AND pu.id_usuario = us.id AND pu.id_grupo = ".$_GET['grupo']."  GROUP BY pu.id ORDER BY pu.created DESC");
	}
?>
Menu:  <a href="../perfil" title="Editar perfil">Editar datos</a> | <a href="../cronjob/cumpleanos_vista.php" title="Ver cumpleaños">Cumpleaños</a> | <a href="../mensajes/" title= "ve a mensajes">Mensajes</a> | <a href="../login/logout.php" title= "Cerrar sesion">Cerrar sesion </a>
    	<form action="" method="post">
			<textarea name="nueva_publicacion"></textarea>	
			<select name="tipo_estado">
				<option value="1">Texto</option>
				<option value="2">Video</option>
				<option value="3">Audio</option>
				<option value="4">Foto</option>
			</select>
			<select name="grupo_estado">
				<?php foreach($grupos as $g){?>
				<option value="<?php echo $g['id']?>"><?php echo $g['nombre']?></option>
				<?php }?>
			</select>	
				<select name="categoria">
					<?php foreach ($categorias as $c){?>
				<option value="<?php echo $c['id']?>"><?php echo $c['nombre']?></option>
				<?php }?>
			</select>	
			<button class="btn primary" type="submit">Publicar</button>
	</form>
	<?php foreach ($categorias as $c){
				echo '<a href="?categoria= '.$c['id'].'"> '.$c['nombre'].'</a> <br/>';
 			}
 			foreach($grupos as $g){
 				echo '<a href="?grupo= '.$g['id'].'"> '.$g['nombre'].'</a> <br/>';
				 }
		$i=1;
		$z=1;
		foreach($publicaciones as $publicacion){
			$comentarios = $comentario->getQuery("SELECT id,id_usuario, texto, created FROM comentarios WHERE id_publicacion =".$publicacion['id']." ORDER BY created DESC");
			$like_estado = $like->getQuery("SELECT count(id) as count FROM likes WHERE id_publicacion = ".$publicacion['id']." AND id_comentario='0' AND deleted = 0");
			$like_estado_usuario = $like->getQuery("SELECT count(id) as count FROM likes WHERE id_publicacion = ".$publicacion['id']." AND id_usuario=".$_SESSION['id_usuario']." AND id_comentario='0' AND deleted = 0");
			echo '<div id ="comentarios-n'.$i.'"> Usuario: '.$publicacion['id_usuario'];
			echo '<br />';
			echo $publicacion['texto'];
			echo '<br />';
			if($like_estado_usuario[0]['count']==0){
				echo '<br /> <span class ="like"> Likes: <span id="like-count-'.$i.'">'.$like_estado[0]['count'].'</span> </span> <a id="like-publicacion-'.$i.'" title="Like" >Me gusta</a>';
			}else{
				echo '<br /> <span class ="like"> Likes: <span id="like-count-'.$i.'">'.$like_estado[0]['count'].'</span> </span> <a id="like-publicacion-'.$i.'" title="Like" >Ya no me gusta</a>';
			}
			echo '<br/>hace '.fecha_pro($publicacion['created']);
			if($comentarios != null){
				echo '<br/>';				
				echo '<br /> comentarios de la publicacion';
				foreach($comentarios as $con){
					$like_comentario = $like->getQuery("SELECT count(id) as count FROM likes WHERE id_publicacion = ".$publicacion['id']." AND id_comentario = ".$con['id']." AND deleted = 0");
					$like_comentario_usuario = $like->getQuery("SELECT count(id) as count FROM likes WHERE id_publicacion = ".$publicacion['id']." AND id_usuario=".$_SESSION['id_usuario']." AND id_comentario = ".$con['id']." AND deleted = 0");
					echo '<br /> Usuario: '.$con['id_usuario'];
					echo '<br />';
					echo $con['texto'];
					echo '<br />';
					if($like_comentario_usuario[0]['count']==0){
						echo '<br /> <span class ="like"> Likes: <span id="like-count-comentario-'.$z.'">'.$like_comentario[0]['count'].'</span> </span> <a id="like-comentario-'.$z.'" title="Like" >Me gusta</a>';
					}else{
						echo '<br /> <span class ="like"> Likes: <span id="like-count-comentario-'.$z.'">'.$like_comentario[0]['count'].'</span> </span> <a id="like-comentario-'.$z.'" title="Like" >Ya no me gusta</a>';
					}
					echo '<br/>hace '.fecha_pro($con['created']);
			?>
			<script>
			jQuery(document).ready(function ($){
				$("#like-comentario-<?php echo $z;?>").click(function() {
					var like= $("#like-count-comentario-<?php echo $z;?>").html();
					var like_text=$("#like-comentario-<?php echo $z;?>").html();
					if(like_text =='Me gusta'){
					like = parseInt(like)+1;
					like_text ='Ya no me gusta';
					$("#like-comentario-<?php echo $z;?>").html(like_text);
					$("#like-count-comentario-<?php echo $z;?>").html(like);
				}else{
					like = parseInt(like)-1;
					like_text ='Me gusta';
					$("#like-comentario-<?php echo $z;?>").html(like_text);
					$("#like-count-comentario-<?php echo $z;?>").html(like);
				}
					$.ajax({
                        url:'likes.php', 
                        data:{ 
                        id_publicacion: <?php echo $publicacion['id'];?>,
                        id_usuario: <?php echo $_SESSION['id_usuario'];?>,
                        id_comentario : <?php echo $con['id'];?>
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
			<?php	$z++;}
			}
			?>
			<script>
			jQuery(document).ready(function ($){
				$("#like-publicacion-<?php echo $i;?>").click(function() {
					var like= $("#like-count-<?php echo $i;?>").html();
					var like_text=$("#like-publicacion-<?php echo $i;?>").html();
					if(like_text =='Me gusta'){
					like = parseInt(like)+1;
					like_text ='Ya no me gusta';
					$("#like-publicacion-<?php echo $i;?>").html(like_text);
					$("#like-count-<?php echo $i;?>").html(like);
				}else{
					like = parseInt(like)-1;
					like_text ='Me gusta';
					$("#like-publicacion-<?php echo $i;?>").html(like_text);
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
			<form action="" method="post">
			<input type="hidden" value="<?php echo $publicacion['id'];?>" name="id_publicacion" id="id_publicacion" >
			<textarea name="nuevo_comentario"></textarea>
			<button class="btn primary" type="submit">Comenta</button>
			</form>
		<?php echo '</div><hr />';
				$i++;
				};	
				if($_GET['categoria']==8){
					$mes_numero = 0;	
					setlocale (LC_TIME,"spanish");
					while($mes_numero != 6){
						$mes_letras= ucwords(strftime('%B',strtotime('-'.$mes_numero.' month')));
						echo $mes_letras.'<br/>';
						$url = '../liquidaciones/'.$_SESSION['empresa'].'/'.date('mY',strtotime('-'.$mes_numero.' month')).'/'.$_SESSION['rut'].'.pdf';
						if(file_exists($url)){
							echo '<a href="'.$url.'" target="_blank" title ="Liquidaciones de '.$mes_letras.'">Liquidacio de '.$mes_letras.'</a> ('.tamano_archivo($url).')';
						}else {
							echo 'No se encontro la liquidacion de este mes.';
						}
						echo '<hr />';
						$mes_numero++;
					}
				}
	require_once('../../layout/prueba_footer.php'); ?>