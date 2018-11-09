<?php
	include '../koneksi.php';
	$status = $_GET['status'] == 'Aktif' ? 'Non Aktif' : 'Aktif';
	mysqli_query($con, "UPDATE kategori_obat SET status = '$status' WHERE id_kategori = '$_GET[id_kategori]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil diperbarui');
 	window.location.href='kategori_obat.php';
 </script>
