<?php 
	include '../koneksi.php';
	mysqli_query($con, "DELETE FROM dokter WHERE id_dokter = '$_GET[id_dokter]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil dihapus ');
 	window.location.href='data_dokter.php';
 </script>