<?php
// PERHATIAN! ATUR URL-nya!
// Diakhiri dengan tanda slash (/)
define('URL','http://localhost/aetra/');
define('DBHOST', 'localhost');
define('DBUSER', 'root');
define('DBPASS', '');
define('DBNAME', 'db_aetra');

$db = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);

if(!$db){
	die("Wrong database connection!");
}else{
	include 'fungsi.php';
}
?>