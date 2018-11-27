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
	<title>Tambah Petugas | Sehatin</title>
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

		$nama_err = $gender_err = $alamat_err = $nohp_err = $username_err = $password_err = $konfirmasi_err = $level_err = "";
		$nama = $gender = $nohp = $user = $pass = $konfirmasi = $level = "";
		$alamat = "Alamat";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//print_r($_POST);
			$quser = mysqli_query($con, "SELECT username FROM login WHERE username = '$_POST[username]'");
			$cekuser = mysqli_num_rows($quser);
			if (empty($_POST['nama'])) {
				$nama_err = "* Nama harus diisi !";
			}
			else if (!preg_match("/^[a-zA-Z ]*$/", $_POST['nama'])) {
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

			if (empty($_POST['user'])) {
				$username_err = "* Username harus diisi !";
			}
			elseif ($cekuser > 0) {
				$username_err = "* Username telah digunakan !";
			}
			else{
				$username = $_POST['user'];
			}

			if (empty($_POST['pass'])) {
				$password_err = "* Password harus diisi !";
			}
			else{
				$pass = $_POST['pass'];
			}

			if (empty($_POST['konfirmasi'])) {
				$konfirmasi_err = "* Konfirmasi password harus diisi !";
			}
			elseif ($_POST['konfirmasi'] != $_POST['pass']) {
				$konfirmasi_err = "* Konfirmasi password tidak sesuai !";
			}
			else{
				$konfirmasi = $_POST['konfirmasi'];
			}

			if (empty($_POST['level'])) {
				$level_err = "* Pilih level !";
			}
			else{
				$level = $_POST['level'];
			}

			if ($nama_err == "" && $gender_err == "" && $alamat_err == "" && $nohp_err == "" && $username_err == "" && $password_err == "" && $konfirmasi_err == "" && $level_err == "") {
				$enkripsi = md5($pass);
				mysqli_query($con, "INSERT INTO petugas (nama_petugas, gender, alamat, no_hp) VALUE ('$nama', '$gender', '$alamat', '$nohp')");
				mysqli_query($con, "INSERT INTO login (id_user, username, password, level, status) VALUE ((SELECT id_petugas FROM petugas WHERE nama_petugas = '$nama'), '$username','$enkripsi', '$level', 'Aktif') ");
				echo "<script>
						alert('Data berhasil ditambah');
						window.location.href='data_petugas.php';
					  </script>";

			}

		}

		 ?>
		 <div class="main">
		 	<div class="main-content">
		 		<div class="container-fluid">
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title"><i class="fa fa-stethoscope"></i>&ensp;Tambah Petugas</h1>
						</div>
					</div>
		 			<div class="row">
		 				<div class="col-md-12">
		 					<div class="panel">
		 						<div class="panel-body">
		 							<form method="POST" action="">
		 								<div class="row">
		 									<div class="col-md-6">
												<label for="">Nama Petugas</label>
		 										<input type="text" name="nama" class="form-control" placeholder="Nama" value="<?php echo(isset($_POST['nama']) ? $_POST['nama'] : $nama ) ?>">
		 										<span class="text-danger"> <?php echo($nama_err); ?></span>
		 									</div>
		 									<div class="col-md-6">
												<label for="">Username</label>
		 										<input type="text" class="form-control" placeholder="Username" name="user" value="<?php echo($user) ?>">
		 										<span class="text-danger"> <?php echo($username_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
		 									<div class="col-md-6">
												<label for="">Gender</label>
												<br>
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
												<label for="">Password</label>
		 										<input type="Password" name="pass" placeholder="Password" class="form-control" value="<?php echo($pass) ?>">
		 										<span class="text-danger"> <?php echo($password_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
			 									<div class="col-md-6">
													<label for="">No Handphone</label>
			 										<input type="text" name="nohp" class="form-control" maxlength="13" placeholder="No Hp" value="<?php echo(isset($_POST['nohp']) ? $_POST['nohp'] : $nohp ) ?>">
			 										<span class="text-danger"> <?php echo($nohp_err); ?></span>
			 									</div>
		 									<div class="col-md-6">
												<label for="">Konfirmasi Password</label>
		 										<input type="password" name="konfirmasi" class="form-control" placeholder="Konfirmasi Password" value="<?php echo(isset($_POST['konfirmasi']) ? $_POST['konfirmasi'] : $konfirmasi ) ?>">
		 										<span class="text-danger"> <?php echo($konfirmasi_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
											<div class="col-md-6">
												<label for="">Alamat</label>
		 										<textarea name="alamat" class="form-control" rows="2"><?php echo $alamat ?></textarea>
		 										<span class="text-danger"> <?php echo($alamat_err); ?></span>
		 									</div>
		 									<div class="col-md-6">
												<label for="">Level</label>
		 										<select class="form-control" name="level">
		 										<option value="">Pilih Level</option>
												<option value="Admin" <?php echo $level == "Admin" ? 'selected' : '' ?> >Admin</option>
												<option value="Apoteker" <?php echo $level == "Apoteker" ? 'selected' : '' ?> >Apoteker</option>
		 										<option value="Kasir" <?php echo $level == "Kasir" ? 'selected' : '' ?> >Kasir</option>
		 										<option value="Resepsionis" <?php echo $level == "Resepsionis" ? 'selected' : '' ?> >Resepsionis</option>
		 									</select>
		 									<span class="text-danger"> <?php echo($level_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
		 									<div class="col-md-6">
		 										<button type="submit" class="btn btn-primary"><i class="fa fa-plus-square"></i>  Tambah</button> &nbsp; &nbsp;
		 										<button type="reset" name="reset" class="btn btn-danger" onclick="history.go(-1);"><i class="fa fa-times-circle"></i> &nbsp;  Batal</button>
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
		<?php include '../dashboard/footer.php'; ?>
	</div>
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>

</body>

</html>
