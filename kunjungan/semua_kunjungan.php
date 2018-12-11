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
<title>Data Kunjungan | Sehatin</title>
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
        <div class="panel">
          <div class="panel-heading">
           <div class="row">
             <div class="col-md-4">
              <h1 class="panel-title"><i class="glyphicon glyphicon-list-alt"></i>&ensp;Data Kunjungan</h1>
             </div>
             <div class="col-md-1 col-md-offset-7">
                <?php if (isset($_GET['submit'])): ?>
                  <a href="export_all.php?dari=<?php echo $_GET['dari']?>&sampai=<?php echo $_GET['sampai']?>&poli=<?php echo $_GET['poli']?>" class="btn btn-success" title="Export ke excel"><i class="fa fa-file-excel-o"></i></a>
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
                    <form action="" method="GET">
                      <div class="row">
                        <div class="col-md-3">
                          <label for="">Dari tanggal</label>
                          <input type="date" name="dari" class="form-control" value="<?php echo(isset($_GET['dari']) ? $_GET['dari'] : "" ) ?>">
                        </div>
                        <div class="col-md-3">
                          <label for="">Sampai tanggal</label>
                          <input type="date" name="sampai" class="form-control" value="<?php echo(isset($_GET['sampai']) ? $_GET['sampai'] : "" ) ?>">
                        </div>
                        <div class="col-md-2">
                          <label for="">Poli</label>
                          <select name="poli" class="form-control">
                            <option value="">-- Pilih Poli --</option>
                            <?php 
                              $qpoli = mysqli_query($con, "SELECT * FROM poli WHERE status = 'Aktif' ORDER BY poli ASC");
                              while ($valpoli = mysqli_fetch_assoc($qpoli)) {
                            ?>
                                <option value="<?php echo $valpoli['id_poli'] ?>" <?php echo !empty($_GET['poli']) && $_GET['poli'] == $valpoli['id_poli'] ? 'selected' : '' ?>><?php echo $valpoli['poli'] ?></option>
                            <?php
                              }
                             ?>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <br>
                          <button style="margin-top: 5px;" type="submit" name="submit" value="submit" class="btn btn-success"><i class="glyphicon glyphicon-filter"></i>&nbsp;Filter</button>
                        </div>
                      </div>
                    </form>
                    <br>
                    <div class="table-responsive">
                      <table class="table table-striped table-hover table-bordered">
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
                          $where = "";
                          $no = 1;
                          if (isset($_GET['submit'])) {
                            if (!empty($_GET['dari']) && !empty($_GET['sampai']) && !empty($_GET['poli'])) {
                               $query = "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, pm.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter WHERE a.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' AND a.id_poli = '$_GET[poli]' ORDER BY a.waktu ASC";
                            }
                            elseif (!empty($_GET['dari']) && !empty($_GET['sampai']) && empty($_GET['poli'])) {
                              $query = "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, pm.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter WHERE a.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' ORDER BY a.waktu ASC";
                            }
                            elseif( empty($_GET['dari']) && empty($_GET['sampai']) && !empty($_GET['poli'])) {
                              $query = "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, pm.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter WHERE a.id_poli = '$_GET[poli]' ORDER BY a.waktu ASC";
                            }
                            
                          }
                          else{
                            $halaman = 10;
                            $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                            $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
                            $query = "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, pm.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter ORDER BY a.waktu ASC LIMIT $mulai, $halaman";
                            $ttl = mysqli_query($con, "SELECT COUNT(*) AS jml_pasien FROM antrian");
                            $jml_pasien = mysqli_fetch_assoc($ttl);
                            $pages = ceil($jml_pasien['jml_pasien'] / $halaman);
                            $no = $mulai + 1;
                          }
                          $result = mysqli_query($con, $query);
                          $jml = mysqli_num_rows($result);
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
                    <div class="rows">
                    <div class="col-md-2">
                      <span>Jumlah data : <?php echo $jml ?></span>
                    </div>  
                    <?php if (!isset($_GET['submit'])): ?>
                      <div class="col-md-2 col-md-offset-8">
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
