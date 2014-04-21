<?php
	require_once('../../core/config.php');
	require_once('../../layout/prueba.php');
	$mensaje_usuario = new ajaxCRUD("Total", "mensaje_usuario", '', "./");
	$mensaje_borrar =$_POST['mensaje_borra'];
	$rol = $_GET['rol'];
	foreach($mensaje_borrar as $me):
		$mensaje_usuario->getquery("UPDATE `mensaje_usuario` SET  `deleted` =  '1' WHERE `id_usuario` =".$_SESSION['id_usuario']." AND `id_mensaje`=".$me." AND `rol`='".$rol."'");
	endforeach;
	if($rol==1){
		header('Location: index.php');
	}else{
		header('Location: salida.php');
	}
?>