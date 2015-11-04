<?php
include 'db.php';
$idkecamatan = $_GET['kec'];
$kel = $db->query("SELECT * FROM kelurahan WHERE idkecamatan='$idkecamatan' order by nama");
echo "<option value=''>-- Pilih Kelurahan --</option>";
while($k = $kel->fetch_array()){
    echo "<option value=\"".$k['id']."\">".$k['nama']."</option>\n";
}
?>