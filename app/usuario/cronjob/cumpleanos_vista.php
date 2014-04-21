<?php 
	require_once('../../core/config.php');
	require_once('../../layout/prueba.php');
	$publicacion = new ajaxCRUD("Total", "publicaciones", '', "./");
	$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
	$empresa = new ajaxCRUD("Total", "empresas", '', "./");
	$publicaciones = $publicacion->getQuery("SELECT pu.* FROM publicaciones as pu, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE us.id_empresa = ".$_SESSION['empresa']." AND us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id AND pu.id_categoria = 5 AND MONTH (pu.created) = MONTH (NOW()) AND DAY(pu.created)=DAY(NOW()) GROUP BY pu.id ORDER BY pu.created DESC");
	foreach($publicaciones as $pu):
		$usuarios =$usuario->getQuery("SELECT id,nombre,apellido FROM usuarios WHERE id='".$pu['id_usuario_etiquetado']."'"); 
		echo	'<div >';	
		echo		'<p>';
		echo 			'Saluda en su dia de cumpleaños a <a href="#" title="Saludos de cumpleaños">'.ucwords($usuarios[0]['nombre']).' '.ucwords($usuarios[0]['apellido']).'</a>';
		echo		'</p>';
		echo	'</div>';
	endforeach;
	require_once('../../layout/prueba_footer.php'); ?>