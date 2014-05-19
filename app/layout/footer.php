<?php require_once('sidebar_der.php'); ?>

</div>
	</div>
	<!-- Modales -->
	<div id="modal-subir-foto" class="simple_overlay">
		<a class="close btn-close-video" title="Cerrar">Cerrar</a>
		<p>Selecciona una foto para usarla en tu perfil:</p>
		<form id="form-adjuntar-video">
			<p>
				<input type="text" id="url-video" placeholder="Haz clic aquí para seleccionar tu foto..." />
				<input type="file" id="foto-img" value="" />
				<a class="btn" id="btn-video" title="Subir">Subir</a>
			</p>
		</form>
	</div>

	<div id="modal-adjuntar-video" class="simple_overlay">
		<a class="close btn-close-video" title="Cerrar">Cerrar</a>
		<p>Pega aquí la dirección de tu video de Youtube o Vimeo:</p>
		<form id="form-adjuntar-video">
			<p>
				<input type="text" id="url-video" placeholder="Dirección para compartir..." />
				<a class="btn" id="btn-video" title="Adjuntar">Adjuntar</a>
			</p>
		</form>
	</div>
</body>
</html>