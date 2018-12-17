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
	<title>Pembayaran | Sehatin</title>
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
	<script type="text/javascript">
		function startCalc(){
			interval = setInterval("calc()", 1);
		}
		function calc(){
			grand = document.pembayaran.grand_total.value;
			byr = document.pembayaran.bayar.value;
			if(grand ==  0){
				document.pembayaran.bayar.readOnly = true;
				document.pembayaran.bayar.value = 0;
			}
			document.pembayaran.kembalian.value = byr - grand;
		}
		function stopCalc(){
			clearInterval(interval);
		}
		
	</script>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<?php
			include '../dashboard/navbar.php';
			include '../dashboard/left_sidebar.php';
			date_default_timezone_set("Asia/Jakarta");
			$waktu = date("d-m-Y H:i");
			$waktu2 = date("d-m-Y H:i:s");
			$qpembayaran = mysqli_query($con, "SELECT pb.id_pembayaran, p.nama, p.kategori, pb.waktu FROM pembayaran pb INNER JOIN antrian a ON pb.id_antrian = a.id_antrian INNER JOIN pasien p ON a.id_pasien = p.id_pasien WHERE pb.id_antrian = '$_GET[id_antrian]' ");
			$valpembayaran = mysqli_fetch_assoc($qpembayaran);

			$qtindakan = mysqli_query($con, "SELECT p.pelayanan, t.subtotal FROM tindakan t INNER JOIN pelayanan p ON t.id_pelayanan = p.id_pelayanan WHERE t.id_pemeriksaan = '$_GET[id_pemeriksaan]'");
			$subtindakan = 0;

			$qobat = mysqli_query($con, "SELECT o.nm_obat, dt.jml, dt.subtotal FROM resep r INNER JOIN detail_resep dt ON r.id_resep = dt.id_resep INNER JOIN obat o ON dt.id_obat = o.id_obat WHERE r.id_pemeriksaan = '$_GET[id_pemeriksaan]' ");
			$subobat = 0;

			$qtotal = mysqli_query($con, "SELECT grand_total FROM pembayaran WHERE id_antrian = '$_GET[id_antrian]' ");
			$valtotal = mysqli_fetch_assoc($qtotal);

			$bayar_err = ""; 
			$bayar = 0;
			if (isset($_POST['submit'])) {
				if (!is_numeric($_POST['bayar'])) {
					$bayar_err = "* Hanya bisa menginput angka ";
				}
				elseif ($_POST['bayar'] < $_POST['grand_total']) {
					$bayar_err = "* Total bayar tidak boleh kurang dari grand total";
				}
				else{
					$bayar = trim($_POST['bayar']);
				}

				if ($bayar_err == "") {
					mysqli_query($con, "UPDATE pembayaran SET waktu = '$waktu2', total_bayar = '$bayar', kembalian = '$_POST[kembalian]', id_user = '$_SESSION[id_user]' WHERE id_pembayaran = '$valpembayaran[id_pembayaran]'  ");
					mysqli_query($con, "UPDATE antrian SET status = 'Selesai' WHERE id_antrian = '$_GET[id_antrian]' ");
					echo "<script>
									alert('Pembayaran sukses ');
									window.location.href='antrian_pembayaran.php';
								</script>";

				}
			}

		?>
		 <div class="main">
			<div class="main-content">
				<div class="col-md-8">
					<div class="panel">
						<div class="panel-heading">
							<h1 class="panel-title"> <i class="fa fa-money"></i>&ensp;Pembayaran</h1>
						</div> 
					</div>
				</div>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-8">
							<div class="panel">
								<div class="panel-heading">
									<h3 class="panel-title">Form Pembayaran</h3>
								</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-6">
											<div class="table-responsive">
												<table>
													<tr>
														<th>No Pembayaran</th>
														<td>&ensp;&emsp;</td>
														<td><?php echo $valpembayaran['id_pembayaran']; ?></td>
													</tr>
													<tr>
														<th>Nama Pasien</th>
														<td>&ensp;&emsp;</td>
														<td><?php echo $valpembayaran['nama'] ?></td>
													</tr>
													<tr>
														<th>Kategori</th>
														<td>&ensp;&emsp;</td>
														<td><?php echo $valpembayaran['kategori'] ?></td>
													</tr>
												</table>
											</div>
										</div>
										<div class="col-md-6">
											<div class="table-responsive">
												<table>
													<tr>
														<th>Waktu</th>
														<td>&ensp;&emsp;</td>
														<td><?php echo $waktu; ?></td>
													</tr>
													<tr>
														<th>Kasir</th>
														<td>&ensp;&emsp;</td>
														<td><?php echo $_SESSION['username'] ?></td>
													</tr>
												</table>
											</div>
										</div>
									</div>
									<br>
									<h5 class="panel-title">Tindakan</h5>
									 <div class="row"> 
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="table table-hover table-striped">
													<thead>
														<tr>
															<th>No</th>
															<th>Nama Tindakan</th>
															<th>Harga</th>
														</tr>
													</thead>
													<tbody>
													<?php
														$no = 1; 
														while ($valtindakan = mysqli_fetch_assoc($qtindakan)) {
															$subtindakan += $valtindakan['subtotal'];
															echo "
															<tr>
																<td>$no</td>
																<td>$valtindakan[pelayanan] </td>
																<td>$valtindakan[subtotal] </td>
															</tr>";
															$no++;
														}
													?>
													</tbody>
													<tfoot>
														<th colspan = "2" style = "text-align:center;">Subtotal</th>
														<td><?php echo $subtindakan ?></td>
													</tfoot>
												</table>	
											</div>
										</div>
									 </div>
									<div class="row">
										<div class="col-md-12">
											<hr>
										</div>
									</div>
									<h5 class="panel-title">Obat </h5>
									<div class="row">
										<div class="col-md-12">
											<div class="table-responsive">
												<table class="table table-striped table-hover">
													<thead>
														<tr>
															<th>No</th>
															<th>Nama Obat</th>
															<th>Jumlah</th>
															<th>Harga</th>
														</tr>
													</thead>
													<tbody>
													<?php 
														$no = 1;
														while ($valobat = mysqli_fetch_assoc($qobat)) {
															$subobat += $valobat['subtotal']; 
															echo "
															<tr>
																<td>$no</td>
																<td>$valobat[nm_obat]</td>
																<td>$valobat[jml]</td>
																<td>$valobat[subtotal]</td>
															</tr>";
															$no++;
														}
													?>
													</tbody>
													<tfoot>
														<th colspan = "3" style = "text-align:center;">Subtotal</th>
														<td><?php echo $subobat ?></td>
													</tfoot>
												</table>
											</div>
										</div>
									</div>
									<form name="pembayaran" action="" method="POST">
										<div class="row">
											<div class="col-md-6">
												<label for="">Grand Total</label>
													<input type="number" name="grand_total" class="form-control" value="<?php echo $valtotal['grand_total'] ?>" readonly="" onFocus="startCalc();" onBlur="stopCalc();">
											</div>
											<div class="col-md-6">
												<label>Kembalian</label>
												<input type="number" name="kembalian" value="<?php echo isset($_POST['kembalian']) ? $_POST['kembalian'] : 0 ?>" class="form-control" readonly="" onchange='tryNumberFormat(this.form.thirdBox);'>
											</div>	
										</div>
										<br>
										<div class="row">
											<div class="col-md-6">
												<label for="">Bayar</label>
													<input type="number" name="bayar" class="form-control" placeholder="Total bayar" onFocus="startCalc();" onblur="stopCalc();" value="<?php echo isset($_POST['bayar']) ? $_POST['bayar'] : '' ?>" required="">
													<span class="text text-danger"><?php echo $bayar_err?></span>
											</div>	
										</div>
										<br>
										<button type="submit" class="btn btn-primary" name="submit" value="submit"><i class="fa fa-check"></i>Simpan</button>
									</form>
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
			$( "#pelayanan" ).autocomplete({
				serviceUrl: "source.php",
				dataType: "JSON",
				onSelect: function (suggestion) {
					$( "#pelayanan" ).val("" + suggestion.pelayanan);
				}
			});
		})
	</script>
</body>

</html>
