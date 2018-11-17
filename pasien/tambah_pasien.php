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
 		<title>Tambah Pasien | Sehatin</title>
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

				$nid_err = $nama_err = $tmpt_err = $tgl_err = $gender_err = $alamat_err = $no_hp_err = $pendidikan_err = $status_err = $kategori_err = "";
				$nid = $nama = $tmpt = $tgl = $gender = $no_hp = $pendidikan = $status = $kategori = "";
				$alamat = "Alamat";

				if ($_SERVER["REQUEST_METHOD"] == "POST") {
					if (empty($_POST['nid'])) {
						$nid_err = "* Nomer Identitas harus diisi !";
					}
					else {
						$nid = trim($_POST['nid']);
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

          if (empty($_POST['tmpt'])) {
						$tmpt_err = "* Tempat Lahir harus diisi !";
					}
					else {
						$tmpt = trim($_POST['tmpt']);
					}
          date_timezone_set("Asia/Jakarta");
          $now = date("Y-m-d");
          if (empty($_POST['tgl'])) {
						$tgl_err = "* Tanggal lahir harus diisi !";
					}
          elseif ($_POST['tgl'] >= $now) {
            $tgl_err = "* Tanggal lahir tidak valid !";
          }
					else {
						$tgl = trim($_POST['tgl']);
					}

					if (empty($_POST['gender'])) {
						$gender_err = "* Pilih gender";
					}
					else {
						$gender = trim($_POST['gender']);
					}

          if (empty($_POST['alamat']) || $_POST['alamat'] == "Alamat") {
						$alamat_err = "* Alamat harus diisi !";
					}
					else {
						$alamat = trim($_POST['alamat']);
					}

					if (empty($_POST['no_hp'])) {
						$no_hp_err = "* No Hp harus diisi !";
					}
					elseif (!is_numeric($_POST['no_hp'])) {
						$no_hp_err = "* No hp harus berupa angka !";
					}
					else {
						$no_hp = trim($_POST['no_hp']);
					}

          if (empty($_POST['pendidikan'])) {
						$pendidikan_err = "* Pendidikan terakhir harus diisi !";
					}
					else {
						$pendidikan = trim($_POST['pendidikan']);
					}

          if (empty($_POST['status'])) {
						$status_err = "* Pilih status !";
					}
					else {
						$status = trim($_POST['status']);
					}

          if (empty($_POST['kategori'])) {
						$kategori_err = "* Pilih kategori pasien !";
					}
					else {
						$kategori = trim($_POST['kategori']);
					}

					if ($nid_err == "" && $nama_err == "" && $tmpt_err == "" && $tgl_err == "" && $gender_err == "" && $alamat_err == "" &&  $no_hp_err == "" && $pendidikan_err == "" && $status_err == "" && $kategori_err == "") {
						mysqli_query($con, "INSERT INTO pasien (no_identitas, nama, tmpt_lahir, tgl_lahir, gender, alamat, no_hp, pendidikan, status_perkawinan, id_kategori_pasien) VALUE ('$nid', '$nama', '$tmpt', '$tgl', '$gender', '$alamat', '$no_hp', '$pendidikan', '$status', '$kategori')");
						echo "<script>
										alert('Data berhasil ditambahkan');
										window.location.href='data_pasien.php';
									</script>";
					}

				}
			 ?>
			 <div class="main">
			 	<div class="main-content">
			 		<div class="container-fluid">
			 			<h3 class="page-title">Pasien</h3>
						<div class="row">
						  <div class="col-md-12">
						    <div class="panel">
						    	<div class="panel-heading">
						    		<h3 class="panel-title">Tambah Pasien</h3>
						    	</div>
									<div class="panel-body">
										<form class="" action="" method="POST">
											<div class="row">
												<div class="col-md-6">
                          <label for="">No Identitas</label>
													<input type="text" name="nid" value="<?php echo(isset($_POST['nid']) ? $_POST['nid'] : '') ?>" placeholder="No KK / NIP / NIM" class="form-control" maxlength="16" minlength="9">
													<span class="text-danger"><?php echo($nid_err)?></span>
												</div>
												<div class="col-md-6">
                          <label for="">Nama Pasien</label>
													<input type="text" name="nama" value="<?php echo(isset($_POST['nama']) ? $_POST['nama'] : '') ?>" placeholder="Nama pasien" class="form-control">
													<span class="text-danger"><?php echo($nama_err)?></span>
												</div>
											</div>
											<br>
                      <div class="row">
												<div class="col-md-6">
                          <label for="">Tempat Lahir</label>
													<input type="text" name="tmpt" value="<?php echo(isset($_POST['tmpt']) ? $_POST['tmpt'] : '') ?>" placeholder="Tempat lahir" class="form-control">
													<span class="text-danger"><?php echo($tmpt_err)?></span>
												</div>
												<div class="col-md-6">
                          <label for="">Tanggal Lahir</label>
													<input type="date" name="tgl" value="<?php echo(isset($_POST['tgl']) ? $_POST['tgl'] : '') ?>" class="form-control">
													<span class="text-danger"><?php echo($tgl_err)?></span>
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
                          <label for="">Alamat</label>
                          <textarea name="alamat" class="form-control"><?php echo($alamat) ?></textarea>
													<span class="text-danger"><?php echo($alamat_err) ?></span>
												</div>
											</div>
											<br>
											<div class="row">
												<div class="col-md-6">
                          <label for="">No Hp</label>
                          <input type="text" name="no_hp" value="<?php echo(isset($_POST['no_hp']) ? $_POST['no_hp'] : '') ?>" placeholder="No Hp" class="form-control">
                          <span class="text-danger"><?php echo($no_hp_err) ?></span>
												</div>
												<div class="col-md-6">
                          <label for="">Pendidikan Terakhir</label>
                          <select class="form-control" name="pendidikan">
                            <option value="">-- Pilih pendidikan terakhir --</option>
                            <option value="SD" <?php echo($_POST['pendidikan'] == 'SD' ? 'selected' : '') ?>>SD</option>
                            <option value="SMP" <?php echo($_POST['pendidikan'] == 'SMP' ? 'selected' : '') ?>>SMP</option>
                            <option value="SMA" <?php echo($_POST['pendidikan'] == 'SMA' ? 'selected' : '') ?>>SMA</option>
                            <option value="D1" <?php echo($_POST['pendidikan'] == 'D1' ? 'selected' : '') ?>>D1</option>
                            <option value="D2" <?php echo($_POST['pendidikan'] == 'D2' ? 'selected' : '') ?>>D2</option>
                            <option value="D3" <?php echo($_POST['pendidikan'] == 'D3' ? 'selected' : '') ?>>D3</option>
                            <option value="S1" <?php echo($_POST['pendidikan'] == 'S1' ? 'selected' : '') ?>>S1</option>
                            <option value="S2" <?php echo($_POST['pendidikan'] == 'S2' ? 'selected' : '') ?>>S2</option>
                            <option value="S3" <?php echo($_POST['pendidikan'] == 'S3' ? 'selected' : '') ?>>S3</option>
                          </select>
                          <span class="text-danger"><?php echo($pendidikan_err) ?></span>
												</div>
											</div>
											<br>
                      <div class="row">
												<div class="col-md-6">
                          <label for="">Status Perkawinan</label>
                          <br>
													<div class="col-md-3">
			 											<label class="fancy-radio">
			 											<input type="radio" name="status" class="form-control" value="Belum Kawin" <?php echo($status == "Belum Kawin" ? 'checked' : '') ?> ><span><i></i>Blm Kawin</span>
			 											</label>
			 										</div>
			 										<div class="col-md-3">
			 											<label class="fancy-radio">
			 											<input type="radio" name="status" class="form-control" value="Kawin" <?php echo($status == "Kawin" ? 'checked' : '') ?> ><span><i></i>Kawin</span>
			 											</label>
			 										</div>
                          <span class="text-danger"><?php echo($status_err) ?></span>
												</div>
												<div class="col-md-6">
                          <label for="">Kategori Pasien</label>
                          <select class="form-control" name="kategori">
                            <option value="">-- Pilih Kategori --</option>
                            <?php
                              $q = "SELECT * FROM kategori_pasien";
                              $r = mysqli_query($con, $q);
                              while ($val = mysqli_fetch_assoc($r)) {
                            ?>
                              <option value="<?php echo $val['id_kategori_pasien'] ?>" <?php echo($_POST['kategori'] == $val['id_kategori_pasien'] ? 'selected' : '')?> > <?php echo $val['kategori_pasien'] ?></option>
                            <?php
                              }
                            ?>
                          </select>
													<span class="text-danger"><?php echo($kategori_err)?></span>
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
			 <div class="clearfix">
			 	<?php
					include '../dashboard/footer.php';
				 ?>
			 </div>
 		</div>
		<script src="../assets/vendor/jquery/jquery.min.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="../assets/scripts/klorofil-common.js"></script>
 	</body>
 </html>
