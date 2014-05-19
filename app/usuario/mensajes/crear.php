<?php 
	// require_once('../../core/config.php');
	require_once('../../layout/header.php');
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
	// pr($_SESSION["autocompletar"]);
	?>

      <div id="col-centro" class="col-contenido">
        	<div id="contenedor-contenido" class="nuevo-msj">
        		<form method="post" action="" id="nuevo-mensaje"> 
					<h3>Redactar nuevo mensaje</h3>
						<div class="contenedor-campos">
							<label for="buscador-destinatario">Para:</label>
							<div id="contenedor-destinatarios" class="contenedor-valores">
								<!-- <span class="destinatario">Felipe Morales <a class="eliminar">x</a></span>
								<span class="destinatario">Felix Saucedo <a class="eliminar">x</a></span>
								<span class="destinatario">Josefina Vargas <a class="eliminar">x</a></span> -->
								<input type="text" id="buscador-destinatario"/> 
							</div>
						</div>
						<div class="contenedor-campos">
							<label for="asunto-mensaje" class="sin-margin">Asunto:</label>
							<input type="text" id="asunto-mensaje-enviar" class="contenedor-valores" name="asunto"/>
						</div>
						<div class="contenedor-campos">
							<label for="asunto-mensaje" class="sin-margin">Mensaje:</label>
							<textarea class="contenedor-valores" name="texto"></textarea>
						</div>
						<input id="id_nombre" name="id_nombre" hidden>
						<p class="btn enviar-msj">
 							<a href="#" title="Enviar" id="enviar-mensaje">Enviar</a>
 						</p>
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
		$( "#buscador-destinatario" ).autocomplete({
			source: "search.php",
			autoFocus: true,
			select: function( event, ui ) {
				log( ui.item.id );
			},
			focus: function( event, ui ) {
				log( ui.item.id );
			},
		});
	});

	$("#enviar-mensaje").click(function(){
		$("#nuevo-mensaje").submit();
	 });
	</script>

        </div>
      </div>
  <?php require_once('../../layout/footer.php'); ?>