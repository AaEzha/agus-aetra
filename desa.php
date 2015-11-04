<?php
include 'db.php';
$idkelurahan = $_GET['kel'];
$desa = $db->query("SELECT * FROM desa WHERE idkelurahan='$idkelurahan' order by nama");
echo "<option value=''>-- Pilih Desa --</option>";
while($k = $desa->fetch_array()){
    echo "<option value=\"".$k['id']."\">".$k['nama']."</option>\n";
}
?>