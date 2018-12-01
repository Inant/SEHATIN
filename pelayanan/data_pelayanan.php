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
	<title>Data Pelayanan | Sehatin</title>
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
					<div class="panel">
						<div class="panel-heading">
							<h3 class="panel-title"><i class="fa fa-stethoscope"></i>&ensp;Data Pelayanan</h3>
							<div class="col-md-2 col-md-offset-10">

							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="panel">
								<br>
								<div class="row">
									<div class="col-md-2">
										<?php if ($_SESSION['level'] == "Admin"): ?>
											<a href="tambah_pelayanan.php"><button type="button" class="btn btn-primary btn-sm" style="margin-left: 25px; margin-bottom: 10px;">Tambah</button></a>
										<?php endif; ?>
									</div>
									 <div class="col-md-6"></div>
									<div class="col-md-4">
										<form action="" method="POST">
											<div class="input-group" style="margin-right: 25px;">
												<input type="text" name="cari" class="form-control input-sm" placeholder="Cari berdasarkan nama ...">
												<span class="input-group-btn"><button type="submit" name="btn_cari" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button></span>
											</div>
										</form>
									</div>
								</div>

								<div class="panel-body">
									<table class="table table-striped table-hover table-bordered">
										<thead>
											<tr>
												<th rowspan="2" >No</th>
												<th rowspan="2" style="text-align:center;">Pelayanan</th>
												<th colspan="4" style="text-align:center;">Harga</th>
                        <th rowspan="2">Status</th>
												<?php if ($_SESSION['level'] == "Admin"): ?>
													<th rowspan="2">Aksi</th>
												<?php endif; ?>
                          <tr>
                          <th>Umum</th>
                          <th>Karyawan</th>
                          <th>Keluarga Karyawan</th>
                          <th>Mahasiswa</th>
                        </tr>
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
													//$query = "SELECT * FROM petugas WHERE nama_petugas LIKE '%$_POST[cari]%' AND username != '$_SESSION[username]' ORDER BY nama_petugas ASC";
												}
												else{
													$query = "SELECT * FROM pelayanan ORDER BY pelayanan ASC";
												}
												$result = mysqli_query($con, $query);
												$jml_petugas = mysqli_num_rows($result);
												$no = 1;
												foreach ($result as $val) {
													$title = $val['status'] == 'Aktif' ? 'Non Aktifkan' : 'Aktifkan';
													$btnclass = $val['status'] == 'Aktif' ? 'btn-success' : 'btn-danger';
													$label = $val['status'] == 'Aktif' ? 'label label-success' : 'label label-danger';
													$edit = "";
													if ($_SESSION['level'] == "Admin") {
														$edit = "<td><a href='edit_pelayanan.php?id_pelayanan=$val[id_pelayanan]' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i></a> <a onclick = 'return konfirm()' href='status_pelayanan.php?id_pelayanan=$val[id_pelayanan]&status=$val[status]' class='btn $btnclass btn-xs' title='$title'><i class='fa fa-power-off'></i></a></td>";
													}

													echo "<tr>
															<td>$no</td>
															<td>$val[pelayanan]</td>
															<td>$val[harga_umum]</td>
															<td>$val[harga_karyawan]</td>
															<td>$val[harga_kel_karyawan]</td>
															<td>$val[harga_mahasiswa]</td>
															<td><span class='$label'>$val[status]</span></td>
															$edit
														  </tr>
													";
													$no++;
												}
													?>
										</tbody>
									</table>
									<span class="text-default">Jumlah data : <?php echo($jml_petugas) ?></span>
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
