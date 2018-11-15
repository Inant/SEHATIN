<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
	echo "<script>
					alert('Anda harus login dahulu!');
					window.location.herf='../login.php';
				</script>";
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 	<head>
 		<meta charset="utf-8">
 		<title>Tambah Pasien Mahasiwa | Sehatin</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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
 		<div id="wrapper">
 			<?php
				include '../dashboard/navbar.php';
				include '../dashboard/left_sidebar.php';

				$nim_err = $nama_err = $gender_err = $tgl_err = $nohp_err = $alamat_err = "";
				$nim = $nama = $gender = $tgl = $nohp = "";
				$alamat = "Alamat";

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (empty($_POST['nim'])) {
						$nim_err = "* NIM harus diisi !";
					}
					else {
						$nim = trim($_POST['nim']);
					}

					if (empty($_POST['nama'])) {
						$nama_err = "* Nama harus diisi !";
					}
					elseif (!preg_match("/^[.a-zA-Z ]*$/", $_POST['nama'])) {
						$nama_err = "* Hanya dapat menginputkan huruf dan spasi !";
					}
					else {
						$nama = trim($_POST['nama']);
					}

					if (empty($_POST['gender'])) {
						$gender_err = "* Pilih gender";
					}
					else {
						$gender = trim($_POST['gender']);
					}

					if (empty($_POST['tgl'])) {
						$tgl_err = "* Tanggal lahir harus diisi !";
					}
					else {
						$tgl = trim($_POST['tgl']);
					}

					if (empty($_POST['no_hp'])) {
						$nohp_err = "* No Hp harus diisi !";
					}
					elseif (!is_numeric($_POST['no_hp'])) {
						$nohp_err = "* No hp harus berupa angka !";
					}
					else {
						$nohp = trim($_POST['no_hp']);
					}

					if (empty($_POST['alamat']) || $_POST['alamat'] == "Alamat") {
						$alamat_err = "* Alamat harus diisi !";
					}
					else {
						$alamat = trim($_POST['alamat']);
					}

					if ($nim_err == "" && $nama_err == "" && $gender_err == "" && $tgl_err == "" && $nohp_err == "" && $alamat_err == "") {
						mysqli_query($con, "INSERT INTO pasien_mahasiswa (nim, nama, gender, tgl_lahir, no_hp, alamat) VALUE ('$nim', '$nama', '$gender', '$tgl', '$nohp', '$alamat')");
						echo "<script>
										alert('Data berhasil ditambah');
										window.location.href='pasien_mahasiswa.php';
									</script>";
					}

				}
			 ?>
			 <div class="main">
			 	<div class="main-content">
			 		<div class="container-fluid">
			 			<h3 class="page-title">Pasien Mahasiswa</h3>
						<div class="row">
						  <div class="col-md-12">
						    <div class="panel">
						    	<div class="panel-heading">
						    		<h3 class="panel-title">Tambah Pasien Mahasiwa</h3>
						    	</div>
									<div class="panel-body">
										<form class="" action="" method="POST">
											<div class="row">
												<div class="col-md-6">
													<input type="text" name="nim" value="<?php echo(isset($_POST['nim']) ? $_POST['nim'] : '') ?>" placeholder="NIM Mahasiwa" class="form-control" maxlength="9" minlength="9">
													<span class="text-danger"><?php echo($nim_err)?></span>
												</div>
												<div class="col-md-6">
													<input type="text" name="nama" value="<?php echo(isset($_POST['nama']) ? $_POST['nama'] : '') ?>" placeholder="Nama Mahasiwa" class="form-control">
													<span class="text-danger"><?php echo($nama_err)?></span>
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
													<input type="date" name="tgl" value="<?php echo(isset($_POST['tgl']) ? $_POST['tgl'] : '') ?>" class="form-control">
													<span class="text-danger"><?php echo($tgl_err) ?></span>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-6">
													<textarea name="alamat" class="form-control"><?php echo($alamat) ?></textarea>
													<span class="text-danger"><?php echo($alamat_err) ?></span>
												</div>
												<div class="col-md-6">
												  <input type="text" name="no_hp" value="<?php echo(isset($_POST['no_hp']) ? $_POST['no_hp'] : '') ?>" placeholder="No Hp" class="form-control">
													<span class="text-danger"><?php echo($nohp_err) ?></span>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-6">
												  <button type="submit" name="button" class="btn btn-primary btn-sm"> <i class="fa fa-plus-square"></i> Tambah </button> &nbsp; &nbsp;
													<button type="reset" name="reset" class="btn btn-danger btn-sm" onclick="history.go(-1)"> <i class="fa fa-times-circle"></i> &nbsp; Batal</button>
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
 		</div>
 	</body>
 </html>
