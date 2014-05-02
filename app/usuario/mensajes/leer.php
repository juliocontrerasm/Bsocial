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
		$nombre = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$mensajes[0]['de']);
	}else if($salida==1){
		$mensajes = $mensaje->getQuery("SELECT * FROM mensajes WHERE de='".$_SESSION['id_usuario']."' AND id=".$id);
		$nombre = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$mensajes[0]['para']);
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
	$respuestas = $mensaje->getQuery("SELECT * FROM mensajes WHERE id_mensaje = '".$id."' ORDER BY created DESC");
?>


      <div id="col-centro" class="col-contenido">
        <div class="contendor-publicacion">
        	
Menu:  <a href="../perfil" title="Editar perfil">Editar datos</a> | <a href="../estados" title="Home">Home</a> | <a href="index.php">Ver mensajes</a> | <a href="crear.php">Crear mensajes</a> | <a href="salida.php">Ver mensajes enviados</a> | <a href="../login/logout.php">Cerrar sesion</a><br /><br />
<form action="" method="post">
<strong>Asunto:</strong> <?=$mensajes[0]['asunto']?><br /><br />
<strong>Mensaje:</strong><br />
<?php foreach ($respuestas as $res){
			$nombre2 = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$res['de']);
		echo '<strong>De:</strong>'.ucwords($nombre2[0]['nombre']).'<br />';
		echo '<strong>Fecha:</strong>'.$res['fecha'].'<br />';
		echo '<strong>Texto:</strong>'.$res['texto'].'<br />';
		echo '<hr />';
	}?>
	<?php if($salida==null){?>
	<strong>De:</strong> <?=ucwords($nombre[0]['nombre'])?><br />
	<?php } else {?>
	<strong>Para:</strong> <?=ucwords($nombre[0]['nombre'])?><br />
	<?php }?>
	<strong>Fecha:</strong> <?=$mensajes[0]['fecha']?><br />
	<?=$mensajes[0]['texto']?>
	<br />
	<hr />
	<br />
	<textarea name="respuesta"></textarea>
	<br />
	<button name="envio" type="submit" >Responder</button>
	<?php 
	# Avisamos que ya lo leimos
	if($salida==null){
	if($mensajes[0]['leido'] != "si")
	{
		$mensaje->getQuery("UPDATE mensajes SET leido='si' WHERE id='".$id."'");
	}
	}
	?>
	</form>


        </div>
      </div>
  <?php require_once('../../layout/footer.php'); ?>