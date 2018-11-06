<?php 
	include '../koneksi.php';
	mysqli_query($con, "DELETE FROM satuan_obat WHERE id_satuan = '$_GET[id_satuan]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil dihapus');
 	window.location.href='satuan_obat.php';
 </script>