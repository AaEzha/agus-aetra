<?php
if(!isset($_GET['a'])){
?>
<h3>Kecamatan <small>| <a href="?hal=daerah&a=tambah">Tambah Kecamatan</a></small></h3>
<?=tabel();?>
<table id="tbl">
	<thead>
		<tr>
			<th data-field="no" width="5%">No</th>
			<th data-field="no" width="5%">Wil</th>
			<th data-field="kec">Nama</th>
			<th data-field="kel" width="15%">Kelurahan</th>
			<th data-field="price" width="15%">Aksi</th>
		</tr>
	</thead>

	<tbody>
	<?php
	$i = 1;
	$ql = $db->query("select * from kecamatan order by nama asc");
	while($d = $ql->fetch_array()){ ?>
		<tr>
			<td><?=$i;?></td>
			<td><?=$d['wilayah'];?></td>
			<td><?=$d['nama'];?></td>
			<td><a href="?hal=kel&kec=<?=$d['id'];?>">Atur</a></td>
			<td><a href="?hal=daerah&a=ubah&i=<?=$d['id'];?>">Ubah</a> | <a href="?hal=daerah&a=hapus&i=<?=$d['id'];?>" <?=yakin();?>>Hapus</a></td>
		</tr>
	<?php $i++; } ?>
	</tbody>
</table>
<?php
}else{
	$a = $_GET['a'];
	switch ($a) {
		case 'tambah':
		case 'ubah':
		if($a=='ubah'){
			if(!isset($_GET['i'])){eksyen('','?hal=daerah');}
			$id = $_GET['i'];
			$q = $db->query("select * from kecamatan where id='$id'");
			$d = $q->fetch_array();

			if(isset($_POST['teks'])){
				$teks = $db->real_escape_string($_POST['teks']);
				$wilayah = $db->real_escape_string($_POST['wilayah']);
				$usr = $_SESSION['usr'];

				$q = $db->query("update kecamatan set nama='$teks', wilayah='$wilayah' where id='$id'");
				if($q){
					eksyen('Data berhasil diubah','?hal=daerah');
				}else{
					eksyen('Data gagal diubah','?hal=daerah');
				}
			}
		}elseif($a=='tambah') {
			if(isset($_POST['teks'])){
				$teks = $db->real_escape_string($_POST['teks']);
				$wilayah = $db->real_escape_string($_POST['wilayah']);
				$usr = $_SESSION['usr'];

				$q = $db->query("insert into kecamatan(id,nama,wilayah) values(uuid(),'$teks','$wilayah')");
				if($q){
					eksyen('Data berhasil diinput','?hal=daerah');
				}else{
					eksyen('Data gagal diinput','?hal=daerah');
				}
			}
		}
?>
			<h3><?php ($a=="tambah") ? $aa='Tambah' : $aa='Ubah'; echo $aa;?> Kecamatan <small>| <a href="?hal=daerah">Kembali</a></small></h3>
			<div class="row">
				<form class="col s12" action="" method="post">
					<div class="row">
						<div class="input-field col s6">
							<input id="teks" name="teks" type="text" class="validate" value="<?php if($a=='ubah') echo $d['nama'];?>" required>
								<label for="teks">Nama Kecamatan</label>
						</div>
						<div class="input-field col s6">
							<p><input class="with-gap" name="wilayah" type="radio" id="wil1" value="1" <?php if($d['wilayah']=='1') echo "checked";?> />
    						<label for="wil1">Wilayah I</label></p>
							<p><input class="with-gap" name="wilayah" type="radio" id="wil2" value="2" <?php if($d['wilayah']=='2') echo "checked";?> />
    						<label for="wil2">Wilayah II</label></p>
						</div>
					</div>
					<button type="submit" class="btn waves-effect waves-light">Simpan</button>
				</form>
			</div>
<?php
			break;

		case 'hapus':
			if(!isset($_GET['i']) or $_GET['i']==''){
				eksyen('','?hal=daerah');
			}
			$id = $_GET['i'];
			// cek anggota kelurahan
			$qkel = $db->query("select id from kelurahan where idkecamatan='$id'");
			$dkel = $qkel->fetch_array();
			$idkel = $dkel['id'];
			// hapus desa berdasarkan id kelurahan
			$db->query("delete from desa where idkelurahan='$idkel'");
			// hapus kelurahan berdasarkan id kecamatan
			$db->query("delete from kelurahan where idkecamatan='$id'");
			// hapus kecamatannya
			$db->query("delete from kecamatan where id='$id'");

			eksyen('','?hal=daerah');
			break;
		
		default:
			# code...
			break;
	}
}