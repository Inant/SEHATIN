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
	<title>Edit Dokter | Sehatin</title>
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
			$query = "SELECT * FROM dokter WHERE id_dokter = '$_GET[id_dokter]'";
			$result = mysqli_query($con, $query);
			$val = mysqli_fetch_assoc($result);
			$nama_err = $gender_err = $alamat_err = $nohp_err = $nip_err = $poli_err ="";
			$nama = $gender = $nohp = $nip = $poli = "";
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
					$alamat = trim($_POST['alamat']);
				}

				if (empty($_POST['nohp'])) {
					$nohp_err = "* No Hp harus diisi !";
				}
				elseif (!is_numeric($_POST['nohp'])) {
					$nohp_err = "* No Hp harus berupa angka !";
				}
				else{
					$nohp = trim($_POST['nohp']);
				}

				if (empty($_POST['nip'])) {
					$nip_err = "* Nomor izin praktek harus diisi !";
				}
				else{
					$nip = trim($_POST['nip']);
				}

				if (empty($_POST['poli'])) {
					$poli_err = "* Pilih poli !";
				}
				else {
					$poli = trim($_POST['poli']);
				}

				if ($nama_err == "" && $gender_err == "" && $alamat_err == "" && $nohp_err == "" && $nip_err == "" && $poli_err == "") {
					mysqli_query($con, "UPDATE dokter SET nm_dokter = '$nama', gender = '$gender', alamat = '$alamat', no_hp = '$nohp', no_ijin_praktek = '$nip', id_poli = '$poli' WHERE id_dokter = '$_POST[id_dokter]' ");
					echo "<script>
						alert('Data berhasil diperbarui');
						window.location.href='data_dokter.php';
					 	</script>";
				}
			}
		?>


		<div class="main">
 		 <div class="main-content">
 			 <div class="container-fluid">
 				 <div class="panel">
 					 <div class="panel-heading">
 						 <h1 class="panel-title"><i class="fa fa-user-md"></i>&ensp;Edit Dokter</h1>
 					 </div>
 				 </div>
 				 <div class="row">
 					 <div class="col-md-12">
 						 <div class="panel">
 							 <div class="row">
 							<div class="panel-body">
									<form method="POST" action="">
										<input type="hidden" name="id_dokter" value="<?php echo $val['id_dokter']?>">
										<div class="row">
											<div class="col-md-6">
												<label for="">Nama Dokter</label>
												<input type="text" name="nama" class="form-control" placeholder="Nama Dokter" value="<?php echo($val['nm_dokter']) ?>">
		 										<span class="text-danger"> <?php echo($nama_err); ?></span>
											</div>
											<div class="col-md-6">
												<label for="">No Handphone</label>
												<input type="text" name="nohp" minlength="11" maxlength="13" class="form-control" placeholder="No Handphone" value="<?php echo($val['no_hp']) ?>">
		 										<span class="text-danger"> <?php echo($nohp_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<label for="">Gender</label>
												<br>
												<div class="col-md-3">
		 											<label class="fancy-radio">
		 											<input type="radio" name="gender" class="form-control" value="Laki-laki" <?php echo($val['gender'] == "Laki-laki" ? 'checked' : '') ?> ><span><i></i>Laki-Laki</span>
		 											</label>
		 										</div>
		 										<div class="col-md-3">
		 											<label class="fancy-radio">
		 											<input type="radio" name="gender" class="form-control" value="Perempuan" <?php echo($val['gender'] == "Perempuan" ? 'checked' : '') ?> ><span><i></i>Perempuan</span>
		 											</label>
		 										</div>
		 										<span class="text-danger"> <?php echo($gender_err); ?></span>
											</div>
											<div class="col-md-6">
												<label for="">No Izin Praktek</label>
												<input type="text" name="nip" class="form-control" placeholder="Nomor Izin Praktek" value="<?php echo($val['no_ijin_praktek']) ?>">
		 										<span class="text-danger"> <?php echo($nip_err); ?></span>
											</div>
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<label for="">Alamat</label>
												<textarea name="alamat" class="form-control" rows="2"><?php echo $val['alamat'] ?></textarea>
		 										<span class="text-danger"> <?php echo($alamat_err); ?></span>
											</div>
											<div class="col-md-6">
												<label for="">Poli</label>
										    <select class="form-control" name="poli">
													<option value="">-- Pilih Poli --</option>
													<?php
														$qpoli = mysqli_query($con, "SELECT * FROM poli");
														while ($valpoli = mysqli_fetch_assoc($qpoli)) {
															echo "<option value = '$valpoli[id_poli]' $val[id_poli] == $valpoli[id_poli] ? 'selected' : ''> $valpoli[poli] </option>";
														}
													 ?>
										    </select>
												<span class="text-danger"><?php echo ($poli_err) ?></span>
										  </div>
										</div>
										<br>
										<div class="row">
		 									<div class="col-md-6">
		 										<button type="submit" class="btn btn-primary"><i class="fa fa-check"></i>  Simpan</button> &nbsp; &nbsp;
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
		<script src="../assets/vendor/jquery/jquery.min.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="../assets/scripts/klorofil-common.js"></script>
</body>
	</div>
</body>
</html>
