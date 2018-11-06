<?php 
	include '../koneksi.php';
	mysqli_query($con, "DELETE FROM petugas WHERE id_petugas = '$_GET[id_petugas]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil dihapus ');
 	window.location.href='data_petugas.php';
 </script>