<!DOCTYPE html>
<?php session_start(); include '../../db.php'; ?>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>PT AETRA Air Tangerang - Pendaftaran Sambungan Baru</title>

  <!-- CSS  -->
  <link href="../../css/css.css" rel="stylesheet">
  <link href="../../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="../../css/jquery.dataTables.min.css" rel="stylesheet">

  <!--  Scripts-->
  <script src="../../js/jquery-1.11.3.min.js"></script>
  <script src="../../js/materialize.js"></script>
  <script src="../../js/init.js"></script>
  <script src="../../js/jquery.dataTables.min.js"></script>
  <script src="../../js/isnumber.js"></script>
  <script src="../../js/tinymce/tinymce.min.js"></script>
</head>
<body>
  <nav class="white" role="navigation" style="height:75px;line-height:75px;">
    <div class="nav-wrapper container"><a id="logo-container" href="#" class="brand-logo"><img src="../../image/aetra.jpg" height="75px"></a>
      <!-- Dropdown Structure -->
      <ul id="dropdown1" class="dropdown-content">
        <li<?=aktif("deskripsi");?>><a href="?hal=deskripsi">Deskripsi</a></li>
        <li<?=aktif("link");?>><a href="?hal=link">Tautan</a></li>
        <li<?=aktif("daerah");?><?=aktif("kel");?><?=aktif("desa");?>><a href="?hal=daerah">Daerah</a></li>
      </ul>
      <ul id="masterdata" class="dropdown-content">
        <li><a href="?hal=user&s=usr">Data Pelanggan</a></li>
        <li><a href="?hal=user&s=srv">Data Surveyor</a></li>
        <li><a href="?hal=user&s=adm">Data Super Admin</a></li>
        <li><a href="?hal=wil">Data Admin Wilayah</a></li>
      </ul>

      <ul class="right hide-on-med-and-down light-blue">
        <li<?=indeks();?>><a href=".">Home</a></li>
        <li<?=aktif("user");?>><a class="dropdown-button" data-activates="masterdata" constrainwidth="false">Master Data</a></li>
        <li<?=aktif("pemasangan");?>><a href="?hal=pemasangan">Data Pemasangan</a></li>
        <li<?=aktif("deskripsi");?><?=aktif("link");?><?=aktif("daerah");?><?=aktif("kel");?><?=aktif("desa");?>><a class="dropdown-button" href="#!" data-activates="dropdown1">Pengaturan</a></li>
        <li><a href="../../keluar.php">Keluar</a></li>
      </ul>

      <ul id="nav-mobile" class="side-nav light-blue">
        <li><a href="#">Navbar Link</a></li>
      </ul>
      <a href="#" data-activates="nav-mobile" class="button-collapse light-blue"><i class="material-icons">menu</i></a>
    </div>
  </nav>
  
  <!--BODY-->
  <div class="container">
    <div class="row">
      <div class="col s12">
        <?php include 'home.php'; ?>
      </div>
    </div>
  </div>

<?php include "../../footer.php";?>

  <script type="text/javascript">

  $('.dropdown-button').dropdown({
      inDuration: 300,
      outDuration: 225,
      constrain_width: false, // Does not change width of dropdown to that of the activator
      hover: true, // Activate on hover
      gutter: 0, // Spacing from edge
      belowOrigin: true, // Displays dropdown below the button
      alignment: 'left' // Displays dropdown with edge aligned to the left of button
    }
  );
  </script>
  </body>
</html>
