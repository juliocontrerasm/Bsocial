<?php 
if (empty($_GET['term'])) exit ;
$q = strtolower($_GET["term"]);
	require_once('../../core/config.php');
$result = array();
foreach ($_SESSION['autocompletar'] as $value) {
	if (strpos(strtolower($value['value']), $q) !== false) {
		array_push($result, array("id"=>$value['id'], "value" => strip_tags($value['value'])));
	}
	if (count($result) > 11)
		break;
}
// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
echo json_encode($result);
?>

<?php 
/* no term passed - just exit early with no response
if (empty($_GET['term'])) exit ;
$q = strtolower($_GET["term"]);
// remove slashes if they were magically added
//if (get_magic_quotes_gpc()) $q = stripslashes($q);
	require_once('../../core/config.php');
	
$result = array();
foreach ($_SESSION["autocompletar"] as $value) {
	if (strpos(strtolower($value['value']), $q) !== false) {
		array_push($result, array("id"=>$value['id'], "value" => strip_tags($value['value'])));
	}
	if (count($result) > 11)
		break;
	//pr($value);
	
}
// json_encode is available in PHP 5.2 and above, or you can install a PECL module in earlier versions
echo json_encode($result);*/
?>