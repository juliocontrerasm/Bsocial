	<?php 
	if (empty($_GET['term'])) 
		{exit ;}
	$q = strtolower($_GET["term"]);
	$result = array();
	session_start();
	foreach ($_SESSION["autocompletar"] as $value) {
		if (strpos(strtolower($value['value']), $q) !== false) {
			array_push($result, array("id"=>$value['id'], "value" => strip_tags($value['value'])));
		}
		if (count($result) > 11)
			break;
	}
	echo json_encode($result);

	?>