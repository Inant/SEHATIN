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
	<title>Data Obat keluar | Sehatin</title>
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
         	<div class="col-md-8">	
              <div class="panel">
                <div class="panel-heading">
                	<div class="row">
                		<div class="col-md-4">
                			<h1 class="panel-title"><i class="fa fa-medkit"></i>&ensp;Data Obat Keluar</h1>
                		</div>
                		<?php if (isset($_GET['submit'])): ?>
                			<div class="col-md-1 col-md-offset-6">
                				<a href="export_obat_keluar.php?dari=<?php echo $_GET['dari']?>&sampai=<?php echo $_GET['sampai']?>" class="btn btn-success" title="Export ke excel"><i class="fa fa-file-excel-o"></i></a>
                			</div>
                		<?php endif ?>
                	</div>
                </div>
			  </div>
         	</div>
         <div class="container-fluid">

			<div class="row">
				<div class="col-md-8">
					<div class="panel">
					<br>
                <div class="panel-body">
					<form action="" method="GET">
						<div class="row">
							<div class="col-md-4">
								<label>Dari tanggal</label>
								<input type="date" name="dari" class="form-control" value="<?php echo(isset($_GET['dari']) ? $_GET['dari'] : "") ?>">
							</div>
							<div class="col-md-4">
								<label>Sampai tanggal</label>
								<input type="date" name="sampai" class="form-control" value="<?php echo(isset($_GET['sampai']) ? $_GET['sampai'] : "") ?>">
							</div>
							<div class="col-md-2">
								<br>
								<button type="submit" style="margin-top: 5px;" name="submit" value="submit" class="btn btn-success"><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter</button>
							</div>
						</div>
					</form>	
					<br>
                  <div class="table-responsive">
                    <table class="table table-striped table-hover">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Nama Obat</th>
                          <th>Kategori</th>
                          <th>Satuan</th>
                          <th>Jumlah Keluar</th>
						</tr>
                      </thead>
					<tbody>
						<?php
							if (isset($_GET['submit'])) {
								$dari = date("Y-m-d", strtotime($_GET['dari']));
								$sampai = date("Y-m-d", strtotime($_GET['sampai']));
								$q = "SELECT DISTINCT o.*, k.kategori, s.satuan, SUM(dt.jml) as jumlah, r.tanggal FROM obat o INNER JOIN kategori_obat k ON  o.id_kategori = k.id_kategori INNER JOIN satuan_obat s ON o.id_satuan = s.id_satuan INNER JOIN detail_resep dt ON dt.id_obat = o.id_obat INNER JOIN resep r ON r.id_resep = dt.id_resep WHERE r.tanggal BETWEEN '$dari 00:00:00' AND '$sampai 23:59:59' GROUP BY dt.id_obat ORDER BY jumlah DESC";
								$no = 1;
							}
							else{
								$halaman = 5;
								$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
								$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
								$q = "SELECT DISTINCT o.*, k.kategori, s.satuan, SUM(dt.jml) as jumlah FROM obat o INNER JOIN kategori_obat k ON  o.id_kategori = k.id_kategori INNER JOIN satuan_obat s ON o.id_satuan = s.id_satuan INNER JOIN detail_resep dt ON dt.id_obat = o.id_obat GROUP BY dt.id_obat ORDER BY jumlah DESC LIMIT $mulai, $halaman";
								$jml = "SELECT id_obat FROM detail_resep GROUP BY id_obat";
								$r = mysqli_query($con, $jml);
								$jml_obat = mysqli_num_rows($r);
								$pages = ceil($jml_obat/$halaman);
								$no = $mulai + 1;
							}
							$result = mysqli_query($con, $q);
							foreach ($result as $val) {
								$tgl_kadaluarsa = date("d-m-Y", strtotime($val['tgl_kadaluarsa']));
								echo "<tr>
										<td>$no</td>
										<td>$val[nm_obat]</td>
										<td>$val[kategori]</td>
										<td>$val[satuan]</td>
										<td>$val[jumlah]</td>
									</tr>";
									$no++;
							}
						?>
						</tbody>
                    </table>
                  </div>
                  <?php if (!isset($_GET['submit'])): ?>
                  	
						<div class="col-md-2 col-md-offset-10">
							<ul class="pagination">
								<?php for ($i=1; $i <= $pages; $i++) { ?>
									<li><a href="?halaman=<?php echo $i; ?> " class="<?php echo $i==$_GET['halaman'] ? 'active' : '' ?>"> <?php echo $i; ?></a></li>
									<?php
								} ?>
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
