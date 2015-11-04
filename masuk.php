<h3>Login</h3>
<?php
if(isset($_POST['usr'])){
	$usr = $db->real_escape_string($_POST['usr']);
	$passwd = $db->real_escape_string(md5($_POST['passwd']));

	$q = $db->query("select * from usr where usr='$usr' and passwd='$passwd'");
	if($q){
		$d = $q->fetch_array();
		$_SESSION['usr'] = $d['usr'];
		$_SESSION['level'] = $d['level'];
		switch ($d['level']) {
			case 'adm':
				eksyen('','apps/admin');
				break;
			case 'usr':
				eksyen('','apps/user');
				break;
			case 'srv':
				eksyen('','apps/survey');
				break;
			
			default:
				# code...
				break;
		}
	}
}
?>
<div class="row">
	<form class="col s12" action="" method="post">
		<div class="row">
			<div class="input-field col s6">
				<input id="usr" name="usr" type="text" class="validate" maxlength="10" length="10" required>
					<label for="usr">Username</label>
			</div>
			<div class="input-field col s6">
				<input id="passwd" name="passwd" type="password" class="validate" required>
				<label for="passwd">Password</label>
			</div>
		</div>
		<button type="submit" class="btn waves-effect waves-light">Login</button>
	</form>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('input#usr').characterCounter();
  });
</script>