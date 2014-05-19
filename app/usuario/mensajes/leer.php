<?php 
	// require_once('../../core/config.php');
	 require_once('../../layout/header.php'); 
	if(!$_SESSION['empresa'] && !$_SESSION['nombre']){
		header('Location: ../login/?error=2');
	}
	$id = $_GET['id'];
	$salida =$_GET['salida'];
	$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
	$mensaje = new ajaxCRUD("Total", "mensajes", '', "./");
	$mensaje_usuario = new ajaxCRUD("Total", "mensaje_usuario", '', "./");
	if($salida==null){
		$mensajes = $mensaje->getQuery("SELECT * FROM mensajes WHERE para='".$_SESSION['id_usuario']."' AND id=".$id);
		$nombre[] = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$mensajes[0]['de']);
		$nombre[] = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$mensajes[0]['para']);
	}else if($salida==1){
		$mensajes = $mensaje->getQuery("SELECT * FROM mensajes WHERE de='".$_SESSION['id_usuario']."' AND id=".$id);
		$nombre[] = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$mensajes[0]['para']);
		$nombre[] = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$mensajes[0]['de']);
	}
	if($_POST['respuesta']!= null){
		$mensaje_usuario->getquery("UPDATE `mensaje_usuario` SET `deleted`=0 WHERE `id_mensaje`='".$id."'");
		$fecha = date("j/m/Y, g:i a");
		if($salida==null){
			$mensaje->getQuery("INSERT INTO mensajes (id_mensaje,para,de,fecha,asunto,texto,created) VALUES (".$id.",'".$mensajes[0]['de']."','".$_SESSION['id_usuario']."','".$fecha."','".$mensajes[0]['asunto']."','".$_POST['respuesta']."',CURRENT_TIMESTAMP)");				
		}else if($salida==1){
			$mensaje->getQuery("INSERT INTO mensajes (id_mensaje,para,de,fecha,asunto,texto,created) VALUES (".$id.",'".$mensajes[0]['para']."','".$_SESSION['id_usuario']."','".$fecha."','".$mensajes[0]['asunto']."','".$_POST['respuesta']."',CURRENT_TIMESTAMP)");				
		}
	}
	$respuestas = $mensaje->getQuery("SELECT * FROM mensajes WHERE id_mensaje = '".$id."' ORDER BY created ASC");
	$last = end($respuestas);
	// pr($last);
?>
      <div id="col-centro" class="col-contenido">
        <div id="contenedor-contenido" class="contenedor-mensajes">
        	<div id="menu-mensajes">
	            <ul>
	              <li class="current"><a href="index.php" title="Mensajes recibidos">Recibidos</a>|</li>
	              <li><a href="salida.php" title="Mensajes enviados">Enviados</a>|</li>
	              <li><a href="borrar.php" title="Borrar mensajes">Borrar</a></li>
	              <!-- <li><a href="#" title="Buscar Mensajes" class="btn-lupita-trans">Buscar</a></li> -->
	              <li class="btn"><a href="crear.php" title="Escribir nuevo mensaje">Nuevo</a></li>
	            </ul>
	         </div>
	         <div id="asunto-mensaje">
						<h3><?php echo $mensajes[0]['asunto'];?></h3>
						<p><?php 
								  $coma=0;
								  // pr($nombre);
								  foreach ($nombre as $value) 
								  {
								  	if($coma!=0){echo ', ';};
								  	echo ucwords($value[0]['nombre']);
								  	$coma=1;
								  }?></p>
			</div>

			<div class="mensaje-abierto <?php if($mensajes[0]['de']==$_SESSION['id_usuario']){ echo 'blanco';}?>">
				<div class="foto-perfil">
					<?php $url_imagen = '../../usuario/perfil/img/'.$_SESSION['empresa'].'/'.$mensajes[0]['de'].'.jpg';
						if( file_exists($url_imagen) ){ ?>
						<p><img src="<?php echo $url_imagen;?>" alt="Imagen perfil" /></p>
						<?php } else { ?>
						<p><img src="<?php echo $url;?>/css/img/avatar.jpg" alt="Imagen perfil" /></p>
						<?php } ?>
				</div>
				<div class="texto-mensaje">
					<h6><?php echo ucwords($nombre[0][0]['nombre']);?></h6>
					<p><?php echo $mensajes[0]['texto'];?></p>
					<p class="fecha"><?php echo date(' d / m / Y ', strtotime($mensajes[0]['created'])).' a las '.date('H:i', strtotime($mensajes[0]['created'])).' Hrs.'; ?></p>
				</div>
				<?php if($respuestas ==null) {?>
						<div class="contenedor-escribir-comentario">
							<div class="escribir-comentario responder-mensaje">
								<form id="responder-mensaje" class="form-comentar-publicacion responder-mensaje" action="" method="post">
									<textarea placeholder="Responder mensaje..." name="respuesta"></textarea>
								</form>
							</div>
							<ul>
								<li class="btn comentar"><a title="Enviar" id="enviar-respuesta">Enviar</a></li>
							</ul>	
						</div>
						<script type="text/javascript">
							$("#enviar-respuesta").click(function(){
								$("#responder-mensaje").submit();
							});
						</script>

				<?php } ?>

			</div>
			<?php 
				foreach ($respuestas as $res){ 
					$nombre2 = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$res['de']);
				?>

			<div class="mensaje-abierto <?php if($res['de']==$_SESSION['id_usuario']){ echo 'blanco';}?>">
				<div class="foto-perfil">
					<?php $url_imagen = '../../usuario/perfil/img/'.$_SESSION['empresa'].'/'.$res['de'].'.jpg';
						if( file_exists($url_imagen) ){ ?>
						<p><img src="<?php echo $url_imagen;?>" alt="Imagen perfil" /></p>
						<?php } else { ?>
						<p><img src="<?php echo $url;?>/css/img/avatar.jpg" alt="Imagen perfil" /></p>
						<?php } ?>
				</div>
				<div class="texto-mensaje">
					<h6><?php echo ucwords($nombre2[0]['nombre']);?></h6>
					<p><?php echo $res['texto'];?></p>
					<p class="fecha"><?php echo date(' d / m / Y ', strtotime($res['created'])).' a las '.date('H:i', strtotime($res['created'])).' Hrs.'; ?></p>
				</div>
				<?php if($last['id'] == $res['id']) {?>
						<div class="contenedor-escribir-comentario">
							<div class="escribir-comentario responder-mensaje">
								<form id="responder-mensaje" class="form-comentar-publicacion responder-mensaje" action="" method="post">
									<textarea placeholder="Responder mensaje..." name="respuesta"></textarea>
								</form>
							</div>
							<ul>
								<li class="btn comentar"><a title="Enviar" id="enviar-respuesta">Enviar</a></li>
							</ul>	
						</div>
						<script type="text/javascript">
							$("#enviar-respuesta").click(function(){
								$("#responder-mensaje").submit();
							});
						</script>

				<?php } ?>


			</div>
			<?php } ?>

			
			</div>
		</div>
			<?php 
			if($salida==null){
				if($mensajes[0]['leido'] != "si")
				{
					$mensaje->getQuery("UPDATE mensajes SET leido='si' WHERE id='".$id."'");
				}
				}
				require_once('../../layout/footer.php'); ?>