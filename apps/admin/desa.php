<?php
if(!isset($_GET['a'])){
	$_SESSION['kel'] = $_GET['kel'];
	$kel = $_SESSION['kel'];
	$kec = $_GET['kec'];
	$_SESSION['kec'] = $kec;
?>
<h3>Desa <small>| <a href="?hal=desa&a=tambah">Tambah Desa</a></small></h3>
<?=tabel();?>
<table id="tbl">
	<thead>
		<tr>
			<th data-field="no" width="10%">No</th>
			<th data-field="kel">Nama</th>
			<th data-field="price" width="15%">Aksi</th>
		</tr>
	</thead>

	<tbody>
	<?php
	$i = 1;
	$ql = $db->query("select * from desa where idkelurahan='$kel' order by nama asc");
	while($d = $ql->fetch_array()){ ?>
		<tr>
			<td><?=$i;?></td>
			<td><?=$d['nama'];?></td>
			<td><a href="?hal=desa&a=ubah&i=<?=$d['id'];?>">Ubah</a> | <a href="?hal=desa&a=hapus&i=<?=$d['id'];?>" <?=yakin();?>>Hapus</a></td>
		</tr>
	<?php $i++; } ?>
	</tbody>
</table>
<div class="col s2 offset-s10">
	<a href="?hal=kel&kec=<?=$kec;?>" class="btn btn-default">Kembali</a>
</div>
<?php
}else{
	$a = $_GET['a'];
	$kel = $_SESSION['kel'];
	switch ($a) {
		case 'tambah':
		case 'ubah':
		if($a=='ubah'){
			if(!isset($_GET['i'])){eksyen('','?hal=desa&kel='.$kel.'&kec='.$_SESSION['kec']);}
			$id = $_GET['i'];
			$q = $db->query("select * from desa where id='$id'");
			$d = $q->fetch_array();

			if(isset($_POST['teks'])){
				$teks = $db->real_escape_string($_POST['teks']);
				$usr = $_SESSION['usr'];

				$q = $db->query("update desa set nama='$teks' where id='$id'");
				if($q){
					eksyen('Data berhasil diubah','?hal=desa&kel='.$kel.'&kec='.$_SESSION['kec']);
				}else{
					eksyen('Data gagal diubah','?hal=desa&kel='.$kel.'&kec='.$_SESSION['kec']);
				}
			}
		}elseif($a=='tambah') {
			if(isset($_POST['teks'])){
				$teks = $db->real_escape_string($_POST['teks']);
				$usr = $_SESSION['usr'];

				$q = $db->query("insert into desa(id,nama,idkelurahan) values(uuid(),'$teks','$kel')");
				if($q){
					eksyen('Data berhasil diinput','?hal=desa&kel='.$kel.'&kec='.$_SESSION['kec']);
				}else{
					eksyen('Data gagal diinput','?hal=desa&kel='.$kel.'&kec='.$_SESSION['kec']);
				}
			}
		}
?>
			<h3><?php ($a=="tambah") ? $aa='Tambah' : $aa='Ubah'; echo $aa;?> Desa <small>| <a href="?hal=desa&kel=<?=$_SESSION['kel'];?>&kec=<?=$_SESSION['kec'];?>">Kembali</a></small></h3>
			<div class="row">
				<form class="col s12" action="" method="post">
					<div class="row">
						<div class="input-field col s12">
							<input id="teks" name="teks" type="text" class="validate" value="<?php if($a=='ubah') echo $d['nama'];?>" required>
								<label for="teks">Nama Desa</label>
						</div>
					</div>
					<button type="submit" class="btn waves-effect waves-light">Simpan</button>
				</form>
			</div>
<?php
			break;

		case 'hapus':
			if(!isset($_GET['i']) or $_GET['i']==''){
				eksyen('','?hal=desa');
			}
			$id = $_GET['i'];
			$db->query("delete from desa where id='$id'");
			eksyen('Data berhasil dihapus','?hal=desa&kel='.$kel.'&kec='.$_SESSION['kec']);
			break;
		
		default:
			# code...
			break;
	}
}