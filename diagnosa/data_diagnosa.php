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
	<title>Data Diagnosa | Sehatin</title>
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
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fas fa-file-medical-alt"></i>&ensp;Data Diagnosa</h3>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">

							<div class="panel">
								<br>
								<div class="row">
									<div class="col-md-2">
										<a href="tambah_diagnosa.php"><button type="button" class="btn btn-primary btn-sm" style="margin-left: 25px; margin-bottom: 10px;">Tambah</button></a>
									</div>
									 <div class="col-md-4"></div>
									<div class="col-md-6">
										<form action="" method="POST">
											<div class="input-group" style="margin-right: 25px;">
												<input type="text" name="cari" class="form-control input-sm" placeholder="Cari berdasarkan diagnosa ...">
												<span class="input-group-btn"><button type="submit" name="btn_cari" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button></span>
											</div>
										</form>
									</div>
								</div>

								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-striped table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Diagnosa</th>
													<th>Status</th>
													<th>Aksi</th>
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
												<?php
													if (isset($_POST['btn_cari'])) {
														$query = "SELECT * FROM diagnosa WHERE diagnosa LIKE '%$_POST[cari]%' ORDER BY diagnosa ASC";
														$no = 1;
													}
													else{
														$halaman = 10;
														$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
														$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
														$jml = mysqli_query($con, "SELECT COUNT(*) AS jml_diagnosa FROM diagnosa");
														$jml_diagnosa = mysqli_fetch_assoc($jml);
														$query = "SELECT * FROM diagnosa ORDER BY diagnosa ASC LIMIT $mulai, $halaman";
														$pages = ceil($jml_diagnosa['jml_diagnosa']/$halaman);
														$no = $mulai + 1;
													}
													$result = mysqli_query($con, $query);
													foreach ($result as $val) {
														$title = $val['status'] == 'Aktif' ? 'Non Aktifkan' : 'Aktifkan';
														$btnclass = $val['status'] == 'Aktif' ? 'btn-success' : 'btn-danger';
														$label = $val['status'] == 'Aktif' ? 'label label-success' : 'label label-danger';
														echo "<tr>
																<td>$no</td>
																<td>$val[diagnosa]</td>
																<td><span class='$label'>$val[status]</span></td>
																<td><a href='edit_diagnosa.php?id_diagnosa=$val[id_diagnosa]' class='btn btn-primary btn-xs' title='Edit'> <i class='fas fa-pen'></i></a> <a onclick = 'return konfirm()' href='status_diagnosa.php?id_diagnosa=$val[id_diagnosa]&status=$val[status]' class='btn $btnclass btn-xs' title='$title'><i class='fa fa-power-off'></i></a></td>
															  </tr>
														";
														$no++;
													}
														?>
											</tbody>
										</table>
									</div>
									<?php if (!isset($_POST['btn_cari'])): ?>
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
