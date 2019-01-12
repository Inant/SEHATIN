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
	<title>List Obat | Sehatin</title>
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
              <div class="panel">
                <div class="panel-heading">
                	<h1 class="panel-title"><i class="fa fa-medkit"></i>&ensp;List Obat</h1>
                </div>
							</div>

						<div class="row">
							<div class="col-md-12">
								<div class="panel">
									<br>
                <div class="row">
                  <div class="col-md-12">
										<?php if ($_SESSION['level'] == "Apoteker"): ?>
											<a href="tambah_obat.php"> <button type="button" class="btn btn-primary btn-sm" style="margin-left:25px; margin-bottom:10px;">Tambah</button> </a>
										<?php endif; ?>
                  </div>
                </div>
                <div class="panel-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-hover ">
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
													<?php if ($_SESSION['level'] == "Apoteker"): ?>
														<th>Aksi</th>
													<?php endif; ?>
                        </tr>
                      </thead>
					<tbody>
						<?php
							$halaman = 10;
							$page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
							$mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
							$q = "SELECT DISTINCT obat.*, kategori, satuan FROM obat INNER JOIN kategori_obat k ON  obat.id_kategori = k.id_kategori INNER JOIN satuan_obat s ON obat.id_satuan = s.id_satuan ORDER BY obat.nm_obat ASC LIMIT $mulai, $halaman";
							$jml = "SELECT COUNT(*) AS jml_obat FROM obat";
							$r = mysqli_query($con, $jml);
							$result = mysqli_query($con, $q);
							$jml_obat = mysqli_fetch_assoc($r);
							$pages = ceil($jml_obat['jml_obat']/$halaman);
							$no = $mulai + 1;
							$aksi = "";
							foreach ($result as $val) {
								if ($_SESSION['level'] == "Apoteker") {
									$aksi = "<td> <a href='edit_obat.php?id_obat=$val[id_obat]' class='btn btn-primary btn-xs' title='Edit'> <i class='fas fa-pen'></i> </a></td>";
								}
								$tgl_kadaluarsa = date("d-m-Y", strtotime($val['tgl_kadaluarsa']));
								echo "<tr>
										<td>$no</td>
										<td>$val[nm_obat]</td>
										<td>$val[kategori]</td>
										<td>$val[satuan]</td>
										<td>$val[harga_beli]</td>
										<td>$val[harga_jual]</td>
										<td>$val[stok]</td>
										<td>$tgl_kadaluarsa</td>
										$aksi
									</tr>";
									$no++;
							}
						?>
						</tbody>
                    </table>
                  </div>
									<div class="col-md-2 col-md-offset-10">
										<ul class="pagination">
											<?php for ($i=1; $i <= $pages; $i++) { ?>
												<li><a href="?halaman=<?php echo $i; ?> " class="<?php echo $i==$_GET['halaman'] ? 'active' : '' ?>"> <?php echo $i; ?></a></li>
												<?php
											} ?>
										</ul>
									</div>
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
