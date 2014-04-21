<?php
	require_once('../../core/config.php');
	require_once('../../layout/prueba.php');
	$comuna = new ajaxCRUD("Total", "comunas", '', "./");
	$publicacion = new ajaxCRUD("Total", "publicaciones", '', "./");
	$comunas = $comuna->getQuery("SELECT id , comuna FROM comunas WHERE id_region=15");
	// echo '{';
	foreach($comunas as $c){
		// echo "'".ucwords(strtolower($c['comuna']))."': ".$c['id'].",";
	}
?>    	
<script type="text/javascript">
function comuna(){
	switch (1){
		case 1  : comunas = {'Alto Hospicio': 346,'Camina': 296,'Colchane': 297,'Huara': 3,'Iquique': 2,'Pica': 4,'Pozo Almonte': 5 };break;
		case 2  : comunas = {'Antofagasta': 7,'Calama': 10,'Maria Elena': 298,'Mejillones': 8,'Ollagüe': 300,'San Pedro De Atacama': 301,'Sierra Gorda': 299,'Taltal': 9,'Tocopilla': 6} ;break;
		case 3  : comunas = {'Alto Del Carmen': 302,'Caldera': 14,'Chañaral': 11,'Copiapo': 13,'Diego De Almagro': 12,'Freirina': 17,'Huasco': 18,'Tierra Amarilla': 15,'Vallenar': 16};break;
		case 4  : comunas = {'Andacollo': 22,'Canela': 31,'Combarbala': 29,'Coquimbo': 21,'Illapel': 30,'La Higuera': 20,'La Serena': 19,'Los Vilos': 33,'Monte Patria': 26,'Ovalle': 25,'Paihuano': 24,'Punitaqui': 27,'Rio Hurtado': 28,'Salamanca': 32,'Vicuña': 23} ;break;
		case 5  : comunas = {'Algarrobo': 44,'Cabildo': 56,'Calle Larga': 67,'Cartagena': 46,'Casablanca': 40,'Catemu': 63,'Concon': 340,'El Quisco': 45,'El Tabo': 47,'Hijuelas': 51,'Isla De Pascua': 41,'Juan Fernandez': 321,'La Calera': 50,'La Cruz': 49,'La Ligua': 59,'Limache': 53,'Llay Llay': 65,'Los Andes': 66,'Nogales': 52,'Olmue': 54,'Panquehue': 62,'Papudo': 57,'Petorca': 55,'Puchuncavi': 36,'Putaendo': 61,'Quillota': 48,'Quilpue': 38,'Quintero': 35,'Rinconada': 68,'San Antonio': 42,'San Esteban': 69,'San Felipe': 60,'Santa Maria': 64,'Santo Domingo': 43,'Valparaiso': 34,'Villa Alemana': 39,'ViÑa Del Mar': 37,'Zapallar': 58};break;
		case 6  : comunas = {'Chepica': 132,'Chimbarongo': 125,'Codegua': 110,'Coinco': 114,'Coltauco': 113,'Doñihue': 112,'Graneros': 107,'La Estrella': 139,'Las Cabras': 116,'Litueche': 136,'Lolol': 129,'Machali': 106,'Malloa': 122,'Marchigue': 134,'Nancagua': 126,'Navidad': 138,'Olivar': 120,'Palmilla': 130,'Paredones': 133,'Peralillo': 131,'Peumo': 115,'Pichidegua': 118,'Pichilemu': 137,'Placilla': 127,'Pumanque': 135,'Quinta De Tilcoco': 123,'Rancagua': 105,'Rengo': 121,'Requinoa': 119,'San Fernando': 124,'San Francisco De Mostazal': 111,'San Vicente': 117,'Santa Cruz': 128} ;break;
		case 7  : comunas = {'Cauquenes': 166,'Chanco': 167,'Colbun': 161,'Constitucion': 157,'Curepto': 155,'Curico': 140,'Empedrado': 158,'Hualañe': 144,'Licanten': 145,'Linares': 159,'Longavi': 162,'Maule': 154,'Molina': 147,'Parral': 164,'Pelarco': 152,'Pelluhue': 320,'Pencahue': 153,'Rauco': 143,'Retiro': 165,'Rio Claro': 149,'Romeral': 141,'Sagrada Familia': 148,'San Clemente': 151,'San Javier': 156,'San Rafael': 341,'Talca': 150,'Teno': 142,'Vichuquen': 146,'Villa Alegre': 163,'Yerbas Buenas': 160} ;break;
		case 8  : comunas = {'Antuco': 303,'Arauco': 198,'Bulnes': 180,'Cabrero': 208,'Cañete': 201,'Chiguayante': 344,'Chillan': 168,'Chillan Viejo': 342,'Cobquecura': 175,'Coelemu': 186,'Coihueco': 170,'Concepcion': 188,'Contulmo': 202,'Coronel': 194,'Curanilahue': 197,'El Carmen': 185,'Florida': 193,'Hualqui': 192,'Laja': 210,'Lebu': 199,'Los Alamos': 200,'Los Angeles': 204,'Lota': 195,'Mulchen': 214,'Nacimiento': 212,'Negrete': 213,'Ninhue': 174,'Pemuco': 184,'Penco': 191,'Pinto': 169,'Portezuelo': 171,'Quilaco': 215,'Quilleco': 206,'Quillon': 182,'Quirihue': 172,'Ranquil': 187,'San Carlos': 176,'San Fabian': 178,'San Gregorio De Ñiquen': 177,'San Ignacio': 181,'San Nicolas': 179,'San Pedro De La Paz': 343,'San Rosendo': 211,'Santa Barbara': 205,'Santa Juana': 196,'Talcahuano': 189,'Tirua': 203,'Tome': 190,'Trehuaco': 173,'Tucapel': 209,'Yumbel': 207,'Yungay': 183} ;break;
		case 9  : comunas = {'Angol': 216,'Carahue': 235,'Collipulli': 220,'Cunco': 230,'Curacautin': 225,'Curarrehue': 305,'Ercilla': 221,'Freire': 229,'Galvarino': 232,'Gorbea': 238,'Lautaro': 231,'Loncoche': 240,'Lonquimay': 226,'Los Sauces': 218,'Lumaco': 223,'Melipeuco': 304,'Nueva Imperial': 234,'Padre Las Casas': 345,'Perquenco': 233,'Pitrufquen': 237,'Pucon': 242,'Puerto Saavedra': 236,'Puren': 217,'Renaico': 219,'Temuco': 227,'Teodoro Schmidt': 306,'Tolten': 239,'Traiguen': 222,'Victoria': 224,'Vilcun': 228,'Villarrica': 241};break;
		case 10	: comunas = {'Ancud': 277,'Calbuco': 265,'Castro': 270,'Chaiten': 280,'Chonchi': 271,'Cochamo': 262,'Curaco De Velez': 276,'Dalcahue': 279,'Fresia': 268,'Frutillar': 269,'Futaleufu': 281,'Hualaihue': 308,'Llanquihue': 267,'Los Muermos': 264,'Maullin': 263,'Osorno': 255,'Palena': 282,'Puerto Montt': 261,'Puerto Octay': 258,'Puerto Varas': 266,'Puqueldon': 274,'Purranque': 260,'Puyehue': 256,'Queilen': 272,'Quellon': 273,'Quemchi': 278,'Quinchao': 275,'Rio Negro': 259,'San Juan De La Costa': 307,'San Pablo': 257} ;break;
		case 11	: comunas = {'Aysen': 285,'Chile Chico': 287,'Cisnes': 286,'Cochrane': 289,'Coyhaique': 284,'Guaitecas': 309,'Lago Verde': 312,'O´higgins': 310,'Rio Ibañez': 288,'Tortel': 311} ;break;
		case 12	: comunas = {'Laguna Blanca': 316,'Navarino': 319,'Porvenir': 292,'Primavera': 317,'Puerto Natales': 291,'Punta Arenas': 290,'Rio Verde': 314,'San Gregorio': 315,'Timaukel': 318,'Torres Del Paine': 313};break;
		case 13	: comunas = {'Alhue': 109,'Buin': 103,'Calera De Tango': 99,'Cerrillos': 333,'Cerro Navia': 324,'Colina': 76,'Conchali': 75,'Curacavi': 83,'El Bosque': 338,'El Monte': 89,'Estacion Central': 328,'Huechuraba': 334,'Independencia': 330,'Isla De Maipo': 87,'La Cisterna': 96,'La Florida': 93,'La Granja': 97,'La Pintana': 327,'La Reina': 92,'Lampa': 78,'Las Condes': 71,'Lo Barnechea': 332,'Lo Espejo': 337,'Lo Prado': 325,'Macul': 323,'Maipu': 94,'Maria Pinto': 90,'Melipilla': 88,'Ñuñoa': 91,'Padre Hurtado': 339,'Paine': 104,'Pedro Aguirre Cerda': 336,'Peñaflor': 85,'Peñalolen': 322,'Pirque': 101,'Providencia': 72,'Pudahuel': 82,'Puente Alto': 100,'Quilicura': 79,'Quinta Normal': 81,'Recoleta': 329,'Renca': 77,'San Bernardo': 98,'San Joaquin': 335,'San Jose De Maipo': 102,'San Miguel': 95,'San Pedro': 108,'San Ramon': 326,'Santiago Centro': 70,'Santiago Oeste': 73,'Santiago Sur': 84,'Talagante': 86,'Til-til': 80,'Vitacura': 331} ;break;
		case 14 : comunas = {'Corral': 244,'Futrono': 248,'La Union': 251,'Lago Ranco': 254,'Lanco': 249,'Los Lagos': 247,'Mafil': 246,'Mariquina': 245,'Valdivia': 243,'Panguipulli': 250,'Paillaco': 252,'Rio Bueno': 253};break;
		case 15 : comunas ={'Arica': 1,'Camarones': 295,'General Lagos': 293,'Putre': 294};break;
	}  
	var output = '';
	for (var property in comunas) 
	  output += '<option value='+ comunas[property] +'>'+ property+'</option>';
	//alert(output);
}
comuna();
</script>

<?php $publicaciones = $publicacion->getQuery("SELECT pu.* FROM publicaciones as pu, grupos as gr, usuarios as us, grupo_usuario as gr_us, empresas as en WHERE us.id_empresa = ".$_SESSION['empresa']." AND us.id =".$_SESSION['id_usuario']." AND gr_us.id_usuario =".$_SESSION['id_usuario']." AND gr.id_empresa = ".$_SESSION['empresa']." AND gr_us.id_grupo = gr.id AND pu.id_grupo = gr.id OR pu.id_usuario_etiquetado = ".$_SESSION['id_usuario']." GROUP BY pu.id ORDER BY pu.created DESC");
		
	pr($publicaciones);
	require_once('../../layout/prueba_footer.php'); ?>