<?php
session_start();
session_destroy();
//Redirigimos hacia la pagina index.php
header ("Location: ../login/"); 
?>