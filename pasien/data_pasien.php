<?php session_start();
if (empthy($_SESSION['username'])&& empty($_SESSION['level'])){
	echo "<script>
	alert('Anda harus login dahulu !');
	window.location.href='login.php';
	</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Data Pasien | Sehatin</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0 maximum-scale=1.0, uer-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<!--<link rel="stylesheet" href="assets/css/demo.css">-->
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="assets/img/favicon.png">
</head>

<body>
    <!--WRAPPER-->
    <div id="wrapper">
      <?php
      include '../dashboard/navbar.php';
      include '../dashboard/left_sidebar.php';
			//inant
      ?>
      <div class="main">
        <div class="main-content">
          <div class="container-fluid">
            <h3 class="page-title">Pasien</h3>
            <div class="row">
                <div class="col-md-12">

                  <div class="panel">

                      <div class="panel-heading">
                        <h4 class="panel-title">Data Pasien</h4>

                      </div>
                      <div class="row">
                        <div class="col-md-2">
                          <a href="tambah_pasien.php"><button type="button" class="btn btn-primary btn-sm" style="margin-left: 25px; margin-bottom: 10px;">Tambah</button></a>
                        </div>
                          <div class="col-md-6"></div>
                          <div class="col-md-4">
                                <form action="" method="POST">
                                  <div class="input-group" style="margin-right: 25px;">
                                    <input type="text" name="cari" class="form-control input-sm"placeholder="Cari brdasarkan nama ...">
                                    <span class="inout-group-btn"><button type="submit" name="btn-cari" class="btn btn-primary btn-sm"><i class="fa fa-search"></button></span>
                                  </div>
                                </form>
                          </div>
                      </div>

                    <div class="panel-body">
                      <table class="table table-striped table-hover table-bordered">
                        <thead>
                          <tr>
                            <th>no</th><!--elsa-->
                          </tr>
                        </thead>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</body>
</html>
