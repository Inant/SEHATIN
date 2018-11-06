<?php 
	include '../koneksi.php';
	mysqli_query($con, "DELETE FROM kategori_obat WHERE id_kategori = '$_GET[id_kategori]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil dihapus');
 	window.location.href='kategori_obat.php';
 </script>