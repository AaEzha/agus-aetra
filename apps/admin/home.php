<?php
if(isset($_GET['hal'])){
	$hal = $_GET['hal'];
	include $hal.'.php';
}else{
	echo "<h3>string@home.php</h3>";
}
?>