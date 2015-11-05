<?php
if(!isset($_GET['a'])){
?>
	<?=tabel();?>
	<h3>Data Admin Wilayah <small>| <a href="?hal=wil&a=tambah">Tambah Admin</a></small></h3>
	<table id="tbl" class="centered">
		<thead>
			<tr>
				<th data-field="id" width="10%">No</th>
				<th data-field="uname">Username</th>
				<th data-field="nama">Nama</th>
				<th data-field="level">Wilayah</th>
				<th data-field="aksi" width="20%">Aksi</th>
			</tr>
		</thead>

		<tbody>
		<?php
		$qu = $db->query("select 
							u.usr,u.level,u.id as idusr,
							b.nama,b.id as idbio,
							uw.wilayah as wilayah
							from usr u 
							join biodata b 
								on u.id=b.idusr 
							join usr_wilayah uw 
								on u.id=uw.idusr 
							where u.hapus='0' and u.level='wil'");
		$i=1;
		while($d = $qu->fetch_array()){ ?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$d['usr'];?></td>
				<td><?=$d['nama'];?></td>
				<td><?=$d['wilayah'];?></td>
				<td><a href="?hal=wil&a=ubah&u=<?=$d['idusr'];?>&b=<?=$d['idbio'];?>">Ubah</a> | <a href="?hal=wil&a=hapus&u=<?=$d['idusr'];?>&b=<?=$d['idbio'];?>">Hapus</a></td>
			</tr>
		<?php $i++; } ?>
		</tbody>
	</table>
<?php
}else{
	$a = $_GET['a'];
	switch ($a) {
		case 'tambah':
			if(isset($_POST['nama'])){
				$nama = $_POST['nama'];
				$email = $_POST['email'];
				$usr = $_POST['usr'];
				$wil = $_POST['wil'];
				$passwd = $_POST['passwd'];

				// cek usr
				$q = $db->query("select usr from usr where usr='$usr'");
				$cek = mysqli_num_rows($q);
				if($cek>=1){
					eksyen('Username telah digunakan oleh orang lain. Pilih username yang lain','?hal=user&a=tambah');
				}

				// cek email
				$q = $db->query("select email from biodata where email='$email'");
				$cek = mysqli_num_rows($q);
				if($cek>=1){
					eksyen('Email telah digunakan oleh orang lain. Pilih email yang lain','?hal=user&a=tambah');
				}

				// uuid usr
				$qu = $db->query("select uuid() as uuid");
				$du = $qu->fetch_array();
				$idusr = $du['uuid'];
				$pass = md5($passwd);
				$db->query("insert into usr(id,usr,passwd,level,usrcrt,wktcrt) values('$idusr','$usr','$pass','wil','$usr',now())") or die("Error inserting user");
				// end

				// biodata
				$db->query("insert into biodata(id,idusr,nama,email,usrcrt,wktcrt) values(uuid(),'$idusr','$nama','$email','$usr',now())") or die("Error inserting bio");
				// end

				// wilayah
				$db->query("insert into usr_wilayah(id,idusr,wilayah) values(uuid(),'$idusr','$wil')");

				eksyen('Data berhasil disimpan','?hal=wil');
			}
?>
			<h3>Tambah Admin Wilayah <small>| <a href="?hal=wil">kembali</a></small></h3>
			<div class="row">
				<form class="col s12" action="" method="post">
					<div class="row">
						<div class="input-field col s6">
							<input id="nama" name="nama" type="text" class="validate" length="35" maxlength="35" required>
								<label for="nama">Nama</label>
						</div>
						<div class="input-field col s6">
							<input id="email" type="email" name="email" class="validate" length="50" maxlength="50" required>
							<label for="email">Email</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<input id="usr" name="usr" type="text" class="validate" length="10" maxlength="10" required>
								<label for="usr">Username</label>
						</div>
						<div class="input-field col s6">
							<input id="passwd" type="password" name="passwd" class="validate" length="50" maxlength="50" required>
							<label for="passwd">Password</label>
						</div>
					</div>

					<div class="row">
						<div class="input-field col s6">
							<p><input class="with-gap" name="wil" type="radio" id="wil1" value="1" checked="" />
    						<label for="wil1">Wilayah I</label></p>
							<p><input class="with-gap" name="wil" type="radio" id="wil2" value="2" />
    						<label for="wil2">Wilayah II</label></p>
						</div>
					</div>
					<button type="submit" class="btn waves-effect waves-light">Simpan</button>
				</form>
			</div>
<?php
			break;

		case 'ubah':
			if(!$_GET['b'] or !$_GET['u'] or $_GET['b']=='' or $_GET['u']==''){
				eksyen('','?hal=user');
			}

			// usr
			$qu = $db->query("select * from usr where id='$_GET[u]'");
			$u = $qu->fetch_array();
			// biodata
			$qb = $db->query("select nama, email from biodata where id='$_GET[b]'");
			$b = $qb->fetch_array();

			// wilayah
			$qw = $db->query("select * from usr_wilayah where idusr='$_GET[u]'");
			$w = $qw->fetch_array();

			if(isset($_POST['nama'])){
				$nama = $_POST['nama'];
				$email = $_POST['email'];
				$usr = $_POST['usr'];
				$passwd = $_POST['passwd'];
				$wil = $_POST['wil'];

				$admin = $_SESSION['usr'];

				// uuid usr
				$idusr = $_GET['u'];
				$db->query("update usr set usr='$usr', usrupd='$admin', wktupd=now() where id='$idusr'") or die("Error inserting user");
				// end

				// passwd
				if($passwd!=''){
					$pass = md5($passwd);
					$db->query("update usr set passwd='$pass' where id='$idusr'");
				}
				// end

				// usr_wilayah
				$db->query("update usr_wilayah set wilayah='$wil' where idusr='$idusr'");

				// uuid biodata
				$idbio = $_GET['b'];
				$db->query("update biodata set nama='$nama', email='$email', usrupd='$admin', wktupd=now() where id='$idbio'") or die("Error inserting bio");
				// end

				eksyen('Data berhasil disimpan','?hal=wil');
			}
?>
			<h3>Ubah Admin Wilayah <small>| <a href="?hal=wil">kembali</a></small></h3>
			<div class="row">
				<form class="col s12" action="" method="post">
					<div class="row">
						<div class="input-field col s6">
							<input id="nama" name="nama" type="text" class="validate" length="35" maxlength="35" value="<?=$b['nama'];?>" required>
								<label for="nama">Nama</label>
						</div>
						<div class="input-field col s6">
							<input id="email" type="email" name="email" class="validate" length="50" maxlength="50" value="<?=$b['email'];?>" required>
							<label for="email">Email</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<input id="usr" name="usr" type="text" class="validate" length="10" maxlength="10" value="<?=$u['usr'];?>" required>
								<label for="usr">Username</label>
						</div>
						<div class="input-field col s6">
							<input id="passwd" type="password" name="passwd" class="validate" length="50" maxlength="50" placeholder="Biarkan seperti ini jika tidak ingin mengubah password">
							<label for="passwd">Password</label>
						</div>
					</div>
					<div class="row">
						<div class="input-field col s6">
							<p><input class="with-gap" name="wil" type="radio" id="wil1" value="1" <?php if($w['wilayah']=='1') echo "checked";?> />
    						<label for="wil1">Wilayah I</label></p>
							<p><input class="with-gap" name="wil" type="radio" id="wil2" value="2" <?php if($w['wilayah']=='2') echo "checked";?> />
    						<label for="wil2">Wilayah II</label></p>
						</div>
					</div>
					<button type="submit" class="btn waves-effect waves-light">Simpan</button>
				</form>
			</div>
<?php
			break;

		case 'hapus':
			if(!$_GET['b'] or !$_GET['u'] or $_GET['b']=='' or $_GET['u']==''){
				eksyen('','?hal=wil');
			}

			// usr
			$idusr = $_GET['u'];
			$db->query("update usr set hapus='1' where id='$idusr'");
			// biodata
			$idbio = $_GET['b'];
			$db->query("update biodata set hapus='1' where id='$idbio'");

			eksyen('Data berhasil dihapus','?hal=wil');
		
		default:
			# code...
			break;
	}
}