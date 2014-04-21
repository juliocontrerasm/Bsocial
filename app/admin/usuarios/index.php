<?php

	require_once('../../layout/header.php');

    $usuario = new ajaxCRUD("Usuario", "usuarios", "id", "./");
     
	$usuario->turnOffAjaxADD();

    #i don't want to visually show the primary key in the table
    //$usuario->omitPrimaryKey();
    $usuario->omitFieldCompletely("deleted");
    
    //defineRelationship (llave foranea,dueño de la llave,llave de referencia,receptor de la llave)

    $usuario->defineRelationship("id_empresa","empresas","id", "nombre");
    $usuario->defineRelationship("id_grupo","grupos","id", "nombre");
    
    //$usuario->formatFieldWithFunction('estado','formatoEstado');

    
    $usuario->displayAs("nombre", "Nombre");
    
    
     
    $usuario->setLimit(30);
	$usuario->displayAddFormTop();
	$usuario->showTable();
	
	require_once('../../layout/footer.php');

?>