<?php 
	include '../koneksi.php';
	$status = $_GET['status'] == "Aktif" ? "Non Aktif" : "Aktif";
	mysqli_query($con, "UPDATE diagnosa SET status = '$status' WHERE id_diagnosa = '$_GET[id_diagnosa]'");
 ?>
 <script type="text/javascript">
 	alert('Berhasil diperbarui');
 	window.location.href='data_diagnosa.php';
 </script>