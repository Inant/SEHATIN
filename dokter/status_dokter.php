<?php
	include '../koneksi.php';
	$status = $_GET['status'] == 'Aktif' ? 'Non Aktif' : 'Aktif';
	mysqli_query($con, "UPDATE login SET status = '$status' WHERE id_user = '$_GET[id_dokter]' AND level = 'Dokter' ");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil diperbarui ');
 	window.location.href='data_dokter.php';
 </script>
