<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login | Sehatin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<!--Ikon di title -->
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<?php
		$user = "";
		session_start();
		$gagal = "";

		$pass = "";

		include 'koneksi.php';
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$user = $_POST['user'];
			$pass = md5($_POST['pass']);
			$query = "SELECT * FROM petugas WHERE username = '$_POST[user]' AND password = '$pass' AND status = 'Aktif'";
			$result = mysqli_query($con, $query);
			$val = mysqli_fetch_assoc($result);
			if (mysqli_num_rows($result) > 0) {
				$_SESSION['username'] = $val['username'];
				$_SESSION['level'] = $val['level'];
				echo "<script> alert('Berhasil Login');
				window.location.href = 'dashboard/dashboard.php';
				</script>";
			}
			else{
				$gagal = "* Username atau password salah atau user Non Aktif";
			}
		}

	 ?>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<h2>SEHATIN</h2>
								<p class="lead">Login</p>
							</div>
							<form class="form-auth-small" action="" method="POST">
								<div class="input-group">
									<label for="signin-email" class="control-label sr-only">Username</label>
									<span class="input-group-addon"><i class="fa fa-user"></i></span>
									<input type="text" class="form-control" id="signin-email" value="<?php echo $user ?>" placeholder="Username" name="user" required>

								</div>
								<br>
								<div class="input-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<span class="input-group-addon"><i class="fa fa-lock"></i></span>
									<input type="password" class="form-control" id="signin-password" placeholder="Password" name="pass" value="" required>
								</div>
								<span class="text-danger"><?php echo $gagal; ?></span>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">SEHATIN</h1>
							<p>by Popeye Team comel</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
