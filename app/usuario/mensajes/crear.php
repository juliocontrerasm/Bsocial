<?php 
	require_once('../../core/config.php');
	require_once('../../layout/prueba.php');
	if(!$_SESSION['empresa'] && !$_SESSION['nombre']){
		header('Location: ../login/?error=2');
	}
	$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
	$nombre = $usuario->getQuery("SELECT us.id, us.nombre FROM  grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE us.id_empresa = ".$_SESSION['empresa']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id GROUP BY us.id  ");
	$result = array();
	foreach ($nombre as $value) {
		array_push($result, array("id"=>$value['id'], "value" => strip_tags($value['nombre'])));
		}
		$_SESSION["autocompletar"]=$result;
	if($_POST['enviar'])
	{
		if(!empty($_POST['para']) && !empty($_POST['asunto']) && !empty($_POST['texto']))
		{
			$mensaje = new ajaxCRUD("Total", "mensajes", '', "./");
			$mensaje_usuario = new ajaxCRUD("Total", "mensaje_usuario", '', "./");
			$fecha = date("j/m/Y, g:i a");
			$mensaje->getQuery("INSERT INTO mensajes (para,de,fecha,asunto,texto,created) VALUES ('".$_POST['id_nombre']."','".$_SESSION['id_usuario']."','".$fecha."','".$_POST['asunto']."','".$_POST['texto']."',CURRENT_TIMESTAMP)");
			$mensajes= $mensaje->getQuery("SELECT id FROM mensajes WHERE para='".$_POST['id_nombre']."' AND de = '".$_SESSION['id_usuario']."' AND fecha = '".$fecha."' AND asunto= '".$_POST['asunto']."' AND texto ='".$_POST['texto']."'");
			//pr($mensajes);
			$mensaje_usuario->getquery("INSERT INTO `mensaje_usuario`(`id`, `id_mensaje`, `id_usuario`,`rol`, `deleted`, `created`) VALUES (null,".$mensajes[0]['id'].",".$_POST['id_nombre'].",'1','0',CURRENT_TIMESTAMP), (null,".$mensajes[0]['id'].",".$_SESSION['id_usuario'].",'2','0',CURRENT_TIMESTAMP)");
			echo $_POST['id_nombre'];
			echo "Mensaje enviado correctamente.";
		}
	}
	pr($_SESSION["autocompletar"]);
	?>
	Menu:  <a href="../perfil" title="Editar perfil">Editar datos</a> | <a href="../estados" title="Home">Home</a> | <a href="index.php">Ver mensajes</a> | <a href="crear.php">Crear mensajes</a> | <a href="salida.php">Ver mensajes enviados</a> | <a href="cerrar.php">Cerrar sesion</a><br /><br />
	<form method="post" action="" >
	<br /><br />
	Para:<br />
	<input type="text" name="para" id="para"/><br />
	Asunto:<br />
	<input type="text" name="asunto" /><br />
	Mensaje:<br />
	<textarea name="texto"></textarea>
	<br /><br />
	<input id="id_nombre" name="id_nombre" hidden>
	<input type="submit" name="enviar" value="Enviar" />
	</form>
	<style>
	.ui-autocomplete-loading {
		background: white url('ui-anim_basic_16x16.gif') right center no-repeat;
	}
	</style>
	<script>
	$(function() {
		$.ui.autocomplete.prototype.options.autoSelect = true;
		function log( message ) {
			document.getElementById("id_nombre").value =parseInt(message);
		}
		$( "#para" ).autocomplete({
			source: "search.php",
			autoFocus: true,
			selectFirst: true,
			onlySelect: true,
			autoSelect: true,
			delay:100,
			select: function( event, ui ) {
				log( ui.item.id );
			},
			focus: function( event, ui ) {
				log( ui.item.id );
			},
		});
	});
	</script>

	<?php require_once('../../layout/prueba_footer.php'); ?>