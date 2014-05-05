<?php 
# Incluimos la configuracion
	// require_once('../../core/config.php');
	 require_once('../../layout/header.php'); 
	if(!$_SESSION['empresa'] && !$_SESSION['nombre']){
		header('Location: ../login/?error=2');
	}
$mensaje = new ajaxCRUD("Total", "mensajes", '', "./");
$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
# Buscamos los mensajes privados
$mensajes = $mensaje->getQuery("SELECT me.* FROM mensajes me, mensaje_usuario me_us WHERE me.para='".$_SESSION['id_usuario']."' AND me_us.id_mensaje=me.id AND me_us.id_usuario = me.para AND me.id_mensaje = 0 AND me_us.deleted = 0 AND me_us.rol =1 GROUP BY me.id");
?>


      <div id="col-centro" class="col-contenido">
        <div id="contenedor-contenido" class="contenedor-mensajes">
          <div id="menu-mensajes">
            <ul>
              <li class="current"><a href="index.php" title="Mensajes recibidos">Recibidos</a>|</li>
              <li><a href="salida.php" title="Mensajes enviados">Enviados</a>|</li>
              <li><a href="borrar.php" title="Borrar mensajes">Borrar</a></li>
              <!-- <li><a href="#" title="Buscar Mensajes" class="btn-lupita-trans">Buscar</a></li> -->
              <li class="btn"><a href="crear.php" title="Escribir nuevo mensaje">Nuevo</a></li>
            </ul>
          </div>
          <form id="mensajes-form" action="borrar.php?rol=1" method="post">
            <?php   foreach($mensajes as $me){ 
                      $nombre = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$me['de']); ?>
                      <div class="mensaje <?php if($me['leido'] == "si") {echo "leido"; }?>">
                        <div class="msj-check">
                          <p><input type="checkbox" name="mensaje_borra[]" value="<?php echo $me['id']; ?>"/></p>
                        </div>
                        <div class="msj-asunto">
                          <h3><a href="leer.php?id=<?=$me['id']?>" title="<?php echo $me['asunto'];?>"><?php echo $me['asunto'];?></a></h3>
                          <p><?php echo ucwords($nombre[0]['nombre']);?></p>
                        </div>
                        <div class="msj-fecha">
                          <p><?php  echo date('d/m/Y', $me['created']); ?></p>
                          <p>a las <?php echo date('H:i', $me['created']); ?> Hrs.</p>
                        </div>
                      </div>
            <?php } ?>
           <!--  <div class="mensaje">
              <div class="msj-check">
                <p><input type="checkbox" name="mensaje_borra[]" value="<?php echo $me['id']; ?>"/></p>
              </div>
              <div class="msj-asunto">
                <h3><a href="leer.php?id=<?=$me['id']?>" title="<?php echo $me['asunto'];?>"><?php echo $me['asunto'];?></a></h3>
                <p><?php ucwords($nombre[0]['nombre']);?></p>
              </div>
              <div class="msj-fecha">
                <p><?php echo date_format($me['fecha'],'d/m/Y'); ?></p>
                <p>a las <?php echo date_format($me['fecha'],'H:i'); ?> Hrs.</p>
              </div>
            </div>
            <div class="mensaje leido">
              <div class="msj-check">
                <p><input type="checkbox" /></p>
              </div>
              <div class="msj-asunto">
                <h3><a href="" title="¡bsocial se expande a México, y Brasil!">¡bsocial se expande a México, y Brasil!</a></h3>
                <p>Felipe Morales, Gonzalo Contreras, Felix Saucedo y 3 más...</p>
              </div>
              <div class="msj-fecha">
                <p>07/01/2016</p>
                <p>a las 10:42 Hrs.</p>
              </div>
            </div>
          </form>
       

Menu:  <a href="../perfil" title="Editar perfil">Editar datos</a> | <a href="../estados" title="Home">Home</a> | <a href="index.php">Ver mensajes</a> | <a href="crear.php">Crear mensajes</a> | <a href="salida.php">Ver mensajes enviados</a> | <a href="../login/logout.php">Cerrar sesion</a><br /><br />
  <form id="mensajes-form" action="borrar.php?rol=1" method="post">
  <button type="submit">borra</button>
  <table width="800" border="0" align="center" cellpadding="1" cellspacing="1">
    <tr>
      <td width="53" align="center" valign="top"><strong></strong></td>
      <td width="426" align="center" valign="top"><strong>Asunto</strong></td>
      <td width="321" align="center" valign="top"><strong>De</strong></td>
	   <td width="321" align="center" valign="top"><strong>Fecha</strong></td>
    </tr>
    <?php
	$i = 0; 
	foreach($mensajes as $me){ 
    $nombre = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$me['de']); ?>
    <tr bgcolor="<?php if($me['leido'] == "si") { echo "#FFE8E8"; } else { if($i%2==0) { echo "#FFE7CE"; } else { echo "#FFCAB0"; } } ?>">
      <td align="center" valign="top"><input type="checkbox" name="mensaje_borra[]" value="<?php echo $me['id']; ?>"></td>
      <td align="center" valign="top"><a href="leer.php?id=<?=$me['id']?>"><?=$me['asunto']?></a></td>
      <td align="center" valign="top"><?=ucwords($nombre[0]['nombre'])?></td>
	  <td align="center" valign="top"><?=$me['fecha']?></td>
    </tr>
<?php $i++; 
} ?>
</table>
</form> -->
          
       </div>
      </div>
  <?php require_once('../../layout/footer.php'); ?>