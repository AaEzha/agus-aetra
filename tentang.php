<?php
$q = $db->query("select * from informasi");
$d = $q->fetch_array();
?>
<h3><?=$d['judul'];?></h3>
<p><?=$d['isi'];?></p>