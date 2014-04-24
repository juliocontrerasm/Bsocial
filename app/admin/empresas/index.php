<?php

	require_once('../../layout/header.php');

    $empresa = new ajaxCRUD("Empresa", "empresas", "id", "./");
     
	$empresa->turnOffAjaxADD();

    #i don't want to visually show the primary key in the table
    //$empresa->omitPrimaryKey();
    $empresa->omitFieldCompletely("deleted");
    
    //$empresa->defineRelationship("id_cliente","clientes","id", "nombre");
    
    $empresa->formatFieldWithFunction('estado','formatoEstado');

    
    $empresa->displayAs("nombre", "Nombre");
    
    
     
    $empresa->setLimit(30);
	$empresa->displayAddFormTop();
	$empresa->showTable();
	
	require_once('../../layout/footer.php');

?>