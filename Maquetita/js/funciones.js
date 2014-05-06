 jQuery(document).ready(function ($){



//Captura valor select Visible Por, posteo de Estado y Hover
	$("#btn-visiblepor").hover(
      function () {
        $("#dropdown-visiblepor").stop(true, true).toggle();
      },
      function () {
        $("#dropdown-visiblepor").stop(true, true).toggle();
      }
    );
	$("#dropdown-visiblepor a").click(function() {
		var select = $(this).html();
	$("#visiblepor-selected").html(select);
	 	return false;
	});


	$("a[rel]").overlay({
    mask: '#789',
	left:"center",
	close: '#btn-video, .close',
    closeOnClick: true,
    closeOnEsc: true
});
// Fin Overlay

//Select de Login	
$( "#tipo_documento" ).change(function() {
	var $documento = $("#tipo_documento option:selected" ).attr("value");
	if($documento == "run"){
		$(".contenedor-input").hide();
		$("#contenedor-run").show();
	}
	if($documento == "usuario"){
		$(".contenedor-input").hide();
		$("#contenedor-usuario").show();
	}
	if($documento == "dni"){
		$(".contenedor-input").hide();
		$("#contenedor-dni").show();
	}
	if($documento == "pasaporte"){
		$(".contenedor-input").hide();
		$("#contenedor-pasaporte").show();
	}
});	
$("#foto-img").change(function() {
	var archivo = $("#foto-img" ).attr("value");
 	$("#url-video").attr("value", archivo);
});




});

