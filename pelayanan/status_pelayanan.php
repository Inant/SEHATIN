<?php 
	include '../koneksi.php';
	$status = $_GET['status'] == "Aktif" ? "Non Aktif" : "Aktif";
	mysqli_query($con, "UPDATE pelayanan SET status = '$status' WHERE id_pelayanan = '$_GET[id_pelayanan]' ");
 ?>
  <script type="text/javascript">
 	alert('Data berhasil diperbarui');
 	window.location.href='data_pelayanan.php';
 </script>
