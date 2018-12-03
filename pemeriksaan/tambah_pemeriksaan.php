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
	<title>Pemeriksaan | Sehatin</title>
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
	<style media="screen">
		.autocomplete-suggestions {
			border: 1px solid #999;
			background: #FFF;
			overflow: auto;
		}
		.autocomplete-suggestion {
			padding: 2px 5px;
			white-space: nowrap;
			overflow: hidden;
		}
		.autocomplete-selected {
			background: #F0F0F0;
		}
		.autocomplete-suggestions strong {
			font-weight: normal;
			color: #3399FF;
		}
		.autocomplete-group {
			padding: 2px 5px;
		}
		.autocomplete-group strong {
			display: block;
			border-bottom: 1px solid #000;
		}
	</style>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php
			include '../dashboard/navbar.php';
			include '../dashboard/left_sidebar.php';
			mysqli_query($con, "UPDATE antrian SET status = 'Diperiksa' WHERE id_antrian = '$_GET[id_antrian]'");

      $qrm = mysqli_query($con, "SELECT p.*, a.*,(SELECT COUNT(*) FROM antrian WHERE id_pasien = '$_GET[p]' ) as jml_kunjungan FROM pasien p, antrian a WHERE p.id_pasien = '$_GET[p]' AND a.id_antrian='$_GET[id_antrian]'");
			$rm = mysqli_fetch_assoc($qrm);
			$qdokter = mysqli_query($con, "SELECT id_dokter, nm_dokter FROM dokter WHERE id_dokter = '$_SESSION[id_user]'");
			$dokter = mysqli_fetch_assoc($qdokter);
      $today = new DateTime();
      $tgl_lahir = new DateTime($rm['tgl_lahir']);
      $usia = $today->diff($tgl_lahir)->y;
      date_default_timezone_set("Asia/Jakarta");
      $date = date("d-m-Y");
			$suhu_err = $tensi1_err = $tensi2_err = $keluhan_err = $pemeriksaan_err = $diagnosa_err = $pelayanan_err = "";
			$suhu = $tensi1 = $tensi2 = $keluhan = $pemeriksaan = $diagnosa = $pelayanan = "";

    	$qid = mysqli_query($con, "SELECT MAX(id_pemeriksaan) as id FROM pemeriksaan");
    	$id = mysqli_fetch_assoc($qid);
			$id = $id['id'] + 1;

			if ($_SERVER["REQUEST_METHOD"] == "POST") {
				$qtindakan = mysqli_query($con, "SELECT * FROM pelayanan WHERE pelayanan = '$_POST[pelayanan]'");
				$cektindakan = mysqli_num_rows($qtindakan);

				if (empty($_POST['tensi1'])) {
					$tensi1_err = "* Tensi harus diisi !";
				}
				else if ($_POST['tensi1'] <= 0) {
					$tensi1_err = "* Tensi tidak valid !";
				}
				else {
				$tensi1 = trim($_POST['tensi1']);
				}

				if (empty($_POST['tensi2'])) {
					$tensi2_err = "* Tensi harus diisi !";
				}
				else if ($_POST['tensi2'] <= 0) {
					$tensi2_err = "* Tensi tidak valid !";
				}
				else {
					$tensi2 = trim($_POST['tensi2']);
				}

				if (empty($_POST['suhu'])) {
					$suhu_err = "* Suhu badan harus diisi !";
				}
				elseif ($_POST['suhu'] <= 0) {
					$suhu_err = "* Suhu badan tidak valid !";
				}
				else {
					$suhu = trim($_POST['suhu']);
				}

				if (empty($_POST['keluhan'])) {
					$keluhan_err = "* Ananemse harus diisi !";
				}
				else {
					$keluhan = trim($_POST['keluhan']);
				}

				if (empty($_POST['pemeriksaan']) || $_POST['pemeriksaan'] == "Pemeriksaan Fisik") {
					$pemeriksaan_err = "* Pemeriksaan fisik harus diisi !";
				}
				else {
					$pemeriksaan = trim($_POST['pemeriksaan']);
				}

				if (empty($_POST['diagnosa']) || $_POST['diagnosa'] == "Diagnosa") {
					$diagnosa_err = "* Diagnosa harus diisi !";
				}
				else {
					$diagnosa = trim($_POST['diagnosa']);
				}

				if (empty($_POST['pelayanan'])) {
					$pelayanan_err = "* Pilih tindakan !";
				}
				elseif ($cektindakan == 0) {
					$pelayanan_err = "* Tindakan tidak sesuai !";
				}
				else {
					$pelayanan = trim($_POST['pelayanan']);
				}

				if ($tensi1_err == "" && $tensi2_err == "" & $suhu_err == "" && $keluhan_err == "" && 			$pemeriksaan_err == "" && $diagnosa_err == "" && $pelayanan_err == "") {
					mysqli_query($con, "INSERT INTO pemeriksaan (id_antrian, id_dokter, pemeriksaan_fisik, tensi, suhu, diagnosa) VALUE ('$_GET[id_antrian]', '$_SESSION[id_user]', '$pemeriksaan', '$tensi1 / $tensi2', '$suhu', '$diagnosa')");

					mysqli_query($con, "INSERT INTO tindakan (id_pemeriksaan, id_pelayanan) VALUE ('$id', (SELECT id_pelayanan FROM pelayanan WHERE pelayanan = '$pelayanan') )");

					mysqli_query($con, "UPDATE antrian SET keluhan = '$keluhan' WHERE id_antrian = '$_GET[id_antrian]'");

					echo "<script>
									window.location.href='../resep/tambah_resep.php?id_antrian=$_GET[id_antrian]&id_pemeriksaan=$id&id_pasien=$rm[id_pasien]';
								</script>";
				}

			}
		?>
		 <div class="main">
		 	<div class="main-content">
		 		<div class="container-fluid">
		 			<h3 class="page-title">Pemeriksaan</h3>
		 			<div class="row">
		 				<div class="col-md-12">
		 					<div class="panel">
		 						<div class="panel-heading">
		 							<h3 class="panel-title">Form Pemeriksaan</h3>
		 						</div>
		 						<div class="panel-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <th>No Pemeriksaan</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $id; ?></td>
                          </tr>
                          <tr>
                            <th>Nama Pasien</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $rm['nama'] ?></td>
                          </tr>
                          <tr>
                            <th>Gender</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $rm['gender'] ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <th>Usia</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $usia; ?></td>
                          </tr>
                          <tr>
                            <th>Kategori Pasien</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $rm['kategori'] ?></td>
                          </tr>
                          <tr>
                            <th>Jumlah Kunjungan</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $rm['jml_kunjungan'] ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <th>Tanggal</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $date; ?></td>
                          </tr>
                          <tr>
                            <th>Dokter Pemeriksa</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $dokter['nm_dokter']; ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <br>
                  <br>
		 							<form method="POST" action="">
										<div class="row">
		 									<div class="col-md-6">
                        <label for="">Tekanan Darah</label>
												<br>
												<div class="col-md-5">
													<input type="number" name="tensi1" value="<?php echo (isset($_POST['tensi1']) ? $_POST['tensi1'] : '') ?>" class="form-control" placeholder="Tekanan atas">
													<span class="text-danger"><?php echo $tensi1_err ?></span>
												</div>
												<div class="col-sm-1">
												  <b>/</b>
												</div>
												<div class="col-md-5">
													<input type="number" name="tensi2" value="<?php echo (isset($_POST['tensi2']) ? $_POST['tensi2'] : '') ?>" class="form-control" placeholder="Tekanan bawah">
													<span class="text-danger"><?php echo $tensi2_err ?></span>
												</div>
		 									</div>
                      <div class="col-md-6">
                        <label for="">Suhu Badan</label>
												<input type="number" name="suhu" value="<?php echo (isset($_POST['suhu']) ? $_POST['suhu'] : '') ?>" class="form-control" placeholder="Suhu badan (Celcius)">
												<span class="text-danger"><?php echo $suhu_err ?></span>
		 									</div>
		 								</div>
		 								<div class="row">
		 									<div class="col-md-6">
                        <label for="">Ananemse</label>
												<textarea name="keluhan" class="form-control"><?php echo $rm['keluhan'] ?></textarea>
                        <span class="text-danger"><?php echo $keluhan_err ?></span>
		 									</div>
                      <div class="col-md-6">
                        <label for="">Pemeriksaan Fisik</label>
												<textarea name="pemeriksaan" class="form-control">Pemeriksaan Fisik</textarea>
                        <span class="text-danger"><?php echo $pemeriksaan_err ?></span>
		 									</div>
		 								</div>
		 								<br>
		 								<div class="row">
                      <div class="col-md-6">
                        <label for="">Diagnosa</label>
												<textarea name="diagnosa" class="form-control">Diagnosa</textarea>
                        <span class="text-danger"><?php echo $diagnosa_err ?></span>
		 									</div>
                      <div class="col-md-6">
                        <label for="">Tindakan</label>
                        <input type="text" id="pelayanan" name="pelayanan" value="<?php echo(isset($_POST['pelayanan']) ? $_POST['pelayanan'] : '') ?>" placeholder="Pilih Tindakan" class="form-control">
                        <span class="text-danger"><?php echo(
                          $pelayanan_err)?></span>
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
	<script src="../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../assets/vendor/jquery/jquery.autocomplete.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$( "#pelayanan" ).autocomplete({
				serviceUrl: "source.php",
				dataType: "JSON",
				onSelect: function (suggestion) {
					$( "#pelayanan" ).val("" + suggestion.pelayanan);
				}
			});
		})
	</script>
</body>

</html>
