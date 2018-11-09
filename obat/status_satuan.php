<?php
	include '../koneksi.php';
	$status = $_GET['status'] == 'Aktif' ? 'Non Aktif' : 'Aktif';
	mysqli_query($con, "UPDATE satuan_obat SET status = '$status' WHERE id_satuan = '$_GET[id_satuan]'");
 ?>
 <script type="text/javascript">
 	alert('Data berhasil diperbarui');
 	window.location.href='satuan_obat.php';
 </script>
