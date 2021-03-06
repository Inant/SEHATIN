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
	<title>Data Dokter | Sehatin</title>
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
						<h1 class="panel-title"><i class="fa fa-user-md"></i>&ensp;Data Dokter</h1>
						 </div>
					 </div>
					 <div class="row">
						 <div class="col-md-12">
							 <div class="panel">
								 <div class="row">
								<div class="panel-body">
		 							<div class="row">
		 								<div class="col-md-2">
		 									<a href="tambah_dokter.php"><button type="button" class="btn btn-primary btn-sm" style="margin-left: 25px; margin-bottom: 10px;">Tambah</button></a>
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
		 								<table class="table table-striped table-hover">
		 									<thead>
		 										<tr>
		 											<th>No</th>
		 											<th>Nama Dokter</th>
		 											<th>Jenis Kelamin</th>
		 											<th>Alamat</th>
		 											<th>No Hp</th>
		 											<th>No Ijin Prakter</th>
													<th>Status</th>
													<th>Poli</th>
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
													$where = "WHERE nm_dokter LIKE '%$_POST[cari]%'";
												}
												else{
													$where = "";
												}
												$query = "SELECT d.*, l.status, p.poli FROM dokter d INNER JOIN login l ON l.id_user = d.id_dokter INNER JOIN poli p ON d.id_poli = p.id_poli $where ORDER BY nm_dokter ASC";
												$jml = "SELECT COUNT(*) AS jml_dokter FROM dokter";
												$r = mysqli_query($con, $jml);
												$jml_dokter = mysqli_fetch_assoc($r);
												$result = mysqli_query($con, $query);
												$no = 1;
												foreach ($result as $val) {
													$title = $val['status'] == 'Aktif' ? 'Non Aktifkan' : 'Aktifkan';
													$btnclass = $val['status'] == 'Aktif' ? 'btn-success' : 'btn-danger';
													$label = $val['status'] == 'Aktif' ? 'label label-success' : 'label label-danger';
													echo "<tr>
															<td>$no</td>
															<td>$val[nm_dokter]</td>
															<td>$val[gender]</td>
															<td>$val[alamat]</td>
															<td>$val[no_hp]</td>
															<td>$val[no_ijin_praktek]</td>
															<td><span class='$label'>$val[status]</span></td>
															<td>$val[poli]</td>
															<td><a href = 'edit_dokter.php?id_dokter=$val[id_dokter]' class='btn btn-primary btn-xs' title='Edit'><i class='fas fa-pen'></i> </a>

																<a onclick = 'return konfirm()' href='status_dokter.php?id_dokter=$val[id_dokter]&status=$val[status]' class= 'btn btn-xs $btnclass' title='$title'><i class='fa fa-power-off'></i></a></td>
														  </tr>";
														  $no++;
												}
											 ?>
		 									</tbody>
		 								</table>
		 								<span class="text-default">Jumlah data : <?php echo $jml_dokter['jml_dokter'] ?></span>
		 							</div>
		 						</div>
		 					</div>
		 				</div>
		 			</div>
		 		</div>
		 	</div>
		 </div>
		 <div class="clearfix">
			 <?php include '../dashboard/footer.php'; ?>
		 </div>
	</div>
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>
</body>
</html>
