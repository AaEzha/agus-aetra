<?php
if(!isset($_GET['a'])){
?>
<h3>Tautan <small>| <a href="?hal=link&a=tambah">Tambah Tautan</a></small></h3>
<?=tabel();?>
<table id="tbl">
	<thead>
		<tr>
			<th data-field="no" width="10%">No</th>
			<th data-field="teks">Teks</th>
			<th data-field="tautan">Tautan</th>
			<th data-field="tautan">Bagian</th>
			<th data-field="price" width="15%">Aksi</th>
		</tr>
	</thead>

	<tbody>
	<?php
	$i = 1;
	$ql = $db->query("select * from tautan order by bagian asc, urutan asc");
	while($d = $ql->fetch_array()){ ?>
		<tr>
			<td><?=$i;?></td>
			<td><?=$d['kata'];?></td>
			<td><?=$d['tautan'];?></td>
			<td><?=$d['bagian'];?></td>
			<td><a href="?hal=link&a=ubah&i=<?=$d['id'];?>">Ubah</a> | <a href="?hal=link&a=hapus&i=<?=$d['id'];?>" <?=yakin();?>>Hapus</a></td>
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
			if(!isset($_GET['i'])){eksyen('','?hal=link');}
			$id = $_GET['i'];
			$q = $db->query("select * from tautan where id='$id'");
			$d = $q->fetch_array();

			if(isset($_POST['teks'])){
				$teks = $db->real_escape_string($_POST['teks']);
				$link = $db->real_escape_string($_POST['link']);
				$bagian = $_POST['bagian'];
				$level = $_POST['level'];
				$urutan = $db->real_escape_string($_POST['urutan']);
				$usr = $_SESSION['usr'];

				$q = $db->query("update tautan set kata='$teks', tautan='$link', bagian='$bagian', urutan='$urutan', level='$level', usrupd='$usr', wktupd=now() where id='$id'");
				if($q){
					eksyen('Data berhasil diubah','?hal=link');
				}else{
					eksyen('Data gagal diubah','?hal=link');
				}
			}
		}elseif($a=='tambah') {
			if(isset($_POST['teks'])){
				$teks = $db->real_escape_string($_POST['teks']);
				$link = $db->real_escape_string($_POST['link']);
				$bagian = $_POST['bagian'];
				$level = $_POST['level'];
				$urutan = $db->real_escape_string($_POST['urutan']);
				$usr = $_SESSION['usr'];

				$q = $db->query("insert into tautan(id,kata,tautan,bagian,urutan,level,usrcrt,wktcrt) values(uuid(),'$teks','$link','$bagian','$urutan','$level','$usr',now())");
				if($q){
					eksyen('Data berhasil diinput','?hal=link');
				}else{
					eksyen('Data gagal diinput','?hal=link');
				}
			}
		}
?>
			<h3><?php ($a=="tambah") ? $aa='Tambah' : $aa='Ubah'; echo $aa;?> Tautan <small>| <a href="?hal=link">Kembali</a></small></h3>
			<div class="row">
				<form class="col s12" action="" method="post">
					<div class="row">
						<div class="input-field col s6">
							<input id="teks" name="teks" type="text" class="validate" value="<?php if($a=='ubah') echo $d['kata'];?>" required>
								<label for="teks">Teks</label>
						</div>
						<div class="input-field col s6">
							<input id="link" name="link" type="text" class="validate" value="<?php if($a=='ubah') echo $d['tautan'];?>" placeholder="Misalnya: http://linknya.com/" required>
							<label for="link">Tautan</label>
						</div>
					</div>
					<div class="row col s12">
					  <div class="col s4">
						<p>Bagian</p>
						<p>
						<?php
						$qb = array('connect','links');
						foreach ($qb as $qb) { ?>
							<input name="bagian" type="radio" id="<?=$qb;?>" value="<?=$qb;?>" <?php if($a=='ubah'){ if($qb==$d['bagian']){ echo "checked"; }} ?> />
							<label for="<?=$qb;?>"><?=$qb;?></label>
						<?php } ?>
							
						</p>
					  </div>
					  <div class="col s4">
						<p>Level</p>
						<p>
						<?php
						$qb = array('usr','adm','srv','all');
						foreach ($qb as $qb) { ?>
							<input name="level" type="radio" id="<?=$qb;?>" value="<?=$qb;?>" <?php if($a=='ubah'){if($qb==$d['level']){ echo "checked"; }} ?> />
							<label for="<?=$qb;?>"><?=$qb;?></label>
						<?php } ?>
							
						</p>
					  </div>
					  <div class="col s4">
						<div class="input-field col s12">
							<input id="urutan" name="urutan" type="text" class="validate" maxlength="3" length="3" value="<?php if($a=='ubah') echo $d['urutan'];?>" required <?=isnumber();?>>
							<label for="urutan">Urutan</label>
						</div>
					  </div>
					</div>
					<button type="submit" class="btn waves-effect waves-light">Simpan</button>
				</form>
			</div>
<?php
			break;

		case 'hapus':
			if(!isset($_GET['i']) or $_GET['i']==''){
				eksyen('','?hal=link');
			}
			$id = $_GET['i'];
			$db->query("delete from tautan where id='$id'");
			eksyen('Data berhasil dihapus','?hal=link');
			break;
		
		default:
			# code...
			break;
	}
}