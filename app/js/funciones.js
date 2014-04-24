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
	// $("#dropdown-visiblepor").hide();
	 	return false;
	});


	$("a[rel]").overlay({
    mask: '#789',
	left:"right"
});
// Fin Overlay

	

});

