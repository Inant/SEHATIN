<?php
	include '../koneksi.php';
	$status = $_GET['status'] == 'Aktif' ? 'Non Aktif' : 'Aktif';
	mysqli_query($con, "UPDATE petugas SET status = '$status' WHERE id_petugas = '$_GET[id_petugas]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil diperbarui ');
 	window.location.href='data_petugas.php';
 </script>
