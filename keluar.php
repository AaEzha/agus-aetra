<?php
session_start();
unset($_SESSION['usr']);
unset($_SESSION['level']);
session_destroy();
die("<meta http-equiv='refresh' content='0;index.php'>");
?>