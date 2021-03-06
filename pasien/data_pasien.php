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
<title>Data Pasien | Sehatin</title>
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
<link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.5.0/css/all.css' integrity='sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU' crossorigin='anonymous'>
<script type="text/javascript">
  function konfirm(){
    tanya = confirm("Anda yakin ?");
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
            <h3 class="panel-title"><i class="lnr lnr-wheelchair"></i>&ensp;Data Pasien</h3>
            <div class="col-md-2 col-md-offset-10">

            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="panel">
            <br>
              <div class="row">
                <div class="col-md-2">
                  <?php
                    if ($_SESSION['level'] == "Resepsionis") {
                  ?>
                      <a href="tambah_pasien.php"><button type="button" class="btn btn-primary btn-sm" style="margin-left : 25px; margin-bottom: 10px;">Tambah</button></a>
                  <?php
                    }
                   ?>

                </div>
                  <div class="col-md-6"></div>
                    <div class="col-md-4">
                      <form action="" method="POST">
                        <div class="input-group" style="margin-right: 25px;">
                          <input type="text" name="cari" class="form-control input-sm" placeholder="Cari berdasarkan nama...">
                          <span class="input-group-btn"><button type="submit" name="btn_cari" class="btn btn-primary btn-sm"><i class="fa fa-search"></i></button></span>
                        </div>
                      </form>
                    </div>
                  </div>
                  <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover">
                        <thead>
                          <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Usia</th>
                            <th>Gender</th>
                            <th>No HP</th>
                            <th>Alamat</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                          <script type="text/javascript">
                          function konfirm() {
                            tanya = confirm("Anda yakin ?");
                            if (tanya == true) return true;
                            else return false;
                          }
                          </script>
                          <?php
                          if (isset($_POST['btn_cari'])) {
                            $query = "SELECT * FROM pasien WHERE nama LIKE '%$_POST[cari]%' ORDER BY nama ASC";
                            $no = 1;
                            $result = mysqli_query($con, $query);
                          }
                          else{
                            $halaman = 10;
                            $page = isset($_GET['halaman']) ? (int)$_GET['halaman'] : 1;
                            $mulai = ($page > 1) ? ($page * $halaman) - $halaman : 0;
                            $query = "SELECT * FROM pasien ORDER BY nama ASC LIMIT $mulai, $halaman";
                            $ttl = mysqli_query($con, "SELECT COUNT(*) AS jml_pasien FROM pasien");
                            $result = mysqli_query($con, $query);
                            $jml = mysqli_fetch_assoc($ttl);
                            $pages = ceil($jml['jml_pasien']/$halaman);
                            $no = $mulai + 1;
                          }
                          $aksi = "";
                          foreach ($result as $val) {
                            $today = new DateTime();
                            $tgl_lahir = new DateTime($val['tgl_lahir']);
                            $usia = $today->diff($tgl_lahir)->y;
                            if ($_SESSION['level'] == "Resepsionis") {
                              $aksi = "<a href='edit_pasien.php?id_pasien=$val[id_pasien]' class='btn btn-primary btn-xs' title='Edit'><i class='fas fa-pen'></i></a>";
                            }
                            echo "<tr>
                            <td>$no</td>
                            <td>$val[nama]</td>
                            <td>$usia</td>
                            <td>$val[gender]</td>
                            <td>$val[no_hp]</td>
                            <td>$val[alamat]</td>
                            <td>$val[kategori]</td>
                            <td>$aksi
                              <a href='../pemeriksaan/history_pemeriksaan.php?p=$val[id_pasien]' class='btn btn-success btn-xs' title='Detail'><i class='fa fa-info-circle'></i></a></td>
                            </tr>
                            ";
                            $no++;
                          }
                          ?>
                        </tbody>
                      </table>
                    </div>
                    <?php if (!isset($_POST['btn_cari'])): ?>
                      <div class="col-md-2 col-md-offset-11">
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
