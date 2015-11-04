<?php session_start(); include 'db.php';
if(!isset($_POST['nama'])){
	eksyen('Isi terlebih dahulu','?hal=daftar');
}else{
	$gelar = mysql_real_escape_string($_POST['gelar']);
	$inisial = mysql_real_escape_string($_POST['inisial']);
	$nama = mysql_real_escape_string($_POST['nama']);
	$ktp = mysql_real_escape_string($_POST['ktp']);
	$email = mysql_real_escape_string($_POST['email']);
	$ttl = mysql_real_escape_string($_POST['ttl']);
	$alamat = mysql_real_escape_string($_POST['alamat']);
	$rt = mysql_real_escape_string($_POST['rt']);
	$rw = mysql_real_escape_string($_POST['rw']);
	$kodepos = mysql_real_escape_string($_POST['kodepos']);
	$kec = mysql_real_escape_string($_POST['kec']);
	$kel = mysql_real_escape_string($_POST['kel']);
	$desa = mysql_real_escape_string($_POST['desa']);
	$telp = mysql_real_escape_string($_POST['telp']);
	$hp = mysql_real_escape_string($_POST['hp']);
	$alamat2 = mysql_real_escape_string($_POST['alamat2']);
	$rt2 = mysql_real_escape_string($_POST['rt2']);
	$rw2 = mysql_real_escape_string($_POST['rw2']);
	$kodepos2 = mysql_real_escape_string($_POST['kodepos2']);
	$kec2 = mysql_real_escape_string($_POST['kec2']);
	$kel2 = mysql_real_escape_string($_POST['kel2']);
	$desa2 = mysql_real_escape_string($_POST['desa2']);
	$telp2 = mysql_real_escape_string($_POST['telp2']);
	$hp2 = mysql_real_escape_string($_POST['hp2']);
	$job = mysql_real_escape_string($_POST['job']);
	$status = mysql_real_escape_string($_POST['status']);
	$status2 = mysql_real_escape_string($_POST['status2']);
	$syarat = mysql_real_escape_string($_POST['syarat']);
	$syarat2 = mysql_real_escape_string($_POST['syarat2']);
	$fungsi = mysql_real_escape_string($_POST['fungsi']);
	$fungsi2 = mysql_real_escape_string($_POST['fungsi2']);
	$jmlkmrtdr = mysql_real_escape_string($_POST['jmlkmrtdr']);
	$jmlkmrmnd = mysql_real_escape_string($_POST['jmlkmrmnd']);
	$ruangtamu = mysql_real_escape_string($_POST['ruangtamu']);
	$ruangmakan = mysql_real_escape_string($_POST['ruangmakan']);
	$ruangkeluarga = mysql_real_escape_string($_POST['ruangkeluarga']);
	$dapur = mysql_real_escape_string($_POST['dapur']);
	$garasi = mysql_real_escape_string($_POST['garasi']);
	$gudang = mysql_real_escape_string($_POST['gudang']);
	$teras = mysql_real_escape_string($_POST['teras']);
	$jmllantai = mysql_real_escape_string($_POST['jmllantai']);
	$jmlpenghuni = mysql_real_escape_string($_POST['jmlpenghuni']);
	$saluranpembuangan = mysql_real_escape_string($_POST['saluranpembuangan']);
	$sanitasi = mysql_real_escape_string($_POST['sanitasi']);
	$halaman = mysql_real_escape_string($_POST['halaman']);
	$lebarjalan = mysql_real_escape_string($_POST['lebarjalan']);
	$tertata = mysql_real_escape_string($_POST['tertata']);
	$estate = mysql_real_escape_string($_POST['estate']);
	$setuju = mysql_real_escape_string($_POST['setuju']);

	if($setuju!="1"){
		eksyen('Anda harus menyetujui Syarat dan Ketentuan PT AETRA Air Tangerang terlebih dahulu','?hal=daftar');
	}

	// surat
	$namafile = $_FILES['surat']['name'];
	$sumber = $_FILES['surat']['tmp_name'];
	$mime = $_FILES['surat']['type'];
	$surat = fopen($sumber,'rb');
	// end

	// uuid usr
	$qu = $db->query("select uuid() as uuid");
	$du = $qu->fetch_array();
	$idusr = $du['uuid'];
	$usr = explode("-", $idusr);
	$user = $usr[0];
	$passwd = md5($usr[1]);
	
	$db->query("insert into usr(id,usr,passwd,level,usrcrt,wktcrt) values('$idusr','$user','$passwd','usr','$user',now())") or die("Error inserting user");
	// end

	// uuid biodata
	$qu = $db->query("select uuid() as uuid");
	$du = $qu->fetch_array();
	$idbio = $du['uuid'];
	$db->query("insert into biodata(id,idusr,gelar,inisial,nama,ktp,email,ttl,alamat,rt,rw,kodepos,kec,kel,desa,telp,hp,job,usrcrt,wktcrt) values('$idbio','$idusr','$gelar','$inisial','$nama','$ktp','$email','$ttl','$alamat','$rt','$rw','$kodepos','$kec','$kel','$desa','$telp','$hp','$job','$user',now())") or die("Error inserting bio");
	// end

	// uuid pasang
	$qu = $db->query("select uuid() as uuid");
	$du = $qu->fetch_array();
	$idpasang = $du['uuid'];
	$db->query("insert into pasang(id,idbiodata,alamat,rt,rw,kodepos,kec,kel,desa,telp,hp,status,status2,syarat,syarat2,surat,mime,fungsi,fungsi2,jmlkmrtdr,jmlkmrmnd,ruangtamu,ruangmakan,ruangkeluarga,dapur,garasi,gudang,teras,jmllantai,jmlpenghuni,saluranpembuangan,sanitasi,lebarjalan,tertata,estate,usrcrt,wktcrt) values('$idpasang','$idbio','$alamat2','$rt2','$rw2','$kodepos2','$kec2','$kel2','$desa2','$telp2','$hp2','$status','$status2','$syarat','$syarat2','$surat','$mime','$fungsi','$fungsi2','$jmlkmrtdr','$jmlkmrmnd','$ruangtamu','$ruangmakan','$ruangkeluarga','$dapur','$garasi','$gudang','$teras','$jmllantai','$jmlpenghuni','$saluranpembuangan','$sanitasi','$lebarjalan','$tertata','$estate','$user',now())")  or die("Error inserting install");
	// end

	// sukses
	eksyen('Pendaftaran berhasil. Silahkan konfirmasi email Anda','index.php');
}