<?php
	session_start(); 

	require_once('../../core/config.php');
	if($_POST['input_contrasena']!=null)
	{
		$usuario = new ajaxCRUD("Total", "usuarios", '', "./"); 
		$documento= $_POST['tipo_documento'];
		switch ($documento) {
			case 'run': $nombre_usuario=$_POST['input_run'] ;break;
			case 'usuario': $nombre_usuario=$_POST['input_usuario'] ;break;
			case 'dni': $nombre_usuario=$_POST['input_dni'] ;break;
			case 'pasaporte': $nombre_usuario=$_POST['input_pasaporte'] ;break;	
		}
		$usuarios = $usuario->getQuery("SELECT us.id, us.username as nombre, us.id_empresa as empresa, us.id_persona as persona, per.nombre as nombre_persona  FROM usuarios as us, personas as per WHERE us.username =  '".$nombre_usuario."'  AND us.password='".md5($_POST['input_contrasena'])."'");
		if($usuarios[0]['nombre']!=null && $usuarios[0]['empresa']!=null)
		{
			$_SESSION['usuario'] = $usuarios[0]['nombre'];
			$_SESSION['id_usuario'] = $usuarios[0]['id'];
			$_SESSION['empresa'] = $usuarios[0]['empresa'];
			$_SESSION['id_persona'] = $usuarios[0]['persona'];
			$_SESSION['nombre'] = $usuarios[0]['nombre_persona'];
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
<body class="login">
	<div id="contenedor-general" class="clearfix login">
		<div id="contenedor-formulario">
			<h1>bsocial</h1>
			<form action="" method="post" id="login" >
				<?php if($_GET['error'] == 1 ){ ?>
				<h3>Usuario o Contraseña Incorrecta</h3>
			<?php } ?>  
			<?php if($_GET['error'] == 2 ){ ?>
				<h3>Sesión terminada</h3>
			<?php } ?>
			<?php if($_GET['save'] == 1 ){ ?>
				<h3>Usuario guardado exitosamente</h3>
			<?php } ?>
				<p>
					<label for="tipo_documento">Tipo de documento</label>
					<select name="tipo_documento" id="tipo_documento">
						<option value="run" id="documento-run" selected>R.U.N.</option>
						<option value="usuario" id="documento-usuario">Usuario</option>
						<option value="dni" id="documento-dni">D.N.I.</option>
						<option value="pasaporte" id="documento-pasaporte">Pasaporte</option>
					</select>
				</p>
				<p id="contenedor-run" class="contenedor-input">
					<label for="input_run">Ingresa tu R.U.N.</label>
					<input type="text" name="input_run" id="input_run" placeholder="Ej: 12345678" maxlength="8" /> - <input type="text" name="input_run_digito" id="input_run_digito" placeholder="9" maxlength="1" />
				</p>
				<p id="contenedor-usuario" class="contenedor-input hide">
					<label for="input_usuario">Ingresa tu Usuario</label>
					<input type="text" name="input_usuario" id="input_usuario" placeholder="juan.perez" />
				</p>
				<p id="contenedor-dni" class="contenedor-input hide">
					<label for="input_dni">Ingresa tu D.N.I.</label>
					<input type="text" name="input_dni" id="input_dni" placeholder="Ej: 12345678" maxlength="8" />
				</p>
				<p id="contenedor-pasaporte" class="contenedor-input hide">
					<label for="input_pasaporte">Ingresa tu Pasaporte</label>
					<input type="text" name="input_pasaporte" id="input_pasaporte" placeholder="Ej: 123456789" maxlength="9" />
				</p>
				<p>
					<label for="input_contrasena">Contraseña</label>
					<input type="password" name="input_contrasena" id="input_contrasena" maxlength="12" />
				</p>
				<p id="login-ingresar" class="btn">
					<a href="#" title="Ingresar" id ="boton-login">Ingresar</a>
				</p>
				<p id="olvido-contrasena">
					<a href="#" title="¿Olvidaste tu contraseña?">¿Olvidaste tu contraseña?</a>
				</p>
			</form>
			<h2>La red social para empresas</h2>
		</div>
		<p id="login-footer">¿Necesitas soporte técnico? <a href="#" title="Contáctanos" class="bold">Contáctanos</a> | Desarrollado por <a href="http://suma.cl/" title="Ir a SUMA.cl" target="_blank">SUMA</a></p>
	</div>

	<script type="text/javascript">
		$("#input_run").Rut({
			digito_verificador: '#input_run_digito',
			on_error: function(){ alert('Rut incorrecto'); },
		});
		$("#boton-login").click(function(){
		    $("#input_run").val($.Rut.quitarFormato($("#input_run").val()));
			$("#login").submit();
		});
	</script>

	</body>
</html>
