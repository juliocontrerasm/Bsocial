<?php 
	require_once('../../core/config.php');
	require_once('../../layout/prueba.php');
	$publicacion = new ajaxCRUD("Total", "publicaciones", '', "./");
	$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
	$empresa = new ajaxCRUD("Total", "empresas", '', "./");
	$usuarios = $usuario->getQuery("SELECT id,nombre,apellido,fecha_nacimiento,id_empresa FROM usuarios WHERE MONTH (fecha_nacimiento) = MONTH (NOW()) AND DAY(fecha_nacimiento)=DAY(NOW())");
	foreach($usuarios as $u):
		$empresas= $empresa->getQuery("SELECT nombre FROM empresas WHERE id= ".$u['id_empresa']);
		$texto = "Feliz cumpleaños ".ucwords($u['nombre']).' '.ucwords($u['apellido']).", te desea ".ucwords($empresas[0]['nombre']).".";
		$publicacion->getQuery("INSERT INTO  `publicaciones` (`id`,`id_categoria`,`id_usuario_etiquetado` ,`id_grupo` ,`id_tipo` ,`texto` ,`created` ,`deleted`,`id_usuario`)
		VALUES (NULL , '5',  '".$u['id']."', '0',  '1',  '".$texto."', '".date("Y-m-d H:i:s")."' ,  '0','0');");
	endforeach;
	require_once('../../layout/prueba_footer.php'); ?>