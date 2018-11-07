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
	<title>Kategori Obat | Sehatin</title>
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
		 	tanya = confirm("Anda yakin ingin menghapus ?");
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
          <h3 class="page-title">Obat</h3>
          <div class="row">
            <div class="col-md-6">
              <div class="panel">
                <div class="panel-heading">
                  <h4 class="panel-title">Data Obat</h4>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <a href="tambah_obat.php"> <button type="button" class="btn btn-primary btn-sm" style="margin-left:25px; margin-bottom:10px;">Tambah</button> </a>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover table-bordered">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Obat</th>
                          <th>Kategori</th>
                          <th>Satuan</th>
                          <th>Harga Beli</th>
                          <th>Harga Jual</th>
                          <th>Stok</th>
                          <th>Tgl Kadaluarsa</th>
													<th>Aksi</th>
                        </tr>
                      </thead>
											<tbody>
												<?php
													$q = "SELECT DISTINCT obat.*, kategori, satuan FROM obat INNER JOIN kategori_obat k ON  obat.id_kategori = k.id_kategori INNER JOIN satuan s ON obat.id_satuan = s.id_satuan ORDER BY nm_obat ASC";
													$jml = "SELECT COUNT(*) AS jml_obat FROM obat";
													$result = mysqli_query($con, $q);
													$r = mysqli_query($con, $jml);
													$jml_obat = mysqli_fetch_assoc($r);
													$no = 1;
													foreach ($result as $val) {
														echo "<tr>
																		<td>$no</td>
																		<td>$val[nm_obat]</td>
																		<td>$val[kategori]</td>
																		<td>$val[satuan]</td>
																		<td>$val[harga_beli]</td>
																		<td>$val[harga_jual]</td>
																		<td>$val[stok]</td>
																		<td>$val[tgl_kadaluarsa]</td>
																		<td> <a href='edit_obat.php?id_obat=$val[id_obat]' class='btn btn-primary btn-xs' title='Edit'> <i class='fa fa-pencil'></i> </a> &nbsp;

																		</td>
																	</tr>";
																	$no++;

													}
												//tambahan
												//tambahan2
												 ?>
											</tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
         </div>
       </div>
     </div>
