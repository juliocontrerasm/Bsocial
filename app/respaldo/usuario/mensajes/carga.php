<?php
	require_once('../../core/config.php');
	require_once('../../layout/prueba.php');
	$mensaje = new ajaxCRUD("Total", "mensajes", '', "./");
	$mensaje_usuario = new ajaxCRUD("Total", "mensaje_usuario", '', "./");
	$mensajes = $mensaje->getQuery("SELECT * FROM mensajes");
	foreach($mensajes as $me):
	$mensaje_usuario->getquery("INSERT INTO `mensaje_usuario`(`id`, `id_mensaje`, `id_usuario`,`rol`, `deleted`, `created`) VALUES (null,".$me['id'].",".$me['para'].",'1','0',CURRENT_TIMESTAMP), (null,".$me['id'].",".$me['de'].",'2','0',CURRENT_TIMESTAMP)");
	endforeach;
?>