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
<title>Kunjungan Perbulan | Sehatin</title>
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
  $bulan = date("F");
  ?>
  <div class="main">
    <div class="main-content">
      <div class="container-fluid">
        <div class="panel">
          <div class="panel-heading">
           <div class="row">
             <div class="col-md-4">
              <h1 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&ensp;Kunjungan Bulan <?php echo $bulan ?></h1>
             </div>
             <div class="col-md-1 col-md-offset-7">
                <a href="export_per_bulan.php" class="btn btn-success" title="Export ke excel"><i class="fa fa-file-excel-o"></i></a>
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
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Poli</th>
                            <th>Status</th>
                            <th>Keluhan</th>
                            <th>Diagnosa</th>
                            <th>Dokter</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          date_default_timezone_set("Asia/Jakarta");
                          $now = date('d-m-Y');
                          $now = explode("-", $now);
                          $now = $now[1];
                          if (isset($_POST['btn_cari'])) {
                            //$query = "SELECT * FROM pasien WHERE nama LIKE '%$_POST[cari]%' ORDER BY nama ASC";
                          }
                          else{
                            $halaman = 10;
                            $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                            $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
                            $query = "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, dg.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter INNER JOIN diagnosa dg ON dg.id_diagnosa = pm.id_diagnosa WHERE month(waktu) = '$now' ORDER BY a.waktu ASC LIMIT $mulai, $halaman";
                            $ttl = mysqli_query($con, "SELECT COUNT(*) AS jml_pasien FROM antrian WHERE month(waktu) = '$now'");
                          }
                          $result = mysqli_query($con, $query);
                          $jml = mysqli_num_rows($result);
                          $jml_pasien = mysqli_fetch_assoc($ttl);
                          $pages = ceil($jml_pasien['jml_pasien'] / $halaman);
                          $no = $mulai + 1;
                          foreach ($result as $val) {
                            $today = new DateTime();
                            $tgl_lahir = new DateTime($val['tgl_lahir']);
                            $usia = $today->diff($tgl_lahir)->y;
                            $t = explode(" ", $val['waktu']);
                            $time = date("d-m-Y", strtotime($t[0]));
                            echo "<tr>
                            <td>$no</td>
                            <td>$val[nama]</td>
                            <td>$usia</td>
                            <td>$val[gender]</td>
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
                    <?php if (!isset($_POST['btn_cari'])): ?>
                      <div class="col-md-2 col-md-offset-10">
                        <ul class="pagination">
                          <?php for ($i=1; $i <= $pages ; $i++) { ?>
                            <li> <a href="?halaman=<?php echo $i ?>" class="<?php echo $i==$_GET['halaman'] ? 'active' : '' ?>"> <?php echo $i ?> </a> </li>
                          <?php } ?>
                        </ul>
                      </div>
                    <?php endif; ?>
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
