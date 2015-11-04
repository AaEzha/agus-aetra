<?php

function dbase(){
	$db = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
	return $db;
}

function yabukan($i){
	if($a=="0"){
		$b = "Bukan";
	}else{
		$b = "Ya";
	}
	return $b;
}

function adatidak($i){
	if($a=="0"){
		$b = "Tidak Ada";
	}else{
		$b = "Ada";
	}
	return $b;
}

function indeks(){ // buat menu home/index
	if(!isset($_GET['hal'])){
		echo " class=\"active\"";
	}
}

function isnumber(){
	$a = 'onkeypress="return isNumber(event)"';
	return $a;
}

function aktif($aktip){ // buat menu selain home
	if(isset($_GET['hal'])){
		if($_GET['hal']==$aktip){
			echo " class=\"active\"";
		}
	}
}
function drop($aktip){ // buat menu selain home
	if(isset($_GET['hal'])){
		if($_GET['hal']==$aktip){
			echo "active";
		}
	}
}

function radio($a,$b){ 
	if($a==$b){
		echo "checked";
	}
}

function listmenu($a,$b){ 
	if($a==$b){
		echo "selected";
	}
}

function sesi($grup){
	if($_SESSION['grup'] != $grup){
		echo '<script>window.location.assign("inside.php");</script>';
	}
}

function tabel(){
	echo "\n<script>$(document).ready(function(){ $('#tbl').dataTable({lengthChange:false,pageLength:25});});</script>";
}

function yakin(){
	echo "onClick=\"return confirm('Apakah Anda yakin akan melakukan aksi ini?');\" ";
}

function eksyen($teks=false,$tujuan){ // buat pindah halaman
	if($teks){
		die("<script>alert('$teks');</script>
	     <meta http-equiv='refresh' content='0;$tujuan'>");
	}else{
		die("<meta http-equiv='refresh' content='0;$tujuan'>");
	}
}

function ambildata($guid,$tabel,$kolom){
	$db=dbase();
	$a = $db->query("select * from $tabel where id='$guid'");
	$b = $a->fetch_array();
	return $b[$kolom];
}

function data_user($guid,$kolom){
	$a = mysql_query("select * from user where GUID='$guid'");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function data_user_detail_user($guid,$kolom){
	$a = mysql_query("select * from user_detail where USER_ID='$guid'");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function data_mog_user_detail($guid,$kolom){
	$a = mysql_query("select * from member_of_group where USER_DETAIL_ID='$guid'");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function data_group_name($guid,$kolom){
	$a = mysql_query("select * from ms_group where GUID='$guid'");
	$b = mysql_fetch_array($a);
	return $b[$kolom];
}

function group_name($uid,$kolom){
	$iduser = data_user($uid,'GUID');
	$iduserdetail = data_user_detail_user($iduser,'GUID');
	$idmog = data_mog_user_detail($iduserdetail,'MS_GROUP_ID');
	$grup = data_group_name($idmog,'GROUP_NAME');
	return $grup;
}
?>