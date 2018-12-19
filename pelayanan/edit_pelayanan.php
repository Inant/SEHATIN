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
	<title>Edit Pelayanan | Sehatin</title>
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

		$query = "SELECT * FROM pelayanan WHERE id_pelayanan = '$_GET[id_pelayanan]'";
		$result = mysqli_query($con, $query);
		$val = mysqli_fetch_assoc($result);
		$pelayanan_err = $umum_err = $karyawan_err = $keluarga_err = $mahasiswa_err = "";
		$pelayanan = $umum = $karyawan = $keluarga = $mahasiswa = "";
		$alamat = "Alamat";
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//print_r($_POST);
			if (empty($_POST['pelayanan'])) {
				$pelayanan_err = "* Pelayanan harus diisi !";
			}
      elseif ($cekpelayanan > 0) {
        $pelayanan_err = "* Pelayanan telah ada !";
      }
			else {
				$pelayanan = trim($_POST['pelayanan']);
			}

			if (!isset($_POST['umum'])) {
				$umum_err = "* Harga harus diisi !";
			}
      elseif ($_POST['umum'] == 0) {
        $umum = trim($_POST['umum']);
      }
      elseif ($_POST['umum'] < 0) {
        $umum_err = "* Harga tidak boleh dibawah 0 !";
      }
			else{
				$umum = $_POST['umum'];
			}

			if (!isset($_POST['karyawan'])) {
				$karyawan_err = "* Harga harus diisi !";
			}
			elseif ($_POST['karyawan'] == 0) {
				$karyawan = trim($_POST['karyawan']);
			}
      elseif ($_POST['karyawan'] < 0) {
        $karyawan_err = "* Harga tidak boleh dibawah 0 !";
      }
			else{
				$karyawan = $_POST['karyawan'];
			}

			if (!isset($_POST['keluarga'])) {
				$keluarga_err = "* Harga harus diisi !";
			}
			elseif ($_POST['keluarga'] == 0) {
				$keluarga = trim($_POST['keluarga']);
			}
      elseif ($_POST['keluarga'] < 0) {
        $keluarga_err = "* Harga tidak boleh dibawah 0 !";
      }
			else{
				$keluarga = $_POST['keluarga'];
			}

			if (!isset($_POST['mahasiswa'])) {
				$mahasiswa_err = "* Harga harus diisi !";
			}
      elseif ($_POST['mahasiswa'] == 0) {
        $mahasiswa = trim($_POST['mahasiswa']);
      }
      elseif ($_POST['mahasiswa'] < 0) {
        $mahasiswa_err = "* Harga tidak boleh dibawah 0 !";
      }
      else {
        $mahasiswa = trim($_POST['mahasiswa']);
      }

			if ($pelayanan_err == "" && $umum_err == "" && $karyawan_err == "" && $keluarga_err == "" &&  $mahasiswa_err == "") {
				mysqli_query($con, "UPDATE pelayanan set pelayanan = '$pelayanan', harga_umum = '$umum', harga_karyawan = '$karyawan', harga_kel_karyawan = '$keluarga', harga_mahasiswa = '$mahasiswa' WHERE id_pelayanan = '$_POST[id_pelayanan]'");
				echo "<script>
						alert('Data berhasil diperbarui');
						window.location.href='data_pelayanan.php';
					  </script>";

			}

		}

		 ?>
		 <div class="main">
		 	<div class="main-content">
		 		<div class="container-fluid">
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title"><i class="fa fa-stethoscope"></i>&ensp;Edit Pelayanan</h1>
						</div>
					</div>
		 			<div class="row">
		 				<div class="col-md-12">
		 					<div class="panel">
		 						<div class="panel-body">
		 							<form method="POST" action="">
		 								<input type="hidden" name="id_pelayanan" value="<?php echo $val['id_pelayanan'] ?>">
		 								<div class="row">
		 									<div class="col-md-6">
												<label for="">Nama Pelayanan</label>
		 										<input type="text" name="pelayanan" class="form-control" placeholder="Nama Pelayanan" value="<?php echo($val['pelayanan']) ?>">
		 										<span class="text-danger"> <?php echo($pelayanan_err); ?></span>
		 									</div>
		 									<div class="col-md-6">
												<label for="">Harga Pasien Umum</label>
		 										<input type="number" class="form-control" placeholder="Harga pasien umum" name="umum" value="<?php echo($val['harga_umum']) ?>">
		 										<span class="text-danger"> <?php echo($umum_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
		 									<div class="col-md-6">
												<label for="">Harga Pasien Karyawan</label>
		 										<input type="number" name="karyawan" placeholder="Harga pasien karyawan" class="form-control" value="<?php echo($val['harga_karyawan']) ?>">
		 										<span class="text-danger"> <?php echo($karyawan_err); ?></span>
		 									</div>
                      <div class="col-md-6">
												<label for="">Harga Pasien Keluarga Karyawan</label>
		 										<input type="number" name="keluarga" placeholder="Harga pasien keluarga karyawan" class="form-control" value="<?php echo($val['harga_kel_karyawan']) ?>">
		 										<span class="text-danger"> <?php echo($keluarga_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
                      <div class="col-md-6">
                        <label for="">Harga Pasien Mahasiswa</label>
                        <input type="number" name="mahasiswa" placeholder="Harga pasien mahasiswa" class="form-control" value="<?php echo($val['harga_mahasiswa']) ?>">
                        <span class="text-danger"> <?php echo($mahasiswa_err); ?></span>
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
