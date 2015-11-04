<!-- CSS  -->
  <link href="css/css.css" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>

  <!--  Scripts-->
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  <script type="text/javascript">
  	$(document).ready(function() {
  		$('.datepicker').pickadate({
		    selectMonths: true, // Creates a dropdown to control month
		    selectYears: 15, // Creates a dropdown of 15 years to control year
		    format:"yyyy-mm-dd"
		  });
  	});
  </script>
<?php
if(isset($_POST['tgl'])){
	echo $_POST['tgl'];
}
?>

<form action="" method="POST">
	<legend>Form title</legend>
	<input type="date" class="datepicker" name="tgl">
	<button type="submit" class="btn">label</button>
</form>