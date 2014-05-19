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
$mensajes = $mensaje->getQuery("SELECT me.* FROM mensajes me, mensaje_usuario me_us WHERE me.de='".$_SESSION['id_usuario']."' AND me_us.id_mensaje=me.id AND me_us.id_usuario = me.de AND me.id_mensaje = 0 AND me_us.deleted = 0 AND me_us.rol =2 GROUP BY me.id");
?>

      <div id="col-centro" class="col-contenido">
        <div id="contenedor-contenido" class="contenedor-mensajes">
          <div id="menu-mensajes">
            <ul>
              <li><a href="index.php" title="Mensajes recibidos">Recibidos</a>|</li>
              <li class="current"><a href="salida.php" title="Mensajes enviados">Enviados</a>|</li>
              <li><a href="borrar.php" title="Borrar mensajes">Borrar</a></li>
              <!-- <li><a href="#" title="Buscar Mensajes" class="btn-lupita-trans">Buscar</a></li> -->
              <li class="btn"><a href="crear.php" title="Escribir nuevo mensaje">Nuevo</a></li>
            </ul>
          </div>
          <form id="mensajes-form" action="borrar.php?rol=1" method="post">
            <?php   foreach($mensajes as $me){ 
                      $nombre = $usuario->getQuery("SELECT nombre From usuarios WHERE id=".$me['para']); ?>
                      <div class="mensaje <?php if($me['leido'] == "si") {echo "leido"; }?>">
                        <div class="msj-check">
                          <p><input type="checkbox" name="mensaje_borra[]" value="<?php echo $me['id']; ?>"/></p>
                        </div>
                        <div class="msj-asunto">
                          <h3><a href="leer.php?id=<?=$me['id']?>&salida=1" title="<?php echo $me['asunto'];?>"><?php echo $me['asunto'];?></a></h3>
                          <p><?php echo ucwords($nombre[0]['nombre']);?></p>
                        </div>
                        <div class="msj-fecha">
                          <p><?php  echo date('d/m/Y', strtotime($me['created'])); ?></p>
                          <p>a las <?php echo date('H:i', strtotime($me['created'])); ?> Hrs.</p>
                        </div>
                      </div>
            <?php } ?>

</form>
          
       </div>
      </div>
  <?php require_once('../../layout/footer.php'); ?>