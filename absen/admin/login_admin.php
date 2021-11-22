<?php 
// memulai session
session_start();

// cek apakah sudah ada session atau belom
if(isset($_SESSION["login"])) {
	header("location: index_admin.php");
}

// cek apakah tombol sudah dipencet
if ( isset($_POST["submit"])) {
	// ambil data dari rest_api
	$data = file_get_contents("http://localhost:8080/rest_api/admin_login.php");
	$login = json_decode($data, true);
	$login = $login["result"];

	// cek apakah datanya ada
	if(isset($_POST['username']) && isset($_POST['password'])) {
		for($i=0; $i < count($login); $i++) {
			if($login[$i]['username_admin'] == $_POST['username']) {
				if($login[$i]['password_admin'] == md5($_POST['password'])) {
					$_SESSION["nama"] = $login[$i]['username_admin'];
					$success = TRUE;
					break;
				} else {
					$success = FALSE;
				}
			} else {
				$success = FALSE;
			}
		}
	} else {
		echo "Harap isi semua kolom yang tersedia";
	}

	if($success == true) {
		echo "
		<script>
			alert('Selamat Datang Admin');
		</script>
		";

		// set session
		$_SESSION["login"] = true;

		header("location: index_admin.php");
		exit;
		
	} else {
		echo "
		<script>
			alert('Username/Password Salah');
			header.location.href = 'login_admin.php';
		</script>
		";
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Admin</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
</head>
<body>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form role="form" method="POST">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" required>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" required>
							</div>
							<button type="submit" name="submit" class="btn btn-primary">Login</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->	
	

<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
