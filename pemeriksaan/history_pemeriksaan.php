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
	<title>History Pemeriksaan | Sehatin</title>
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
      $qpasien = mysqli_query($con, "SELECT * FROM pasien WHERE id_pasien = '$_GET[p]'");
      $valpasien = mysqli_fetch_assoc($qpasien);
      $tgl_lahir = date("d-m-Y", strtotime($valpasien['tgl_lahir']));
      $qhistory = mysqli_query($con, "SELECT DISTINCT * FROM antrian WHERE id_pasien = '$_GET[p]' ORDER BY waktu DESC");
      $qpemeriksaan = mysqli_query($con, "SELECT DISTINCT a.*, pm.*, t.*, p.pelayanan, d.nm_dokter FROM antrian a INNER JOIN pemeriksaan pm ON a.id_antrian = pm.id_antrian INNER JOIN tindakan t ON t.id_pemeriksaan = pm.id_pemeriksaan INNER JOIN pelayanan p ON p.id_pelayanan = t.id_pelayanan INNER JOIN dokter d ON pm.id_dokter = d.id_dokter WHERE a.id_pasien = '$_GET[p]' AND t.id_pelayanan != 1 ORDER BY a.id_antrian DESC");
		 ?>
		 <div class="main">
		 	<div class="main-content">
		 		<div class="container-fluid">
          <div class="panel">
						<div class="panel-heading">
              <div class="row">
                <div class="col-md-4">
                  <h3 class="panel-title"><i class="lnr lnr-calendar-full"></i>&ensp;History Pemeriksaan</h3>
                </div>
                <div class="col-md-2 col-md-offset-6">
                  <a href="#" onclick="history.go(-1)" class="btn btn-danger">Kembali</a>
                </div>
              </div>
						</div>
					</div>
		 			<div class="panel panel-profile">
            <div class="clearfix">
              <div class="profile-left">
                <div class="profile-header">
                  <div class="overlay"></div>
                  <div class="profile-stat">
                    <div class="row">
                      <div class="col-md-12 stat-item">
                        <?php echo mysqli_num_rows($qhistory) ?> <span>Kunjungan</span>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="profile-detail">
                  <div class="profile-info">
                    <h4 class="heading">Data Pasien</h4>
                    <ul class="list-unstyled list-justify">
                      <li>Nama <span><?php echo $valpasien['nama'] ?></span></li>
                      <li>Tempat, Tanggal Lahir <span><?php echo "$valpasien[tmpt_lahir], $tgl_lahir"  ?></span></li>
                      <li>Gender <span><?php echo $valpasien['gender'] ?></span></li>
                      <li>Alamat <span><?php echo $valpasien['alamat'] ?></span></li>
                      <li>No Hp <span><?php echo $valpasien['no_hp'] ?></span></li>
                      <li>Pendidikan <span><?php echo $valpasien['pendidikan'] ?></span></li>
                      <li>Status Perkawinan <span><?php echo $valpasien['status_perkawinan'] ?></span></li>
                      <li>Kategori <span><?php echo $valpasien['kategori'] ?></span></li>
                    </ul>
                  </div>
                </div>
              </div>

              <div class="profile-right">
                <h4 class="heading">History Kunjungan</h4>
                <div class="custom-tabs-line tabs-line-bottom left-aligned">
                  <ul class="nav" role="tablist">
                    <li class="active"> <a href="#" role="tab" data-toggle="tab">History</a> </li>
                  </ul>
                </div>
                <div class="tab-content">
                  <div class="tab-pane fade in active" id="tab-bottom-left1">
                    <ul class="list-unstyled activity-timeline">
                      <?php
                        while ($valhistory = mysqli_fetch_assoc($qhistory)) {
                          $tgl = explode(" ", $valhistory['waktu']);
                          $tgl_periksa = $tgl[0];
                          $waktu_periksa = $tgl[1];
                          $tgl_periksa = date("d-m-Y", strtotime($tgl_periksa));
                      ?>
                          <li>
                            <i class="fa fa-medkit activity-icon"></i>
                            <p><?php echo $valhistory['keluhan'] ?> <span class="timestamp"><?php echo $tgl_periksa . " " . $waktu_periksa ?> </span> </p>
                          </li>
                      <?php
                        }
                      ?>

                    </ul>
                  </div>
									<br><br>
                </div>
              </div>

            </div>
          </div>
					<div class="panel">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-2"><h4 class="panel-title">Pemeriksaan</h4></div>
								<?php if (mysqli_num_rows($qpemeriksaan) > 0): ?>
									<div class="col-md-2 col-md-offset-8"><a href="export.php?id_pasien=<?php echo $_GET['p']?>" class="btn btn-success btn-md" title="Export ke Excel"><i class="fa fa-file-excel-o"></i></a></div>
								<?php endif ?>
							</div>
						</div>
					</div>
          <?php
            while ($pemeriksaan = mysqli_fetch_assoc($qpemeriksaan)) {
							$tgl_pemeriksaan = explode(" ", $pemeriksaan['waktu']);
							$tgl_pemeriksaan = date("d-m-Y", strtotime($tgl_pemeriksaan[0]));
          ?>
						<div class="col-md-6">
							<div class="panel">
								<table class="table">
									<tr>
										<td>Tanggal</td>
										<td><?php echo $tgl_pemeriksaan ?></td>
									</tr>
								  <tr>
								  	<td>Keluhan</td>
								  	<td><?php echo $pemeriksaan['keluhan'] ?></td>
								  </tr>
									<tr>
										<td>Dokter</td>
										<td><?php echo $pemeriksaan['nm_dokter'] ?></td>
									</tr>
									<tr>
										<td>Pemeriksaan Fisik</td>
										<td><?php echo $pemeriksaan['pemeriksaan_fisik'] ?></td>
									</tr>
									<tr>
										<td>Tekanan Darah</td>
										<td><?php echo $pemeriksaan['tensi'] ?></td>
									</tr>
									<tr>
										<td>Suhu Badan</td>
										<td><?php echo $pemeriksaan['suhu'] ?></td>
									</tr>
									<tr>
										<td>Diagnosa</td>
										<td><?php echo $pemeriksaan['diagnosa'] ?></td>
									</tr>
									<tr>
										<td>Tindakan</td>
										<td><?php echo $pemeriksaan['pelayanan'] ?></td>
									</tr>
								</table>
							</div>
						</div>
          <?php
            }
          ?>
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
