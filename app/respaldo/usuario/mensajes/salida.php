<?php 
# Incluimos la configuracion
  require_once('../../core/config.php');
  require_once('../../layout/prueba.php');
  if(!$_SESSION['empresa'] && !$_SESSION['nombre']){
    header('Location: ../login/?error=2');
  }
$mensaje = new ajaxCRUD("Total", "mensajes", '', "./");
$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
# Buscamos los mensajes privados
$mensajes = $mensaje->getQuery("SELECT me.* FROM mensajes me, mensaje_usuario me_us WHERE me.de='".$_SESSION['id_usuario']."' AND me_us.id_mensaje=me.id AND me_us.id_usuario = me.de AND me.id_mensaje = 0 AND me_us.deleted = 0 AND me_us.rol =2 GROUP BY me.id");
?>
Menu: <a href="index.php">Ver mensajes</a> | <a href="crear.php">Crear mensajes</a> | <a href="salida.php">Ver mensajes enviados</a> | <a href="../login/logout.php">Cerrar sesion</a><br /><br />
 <form id="mensajes-form" action="borrar.php?rol=2" method="post">
  <button type="submit">borra</button>
  <table width="800" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="53" align="center" valign="top"><strong></strong></td>
      <td width="426" align="center" valign="top"><strong>Asunto</strong></td>
      <td width="321" align="center" valign="top"><strong>Para</strong></td>
    <td width="321" align="center" valign="top"><strong>Fecha</strong></td>
    </tr>
    <?php
  $i = 0; 
  foreach($mensajes as $me){ 
    $nombre = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$me['para']);?>
    <tr bgcolor="<?php if($me['leido'] == "si") { echo "#FFE8E8"; } else { if($i%2==0) { echo "#FFE7CE"; } else { echo "#FFCAB0"; } } ?>">
      <td align="center" valign="top"><input type="checkbox" name="mensaje_borra[]" value="<?php echo $me['id']; ?>"></td>
      <td align="center" valign="top"><a href="leer.php?id=<?=$me['id']?>&salida=1"><?=$me['asunto']?></a></td>
      <td align="center" valign="top"><?=$nombre[0]['nombre']?></td>
    <td align="center" valign="top"><?=$me['fecha']?></td>
    </tr>
  <?php $i++; 
  } ?>
  </table>

</form>