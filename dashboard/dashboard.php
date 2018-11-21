<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
	echo "<script>
		alert('Anda harus login dahulu !');
		window.location.href='../login.php';
	</script>";
}
else {
	include '../koneksi.php';

	function hitungJml($tb, $where)
	{
		include '../koneksi.php';
		$query = mysqli_query($con, "SELECT COUNT(*) as jml FROM $tb $where");
		$val = mysqli_fetch_array($query);
		return $val['jml'];
	}
	date_default_timezone_set("Asia/Jakarta");
	$now = date('Y-m-d');

	$qphi = mysqli_query($con, "SELECT id_antrian FROM antrian WHERE waktu BETWEEN '$now 00:00:00' AND '$now 23:59:59'");
	$jphi = mysqli_num_rows($qphi);

	if ($_SESSION['level'] == "Dokter") {
		$qnama = "SELECT nm_dokter as nama FROM dokter WHERE dokter.id_dokter = '$_SESSION[id_user]'";
	}
	else {
		$qnama = "SELECT nama_petugas as nama FROM petugas WHERE id_petugas = '$_SESSION[id_user]'";
	}
	$rnama = mysqli_query($con, $qnama);
	$valnama = mysqli_fetch_assoc($rnama);
}
 ?>

<!doctype html>
<html lang="en">
<head>
	<title>Selamat Datang | Sehatin</title>
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
			include 'navbar.php';
			include 'left_sidebar.php';
			include 'content_dashboard.php';
		 ?>

		<div class="clearfix"></div>
		<?php include 'footer.php'; ?>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>

</body>

</html>
