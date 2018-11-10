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
	<title>Pasien Mahasiwa | Sehatin</title>
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
	<script type="text/javascript">
		function konfirm(){
		 	tanya = confirm("Anda yakin ?");
		 	if (tanya == true) return true;
		 	else return false;
		}
	</script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
    <?php
    include '../dashboard/navbar.php';
    include '../dashboard/left_sidebar.php';
    ?>
    <div class="main">
      <div class="main-content">
        <div class="container-fluid">
          <h3 class="page-title">Pasien</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
							<div class="panel-heading">
									<h4 class="panel-title">Pasien Mahasiwa</h4>

							</div>
								<div class="row">
									<div class="col-md-2">
										<a href="tambah_pasien.php"><button type="button" class="btn btn-primary btn-sm" style="margin-left : 25px; margin-bottom: 10px;">Tambah</button></a>
									</div>
										<div class="col-md-6"></div>
											<div class="col-md-4">
												<form action="" method="POST">
													<div class="input-group" style="margin-right: 25px;">
														<input type="text" name="cari" class="form-control input-sm" placeholder="Cari berdasarkan nama...">
														<span class="input-group-btn"><button type="submit" name="btn-cari" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button></span>
													</div>
												</form>
											</div>
										</div>
										<div class="panel-body">
											<table class="table table-striped table-hover table-bordered">
												<thead>
													<tr>
														<th>No</th>
														<th>Nim</th>
														<th>Nama</th>
														<th>Jenis Kelamin</th>
														<th>Tanggal Lahir</th>
														<th>No Telepon</th>
														<th>Alamat</th>
													</tr>
												</thead>
												<tbody>
													<script type="text/javascript">
														function konfirm() {
															tanya = confirm("Anda yakin ?");
															if (tanya == true) return true;
															else return false;
														}
													</script>
													<script type="text/javascript">
														function konfirm() {
															tanya = confirm("Anda yakin ?");
															if (tanya == true) return true;
															else return false;
														}
													</script>
													<?php
													if (isset($_POST['btn_cari'])) {
														$query = "SELECT * FROM pasien_mahasiswa WHERE nama LIKE '%$_POST[cari]%' AND username != '$_SESSION[username]' ORDER BY nama ASC";
													}
													else{
														$query = "SELECT * FROM pasien_mahasiswa WHERE username != '$_SESSION[username]' ORDER BY id_mahasiswa ASC";
													}
													$jml = "SELECT COUNT(*) as jml_petugas FROM pasien_mahasiswa";
													$r = mysqli_query($con, $jml);
													$jml_petugas = mysqli_fetch_assoc($r);
													$result = mysqli_query($con, $query);
													$no = 1;
													foreach ($rsult as $val) {
														$title = $val['status'] == 'Aktif' ? 'Non Aktifkan' : 'Aktifkan';
														$btnclass = $val['status'] == 'Aktif' ? 'btn-success' : 'btn-danger';
														$label = $val['status'] == 'Aktif' ? 'label label-success' : 'label label-danger';
														echo "<tr>
																<td>$no</td>
																<td>$val[nama]</td>
																<td>$val[gender]</td>
																<td>$val[tgl_lahir]</td>
																<td>$val[no_hp]</td>
																<td>$val[alamat]</td>
																<td><span class='$label'>$val[status]</span></td>
																<td><a onclick = 'return konfirm()' href='status_petugas.php?id_petugas=$val[id_petugas]&status=$val[status]' class='btn $btnclass btn-xs' title='$title'><i class='fa fa-power-off'></i></a></td>
															  </tr>
																";
														$no++;
														}
													?>
												</tbody>
											</table>
											<span class="text-default">Jumlah data : <?php echo($jml_pasien['$jml_pasien']) ?></span>
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
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>

	</body>
</html>
