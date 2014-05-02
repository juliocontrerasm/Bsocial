<?php require_once('../../core/config.php'); 
	if(!$_SESSION['empresa'] && !$_SESSION['nombre']){
		header('Location: ../login/?error=2');
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html;" charset="utf-8">
<title>B-Social - La Red Social para Empresas</title>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" >
<link rel="stylesheet" href="<?php echo $url;?>css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $url;?>css/estilo.css" type="text/css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $url;?>js/jquery.tools.min.js"></script> 
<script type="text/javascript" src="<?php echo $url;?>js/funciones.js"></script>
<script src="<?php echo $url;?>js/jquery-1.10.2.js"></script> 
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>  
<script type="text/javascript" src="<?php echo $url;?>js/bootstrap.js"></script>
<script type="text/javascript" src="<?php echo $url;?>js/jquery-validate.min.js"></script>
<script type="text/javascript" src="<?php echo $url;?>js/validCampoFranz.js"></script>
<link href='http://fonts.googleapis.com/css?family=Roboto:400,700,500,300,400italic,300italic,100italic,100,500italic,700italic,900,900italic' rel='stylesheet' type='text/css'>


</head>

<body>
	<div id="contenedor-general" class="clearfix">
		<div id="header">
			<div id="logo">
				<h1><a href="<?php echo $url;?>usuario/estados/" title="B-Social - Home">B-Social - La Red Social para Empresas</a></h1>
			</div>
			<div id="bigbanner">
			</div>
			<div id="menu-user">
				<ul id="iconos-user">
					<li><a href="../perfil" title="Información" id="informacion">Información</a></li>
					<li><a href="../mensajes/" title="mensajes" id="mensajes">mensajes</a></li>
					<li><a href="../perfil" title="usuario" id="usuario">usuario</a></li>
				</ul>
				<ul id="btn-username">
					<li id="contenedor-drop">
						<a><?php echo  $_SESSION['usuario']; ?></a>
						<ul id="dropdown-username">
							<li id="contenedor-flecha"><span class="flecha-up"></span> <a href="../perfil" title="Configuración">Configuración</a></li>
							<li><a href="../login/logout.php" title="Cerrar sesión">Cerrar sesión</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	
		<div id="contenedor-central">
<?php require_once('sidebar_izq.php'); ?>
