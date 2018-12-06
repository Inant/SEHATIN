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
	<title>Tambah Obat | Sehatin</title>
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

    $nm_obat_err = $kategori_err = $satuan_err = $hbeli_err = $hjual_err = $stok_err = $tgl_err = "";
    $nm_obat = $kategori = $satuan = $hbeli = $hjual = $stok = $tgl = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			//print_r($_POST);
			$qobat = mysqli_query($con, "SELECT nm_obat FROM obat WHERE nm_obat = '$_POST[nm_obat]'");
			$cekobat = mysqli_num_rows($qobat);

			if (empty($_POST['nm_obat'])) {
				$nm_obat_err = "* Nama obat harus diisi !";
			}
      elseif ($cekobat > 0) {
        $nm_obat_err = "* Obat sudah ada !";
      }
			else {
				$nm_obat = trim($_POST['nm_obat']);
			}

      if (empty($_POST['kategori'])) {
        $kategori_err = "* Pilih kategori !";
      }
      else {
        $kategori = $_POST['kategori'];
      }

      if (empty($_POST['satuan'])) {
        $satuan_err = "* Pilih satuan !";
      }
      else {
        $satuan = $_POST['satuan'];
      }

      date_default_timezone_set("Asia/Jakarta");
      $now = date("Y-m-d");

      if (empty($_POST['tgl'])) {
        $tgl_err = "* Tanggal kadaluarsa harus diisi !";
      }
      elseif ($_POST['tgl'] <= $now) {
        $tgl_err = "* Obat kadaluarsa !";
      }
      else {
        $tgl = trim($_POST['tgl']);
      }

      if (empty($_POST['hbeli'])) {
        $hbeli_err = "* Harga beli harus diisi !";
      }
      elseif (!is_numeric($_POST['hbeli'])) {
        $hbeli_err = "* Hanya boleh menginput angka !";
      }
      else {
        $hbeli = trim($_POST['hbeli']);
      }

      if (empty($_POST['hjual'])) {
        $hjual_err = "* Harga jual harus diisi !";
      }
      elseif (!is_numeric($_POST['hjual'])) {
        $hjual_err = "* Hanya boleh menginput angka !";
      }
      elseif ($_POST['hjual'] <= $_POST['hbeli']) {
        $hjual_err = "* Harga jual kurang atau sama dengan harga beli !";
      }
      else {
        $hjual = trim($_POST['hjual']);
      }

      if (empty($_POST['stok'])) {
        $stok_err = "* Stok harus diisi !";
      }
      else {
        $stok = trim($_POST['stok']);
      }

      if ($nm_obat_err == "" && $kategori_err == "" && $satuan_err == "" && $hbeli_err == "" && $hjual_err == "" && $stok_err == "" && $tgl_err == "") {
        mysqli_query($con, "INSERT INTO obat (nm_obat, id_kategori, id_satuan, harga_beli, harga_jual, stok, tgl_kadaluarsa, id_petugas) VALUE ('$nm_obat', '$kategori', '$satuan', '$hbeli', '$hjual', '$stok', '$tgl', '$_SESSION[id_user]' )");
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href='data_obat.php';
              </script>";
      }

      print_r($_POST);
		}

		 ?>
		 <div class="main">
		 	<div class="main-content">
		 		<div class="container-fluid">
          <div class="panel">
            <div class="panel-heading">
              <h1 class="panel-title"><i class="fa fa-medkit"></i>&ensp;Tambah Obat</h1>
            </div>
          </div>
		 			<div class="row">
		 				<div class="col-md-12">
		 					<div class="panel">
		 						<div class="panel-body">
		 							<form method="POST" action="">
		 								<div class="row">
		 									<div class="col-md-6">
												<label for="">Nama Obat</label>
		 										<input type="text" name="nm_obat" class="form-control" placeholder="Nama Obat" value="<?php echo(isset($_POST['nm_obat']) ? $_POST['nm_obat'] : $nm_obat ) ?>">
		 										<span class="text-danger"> <?php echo($nm_obat_err); ?></span>
		 									</div>
		 									<div class="col-md-6">
												<label for="">Kategori Obat</label>
		 										<select class="form-control" name="kategori">
                           <option value="">-- Pilih Kategori --</option>
                           <?php
                              $qkategori = mysqli_query($con, "SELECT * FROM kategori_obat WHERE status = 'Aktif' ORDER BY kategori ASC");
                              while ($valkategori = mysqli_fetch_assoc($qkategori)) {
                            ?>
                                <option value="<?php echo $valkategori['id_kategori'] ?>" <?php echo (isset($_POST['kategori']) && $_POST['kategori'] == $valkategori['id_kategori'] ? 'selected' : '') ?>> <?php echo $valkategori['kategori'] ?> </option>
                            <?php
                              }
                            ?>
                         </select>
		 										<span class="text-danger"> <?php echo($kategori_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
                    <div class="row">
		 									<div class="col-md-6">
												<label for="">Tanggal Kadaluarsa</label>
		 										<input type="date" name="tgl" class="form-control" value="<?php echo(isset($_POST['tgl']) ? $_POST['tgl'] : $tgl ) ?>">
		 										<span class="text-danger"> <?php echo($tgl_err); ?></span>
		 									</div>
		 									<div class="col-md-6">
												<label for="">Satuan Obat</label>
		 										<select class="form-control" name="satuan">
                           <option value="">-- Pilih Satuan --</option>
                           <?php
                              $qsatuan = mysqli_query($con, "SELECT * FROM satuan_obat WHERE status = 'Aktif' ORDER BY satuan ASC");
                              while ($valsatuan = mysqli_fetch_assoc($qsatuan)) {
                            ?>
                                <option value="<?php echo $valsatuan['id_satuan'] ?>" <?php echo (isset($_POST['satuan']) && $_POST['satuan'] == $valsatuan['id_satuan'] ? 'selected' : '') ?>> <?php echo $valsatuan['satuan'] ?> </option>
                            <?php
                              }
                            ?>
                         </select>
		 										<span class="text-danger"> <?php echo($satuan_err); ?></span>
		 									</div>
		 								</div>
                    <br>
                    <div class="row">
		 									<div class="col-md-6">
												<label for="">Harga Beli</label>
		 										<input type="number" name="hbeli" placeholder="Harga Beli" class="form-control" value="<?php echo(isset($_POST['hbeli']) ? $_POST['hbeli'] : $hbeli ) ?>">
		 										<span class="text-danger"> <?php echo($hbeli_err); ?></span>
		 									</div>
		 									<div class="col-md-6">
                        <label for="">Harga Jual</label>
		 										<input type="number" name="hjual" placeholder="Harga Jual" class="form-control" value="<?php echo(isset($_POST['hjual']) ? $_POST['hjual'] : $hjual ) ?>">
		 										<span class="text-danger"> <?php echo($hjual_err); ?></span>
		 									</div>
		 								</div>
		 								<br>
                    <div class="row">
		 									<div class="col-md-6">
												<label for="">Stok</label>
		 										<input type="number" name="stok" placeholder="Stok" class="form-control" value="<?php echo(isset($_POST['stok']) ? $_POST['stok'] : $stok ) ?>">
		 										<span class="text-danger"> <?php echo($stok_err); ?></span>
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
