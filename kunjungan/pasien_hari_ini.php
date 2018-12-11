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
<title>Kunjungan Perhari | Sehatin</title>
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

  date_default_timezone_set("Asia/Jakarta");
  $now = date('Y-m-d');
  $tgl = date('d-m-Y');
  if (isset($_POST['btn_cari'])) {
    //$query = "SELECT * FROM pasien WHERE nama LIKE '%$_POST[cari]%' ORDER BY nama ASC";
  }
  else{
    $query = "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, pm.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter WHERE waktu BETWEEN '$now 00:00:00' AND '$now 23:59:59' ORDER BY a.waktu ASC";
  }
  $result = mysqli_query($con, $query);
  $jml = mysqli_num_rows($result);
  ?>
  <div class="main">
    <div class="main-content">
      <div class="container-fluid">
        <div class="panel">
          <div class="panel-heading">
            <div class="row">
              <div class="col-md-4">
                <h1 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&ensp;Data Kunjungan Tanggal <?php echo $tgl ?></h1>
              </div>
              <div class="col-md-1 col-md-offset-7">
                <?php if ($jml > 0): ?>
                  <a href="export_per_hari.php" class="btn btn-success" title="Export ke excel"><i class="fa fa-file-excel-o"></i></a>
                <?php endif ?>
              </div>  
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel">
              <br>
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-bordered">
                        <?php if ($jml > 0): ?>
                          <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>Alamat</th>
                            <th>Kategori</th>
                            <th>Waktu</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Dokter</th>
                          </tr>
                        </thead>
                        <?php else: ?>
                          
                        <?php endif ?>
                        <tbody>
                          <?php
                          $no = 1;
                          foreach ($result as $val) {
                            $today = new DateTime();
                            $tgl_lahir = new DateTime($val['tgl_lahir']);
                            $usia = $today->diff($tgl_lahir)->y;
                            $t = explode(" ", $val['waktu']);
                            $time = $t[1];
                            echo "<tr>
                            <td>$no</td>
                            <td>$val[nama]</td>
                            <td>$usia</td>
                            <td>$val[gender]</td>
                            <td>$val[alamat]</td>
                            <td>$val[kategori]</td>
                            <td>$time</td>
                            <td>$val[poli]</td>
                            <td><span class='label label-success'>$val[status]</span></td>
                            <td>$val[keluhan]</td>
                            <td>$val[diagnosa]</td>
                            <td>$val[nm_dokter]</td>
                            </tr>
                            ";
                            $no++;
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <span class="text-default">Jumlah data : <?php echo($jml) ?></span>
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
