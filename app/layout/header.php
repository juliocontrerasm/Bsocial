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

<link rel="stylesheet" href="<?php echo $url;?>css/reset.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $url;?>css/estilo.css" type="text/css" />
<script type="text/javascript" src="<?php echo $url;?>js/jquery.tools.min.js"></script> 
<script type="text/javascript" src="<?php echo $url;?>js/funciones.js"></script>
<script type="text/javascript" src="<?php echo $url;?>js/jquery-validate.min.js"></script>
<script type="text/javascript" src="<?php echo $url;?>js/validCampoFranz.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>  
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,400italic,300italic,100italic,100,500italic,700italic,900,900italic' rel='stylesheet' type='text/css'>


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
					<li  id="contenedor-drop-mensajes">
						<a href="../mensajes/" title="Mensajes" id="mensajes">mensajes</a>
						<div id="dropdown-mensajes">
							<div id="contenedor-flecha-mensajes">
								<span class="flecha-up"></span>
							</div>
							<div id="mensaje-overflow">
								<?php 
								$mensaje = new ajaxCRUD("Total", "mensajes", '', "./");
								$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
								$mensajes = $mensaje->getQuery("SELECT me.* FROM mensajes me, mensaje_usuario me_us WHERE me.para='".$_SESSION['id_usuario']."' AND me_us.id_mensaje=me.id AND me_us.id_usuario = me.para AND me.id_mensaje = 0 AND me_us.deleted = 0 AND me_us.rol =1 GROUP BY me.id");
								foreach($mensajes as $me){
								?>
								<div class="drop-mensaje <?php if($me['leido'] != "si") {echo "noleido"; }?>">
									<p class="drop-asunto">
										<a href="../../usuario/mensajes/leer.php?id=<?=$me['id']?>" title="<?php echo $me['asunto'];?>"><?php if(strlen($cadena)<27){ echo $me['asunto']; }else{echo substr($me['asunto'],0, 27).'...';}?></a><!-- <span class="globo">99</span> -->
									</p>
									<p class="drop-fecha"><?php  echo date(' d / m / Y ', $me['created']).' a las '.date('H:i', $me['created']).' Hrs.'; ?></p>
								</div>
								<?php } ?>
							</div>
						</div>
					</li>
					<li><a href="../perfil" title="Usuario" id="usuario">usuario</a></li>
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
