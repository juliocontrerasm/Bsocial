<?php
	//session_save_path(dirname($_SERVER['DOCUMENT_ROOT']).'/public_html/tmp');
//phpinfo();
	session_start(); 
	require_once('../../core/config.php');

	if($_POST['user']!=null && $_POST['pass']!=null)
	{
		$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
		$usuarios = $usuario->getQuery("SELECT id, username as nombre, id_empresa as empresa FROM usuarios WHERE username ='".$_POST['user']."' AND password='".md5($_POST['pass'])."'");
		
		
				
		if($usuarios[0]['nombre']!=null && $usuarios[0]['empresa']!=null)
		{
			$_SESSION['usuario'] = $usuarios[0]['nombre'];
			$_SESSION['id_usuario'] = $usuarios[0]['id'];
			$_SESSION['empresa'] = $usuarios[0]['empresa'];
			
			header('Location:../estados');
			//echo $_SESSION['empresa'];
			//pr($usuarios);
		}
		else
		{
			header('Location:../login/?error=1'.$_POST['user'].$_POST['pass'].$usuarios);	
		}	
	
		
	}
?>
	<?php if($_GET['error'] == 1 ){ ?>
		<h3>Usuario o Contraseña Incorrecta</h3>
	<?php } ?>  
	<?php if($_GET['error'] == 2 ){ ?>
		<h3>Sesión terminada</h3>
	<?php } ?>    	
	<form action="" method="post">
			<div class="clearfix">
				<input type="text" placeholder="Usuario" name="user">
			</div>
			<div class="clearfix">
				<input type="password" placeholder="Contraseña" name="pass">
			</div>
			<button class="btn primary" type="submit">Entrar</button>
	</form>
				