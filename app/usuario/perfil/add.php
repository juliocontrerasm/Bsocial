<?php
  // require_once('../../core/config.php');
   require_once('../../layout/header.php'); 
	$usuario = new ajaxCRUD("Total", "usuarios", '', "./");
	$region = new ajaxCRUD("Total", "regiones", '', "./");
	$gr_us = new ajaxCRUD("Total", "grupo_usuario", '', "./");
	$regiones = $region->getQuery("SELECT * FROM regiones ");
	if($_POST['nombre']!=null){
		$comprobar_rut = $usuario->getQuery("SELECT * FROM usuarios WHERE rut = '".$_POST['rut']."'");
		if($comprobar_rut==null){
			$usuario->getQuery("INSERT INTO `usuarios`(`id_empresa`, `username`, `password`, `rut`, `nombre`, `apellido`, `fecha_nacimiento`, `genero`, `direccion`, `id_comuna`, `descripcion`, `cargo`, `created`) VALUES ('3','".$_POST['username']."','".md5($_POST['password'])."','".$_POST['rut']."','".$_POST['nombre']."','".$_POST['apellido']."','".$_POST['año'].'-'.$_POST['mes'].'-'.$_POST['dia']."', '".$_POST['sexo']."', '".$_POST['direccion']."','".$_POST['comuna']."','".$_POST['descripcion']."',0,0 )");
			$id_usuario = $usuario->getQuery("SELECT id FROM usuarios WHERE rut = '".$_POST['rut']."'");
			$gr_us->getQuery("INSERT INTO `grupo_usuario` (`id_usuario`,`id_grupo`) VALUES (".$id_usuario[0]['id'].",4 )");
			$archivo=$_FILES['foto']['name'];  
			  	$carpeta='img/'.$_SESSION['empresa'];  
			  	if($archivo!=null)
			  	{
			     	$archivo = $_SESSION['id_usuario'].'.jpg';
			        copy($_FILES['foto']['tmp_name'], $carpeta.$archivo);
			    } 
			 header('Location:../login/?save=1');
		}else 
		{
			header('Location: ../perfil/add.php?error=2');
		}
	}
	if($_GET['error'] == 1 ){ 
		echo '<h3>Su contraseña no coincide</h3>';
	 } 
	 if($_GET['error'] == 2 ){ 
		echo '<h3>El registro del rut existe</h3>';
	 }    
	 if($_GET['save'] == 1 ){ 
		echo '<h3>Sus datos fueron Guardados con exito</h3>';
	 } ?>


      <div id="col-centro" class="col-contenido">
        <div class="contendor-publicacion">

        	
	<form action="<?=$PHP_SELF?>" method="post" id="editar" onsubmit="return validar();" enctype="multipart/form-data">
		<div id ="rut-content" class="rut" >
			<div id="rut-description" ></div>
			<br />
			<label id ="rut-label" class="rut" for="rut" >Rut</label>
			<br />
			<input id ="rut" name="rut" Type ="text" data-required="true" data-describedby="rut-description" data-description="rut" class="required" maxlength="8"/> - <input class="required" type="text" id="verificador" name="verificador" maxlength="1"/>
		</div>
		<div id ="username-content" class="username" >
			<div id="username-description" ></div>
			<br />
			<label id ="username-label" class="username" for="username" >Nombre de usuario</label>
			<br />
			<input id ="username" name="username" Type ="text" data-required="true" data-describedby="username-description" data-description="username" class="required"/>
		</div>
		<div id ="nombre-content" class="nombre" >
			<div id="nombre-description" ></div>
			<br />
			<label id ="nombre-label" class="nombre" for="nombre" >Nombre</label>
			<br />
			<input id ="nombre" name="nombre" Type ="text" data-required="true" data-describedby="nombre-description" data-description="nombre" class="required"/>
		</div>
		<div id ="apellido-content" class="apellido" >
			<div id="apellido-description" ></div>
			<br />
			<label id ="apellido-label" class="apellido" for="apellido" >Apellidos</label>
			<br />
			<input id ="apellido" name="apellido" Type ="text" data-required="true" data-describedby="apellido-description" data-description="apellido" class="required"/>
		</div>
		<div id ="foto-content" class="foto" >
			<div id="foto-description" ></div>
			<br />
			<label id ="foto-label" class="foto" for="foto" >Foto</label>
			<br />
			<input type="file" name="foto" /> 
		</div>
		<div id ="edad-content" class="edad" >
			<div id="dia-description" ></div> <div id="mes-description" ></div> <div id="año-description" ></div>
			<br />
			<label id ="edad-label" class="edad" for="edad" >Fecha de nacimiento</label>
			<br />
			<select  id ="dia" name="dia" Type ="text" data-required="true" data-describedby="dia-description" data-description="dia" class="required">
				<option value="" >Dia</option>
				<?php
						for($d=1;$d<=31;$d++)  
						{
							if($d<10): 
								$dd = '0'.$d; 
							else:
								$dd = $d;
							endif;
								echo "<option value='$dd'>$dd</option>";
						}
					?>
			</select>
			<select  id ="mes" name="mes" Type ="text" data-required="true" data-describedby="mes-description" data-description="mes" class="required">
				<option value="" selected>Mes</option>
				<?php
					$mes_n = date( 'm' , strtotime($usuarios[0]['fecha_nacimiento']));
					for($m = 1; $m<=12; $m++)
					{
						if($m<10)
							$me = '0'.$m;
						else
							$me = $m;
						switch($me)
						{
							case "01": $mes = "Enero"; break;
							case "02": $mes = "Febrero"; break;
							case "03": $mes = "Marzo"; break;
							case "04": $mes = "Abril"; break;
							case "05": $mes = "Mayo"; break;
							case "06": $mes = "Junio"; break;
							case "07": $mes = "Julio"; break;
							case "08": $mes = "Agosto"; break;
							case "09": $mes = "Septiembre"; break;
							case "10": $mes = "Octubre"; break;
							case "11": $mes = "Noviembre"; break;
							case "12": $mes = "Diciembre"; break;			
						}
						echo "<option value='$me'>$mes</option>";
					}
				?>
			</select>
			<select  id ="año" name="año" Type ="text" data-required="true" data-describedby="año-description" data-description="año" class="required">
			<option value="" selected>Año</option>
			<?php
				$año = date( 'Y' , strtotime($usuarios[0]['fecha_nacimiento']));
				$tope = date('Y');
				$edad_max = 100;
				$edad_min = 18;
				for($a= $tope - $edad_max; $a<=$tope - $edad_min; $a++){
						echo "<option value='$a' >$a</option>";
					} 
			?>
			</select>
		</div>
		<div id ="sexo-content" class="sexo" >
			<br />
			<span>Genero</span>
			<br />
			<input type="radio" name="sexo" value="f" id="radio1"><label for="radio1">Mujer </label><br />
			<input type="radio" name="sexo" value="m" id="radio2"><label for="radio2">Hombre</label> <br />
		</div>
		<!-- <div id ="cargo-content" class="cargo" >
			<div id="cargo-description" ></div>
			<br />
			<label id ="cargo-label" class="cargo" for="cargo" >Cargo</label>
			<br />
			<input   id ="cargo" name="cargo" Type ="text" data-required="true" data-describedby="cargo-description" data-description="cargo" class="required"/>
		</div> -->
		<div id ="direccion-content" class="direccion" >
			<div id="direccion-description" ></div>
			<br />
			<label id ="direccion-label" class="direccion" for="direccion" >Direccion</label>
			<br />
			<input  id ="direccion" name="direccion" Type ="text" data-required="true" data-describedby="direccion-description" data-description="direccion" class="required"/>
		</div>
		<div id ="region-content" class="region">
			<div id="region-description" ></div>
			<br />
			<label id ="region-label" class="region" for="region" >Region</label>
			<br />
			<select name="region" id="region" onchange="return carga_comuna()" data-required="true" data-describedby="region-description" data-description="region" class="required" >
	            <option value="" > Seleccione Region </option>
	            <?php foreach ($regiones as $r):?>  
	          		<option value="<?php echo $r['id'];?>" ><?php echo $r['region'];?></option>
	            <?php endforeach; ?> 
	   		</select>
	   	</div>
	   	<div id ="comuna-content" class="comuna">
			<div id="comuna-description" ></div>
			<br />
			<label id ="comuna-label" class="comuna" for="comuna" >Comuna</label>
			<br />
			<select name="comuna" id="comuna" data-required="true" data-describedby="comuna-description" data-description="comuna" class="required" >
	            <option value=""> Seleccione Comuna </option>
	   		</select>
	   	</div>
	   	<div id="descripcion-content" class="descripcion">
	   		<div id="descripcion-description" ></div>
			<br />
			<label id ="descripcion-label" class="descripcion" for="descripcion" >Describete </label>
			<br />
			<textarea name="descripcion" id="descripcion" ></textarea>
	   	</div>
	   	<div id ="password-content" class="password" >
			<div id="password-description" ></div>
			<br />
			<label id ="password-label" class="password" for="password" >Password</label>
			<br />
			<input  id ="password" name="password"  type="password" data-describedby="password-description" data-description="password" class="required" data-conditional="password"/>
		</div>
		<div id ="r-password-content" class="r-password" >
			<div id="r_password-description" ></div>
			<br />
			<label id ="r-password-label" class="r-password" for="r-password" >Repita password</label>
			<br />
			<input  id ="r-password" name="r_password" type="password"  data-conditional = 'r_password' data-describedby="r_password-description" data-description="r_password" class="required" data-conditional="r_password"/>
		</div>
		<br />
		<button type ="submit" id="editar" >Registrate</button>
	</form>
	<script type="text/javascript">
		$("#rut").Rut({
			digito_verificador: '#verificador',
			on_error: function(){ alert('Rut incorrecto'); },
			on_success: function(){ alert('Rut correcto'); } 
		});
		$('#rut').validCampoFranz('0123456789');
		$('#verificador').validCampoFranz('0123456789kK');
		function carga_comuna(){
			var id_region = $("#region").val();
			switch (parseInt(id_region)){
				case 1  : comunas = {'Alto Hospicio': 346,'Camina': 296,'Colchane': 297,'Huara': 3,'Iquique': 2,'Pica': 4,'Pozo Almonte': 5 };break;
				case 2  : comunas = {'Antofagasta': 7,'Calama': 10,'Maria Elena': 298,'Mejillones': 8,'Ollagüe': 300,'San Pedro De Atacama': 301,'Sierra Gorda': 299,'Taltal': 9,'Tocopilla': 6} ;break;
				case 3  : comunas = {'Alto Del Carmen': 302,'Caldera': 14,'Chañaral': 11,'Copiapo': 13,'Diego De Almagro': 12,'Freirina': 17,'Huasco': 18,'Tierra Amarilla': 15,'Vallenar': 16};break;
				case 4  : comunas = {'Andacollo': 22,'Canela': 31,'Combarbala': 29,'Coquimbo': 21,'Illapel': 30,'La Higuera': 20,'La Serena': 19,'Los Vilos': 33,'Monte Patria': 26,'Ovalle': 25,'Paihuano': 24,'Punitaqui': 27,'Rio Hurtado': 28,'Salamanca': 32,'Vicuña': 23} ;break;
				case 5  : comunas = {'Algarrobo': 44,'Cabildo': 56,'Calle Larga': 67,'Cartagena': 46,'Casablanca': 40,'Catemu': 63,'Concon': 340,'El Quisco': 45,'El Tabo': 47,'Hijuelas': 51,'Isla De Pascua': 41,'Juan Fernandez': 321,'La Calera': 50,'La Cruz': 49,'La Ligua': 59,'Limache': 53,'Llay Llay': 65,'Los Andes': 66,'Nogales': 52,'Olmue': 54,'Panquehue': 62,'Papudo': 57,'Petorca': 55,'Puchuncavi': 36,'Putaendo': 61,'Quillota': 48,'Quilpue': 38,'Quintero': 35,'Rinconada': 68,'San Antonio': 42,'San Esteban': 69,'San Felipe': 60,'Santa Maria': 64,'Santo Domingo': 43,'Valparaiso': 34,'Villa Alemana': 39,'ViÑa Del Mar': 37,'Zapallar': 58};break;
				case 6  : comunas = {'Chepica': 132,'Chimbarongo': 125,'Codegua': 110,'Coinco': 114,'Coltauco': 113,'Doñihue': 112,'Graneros': 107,'La Estrella': 139,'Las Cabras': 116,'Litueche': 136,'Lolol': 129,'Machali': 106,'Malloa': 122,'Marchigue': 134,'Nancagua': 126,'Navidad': 138,'Olivar': 120,'Palmilla': 130,'Paredones': 133,'Peralillo': 131,'Peumo': 115,'Pichidegua': 118,'Pichilemu': 137,'Placilla': 127,'Pumanque': 135,'Quinta De Tilcoco': 123,'Rancagua': 105,'Rengo': 121,'Requinoa': 119,'San Fernando': 124,'San Francisco De Mostazal': 111,'San Vicente': 117,'Santa Cruz': 128} ;break;
				case 7  : comunas = {'Cauquenes': 166,'Chanco': 167,'Colbun': 161,'Constitucion': 157,'Curepto': 155,'Curico': 140,'Empedrado': 158,'Hualañe': 144,'Licanten': 145,'Linares': 159,'Longavi': 162,'Maule': 154,'Molina': 147,'Parral': 164,'Pelarco': 152,'Pelluhue': 320,'Pencahue': 153,'Rauco': 143,'Retiro': 165,'Rio Claro': 149,'Romeral': 141,'Sagrada Familia': 148,'San Clemente': 151,'San Javier': 156,'San Rafael': 341,'Talca': 150,'Teno': 142,'Vichuquen': 146,'Villa Alegre': 163,'Yerbas Buenas': 160} ;break;
				case 8  : comunas = {'Antuco': 303,'Arauco': 198,'Bulnes': 180,'Cabrero': 208,'Cañete': 201,'Chiguayante': 344,'Chillan': 168,'Chillan Viejo': 342,'Cobquecura': 175,'Coelemu': 186,'Coihueco': 170,'Concepcion': 188,'Contulmo': 202,'Coronel': 194,'Curanilahue': 197,'El Carmen': 185,'Florida': 193,'Hualqui': 192,'Laja': 210,'Lebu': 199,'Los Alamos': 200,'Los Angeles': 204,'Lota': 195,'Mulchen': 214,'Nacimiento': 212,'Negrete': 213,'Ninhue': 174,'Pemuco': 184,'Penco': 191,'Pinto': 169,'Portezuelo': 171,'Quilaco': 215,'Quilleco': 206,'Quillon': 182,'Quirihue': 172,'Ranquil': 187,'San Carlos': 176,'San Fabian': 178,'San Gregorio De Ñiquen': 177,'San Ignacio': 181,'San Nicolas': 179,'San Pedro De La Paz': 343,'San Rosendo': 211,'Santa Barbara': 205,'Santa Juana': 196,'Talcahuano': 189,'Tirua': 203,'Tome': 190,'Trehuaco': 173,'Tucapel': 209,'Yumbel': 207,'Yungay': 183} ;break;
				case 9  : comunas = {'Angol': 216,'Carahue': 235,'Collipulli': 220,'Cunco': 230,'Curacautin': 225,'Curarrehue': 305,'Ercilla': 221,'Freire': 229,'Galvarino': 232,'Gorbea': 238,'Lautaro': 231,'Loncoche': 240,'Lonquimay': 226,'Los Sauces': 218,'Lumaco': 223,'Melipeuco': 304,'Nueva Imperial': 234,'Padre Las Casas': 345,'Perquenco': 233,'Pitrufquen': 237,'Pucon': 242,'Puerto Saavedra': 236,'Puren': 217,'Renaico': 219,'Temuco': 227,'Teodoro Schmidt': 306,'Tolten': 239,'Traiguen': 222,'Victoria': 224,'Vilcun': 228,'Villarrica': 241};break;
				case 10 : comunas = {'Ancud': 277,'Calbuco': 265,'Castro': 270,'Chaiten': 280,'Chonchi': 271,'Cochamo': 262,'Curaco De Velez': 276,'Dalcahue': 279,'Fresia': 268,'Frutillar': 269,'Futaleufu': 281,'Hualaihue': 308,'Llanquihue': 267,'Los Muermos': 264,'Maullin': 263,'Osorno': 255,'Palena': 282,'Puerto Montt': 261,'Puerto Octay': 258,'Puerto Varas': 266,'Puqueldon': 274,'Purranque': 260,'Puyehue': 256,'Queilen': 272,'Quellon': 273,'Quemchi': 278,'Quinchao': 275,'Rio Negro': 259,'San Juan De La Costa': 307,'San Pablo': 257} ;break;
				case 11 : comunas = {'Aysen': 285,'Chile Chico': 287,'Cisnes': 286,'Cochrane': 289,'Coyhaique': 284,'Guaitecas': 309,'Lago Verde': 312,'O´higgins': 310,'Rio Ibañez': 288,'Tortel': 311,} ;break;
				case 12 : comunas = {'Laguna Blanca': 316,'Navarino': 319,'Porvenir': 292,'Primavera': 317,'Puerto Natales': 291,'Punta Arenas': 290,'Rio Verde': 314,'San Gregorio': 315,'Timaukel': 318,'Torres Del Paine': 313};break;
				case 13 : comunas = {'Alhue': 109,'Buin': 103,'Calera De Tango': 99,'Cerrillos': 333,'Cerro Navia': 324,'Colina': 76,'Conchali': 75,'Curacavi': 83,'El Bosque': 338,'El Monte': 89,'Estacion Central': 328,'Huechuraba': 334,'Independencia': 330,'Isla De Maipo': 87,'La Cisterna': 96,'La Florida': 93,'La Granja': 97,'La Pintana': 327,'La Reina': 92,'Lampa': 78,'Las Condes': 71,'Lo Barnechea': 332,'Lo Espejo': 337,'Lo Prado': 325,'Macul': 323,'Maipu': 94,'Maria Pinto': 90,'Melipilla': 88,'Ñuñoa': 91,'Padre Hurtado': 339,'Paine': 104,'Pedro Aguirre Cerda': 336,'Peñaflor': 85,'Peñalolen': 322,'Pirque': 101,'Providencia': 72,'Pudahuel': 82,'Puente Alto': 100,'Quilicura': 79,'Quinta Normal': 81,'Recoleta': 329,'Renca': 77,'San Bernardo': 98,'San Joaquin': 335,'San Jose De Maipo': 102,'San Miguel': 95,'San Pedro': 108,'San Ramon': 326,'Santiago Centro': 70,'Santiago Oeste': 73,'Santiago Sur': 84,'Talagante': 86,'Til-til': 80,'Vitacura': 331,} ;break;
				case 14 : comunas = {'Corral': 244,'Futrono': 248,'La Union': 251,'Lago Ranco': 254,'Lanco': 249,'Los Lagos': 247,'Mafil': 246,'Mariquina': 245,'Valdivia': 243,'Panguipulli': 250,'Paillaco': 252,'Rio Bueno': 253};break;
				case 15 : comunas = {'Arica': 1,'Camarones': 295,'General Lagos': 293,'Putre': 294};break;
				default : comunas = {};break;
			}  
			var output = '<option value="0" selected> Seleccione Comuna </option>';
			for (var property in comunas) {
			  output += '<option value='+ comunas[property] +'>'+ property+'</option>';
			}
			$("select#comuna").html(output);
		}
		function validar(){
		$("#rut").val($.Rut.quitarFormato($("#rut").val()));
		}
		$('#editar').validate({
	      onKeyup : true,
	      onChange : true,
	      eachValidField : function() {
	        $(this).closest('div').removeClass('error').addClass('success');
	      },
	      eachInvalidField : function() {
	        $(this).closest('div').removeClass('success').addClass('error');
	      },
	      conditional : {
	        r_password : function() {
	          return $(this).val() == $('#password').val();
	        }
	      },
	      description : {
	        nombre:{
	          required : '<div class="alert alert-error">Escriba su nombre. </div>',
	        }, 
	        apellido:{
	          required : '<div class="alert alert-error">Escriba sus apelidos.</div>',
	        }, 
	        dia:{
	          required : '<div class="alert alert-error">Seleccione un dia.</div>',
	        },
	        mes:{
	          required : '<div class="alert alert-error">Seleccione un mes.</div>',
	        },
	        año:{
	          required : '<div class="alert alert-error">Seleccione un año.</div>',
	        },
	        cargo:{
	          required : '<div class="alert alert-error">Escriba su cargo.</div>',
	        },
	        direccion:{
	          required : '<div class="alert alert-error">Escriba su direccion.</div>',
	        },
	        region:{
	          required : '<div class="alert alert-error">Seleccione su region.</div>',
	        },
	        comuna:{
	          required : '<div class="alert alert-error">Seleccione su comuna.</div>',
	        }, 
	        password:{
	          required : '<div class="alert alert-error">Escriba su contraseña para poder hacer los cambios.</div>',
	        }, 
	        password:{
	          required : '<div class="alert alert-error">Escriba su nueva contraseña.</div>',
	        }, 
	        r_password:{
	          required : '<div class="alert alert-error">Escriba su confirmacion de contraseña .</div>',
	          conditional : '<div class="alert alert-error">Su nueva contraseña no coincide.</div>'
	        }
	      }
	    });
	</script>
        </div>
      </div>
  <?php require_once('../../layout/footer.php'); ?>