<h5>Formulir Pendaftaran Sambungan Baru Rumah Tangga</h5>
<script type="text/javascript">
  $(document).ready(function() {
  	// aktivasi hitung mundur
    $('input#Gelar').characterCounter();
    // aktivasi element select
    $('select').material_select();
    // aktivasi textarea
    $('#alamat').trigger('autoresize');
    // sembunyikan field lainnya
    $('#lain1,#lain2,#lain3').hide();
    // tampilkan field status
    $('#lstatus').click(function(){
    	$('#lain1').show();
    })
    // tampilkan field syarat
    $('#lsyarat').click(function(){
    	$('#lain2').show();
    })
    // tampilkan field fungsi
    $('#lfungsi').click(function(){
    	$('#lain3').show();
    })
    // sembunyikan field status
    $('[id^=status]').click(function(){
    	$('#lain1').hide();
    })
    // sembunyikan field syarat
    $('[id^=syarat]').click(function(){
    	$('#lain2').hide();
    })
    // sembunyikan field fungsi
    $('[id^=fungsi]').click(function(){
    	$('#lain3').hide();
    })
    $("#kec").change(function(){
	    var kecamatan = $("#kec").val();
	    $.ajax({
	        url: "kelurahan.php",
	        data: "kec="+kecamatan,
	        cache: false,
	        success: function(msg){
	            //jika data sukses diambil dari server kita tampilkan
	            //di <select id=kel>
	            $("#kel").html(msg);
	        }
	    });
	});
	$("#kel").change(function(){
	    var kelurahan = $("#kel").val();
	    $.ajax({
	        url: "desa.php",
	        data: "kel="+kelurahan,
	        cache: false,
	        success: function(msg){
	            $("#desa").html(msg);
	        }
	    });
	});
	$("#kec2").change(function(){
	    var kecamatan = $("#kec2").val();
	    $.ajax({
	        url: "kelurahan.php",
	        data: "kec="+kecamatan,
	        cache: false,
	        success: function(msg){
	            //jika data sukses diambil dari server kita tampilkan
	            //di <select id=kel>
	            $("#kel2").html(msg);
	        }
	    });
	});
	$("#kel2").change(function(){
	    var kelurahan = $("#kel2").val();
	    $.ajax({
	        url: "desa.php",
	        data: "kel="+kelurahan,
	        cache: false,
	        success: function(msg){
	            $("#desa2").html(msg);
	        }
	    });
	});
	$('.datepicker').pickadate({
		selectMonths: true, // Creates a dropdown to control month
		selectYears: 15, // Creates a dropdown of 15 years to control year
		format:"yyyy-mm-dd"
	});
  });
</script>
<div class="row">
	<form class="col s12" action="daftar-act.php" method="post" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s6">
				<input id="gelar" type="text" name="gelar" class="validate" value="" length="20" maxlength="20">
					<label for="gelar">Gelar</label>
			</div>
			<div class="input-field col s6">
				<input id="Inisial" type="text" name="inisial" class="validate" value="" length="12" maxlength="12">
				<label for="Inisial">Inisial</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input id="nama" type="text" name="nama" class="validate" value="" length="35" maxlength="35" required>
				<label for="nama">Nama <small>(Sesuai KTP)</small></label>
			</div>
			<div class="input-field col s6">
				<input id="ktp" type="text" name="ktp" class="validate" value="" length="30" maxlength="30" onkeypress="return isNumber(event)" required>
				<label for="ktp">No. KTP</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input id="email" type="email" name="email" class="validate" value="" required>
				<label for="email">Email</label>
			</div>
			<div class="input-field col s6">
				<input id="ttl" type="date" class="datepicker" name="ttl" Placeholder="Tanggal Lahir" required>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s12">
				<input id="job" type="text" class="validate" value="" name="job" required>
				<label for="job">Pekerjaan</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s8">
				<input id="alamat" type="text" class="validate" value="" name="alamat" required>
				<label for="alamat">Alamat</label>
			</div>
			<div class="input-field col s1">
				<input id="rt" name="rt" type="text" class="validate" value="" onkeypress="return isNumber(event)" length="3" maxlength="3" required>
				<label for="rt">RT</label>
			</div>
			<div class="input-field col s1">
				<input id="rw" name="rw" type="text" class="validate" value="" onkeypress="return isNumber(event)" length="3" maxlength="3" required>
				<label for="rw">RW</label>
			</div>
			<div class="input-field col s2">
				<input id="kodepos" type="text" class="validate" value="" onkeypress="return isNumber(event)" length="5" maxlength="5" name="kodepos" required>
				<label for="kodepos">Kode Pos</label>
			</div>
		</div>
		<div class="row">
			<div class="col s4">
				<label for="kec">Kecamatan</label>
				<select name="kec" id="kec" class="browser-default" required>
					<option value="">--Pilih Kecamatan--</option>
				<?php
				$qkec = $db->query("select * from kecamatan order by nama asc");
				while($dkec = $qkec->fetch_array()){
				?>
					<option value="<?=$dkec['id'];?>"><?=$dkec['nama'];?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col s4">
				<label for="kel">Kelurahan</label>
				<select name="kel" id="kel" class="browser-default" required>
					<option value="">--Pilih Kelurahan--</option>
				</select>
			</div>
			<div class="col s4">
				<label for="desa">Desa</label>
				<select name="desa" id="desa" class="browser-default" required>
					<option value="">--Pilih Desa--</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input id="tlp" type="text" class="validate" value="" onkeypress="return isNumber(event)" maxlength="14" length="14" name="telp">
				<label for="tlp">No.Telp</label>
			</div>
			<div class="input-field col s6">
				<input id="hp" type="text" class="validate" value="" onkeypress="return isNumber(event)" maxlength="14" length="14" name="hp" required>
				<label for="hp">No.HP</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s8">
				<input id="alamat2" type="text" class="validate" value="" name="alamat2" required>
				<label for="alamat2">Alamat <small>(Yang akan dipasang)</small></label>
			</div>
			<div class="input-field col s1">
				<input id="rt2" name="rt2" type="text" class="validate" value="" length="3" maxlength="3" required>
				<label for="rt2">RT</label>
			</div>
			<div class="input-field col s1">
				<input id="rw2" name="rw2" type="text" class="validate" value="" length="3" maxlength="3" required>
				<label for="rw2">RW</label>
			</div>
			<div class="input-field col s2">
				<input id="kodepos2" type="text" class="validate" value="" onkeypress="return isNumber(event)" length="5" maxlength="5" name="kodepos2" required>
				<label for="kodepos2">Kode Pos</label>
			</div>
		</div>
		<div class="row">
			<div class="col s4">
				<label for="kec2">Kecamatan</label>
				<select name="kec2" id="kec2" class="browser-default" required>
					<option value="">--Pilih Kecamatan--</option>
				<?php
				$qkec = $db->query("select * from kecamatan order by nama asc");
				while($dkec = $qkec->fetch_array()){
				?>
					<option value="<?=$dkec['id'];?>"><?=$dkec['nama'];?></option>
				<?php } ?>
				</select>
			</div>
			<div class="col s4">
				<label for="kel2">Kelurahan</label>
				<select name="kel2" id="kel2" class="browser-default" required>
					<option value="">--Pilih Kelurahan--</option>
				</select>
			</div>
			<div class="col s4">
				<label for="desa2">Desa</label>
				<select name="desa2" id="desa2" class="browser-default" required>
					<option value="">--Pilih Desa--</option>
				</select>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input id="tlp2" type="text" class="validate" value="" onkeypress="return isNumber(event)" maxlength="14" length="14" name="telp2">
				<label for="tlp2">No.Telp</label>
			</div>
			<div class="input-field col s6">
				<input id="hp2" type="text" class="validate" value="" onkeypress="return isNumber(event)" maxlength="14" length="14" name="hp2" required>
				<label for="hp2">No.HP</label>
			</div>
		</div>
		<div class="row">
			<p>
				Status Kepemilikan Rumah
			</p>
			<p>
				<input name="status" type="radio" id="status" value="Rumah Sendiri" checked />
				<label for="status">Rumah Sendiri</label>
			</p>
			<p>
				<input name="status" type="radio" id="status2" value="Kontrak / Sewa" />
				<label for="status2">Kontrak / Sewa</label>
			</p>
			<p>
				<input name="status" type="radio" id="status3" value="Dinas" />
				<label for="status3">Dinas</label>
			</p>
			<p>
				<input name="status" type="radio" id="lstatus" value="Lainnya" />
				<label for="lstatus">Lainnya</label>
				<div class="input-field col s5" id="lain1">
					<input id="tstatus" name="status2" type="text" class="validate" value="">
					<label for="tstatus">Lainnya</label>
				</div>
			</p>
		</div>
		<div class="row">
			<p>
				Persyaratan yang dilampirkan
			</p>
			<div class="col s6">
			<p>
				<input name="syarat" type="radio" id="syarat" value="KTP" checked />
				<label for="syarat">KTP</label>
			</p>
			<p>
				<input name="syarat" type="radio" id="syarat2" value="KK" />
				<label for="syarat2">KK</label>
			</p>
			<p>
				<input name="syarat" type="radio" id="syarat3" value="PBB" />
				<label for="syarat3">PBB</label>
			</p>
			<p>
				<input name="syarat" type="radio" id="lsyarat" value="Lainnya" />
				<label for="lsyarat">Lainnya</label>
				<div class="input-field col s5" id="lain2">
					<input id="tsyarat" name="syarat2" type="text" class="validate" value="">
					<label for="tsyarat">Lainnya</label>
				</div>
			</p>
			</div>
			<div class="file-field input-field col s6">
				<input class="file-path validate" type="text"/>
				<div class="btn">
					<span>Lampirkan Persyaratan</span>
					<input type="file" name="surat" required />
				</div>
			</p>
			</div>
		</div>
		<div class="row">
			Fungsi Bangunan
		</div>
		<div class="row">
			<div class="col s4">
			<?php
			$fi = 1;
			$fungsi = array('Tempat Ibadah','Asrama Badan Sosial','Rumah Yatim Piatu','Kantor Instansi Pemerintah','Kantor Perwakilan Asing','Lembaga Swasta Non Komersial','Instansi Perguruan / Kursus Instansi','ABRI (TNI/POLRI)','Kios/Warung');
			foreach($fungsi as $f){
			?>
				<p>
					<input class="with-gap" name="fungsi" type="radio" id="fungsi<?=$fi;?>" value="<?=$f;?>" />
					<label for="fungsi<?=$fi;?>"><?=$f;?></label>
				</p>
			<?php $fi++; } ?>
			</div>
			<div class="col s4">
			<?php
			$fi = 10;
			$fungsi = array('Bengkel Kecil','Usaha Kecil','Pergudangan','Usaha Kecil Dalam Rumah Tangga','Tempat Pangkas Rambut','Bengkel Menengah','Usaha Menengah','Usaha Menengah Dalam Rumah Tangga','Penjahit');
			foreach($fungsi as $f){
			?>
				<p>
					<input class="with-gap" name="fungsi" type="radio" id="fungsi<?=$fi;?>" value="<?=$f;?>" />
					<label for="fungsi<?=$fi;?>"><?=$f;?></label>
				</p>
			<?php $fi++; } ?>
			</div>
			<div class="col s4">
			<?php
			$fi = 19;
			$fungsi = array('Rumah Makan / Restoran Kecil','RS. Swasta / Poliklinik / Lab','Praktek Dokter','Kantor Pengacara','Steembath / Salon','Perusahaan Perdagangan/Niaga/Ruko/Rukan');
			foreach($fungsi as $f){
			?>
				<p>
					<input class="with-gap" name="fungsi" type="radio" id="fungsi<?=$fi;?>" value="<?=$f;?>" checked />
					<label for="fungsi<?=$fi;?>"><?=$f;?></label>
				</p>
			<?php $fi++; } ?>
				<p>
					<input class="with-gap" name="fungsi" type="radio" id="lfungsi" name="Lainnya" />
					<label for="lfungsi">Lainnya</label>
				</p>
				<p>
				<div class="input-field col s12" id="lain3">
					<input id="tfungsi" type="text" class="validate" value="" name="fungsi2">
					<label for="tfungsi">Lainnya</label>
				</div>
			</div>
		</div>
		<div class="row">
			<p>Kondisi Bangunan dan Lingkungan <small>(Untuk Pelanggan Rumah Tangga)</small></p>
		</div>
		<div class="row">
			<div class="col s6">
				Kondisi Bangunan
			</div>
			<div class="col s6">
				Lingkungan / Prasarana
			</div>
		</div>
		<div class="row">
			<div class="col s3">
				<div class="input-field">
					<input id="jmlkmrtdr" name="jmlkmrtdr" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="jmlkmrtdr">Jumlah Kamar Tidur</label>
				</div>
				<div class="input-field">
					<input id="jmlkmrmnd" name="jmlkmrmnd" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="jmlkmrmnd">Jumlah Kamar Mandi</label>
				</div>
				<div class="input-field">
					<input id="ruangtamu" name="ruangtamu" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="ruangtamu">Ruang Tamu</label>
				</div>
				<div class="input-field">
					<input id="ruangmakan" name="ruangmakan" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="ruangmakan">Ruang Makan</label>
				</div>
				<div class="input-field">
					<input id="ruangkeluarga" name="ruangkeluarga" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="ruangkeluarga">Ruang Keluarga</label>
				</div>
				<div class="input-field">
					<input id="dapur" name="dapur" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="dapur">Dapur</label>
				</div>
			</div>
			<div class="col s3">
				<div class="input-field">
					<input id="teras" name="teras" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="teras">Teras</label>
				</div>
				<div class="input-field">
					<input id="garasi" name="garasi" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="garasi">Garasi</label>
				</div>
				<div class="input-field">
					<input id="gudang" name="gudang" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="gudang">Gudang</label>
				</div>
				<div class="input-field">
					<input id="jmllantai" name="jmllantai" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="jmllantai">Jumlah Lantai</label>
				</div>
				<div class="input-field">
					<input id="jmlpenghuni" name="jmlpenghuni" type="text" class="validate" value="0" onkeypress="return isNumber(event)" required>
					<label for="jmlpenghuni">Jumlah Penghuni</label>
				</div>
			</div>
			<div class="col s6">
				<div class="row">
					<div class="col s5">
						Saluran Pembuangan
					</div>
					<div class="col s7">
						<input class="with-gap" name="saluranpembuangan" value="1" type="radio" id="saluranpembuangan1" checked />
						<label for="saluranpembuangan1">Ada</label>
						<input class="with-gap" name="saluranpembuangan" value="0" type="radio" id="saluranpembuangan2" />
						<label for="saluranpembuangan2">Tidak Ada</label>
					</div>
				</div>
				<div class="row">
					<div class="col s5">
						Sanitasi
					</div>
					<div class="col s7">
						<input class="with-gap" name="sanitasi" value="1" type="radio" id="sanitasi1" checked />
						<label for="sanitasi1">Ada</label>
						<input class="with-gap" name="sanitasi" value="0" type="radio" id="sanitasi2" />
						<label for="sanitasi2">Tidak Ada</label>
					</div>
				</div>
				<div class="row">
					<div class="col s5">
						Halaman
					</div>
					<div class="col s7">
						<input class="with-gap" name="halaman" value="1" type="radio" id="halaman1" checked />
						<label for="halaman1">Ada</label>
						<input class="with-gap" name="halaman" value="0" type="radio" id="halaman2" />
						<label for="halaman2">Tidak Ada</label>
					</div>
				</div>
				<div class="row">
					<div class="col s5">
						Lebar Jalan (meter)
					</div>
					<div class="col s7">
						<div class="row">
							<div class="col s5">
								<input class="with-gap" name="lebarjalan" value="4" type="radio" id="lebarjalan1" checked />
								<label for="lebarjalan1">> 4 </label>
							</div>
							<div class="col s7">
								<input class="with-gap" name="lebarjalan" value="3" type="radio" id="lebarjalan2" />
								<label for="lebarjalan2">3-4 m</label>
							</div>
						</div>
						<div class="row">
							<div class="col s5">
								<input class="with-gap" name="lebarjalan" value="2" type="radio" id="lebarjalan3" />
								<label for="lebarjalan3">1-2 m</label>
							</div>
							<div class="col s7">
								<input class="with-gap" name="lebarjalan" value="1" type="radio" id="lebarjalan4" />
								<label for="lebarjalan4">< 1 m</label>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col s5">
						Lingkungan Tertata
					</div>
					<div class="col s7">
						<input class="with-gap" name="tertata" value="1" type="radio" id="tertata1" checked />
						<label for="tertata1">Ya</label>
						<input class="with-gap" name="tertata" value="0" type="radio" id="tertata2" />
						<label for="tertata2">Bukan</label>
					</div>
				</div>
				<div class="row">
					<div class="col s5">
						Real Estate
					</div>
					<div class="col s7">
						<input class="with-gap" name="estate" value="1" type="radio" id="estate1" checked />
						<label for="estate1">Ya</label>
						<input class="with-gap" name="estate" value="0" type="radio" id="estate2" />
						<label for="estate2">Bukan</label>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<p>
				<input type="checkbox" id="setuju" name="setuju" value="1" required class="validate filled-in" />
				<label for="setuju">Saya menyetujui Syarat & Ketentuan PT. AETRA Air Tangerang</label>
			</p>
		</div>
		<button type="submit" class="btn waves-effect waves-light">Daftar</button>
	</form>
</div>