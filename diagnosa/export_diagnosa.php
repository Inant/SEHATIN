<?php 
	include '../koneksi.php';
	if (!empty($_GET['dari']) && !empty($_GET['sampai'])) {
		$query = "SELECT dg.*, COUNT(pm.id_diagnosa) as jumlah FROM diagnosa dg INNER JOIN pemeriksaan pm ON pm.id_diagnosa = dg.id_diagnosa INNER JOIN antrian a ON a.id_antrian = pm.id_antrian WHERE a.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' GROUP BY pm.id_diagnosa ORDER BY jumlah DESC";
		$filename = $_GET['dari']."sampai".$_GET['sampai'];
		$dari = date("d-m-Y", strtotime($_GET['dari']));
		$sampai = date("d-m-Y", strtotime($_GET['sampai']));
		$title = "Tanggal ".$dari." Sampai ".$sampai;
	}
	else{
		$query = "SELECT dg.*, COUNT(pm.id_diagnosa) as jumlah FROM diagnosa dg INNER JOIN pemeriksaan pm ON pm.id_diagnosa = dg.id_diagnosa GROUP BY pm.id_diagnosa ORDER BY jumlah DESC";
		$filename="";
		$title="";
	}
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=riwayat_diagnosa$filename.xls");
 ?>
 <center>
 	<h4>Riwayat Diagnosa</h4>
 	<h5><?php echo $title ?></h5>
 	<table border="1">
 		<tr>
 			<th>No</th>
 			<th>Diagnosa</th>
 			<th>Jumlah</th>
 		</tr>
 		<?php 
 			$no = 1;
 			$query = mysqli_query($con, $query);
 			while ($val = mysqli_fetch_assoc($query)) {
 		?>
 				<tr>
 					<td><?php echo $no ?></td>
 					<td><?php echo $val['diagnosa'] ?></td>
 					<td><?php echo $val['jumlah'] ?></td>
 				</tr>
 		<?php
 		$no++;
 			}
 		 ?>
 	</table>
 </center>