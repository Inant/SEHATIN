<?php
session_start();
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
<title>Pembayaran Perhari | Sehatin</title>
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
    $query = "SELECT p.nama, p.kategori, pb.grand_total,pb.waktu, pb.total_bayar, pb.kembalian FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN pembayaran pb ON a.id_antrian = pb.id_antrian WHERE pb.waktu BETWEEN '$now 00:00:00' AND '$now 23:59:59' AND a.status = 'Selesai' ORDER BY pb.waktu ASC ";
    $qpendapatan = mysqli_query($con, "SELECT SUM(grand_total) as pendapatan FROM pembayaran INNER JOIN antrian a ON a.id_antrian = pembayaran.id_antrian WHERE pembayaran.waktu BETWEEN '$now 00:00:00' AND '$now 23:59:59' AND a.status = 'Selesai' ");
    $pendapatan = mysqli_fetch_assoc($qpendapatan);
    $pendapatan = $pendapatan['pendapatan'];
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
                <h1 class="panel-title"><i class="fas fa-file-alt"></i>&ensp;Data Pembayaran Tanggal <?php echo $tgl ?></h1>
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
                      <table class="table table-striped table-hover">
                        <?php if ($jml > 0): ?>
                          <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Waktu</th>
                            <th>Grand Total</th>
                            <th>Total Bayar</th>
                            <th>Kembalian</th>
                          </tr>
                        </thead>
                        <?php else: ?>
                          <h4><i>Belum ada pembayaran</i></h4>
                        <?php endif ?>
                        <tbody>
                          <?php
                          $no = 1;
                          foreach ($result as $val) {
                            $waktu = explode(" ", $val['waktu']);
                            $waktu = $waktu[1];
                            $waktu = date("H:i", strtotime($waktu));
                            echo "<tr>
                            <td>$no</td>
                            <td>$val[nama]</td>
                            <td>$val[kategori]</td>
                            <td>$waktu</td>
                            <td>$val[grand_total]</td>
                            <td>$val[total_bayar]</td>
                            <td>$val[kembalian]</td>
                            </tr>
                            ";
                            $no++;
                          }
                          ?>
                        </tbody>
                        <?php if ($jml > 0): ?>
                          <tfoot>
                            <tr>
                              <th colspan="4" style="text-align: center;">Pendapatan</th><th colspan="3" style="text-align: left;"><?php echo $pendapatan ?></th>
                            </tr>
                          </tfoot>
                        <?php endif ?>
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
