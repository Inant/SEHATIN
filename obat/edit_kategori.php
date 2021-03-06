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
	<title>Edit Kategori Obat | Sehatin</title>
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
		$query = "SELECT * FROM kategori_obat WHERE id_kategori = '$_GET[id_kategori]'";
		$result = mysqli_query($con, $query);
		$val = mysqli_fetch_assoc($result);
		$kategori_err ="";
		$kategori = "";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
		 	if (empty($_POST['kategori'])) {
		 		$kategori_err = "* Kategori harus diisi !";
		 	}
		 	else{
		 		$kategori = $_POST['kategori'];
		 	}

		 	if ($kategori_err == "") {
		 		mysqli_query($con, "UPDATE kategori_obat SET kategori = '$kategori' WHERE id_kategori = '$_POST[id_kategori]'");
		 		echo "<script>
		 				alert('Data berhasil diperbarui');
		 				window.location.href='kategori_obat.php';
		 				</script>";
		 	}
		 } ?>
		 <div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Kategori Obat</h3>
					<div class="row">
						<div class="col-md-6">
							<div class="panel">
								<div class="panel-heading">
									<h4 class="panel-title">Edit Kategori Obat</h4>
								</div>
								<div class="panel-body">
									<form method="POST" action="">
										<input type="hidden" name="id_kategori" value="<?php echo $val['id_kategori']?>">
										<input type="text" name="kategori" class="form-control" placeholder="Masukan kategori obat" value="<?php echo isset($_POST['submit']) ? $_POST['kategori'] : $val['kategori'] ?>">
										<span class="text-danger"><?php echo $kategori_err ?></span>
										<br>
										<button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i>  Simpan</button> &nbsp; &nbsp;
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
