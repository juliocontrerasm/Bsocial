<?php
	session_start(); 

	require_once('../../core/config.php');
	if($_POST['user']!=null && $_POST['pass']!=null)
	{
		$usuario = new ajaxCRUD("Total", "usuarios", '', "./"); 
		$usuarios = $usuario->getQuery("SELECT id, username as nombre, id_empresa as empresa, rut FROM usuarios WHERE rut =  '".$_POST['user']."'  AND password='".md5($_POST['pass'])."'");
		if($usuarios[0]['nombre']!=null && $usuarios[0]['empresa']!=null)
		{
			$_SESSION['usuario'] = $usuarios[0]['nombre'];
			$_SESSION['id_usuario'] = $usuarios[0]['id'];
			$_SESSION['empresa'] = $usuarios[0]['empresa'];
			$_SESSION['rut'] = $usuarios[0]['rut'];			
			header('Location:../estados/');
		}
		else
		{
			header('Location:../login/?error=1');	
		}
	}
	if ($_SESSION['id_usuario'] != null){
		header('Location:../estados/');
	}
	require_once('../../layout/prueba.php');
?>
	<?php if($_GET['error'] == 1 ){ ?>
		<h3>Usuario o Contraseña Incorrecta</h3>
	<?php } ?>  
	<?php if($_GET['error'] == 2 ){ ?>
		<h3>Sesión terminada</h3>
	<?php } ?>
	<?php if($_GET['save'] == 1 ){ ?>
		<h3>Usuario guardado exitosamente</h3>
	<?php } ?>     	
	<form action="" method="post" id="login">
			<div class="clearfix">
				<input type="text" placeholder="Usuario" name="user" id="user" class="required" maxlength="8"/> - <input class="required" type="text" id="verificador" name="verificador" maxlength="1"/>
			</div>
			<div class="clearfix">
				<input type="password" placeholder="Contraseña" name="pass">
			</div>
			<button class="btn primary" type="button" id="enviar">Entrar</button>
	</form>
	<a href="../perfil/add.php"> Crear cuenta</a>
	<script type="text/javascript">
		$("#user").Rut({
			digito_verificador: '#verificador',
			on_error: function(){ alert('Rut incorrecto'); },
			//on_success: function(){ alert('Rut correcto'); } 
		});
		$("#enviar").click(function(){
			$("#user").val($.Rut.quitarFormato($("#user").val()));
			$("#login").submit();
		});
		$('#user').validCampoFranz('0123456789');
		$('#verificador').validCampoFranz('0123456789kK');
	</script>
