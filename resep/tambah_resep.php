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
	<title>Resep | Sehatin</title>
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
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
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
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php
			include '../dashboard/navbar.php';
			include '../dashboard/left_sidebar.php';
			$qrm = mysqli_query($con, "SELECT p.*, a.*,(SELECT COUNT(*) FROM antrian WHERE id_pasien = '$_GET[id_pasien]' ) as jml_kunjungan FROM pasien p, antrian a WHERE p.id_pasien = '$_GET[id_pasien]' AND a.id_antrian='$_GET[id_antrian]'");
			$rm = mysqli_fetch_assoc($qrm);
			$qdokter = mysqli_query($con, "SELECT id_dokter, nm_dokter FROM dokter WHERE id_dokter = '$_SESSION[id_user]'");
			$dokter = mysqli_fetch_assoc($qdokter);
			$today = new DateTime();
      		$tgl_lahir = new DateTime($rm['tgl_lahir']);
     		$usia = $today->diff($tgl_lahir)->y;
      		date_default_timezone_set("Asia/Jakarta");
      		$date = date("d-m-Y");
			$qpage = mysqli_query($con, "SELECT id_poli FROM dokter WHERE id_dokter = '$_SESSION[id_user]'");
			$rpage = mysqli_fetch_assoc($qpage);
			if ($rpage['id_poli'] == 1) {
				$page = 'antrian_umum.php';
			}
			elseif ($rpage['id_poli'] == 2) {
				$page = 'antrian_gigi.php';
			}
			else {
				$page = 'antrian_kia.php';
			}
			$tgl = date("Y-m-d H:i:s");
			if(isset($_POST['submit'])){
				mysqli_query($con, "INSERT INTO resep (id_pemeriksaan, tanggal) VALUE ('$_GET[id_pemeriksaan]', '$tgl')");
				$var = mysqli_query($con, "SELECT id_resep FROM resep ORDER BY id_resep DESC LIMIT 1");
				$varr = mysqli_fetch_assoc($var);
				for($i=0;$i<count($_POST['obat']);$i++){
					$obat = $_POST['obat'][$i];
					$dosis1 = $_POST['dosis1'][$i];
					$dosis2 = $_POST['dosis2'][$i];
					$jumlah = $_POST['jumlah'][$i];
					$harga = 0;
					if ($rm['kategori'] == "Umum") {
						$qharga = mysqli_query($con, "SELECT harga_jual FROM obat WHERE nm_obat = '$obat'");
						$harga = mysqli_fetch_assoc($qharga);
						$harga = $harga['harga_jual'];
					}
					$subtotal = $harga * $jumlah;
					mysqli_query($con, "INSERT INTO detail_resep (id_resep, id_obat, dosis1, dosis2, jml, subtotal) VALUE ( '$varr[id_resep]', (SELECT id_obat FROM obat WHERE nm_obat = '$obat'), '$dosis1', '$dosis2', '$jumlah', '$subtotal') ");
					mysqli_query($con, "UPDATE obat SET stok = (SELECT stok FROM (SELECT * FROM obat) as ob WHERE nm_obat = '$obat') - '$jumlah' WHERE id_obat = (SELECT id_obat FROM (SELECT * FROM obat) as obt WHERE nm_obat = '$obat')");
				}
				mysqli_query($con, "UPDATE resep SET resep.harga_resep = (SELECT SUM(dt.subtotal) FROM detail_resep dt WHERE id_resep = '$varr[id_resep]' GROUP BY dt.id_resep) WHERE id_resep = '$varr[id_resep]' ");
				mysqli_query($con, "UPDATE antrian SET status ='Menuggu obat' WHERE id_antrian = '$_GET[id_antrian]'");
				mysqli_query($con, "INSERT INTO pembayaran (id_antrian, waktu, grand_total) VALUE ('$_GET[id_antrian]', '2018-12-13 00:52:52', (SELECT resep.harga_resep FROM resep WHERE resep.id_pemeriksaan = '$_GET[id_pemeriksaan]') + (SELECT SUM(tindakan.subtotal) FROM tindakan WHERE tindakan.id_pemeriksaan = '$_GET[id_pemeriksaan]'))");
				echo "<script>
								alert('Pasien selesai diperiksa ');
								window.location.href='../antrian/$page';
							</script>";
			}
		?>
		 <div class="main">
		 	<div class="main-content">
		 		<div class="container-fluid">
		 			<div class="panel">
						<div class="panel-heading">
							<div class="row">
								<div class="col-md-4">
									<h3 class="panel-title"><i class="material-icons" style="font-size:21px">receipt</i>&ensp;Resep</h3>
								</div>
							</div>
						</div>
					</div>
		 			<div class="row">
		 				<div class="col-md-12">
		 					<div class="panel">
		 						<div class="panel-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <th>No Pemeriksaan</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $_GET['id_pemeriksaan'] ?></td>
                          </tr>
                          <tr>
                            <th>Nama Pasien</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $rm['nama'] ?></td>
                          </tr>
                          <tr>
                            <th>Gender</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $rm['gender'] ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <th>Usia</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $usia; ?></td>
                          </tr>
                          <tr>
                            <th>Kategori Pasien</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $rm['kategori'] ?></td>
                          </tr>
                          <tr>
                            <th>Jumlah Kunjungan</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $rm['jml_kunjungan'] ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="table-responsive">
                        <table>
                          <tr>
                            <th>Tanggal</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $date; ?></td>
                          </tr>
                          <tr>
                            <th>Dokter Pemeriksa</th>
                            <td>&ensp;&emsp;</td>
                            <td><?php echo $dokter['nm_dokter']; ?></td>
                          </tr>
                        </table>
                      </div>
                    </div>
                  </div>
                  <br>
                  <br>
                  <div class="col-md-12">
                    <form action="" method="POST" name="add_name" id="add_name">
                      <div class="table-responsive">
                        <table class="table" id="dynamic_field">
													<tr>
														<th>Nama Obat</th>
														<th colspan="3">Dosis</th>
														<th>Jumlah</th>
													</tr>
                          <tr>
                            <td><input type="text" id="obat1" name="obat[]" placeholder="Nama Obat" class="form-control obat" required="" /></td>
														<td> <input type="number" id="dosis1" name="dosis1[]" value="" class="form-control" required=""> </td>
														<td> <b>X</b> </td>
														<td> <input type="number" id="dosis2" name="dosis2[]" value="" class="form-control" required=""> </td>
														<td> <input type="number" id="jumlah" name="jumlah[]" value="" class="form-control" placeholder="Jumlah" required=""> </td>
														<td><button type="button" name="add" id="add" class="btn btn-success"> <i class="fa fa-plus-circle"></i> </button></td>
                          </tr>
                        </table>
                      </div>
                      <input type="submit" name="submit" id="submit" class="btn btn-primary" value="Simpan" />
                    </form>
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
	<script src="../assets/vendor/jquery/jquery.min.js"></script>
	<script src="../assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="../assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="../assets/scripts/klorofil-common.js"></script>
	<script src="../assets/vendor/jquery/jquery-3.2.1.min.js"></script>
	<script src="../assets/vendor/jquery/jquery.autocomplete.min.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      var postURL = "/addmore.php";
      var i=1;


      $('#add').click(function(){
				/*
        $( "#obat" ).autocomplete({
         serviceUrl: "source.php",
         dataType: "JSON",
         onSelect: function (suggestion) {
           $( "#obat" ).val("" + suggestion.obat);
         }
       });
			 */
           i++;
           $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="text" name="obat[]" placeholder="Nama Obat" class="form-control obat" id="obat'+i+'" required="" /></td><td><input type="number" id="dosis1" name="dosis1[]" value="" class="form-control" required=""></td><td><b>X</b></td><td><input type="number" id="dosis2" name="dosis2[]" value="" class="form-control" required=""></td><td><input type="number" id="jumlah" name="jumlah[]" value="" class="form-control" placeholder="Jumlah" required=""></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove"><i class="fa fa-times-circle"></i> </button></td></tr>');
					 $( "#obat"+i ).autocomplete({
		 				serviceUrl: "source.php",
		 				dataType: "JSON",
		 				onSelect: function (suggestion) {
							var getId = $(this).attr("id")
		 					$( "#"+getId ).val("" + suggestion.obat);
		 				}
		 			});

					 /*
					 $( "#obat"+i ).autocomplete({
	 					serviceUrl: "source.php",
	 					dataType: "JSON",
	 					onSelect: function (suggestion) {
	 						$( "#obat"+i ).val("" + suggestion.obat);
	 					}
	 				});
					*/
      });


      $(document).on('click', '.btn_remove', function(){
           var button_id = $(this).attr("id");
           $('#row'+button_id+'').remove();
      });


      $('#submit').click(function(){
           $.ajax({
                url:postURL,
                method:"POST",
                data:$('#add_name').serialize(),
                type:'json',
                success:function(data)
                {
                  	i=1;
                  	$('.dynamic-added').remove();
                  	$('#add_name')[0].reset();
    				        alert('Record Inserted Successfully.');
                }
           });
      });
			$( "#obat"+i ).autocomplete({
				serviceUrl: "source.php",
				dataType: "JSON",
				onSelect: function (suggestion) {
					var getId = $(this).attr("id")
					$( "#"+getId ).val("" + suggestion.obat);
				}
			});


    });
	</script>
</body>

</html>
