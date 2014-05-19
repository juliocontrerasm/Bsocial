<?php
  // require_once('../../core/config.php');
   require_once('../../layout/header.php'); 
	if(!$_SESSION['empresa'] && !$_SESSION['nombre']){
		header('Location: ../login/?error=2');
	}
	$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
	$region = new ajaxCRUD("Total", "regiones", '', "./");
	$comuna = new ajaxCRUD("Total", "comunas", '', "./");
	if($_GET['usuario']!=null){
		$usuarios = $usuario->getQuery("SELECT us.id as id_usuario ,us.id_empresa as id_empresa,per.nombre as nom_usuario, per.apellido as apell_usuario,per.direccion as direc_usuario, per.cargo as cargo_usuario, em.nombre as nom_empresa , com.comuna as nom_comuna , re.region as nom_region FROM usuarios as us, regiones as re, comunas as com, empresas as em, personas as per WHERE us.id ='".$_GET['usuario']."' AND per.id = us.id_persona AND em.id = us.id_empresa AND com.id = per.id_comuna AND re.id = com.id_region group by us.id  ");
		
	}else{
		$usuarios = $usuario->getQuery("SELECT us.id as id_usuario ,us.id_empresa as id_empresa,per.nombre as nom_usuario, per.apellido as apell_usuario,per.direccion as direc_usuario, per.cargo as cargo_usuario, em.nombre as nom_empresa , com.comuna as nom_comuna , re.region as nom_region FROM usuarios as us, regiones as re, comunas as com, empresas as em, personas as per WHERE us.id ='".$_SESSION['id_usuario']."' AND per.id = us.id_persona AND em.id = us.id_empresa AND com.id = per.id_comuna AND re.id = com.id_region group by us.id  ");
	}
	// pr($usuarios);
?>

      <div id="col-centro" class="col-contenido">
		<div id="contenedor-contenido" class="perfil">
			<?php 
			$url_imagen = '../../usuario/perfil/img/'.$usuarios[0]['id_empresa'].'/'.$usuarios[0]['id_usuario'].'.jpg';
			if( file_exists($url_imagen) ){ 
			echo '<img src="'.$url_imagen.'" alt="Imagen perfil" />';
			 } else { 
			echo '<img src="'.$url.'/css/img/avatar.jpg" alt="Imagen perfil" />';
			 } 
				echo '<h3>'.ucwords($usuarios[0]['nom_usuario']).' '.ucwords($usuarios[0]['apell_usuario']).'</h3>';
				echo '<p class="titulo">Cargo:</p>';
				echo '<p class="bajada">'.ucwords($usuarios[0]['cargo_usuario']).'</p>';
				echo '<p class="titulo">Empresa:</p>';
				echo '<p class="bajada">'.$usuarios[0]['nom_empresa'].'</p>';
				echo '<p class="titulo">Locación:</p>';
				echo '<p class="bajada">'.$usuarios[0]['direc_usuario'].' , '.$usuarios[0]['nom_comuna'].' , '.$usuarios[0]['nom_region'].' </p>';
				if($_GET['usuario']!=null && $_GET['usuario']!=$_SESSION['id_usuario']){
					echo '<p class="btn">';
					echo '	<a href="#" title="Enviar un mensaje">Enviar un mensaje</a>';
					echo '</p>';
				} else {
					echo '<p class="editar"><a href="editar.php" title="Editar perfil">Editar perfil</a></p>';
				}
				?>
		</div>
      </div>
  <?php require_once('../../layout/footer.php'); ?>