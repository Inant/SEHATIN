<?php
	include '../koneksi.php';
	$status = $_GET['status'] == 'Aktif' ? 'Non Aktif' : 'Aktif';
	mysqli_query($con, "UPDATE poli SET status = '$status' WHERE id_poli = '$_GET[id_poli]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil diperbarui');
 	window.location.href='data_poli.php';
 </script>
