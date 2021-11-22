<?php 

session_start();

if(!isset($_SESSION["login"])) {
	header("location: login_admin.php");
	exit;
}

// cek apakah tombol sudah dipencet
if ( isset($_POST["submit"])) {
	$id = $_GET["id_login"];

	$data = file_get_contents("http://localhost:8080/rest_api/user_login.php?id_login=$id");
    $data = json_decode($data, true);
    $data = $data["result"];

    $password_lama = md5($_POST["password_lama"]);
    $password = $_POST["password"];
	

	if($password_lama == $data["password"]) {
		$url="http://localhost:8080/rest_api/user_login.php?id_login=$id";
    
		$temp=array(
			"id_login" => "$id",
			"password"=>"$password"
		);
		$options = array(
					"http"=> array(
						"method"=>"POST",
						"header"=>"Content-Type: application/x-www-form-urlencoded",
						"content"=>http_build_query($temp)
					)
		);
		$response=file_get_contents($url,false,stream_context_create($options));
		echo 
		"
		<script>
			alert('Data Berhasil Diedit');
			document.location.href = 'data_user.php';
		</script>
		";
	} else {
		echo 
		"
		<script>
			alert('Password Lama Salah');
			document.location.href = 'ubahUser.php?id_login=$id';
		</script>
		";
	}



} else {

    $id = $_GET["id_login"];

    $data = file_get_contents("http://localhost:8080/rest_api/user_login.php?id_login=$id");
    $data = json_decode($data, true);
    $data = $data["result"];
    
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Halaman Admin</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
	<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
					<a class="navbar-brand" href="index_admin.php"><span>Halaman</span> Admin</a>
					<ul class="nav navbar-top-links navbar-right"></ul>
			</div>

		</div><!-- /.container-fluid -->
	</nav>
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name"><?= $_SESSION["nama"]; ?></div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>
		<ul class="nav menu">
			<li class="parent active">
				<a data-toggle="collapse" href="#sub-item-1">
					<em class="fa fa-table">&nbsp;</em> 
					Data Table 
					<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="fa fa-plus"></em></span>
				</a>
				<ul class="children collapse" id="sub-item-1">
					<li><a class="" href="index_admin.php">
						<span class="fa fa-arrow-right">&nbsp;</span> Mahasiswa
					</a></li>
					<li><a class="active" href="data_user.php">
						<span class="fa fa-arrow-right">&nbsp;</span> User Login
					</a></li>
				</ul>
			</li>
			<li><a href="logout.php"><em class="fa fa-power-off">&nbsp;</em> Logout</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="index_admin.php">
					<em class="fa fa-table"></em>
				</a></li>
				<li class="">Table Login User</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Ubah Data</h1>
			</div>
		</div><!--/.row-->
		
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Forms</div>
                    <div class="panel-body">
                        <div class="col-md-6">
							<form role="form" action="" method="POST">
								<div class="form-group" >
									<label>Username</label>
									<input class="form-control" id="nama" name="nama" value="<?= $data["username"]?>" disabled required>
								</div>
								<div class="form-group">
									<label for="password">Password Lama</label>
									<input class="form-control" id="password" name="password_lama" type="password" required>
								</div>
								<div class="form-group">
									<label for="password">Password Baru</label>
									<input class="form-control" id="password" name="password" type="password" required>
								</div>
								<button type="submit" class="btn btn-primary" name="submit">Simpan Perubahan</button>
							</form>
						</div>
                    </div>
                </div>
            </div><!-- /.panel-->
        </div>
    </div>
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
	var chart1 = document.getElementById("line-chart").getContext("2d");
	window.myLine = new Chart(chart1).Line(lineChartData, {
	responsive: true,
	scaleLineColor: "rgba(0,0,0,.2)",
	scaleGridLineColor: "rgba(0,0,0,.05)",
	scaleFontColor: "#c5c7cc"
	});
};
	</script>
		
</body>
</html>