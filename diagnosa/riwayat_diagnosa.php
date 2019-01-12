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
	<title>Riwayat Diagnosa | Sehatin</title>
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
		 ?>
		<div class="main">
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-6">
							<div class="panel">
								<div class="row">
										<div class="col-md-6">
											<div class="panel-heading">
												<h3 class="panel-title"><i class="fas fa-file-medical-alt"></i>&ensp;Riwayat Diagnosa</h3>
											</div>
										</div>
										<div class="col-md-2 col-md-offset-3">
											<?php if (!empty($_GET['dari']) && !empty($_GET['sampai'])): ?>
												<a href="export_diagnosa.php?dari=<?php echo $_GET['dari'] ?>&sampai=<?php echo $_GET['sampai'] ?>" class="btn btn-success" title="Export excel" style="margin-top: 15px;"><i class="fa fa-file-excel-o"></i></a>
											<?php else: ?>
												<a href="export_diagnosa.php" class="btn btn-success" title="Export excel" style="margin-top: 15px;"><i class="fa fa-file-excel-o"></i></a>
											<?php endif ?>
										</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">

							<div class="panel">
								<br>
								<div class="row">
									<form method="GET" action="">
										<div class="col-md-4">
											<label>Dari tanggal</label>
											<input type="date" name="dari" class="form-control" value="<?php echo !empty($_GET['dari']) ? $_GET['dari'] : '' ?>">
										</div>
										<div class="col-md-4">
											<label>Sampai tanggal</label>
											<input type="date" name="sampai" class="form-control" value="<?php echo !empty($_GET['sampai']) ? $_GET['sampai'] : '' ?>">
										</div>
										<div class="col-md-4">
											<button type="submit" name="filter" class="btn btn-success" style="margin-top: 25px;"><i class="fa fa-filter"></i>&nbsp;Filter</button>
										</div>
									</form>
								</div>

								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Diagnosa</th>
													<th>Jumlah</th>
												</tr>
											</thead>
											<tbody>
												<?php
													if (isset($_GET['filter'])) { 
														$no = 1;
														$query = "SELECT dg.*, COUNT(pm.id_diagnosa) as jumlah FROM diagnosa dg INNER JOIN pemeriksaan pm ON pm.id_diagnosa = dg.id_diagnosa INNER JOIN antrian a ON a.id_antrian = pm.id_antrian WHERE a.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' GROUP BY pm.id_diagnosa ORDER BY jumlah DESC";
													}
													else{
														$halaman = 10;
														$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
														$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
														$jml = mysqli_query($con, "SELECT COUNT(pm.id_diagnosa) AS jml_diagnosa FROM diagnosa dg INNER JOIN pemeriksaan pm ON pm.id_diagnosa = dg.id_diagnosa");
														$jml_diagnosa = mysqli_fetch_assoc($jml);
														$query = "SELECT dg.*, COUNT(pm.id_diagnosa) as jumlah FROM diagnosa dg INNER JOIN pemeriksaan pm ON pm.id_diagnosa = dg.id_diagnosa GROUP BY pm.id_diagnosa ORDER BY jumlah DESC LIMIT $mulai, $halaman";
														$pages = ceil($jml_diagnosa['jml_diagnosa']/$halaman);
														$no = $mulai + 1;
													}
													$result = mysqli_query($con, $query);
													foreach ($result as $val) {
														echo "<tr>
																<td>$no</td>
																<td>$val[diagnosa]</td>
																<td>$val[jumlah]</td>
															  </tr>
														";
														$no++;
													}
														?>
											</tbody>
										</table>
									</div>
									<?php if (!isset($_GET['filter'])): ?>
										<div class="col-md-4 col-md-offset-8">
											<ul class="pagination">
												<?php for ($i=1; $i <= $pages ; $i++) { ?> 
													<li><a href="?halaman=<?php echo $i ?>" class="<?php echo $i==$_GET['halaman'] ? 'active' : '' ?>" ><?php echo $i; ?></a></li>
												<?php } ?>
											</ul>
										</div>
									<?php endif ?>
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
