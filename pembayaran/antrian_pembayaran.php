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
<title>Antrian Pembayaran | Sehatin</title>
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
  if (isset($_POST['btn_cari'])) {
    //$query = "SELECT * FROM pasien WHERE nama LIKE '%$_POST[cari]%' ORDER BY nama ASC";
  }
  else{
    $query = "SELECT DISTINCT p.*, a.id_antrian, pm.id_pemeriksaan, a.status, a.waktu, a.keluhan FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian WHERE a.status = 'Proses Pembayaran' ORDER BY a.waktu ASC";
                            
  }
  $result = mysqli_query($con, $query);
  $jml = mysqli_num_rows($result);
  ?>
  <div class="main">
    <div class="main-content">
      <div class="container-fluid">
        <div class="panel">
          <div class="panel-heading">
            <h1 class="panel-title"><i class="fa fa-money"></i>&ensp;Antrian Pembayaran</h1>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel">
              <br>
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <?php if ($jml > 0): ?>
                          <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Kategori</th>
                            <th>Waktu</th>
                            <th>Status</th>
                            <th>Keluhan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <?php else: ?>
                          <i><h5>Tidak ada antrian</h5></i>
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
                            <td>$val[no_hp]</td>
                            <td>$val[alamat]</td>
                            <td>$val[kategori]</td>
                            <td>$time</td>
                            <td><span class='label label-success'>$val[status]</span></td>
                            <td>$val[keluhan]</td>
                            <td> <a href='form_pembayaran.php?id_pasien=$val[id_pasien]&id_antrian=$val[id_antrian]&id_pemeriksaan=$val[id_pemeriksaan]' class='btn btn-primary btn-xs' ><i class='fa fa-money'></i> </a> </td>
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
