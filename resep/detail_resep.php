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
<title>Detail Resep | Sehatin</title>
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
        <div class="row">
          <div class="col-md-6">
            <div class="panel">
              <div class="panel-heading">
                <h1 class="panel-title"><i class="material-icons" style="font-size:21px">receipt</i>&ensp;Detail Resep</h1>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="panel">
              <br>
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama Obat</th>
                            <th>Dosis</th>
                            <th>Jumlah</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          date_default_timezone_set("Asia/Jakarta");
                          $now = date('Y-m-d');
                          if (isset($_POST['btn_cari'])) {
                            //$query = "SELECT * FROM pasien WHERE nama LIKE '%$_POST[cari]%' ORDER BY nama ASC";
                          }
                          else{
                            $query = "SELECT r.*, dt.*, o.nm_obat, s.satuan FROM resep r INNER JOIN detail_resep dt ON dt.id_resep = r.id_resep INNER JOIN pemeriksaan p ON p.id_pemeriksaan = r.id_pemeriksaan INNER JOIN obat o ON dt.id_obat = o.id_obat INNER JOIN satuan_obat s ON o.id_satuan = s.id_satuan WHERE r.id_pemeriksaan = '$_GET[id_pemeriksaan]' ORDER BY o.nm_obat ASC";
                          }
                          $result = mysqli_query($con, $query);
                          $jml = mysqli_num_rows($result);
                          $no = 1;
                          foreach ($result as $val) {

                            echo "<tr>
                            <td>$no</td>
                            <td>$val[nm_obat]</td>
                            <td>$val[dosis1] X $val[dosis2]</td>
                            <td>$val[jml] $val[satuan]</td>
                            
                            </tr>
                            ";
                            $no++;
                          }
                          ?>
                        </tbody>
                      </table>
                      <a href="resep_selesai.php?id_antrian=<?php echo $_GET['id_antrian'] ?>" class="btn btn-primary"><i class="fa fa-check"> </i> Selesai</a>
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
<!-- END WRAPPER -->
<!-- Javascript -->
<script src="../assets/vendor/jquery/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="../assets/scripts/klorofil-common.js"></script>

</body>
</html>
