<?php session_start();
if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
	echo "<script>
		alert('Anda harus login dahulu !');
		window.location.href='../login.php';
	</script>";
}
 ?>
 <!doctype html>
<html lang="en">
<head>
	<title>Tambah Poli | Sehatin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="../assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="../assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="../assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<!--<link rel="stylesheet" href="assets/css/demo.css">-->
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php
			include '../dashboard/navbar.php';
			include '../dashboard/left_sidebar.php';
			$poli_err = "";
			$poli = "";
			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST['poli'])) {
					$poli_err = "* Nama poli harus diisi !";
				}
				else{
					$poli = $_POST['poli'];
				}

				if ($poli_err == "") {
					mysqli_query($con, "INSERT INTO poli (poli) VALUE ('$poli')");
					echo "<script>
							alert('Data berhasil ditambah');
							window.location.href='data_poli.php';
						  </script>";
				}
			}
		?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">

						<div class="col-md-6">

							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-hospital-o"></i>&ensp;Tambah Poli</h3>
								</div>
							</div>
						</div>
					</div>
						<div class="row">
							<div class="col-md-6">
								<div class="panel">
									<div class="panel-heading">
<br>
									<div class="panel-body">
										<form method="POST" action="">

											<input type="text" name="poli" class="form-control" placeholder="Masukan nama poli" value="<?php echo isset($_POST['poli']) ? $_POST['poli'] : $poli ?>">
											<span class="text-danger"><?php echo $poli_err ?></span>

											<br>
											<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-plus-square"></i>  Tambah</button> &nbsp; &nbsp;
		 										<button type="reset" name="reset" class="btn btn-danger btn-sm" onclick="history.go(-1);"><i class="fa fa-times-circle"></i> &nbsp;  Batal</button>
										</form>
									</div>
								</div>
							</div>
						</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
		<?php include '../dashboard/footer.php'; ?>
	</div>
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>
</body>
</html>
