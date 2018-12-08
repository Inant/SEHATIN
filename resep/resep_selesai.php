<?php 
	include '../koneksi.php';
	mysqli_query($con, "UPDATE antrian SET status = 'Proses Pembayaran' WHERE id_antrian = '$_GET[id_antrian]' ");
	echo "<script>
			alert('Resep telah selesai');
		  </script>";
	header('Location:antrian_resep.php');
 ?>