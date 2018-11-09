<?php
	include '../koneksi.php';
	$status = $_GET['status'] == 'Aktif' ? 'Non Aktif' : 'Aktif';
	mysqli_query($con, "UPDATE dokter SET status = '$status' WHERE id_dokter = '$_GET[id_dokter]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil diperbarui ');
 	window.location.href='data_dokter.php';
 </script>
