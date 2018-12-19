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
	<title>Data Poli | Sehatin</title>
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
					<div class="row">

						<div class="col-md-4">

							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title"><i class="fa fa-hospital-o"></i>&ensp;Data Poli</h3>
								</div>
							</div>
						</div>
					</div>
		 			<div class="row">
		 				<div class="col-md-4">
		 					<div class="panel">
<br>
		 						<div class="panel-body">
		 							<table class="table table-striped table-hover">
		 								<thead>
		 									<tr>
		 										<th>No</th>
		 										<th>Nama Poli</th>
		 										<th>Aksi</th>
		 									</tr>
		 								</thead>
		 								<tbody>
		 									<?php
		 										$query = "SELECT * FROM poli ORDER BY poli ASC";
		 										$jml = "SELECT COUNT(*) as jml_poli FROM poli";
		 										$result = mysqli_query($con, $query);
		 										$r = mysqli_query($con, $jml);
		 										$jml_poli = mysqli_fetch_assoc($r);
		 										$no = 1;
		 										foreach ($result as $val) {
													$title = $val['status'] == 'Aktif' ? 'Non Aktifkan' : 'Aktifkan';
													$btnclass = $val['status'] == 'Aktif' ? 'btn-success' : 'btn-danger';
													$label = $val['status'] == 'Aktif' ? 'label label-success' : 'label label-danger';
		 											echo "<tr>
		 													<td>$no</td>
		 													<td>$val[poli]</td>
		 													<td><a href = 'edit_poli.php?id_poli=$val[id_poli]' class='btn btn-primary btn-xs' title='Edit'><i class='fa fa-pencil'></i> </a>&nbsp;

		 												  </tr>";
		 											$no++;
		 										}
		 									 ?>
		 								</tbody>
		 							</table>
		 							<span class="text-default">Jumlah data : <?php echo $jml_poli['jml_poli'] ?></span>
		 						</div>
		 					</div>
		 				</div>
		 				<!--<div class="col-md-6">
		 					<div class="panel-heading">
		 						<h4 class="panel-title">Poli</h4>
		 					</div>
		 					<div class="panel-body">
		 						<form action="" method="POST">
		 							<input type="text" name="">
		 						</form>
		 					</div>
		 				</div>-->
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
