<?php
if(!isset($_GET['a'])){
	$_SESSION['kec'] = $_GET['kec'];
	$kec = $_SESSION['kec'];
?>
<h3>Kelurahan <small>| <a href="?hal=kel&a=tambah">Tambah Kelurahan</a></small></h3>
<?=tabel();?>
<table id="tbl">
	<thead>
		<tr>
			<th data-field="no" width="10%">No</th>
			<th data-field="kec">Nama</th>
			<th data-field="kel" width="15%">Desa</th>
			<th data-field="price" width="15%">Aksi</th>
		</tr>
	</thead>

	<tbody>
	<?php
	$i = 1;
	$ql = $db->query("select * from kelurahan where idkecamatan='$kec' order by nama asc");
	while($d = $ql->fetch_array()){ ?>
		<tr>
			<td><?=$i;?></td>
			<td><?=$d['nama'];?></td>
			<td><a href="?hal=desa&kel=<?=$d['id'];?>&kec=<?=$kec;?>">Atur</a></td>
			<td><a href="?hal=kel&a=ubah&i=<?=$d['id'];?>">Ubah</a> | <a href="?hal=kel&a=hapus&i=<?=$d['id'];?>" <?=yakin();?>>Hapus</a></td>
		</tr>
	<?php $i++; } ?>
	</tbody>
</table>
<div class="col s2 offset-s10">
	<a href="?hal=daerah" class="btn btn-default">Kembali</a>
</div>
<?php
}else{
	$a = $_GET['a'];
	$kec = $_SESSION['kec'];
	switch ($a) {
		case 'tambah':
		case 'ubah':
		if($a=='ubah'){
			if(!isset($_GET['i'])){eksyen('','?hal=kel&kec='.$kec);}
			$id = $_GET['i'];
			$q = $db->query("select * from Kelurahan where id='$id'");
			$d = $q->fetch_array();

			if(isset($_POST['teks'])){
				$teks = $db->real_escape_string($_POST['teks']);
				$usr = $_SESSION['usr'];

				$q = $db->query("update kelurahan set nama='$teks' where id='$id'");
				if($q){
					eksyen('Data berhasil diubah','?hal=kel&kec='.$kec);
				}else{
					eksyen('Data gagal diubah','?hal=kel&kec='.$kec);
				}
			}
		}elseif($a=='tambah') {
			if(isset($_POST['teks'])){
				$teks = $db->real_escape_string($_POST['teks']);
				$usr = $_SESSION['usr'];

				$q = $db->query("insert into kelurahan(id,nama,idkecamatan) values(uuid(),'$teks','$kec')");
				if($q){
					eksyen('Data berhasil diinput','?hal=kel&kec='.$kec);
				}else{
					eksyen('Data gagal diinput','?hal=kel&kec='.$kec);
				}
			}
		}
?>
			<h3><?php ($a=="tambah") ? $aa='Tambah' : $aa='Ubah'; echo $aa;?> Kelurahan <small>| <a href="?hal=kel&kec=<?=$_SESSION['kec'];?>">Kembali</a></small></h3>
			<div class="row">
				<form class="col s12" action="" method="post">
					<div class="row">
						<div class="input-field col s12">
							<input id="teks" name="teks" type="text" class="validate" value="<?php if($a=='ubah') echo $d['nama'];?>" required>
								<label for="teks">Nama Kelurahan</label>
						</div>
					</div>
					<button type="submit" class="btn waves-effect waves-light">Simpan</button>
				</form>
			</div>
<?php
			break;

		case 'hapus':
			if(!isset($_GET['i']) or $_GET['i']==''){
				eksyen('','?hal=kel');
			}
			$id = $_GET['i'];
			// hapus desa
			$db->query("delete from desa where idkelurahan='$id'");
			// hapus kelurahan
			$db->query("delete from kelurahan where id='$id'");
			eksyen('Data berhasil dihapus','?hal=kel&kec='.$kec);
			break;
		
		default:
			# code...
			break;
	}
}