<?php
	//session_save_path(dirname($_SERVER['DOCUMENT_ROOT']).'/public_html/tmp');

	session_start(); 
	require_once('../../core/config.php');

	if(!$_SESSION['empresa'] && !$_SESSION['nombre']){
		header('Location: ../login/?error=2');
	}

	$like = new ajaxCRUD("Total", "likes", '', "./");
	echo $_POST['id_estado'];
	echo $_POST['id_usuario'];
	echo $_POST['id_comentario'];
if($_POST['id_comentario']==null){
	if($_POST['id_estado']!=null && $_POST['id_usuario']!=null)
	{
		$likes= $like->getQuery("SELECT count(id) as count FROM likes WHERE id_usuario ='".$_POST['id_usuario']."' AND id_estado='".$_POST['id_estado']."' AND deleted = 0  ");
		if($likes[0]['count']==0){
		$like->getQuery("INSERT INTO `likes`(`id`, `id_estado`, `id_comentario`, `id_usuario`, `created`, `deleted`) VALUES
											(NULL,'".$_POST['id_estado']."','0','".$_POST['id_usuario']."', CURRENT_TIMESTAMP , '0')");
		}else if($likes[0]['count']==1) {
		$like->getQuery("UPDATE `likes` SET `deleted`=1 WHERE `id_estado`='".$_POST['id_estado']."' AND `id_comentario`=0 AND `id_usuario`='".$_POST['id_usuario']."'");
		}
		pr($likes);

	}
}
else {
if($_POST['id_estado']!=null && $_POST['id_usuario']!=null && $_POST['id_comentario']!=null)
	{
		$likes= $like->getQuery("SELECT count(id) as count FROM likes WHERE id_usuario ='".$_POST['id_usuario']."' AND id_estado='".$_POST['id_estado']."' AND id_comentario='".$_POST['id_comentario']."' AND deleted = 0  ");
		if($likes[0]['count']==0){
		$like->getQuery("INSERT INTO `likes`(`id`, `id_estado`, `id_comentario`, `id_usuario`, `created`, `deleted`) VALUES
											(NULL,'".$_POST['id_estado']."','".$_POST['id_comentario']."','".$_POST['id_usuario']."', CURRENT_TIMESTAMP , '0')");
		}else {
		$like->getQuery("UPDATE `likes` SET `deleted`=1 WHERE `id_estado`='".$_POST['id_estado']."' AND `id_comentario`='".$_POST['id_comentario']."' AND id_comentario='".$_POST['id_comentario']."' AND `id_usuario`='".$_POST['id_usuario']."'");
		}

	}
}
?>
    	