<?php session_start();
if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
	echo "<script>
		alert('Anda harus login dahulu !');
		window.location.href='login.php';
	</script>";
}
 ?>
<!doctype html>
<html lang="en">	
<head>
	<title>Tambah Dokter | Sehatin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<!--<link rel="stylesheet" href="assets/css/demo.css">-->
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php 
			include 'navbar.php';
			include 'left_sidebar.php';

			$nama_err = $gender_err = $alamat_err = $nohp_err = $nip_err = "";
			$nama = $gender = $nohp = $nip = "";
			$alamat = "Alamat";

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				if (empty($_POST['nama'])) {
					$nama_err = "* Nama harus diisi !";
				}
				else if (!preg_match("/^[.a-zA-Z ]*$/", $_POST['nama'])) {
					$nama_err = "* Hanya dapat menginputkan huruf dan spasi !";
				}
				else {
					$nama = trim($_POST['nama']);
				}

				if (empty($_POST['gender'])) {
					$gender_err = "* Pilih gender !";
				}
				else{
					$gender = $_POST['gender'];
				}

				if (empty($_POST['alamat']) || $_POST['alamat'] == "Alamat") {
					$alamat_err = "* Alamat harus diisi !";
				}
				else{
					$alamat = $_POST['alamat'];
				}

				if (empty($_POST['nohp'])) {
					$nohp_err = "* No Hp harus diisi !";
				}
				elseif (!is_numeric($_POST['nohp'])) {
					$nohp_err = "* No Hp harus berupa angka !";
				}
				else{
					$nohp = $_POST['nohp'];
				}

				if (empty($_POST['nip'])) {
					$nip_err = "* Nomor izin praktek harus diisi !";
				}
				else{
					$nip = $_POST['nip'];
				}

				if ($nama_err == "" && $gender_err == "" && $alamat_err == "" && $nohp_err == "" && $nip_err == "") {
					mysqli_query($con, "INSERT INTO dokter (nm_dokter, gender, alamat, no_hp, no_ijin_praktek) VALUE ('$nama', '$gender', '$alamat', '$nohp', '$nip')");
					echo "<script>
						alert('Data berhasil ditambah');
						window.location.href='data_dokter.php';
					  </script>";
				}
			}
		?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<h3 class="page-title">Dokter</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Tambah Dokter</h3>
								</div>
								<div class="panel-body">
									<form method="POST" action="">
										<div class="row">
											<div class="col-md-6">
												<input type="text" name="nama" class="form-control" placeholder="Nama Dokter" value="<?php echo(isset($_POST['nama']) ? $_POST['nama'] : $nama ) ?>">
		 										<span class="text-danger"> <?php echo($nama_err); ?></span>
											</div>
											<div class="col-md-6">
												<input type="text" name="nohp" minlength="11" maxlength="13" class="form-control" placeholder="No Handphone" value="<?php echo(isset($_POST['nohp']) ? $_POST['nohp'] : $nohp ) ?>">
		 										<span class="text-danger"> <?php echo($nohp_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<div class="col-md-3">
		 											<label class="fancy-radio">
		 											<input type="radio" name="gender" class="form-control" value="Laki-laki" <?php echo($gender == "Laki-laki" ? 'checked' : '') ?> ><span><i></i>Laki-Laki</span>
		 											</label>
		 										</div>
		 										<div class="col-md-3">
		 											<label class="fancy-radio">
		 											<input type="radio" name="gender" class="form-control" value="Perempuan" <?php echo($gender == "Perempuan" ? 'checked' : '') ?> ><span><i></i>Perempuan</span>
		 											</label>
		 										</div>
		 										<span class="text-danger"> <?php echo($gender_err); ?></span>
											</div>
											<div class="col-md-6">
												<input type="text" name="nip" class="form-control" placeholder="Nomor Izin Praktek" value="<?php echo(isset($_POST['nip']) ? $_POST['nip'] : $nip ) ?>">
		 										<span class="text-danger"> <?php echo($nip_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<textarea name="alamat" class="form-control" rows="2"><?php echo $alamat ?></textarea>
		 										<span class="text-danger"> <?php echo($alamat_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
		 									<div class="col-md-6">
		 										<button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Tambah</button> &nbsp; &nbsp;
		 										<button type="reset" name="reset" class="btn btn-danger"><i class="fa fa-times-circle" onclick="history.go(-1);"></i> &nbsp;  Batal</button>
		 									</div>
		 								</div>	
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="clearfix"></div>
		<?php include 'footer.php'; ?>
	</div>
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="assets/scripts/klorofil-common.js"></script>
</body>
</html>