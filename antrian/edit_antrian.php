<?php
session_start();
if (empty($_SESSION['username']) && empty($_SESSION['level'])) {
	echo "<script>
					alert('Anda harus login dahulu!');
					window.location.herf='../login.php';
				</script>";
}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
 	<head>
 		<meta charset="utf-8">
 		<title>Tambah Pasien | Sehatin</title>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
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
    <style media="screen">
      .autocomplete-suggestions {
        border: 1px solid #999;
        background: #FFF;
        overflow: auto;
      }
      .autocomplete-suggestion {
        padding: 2px 5px;
        white-space: nowrap;
        overflow: hidden;
      }
      .autocomplete-selected {
        background: #F0F0F0;
      }
      .autocomplete-suggestions strong {
        font-weight: normal;
        color: #3399FF;
      }
      .autocomplete-group {
        padding: 2px 5px;
      }
      .autocomplete-group strong {
        display: block;
        border-bottom: 1px solid #000;
      }
    </style>
 	</head>
 	<body>
 		<div id="wrapper">
 			<?php
				include '../dashboard/navbar.php';
				include '../dashboard/left_sidebar.php';

				$nama_err = $keluhan_err = $poli_err = "";
        $nama = $poli = "";
        $keluhan = "Keluhan";
        $query = mysqli_query($con, "SELECT a.*, p.nama FROM antrian a INNER JOIN pasien p ON a.id_pasien = p.id_pasien WHERE id_antrian = '$_GET[id_antrian]'");
        $val = mysqli_fetch_assoc($query);
				if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $q = mysqli_query($con, "SELECT id_pasien FROM pasien WHERE nama = '$_POST[nama]'");
          $cek = mysqli_num_rows($q);
          date_default_timezone_set("Asia/Jakarta");
          $waktu = date("Y-m-d H:i:s");

					if (empty($_POST['nama'])) {
						$nama_err = "* Nama harus diisi !";
					}
          elseif ($cek == 0) {
            $nama_err = "* Pasien tidak terdaftar !";
          }
					else {
						$nama = trim($_POST['nama']);
					}

          if (empty($_POST['poli'])) {
            $poli_err = "* Pilih poli !";
          }
          else {
            $poli = trim($_POST['poli']);
          }

          if (empty($_POST['keluhan']) || $_POST['keluhan'] == "Keluhan") {
            $keluhan_err = "* Keluhan harus diisi!";
          }
          else {
            $keluhan = $_POST['keluhan'];
          }
					if ($nama_err == "" && $poli_err == "" && $keluhan_err == "") {
						mysqli_query($con, "UPDATE antrian set id_pasien = (SELECT id_pasien FROM pasien WHERE nama = '$nama'), id_poli = '$poli', keluhan = '$keluhan' WHERE id_antrian = '$_POST[id_antrian]'");
					  echo "<script>
							alert('Data berhasil diperbarui');
								  </script>";
            if ($poli == 1) {
              echo "<script>
                window.location.href='antrian_umum.php'
                    </script>";
            }
            elseif ($poli == 2) {
              echo "<script>
                window.location.href='antrian_gigi.php'
                    </script>";
            }
            elseif ($poli == 5) {
              echo "<script>
                window.location.href='antrian_kia.php'
                    </script>";
            }
					}

				}
			 ?>
			 <div class="main">
			 	<div class="main-content">
			 		<div class="container-fluid">
			 			<h3 class="page-title">Antrian</h3>
						<div class="row">
						  <div class="col-md-12">
						    <div class="panel">
						    	<div class="panel-heading">
						    		<h3 class="panel-title">Edit Antrian</h3>
						    	</div>
									<div class="panel-body">
										<form class="" action="" method="POST">
                      <input type="hidden" name="id_antrian" value="<?php echo $val['id_antrian'] ?>">
											<div class="row">
												<div class="col-md-6">
                          <label for="">Nama Pasien</label>
													<input type="text" id="nama" name="nama" value="<?php echo($val['nama']) ?>" placeholder="Nama pasien" class="form-control">
													<span class="text-danger"><?php echo(
                          $nama_err)?></span>
												</div>
                        <div class="col-md-6">
                          <label for="">Poli</label>
                          <select class="form-control" name="poli">
                            <option value="">-- Pilih Poli --</option>
                            <?php
                              $qpoli = mysqli_query($con, "SELECT * FROM poli");
                              while ($vall = mysqli_fetch_assoc($qpoli)) { ?>
                                <option value="<?php echo ($vall['id_poli']) ?>" <?php echo ($vall['id_poli'] == $val['id_poli'] ? 'selected' : '') ?> ><?php echo ($vall['poli']) ?></option>
                            <?php
                              }
                             ?>
                          </select>
                          <span class="text-danger"><?php echo ($poli_err) ?></span>
                        </div>
											</div>
											<br>
                      <div class="row">
                        <div class="col-md-6">
                          <label for="">Keluhan</label>
                          <textarea name="keluhan" class="form-control"><?php echo $val['keluhan'] ?></textarea>
                          <span class="text-danger"><?php echo ($keluhan_err) ?></span>
                        </div>
                      </div>
                      <br>
											<div class="row">
												<div class="col-md-6">
												  <button type="submit" name="button" class="btn btn-primary btn-sm"> <i class="fa fa-check"></i> Simpan </button> &nbsp; &nbsp;
													<button type="reset" name="reset" class="btn btn-danger btn-sm" onclick="history.go(-1)"> <i class="fa fa-times-circle"></i> &nbsp; Batal</button>
												</div>
											</div>
										</form>
									</div>
						    </div>
						  </div>
						</div>
			 		</div>
			 	</div>
			 </div>
			 <div class="clearfix">
			 	<?php
					include '../dashboard/footer.php';
				 ?>
			 </div>
 		</div>

		<script src="../assets/vendor/jquery/jquery.min.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
		<script src="../assets/scripts/klorofil-common.js"></script>
    <script src="../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="../assets/vendor/jquery/jquery.autocomplete.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $( "#nama" ).autocomplete({
          serviceUrl: "source.php",
          dataType: "JSON",
          onSelect: function (suggestion) {
            $( "#nama" ).val("" + suggestion.nama);
          }
        });
      })
    </script>
 	</body>
 </html>
