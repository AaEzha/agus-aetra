<h3>Deskripsi</h3>
<script type="text/javascript">
tinymce.init({
    selector: "textarea",
    plugins: [
        "advlist autolink lists link image charmap print preview anchor",
        "searchreplace visualblocks code fullscreen",
        "insertdatetime media table contextmenu paste"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
});
</script>
<?php
$q = $db->query("select * from informasi");
$d = $q->fetch_array();

if(isset($_POST['judul'])){
	$judul = $db->real_escape_string($_POST['judul']);
	$isi = $db->real_escape_string($_POST['isi']);
	$db->query("update informasi set judul='$judul', isi='$isi', usrupd='".$_SESSION['usr']."', wktupd=now()");
	eksyen('','?hal=deskripsi');
}
?>
<form class="col s12" action="" method="post">
	<div class="row">
		<div class="input-field col s12">
			<input id="teks" name="judul" type="text" class="validate" value="<?=$d['judul'];?>" required>
			<label for="teks">Judul</label>
		</div>
	</div>
	<div class="row">
		<div class="input-field col s12">
			<textarea name="isi"><?=$d['isi'];?></textarea>
		</div>
	</div>
	<button type="submit" class="btn waves-effect waves-light">Simpan</button>
</form>