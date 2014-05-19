<?php 
	$publicacion = new ajaxCRUD("Total", "publicaciones", '', "./");
	$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
	$publicaciones = $publicacion->getQuery("SELECT pu.* FROM publicaciones as pu, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE us.id_empresa = ".$_SESSION['empresa']." AND us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr_us.id_grupo = gr.id AND pu.id_categoria = 5 AND MONTH (pu.created) = MONTH (NOW()) AND DAY(pu.created)=DAY(NOW()) GROUP BY pu.id ORDER BY pu.created DESC");
?>



<div id="col-derecha" class="col-contenido">
				<div class="aviso-destacado icn-azul">
					<h5 class="icn-aviso-azul">Aviso Destacado</h5>	
					<p class="contenedor-imagen">
						<img src="../../css/img/aviso-destacado.jpg" alt="Imagen de aviso destacado" />
					</p>
					<div class="parrafo">
						<h6><a href="" title="Ver aviso">¡Fiesta de fin de año!</a></h6>
						<p><a href="" title="Ver aviso">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor.</a>
						</p>	
					</div>
				</div>

				<?php foreach($publicaciones as $pu){
						$usuarios =$usuario->getQuery("SELECT id,nombre,apellido FROM usuarios WHERE id='".$pu['id_usuario_etiquetado']."'"); ?>
						<div class="cumpleano-destacado">
							<h5 class="icn-cumpleanos-azul">Cumpleaños</h5>
							<p>Saluda en su día de cumpleaños <br>a <a href="" title="Saluda a <?php  echo ucwords($usuarios[0]['nombre']).' '.ucwords($usuarios[0]['apellido']); ?>"><?php  echo ucwords($usuarios[0]['nombre']).' '.ucwords($usuarios[0]['apellido']); ?></span></a></p>
						</div>
				<?php }?>
				<div class="encuesta-destacada">
					<h5 class="icn-encuestas-azul"></h5>
					<p>¿Que beneficios te gustaría para tu cumpleaños?</p>
					<form class="form-encuesta">
						<p>
							<input type="radio" id="opcion1" name="opcion" />
							<label for="opcion1"><span></span>Bono</label>
						</p>
						<p>
							<input type="radio" id="opcion2" name="opcion" />
							<label for="opcion2"><span></span>Masaje</label>
						</p>
						<p>
							<input type="radio" id="opcion3" name="opcion" />
							<label for="opcion3"><span></span>Chelita</label>
						</p>
						<p>
							<input type="radio" id="opcion4" name="opcion" />
							<label for="opcion4"><span></span>Medio día libre</label>
						</p>
					</form>
					<p class="btn">
						<a href="#" title="Votar">Votar</a>
					</p>
				</div>
			</div>
