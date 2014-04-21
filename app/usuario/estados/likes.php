<?php
	require_once('../../core/config.php');
	if(!$_SESSION['empresa'] && !$_SESSION['nombre']){
		header('Location: ../login/?error=2');
	}
	$like = new ajaxCRUD("Total", "likes", '', "./");
if($_POST['id_comentario']==null){
	if($_POST['id_publicacion']!=null && $_POST['id_usuario']!=null)
	{
		$likes= $like->getQuery("SELECT count(id) as count FROM likes WHERE id_usuario ='".$_POST['id_usuario']."' AND id_publicacion='".$_POST['id_publicacion']."' AND deleted = 0  ");
		if($likes[0]['count']==0){
		$like->getQuery("INSERT INTO `likes`(`id`, `id_publicacion`, `id_comentario`, `id_usuario`, `created`, `deleted`) VALUES
											(NULL,'".$_POST['id_publicacion']."','0','".$_POST['id_usuario']."', '".date("Y-m-d H:i:s")."' , '0')");
		}else if($likes[0]['count']==1) {
		$like->getQuery("UPDATE `likes` SET `deleted`=1 WHERE `id_publicacion`='".$_POST['id_publicacion']."' AND `id_comentario`=0 AND `id_usuario`='".$_POST['id_usuario']."'");
		}
	}
}
else {
if($_POST['id_publicacion']!=null && $_POST['id_usuario']!=null && $_POST['id_comentario']!=null)
	{
		$likes= $like->getQuery("SELECT count(id) as count FROM likes WHERE id_usuario ='".$_POST['id_usuario']."' AND id_publicacion='".$_POST['id_publicacion']."' AND id_comentario='".$_POST['id_comentario']."' AND deleted = 0  ");
		if($likes[0]['count']==0){
		$like->getQuery("INSERT INTO `likes`(`id`, `id_publicacion`, `id_comentario`, `id_usuario`, `created`, `deleted`) VALUES
											(NULL,'".$_POST['id_publicacion']."','".$_POST['id_comentario']."','".$_POST['id_usuario']."', '".date("Y-m-d H:i:s")."' , '0')");
		}else {
		$like->getQuery("UPDATE `likes` SET `deleted`=1 WHERE `id_publicacion`='".$_POST['id_publicacion']."' AND `id_comentario`='".$_POST['id_comentario']."' AND id_comentario='".$_POST['id_comentario']."' AND `id_usuario`='".$_POST['id_usuario']."'");
		}
	}
}
exit;
?>
    	