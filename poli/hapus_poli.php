<?php 
	include '../koneksi.php';
	mysqli_query($con, "DELETE FROM poli WHERE id_poli = '$_GET[id_poli]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil dihapus');
 	window.location.href='data_poli.php';
 </script>