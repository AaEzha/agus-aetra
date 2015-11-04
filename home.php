<?php
if(isset($_GET['hal'])){
	$hal = $_GET['hal'];
	include $hal.'.php';
}else{
	include 'homepage.php';
}
?>