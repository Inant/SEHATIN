<?php 
	include '../koneksi.php';
	$qpasien = mysqli_query($con, "SELECT * FROM pasien WHERE id_pasien = '$_GET[id_pasien]'");
	$valpasien = mysqli_fetch_assoc($qpasien);
	date_default_timezone_set("Asia/Jakarta");
	$today = new DateTime();
    $tgl_lahir = new DateTime($valpasien['tgl_lahir']);
    $usia = $today->diff($tgl_lahir)->y;
    $qpemeriksaan = mysqli_query($con, "SELECT a.waktu, a.keluhan, dg.diagnosa, p.pelayanan, d.nm_dokter FROM antrian a INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN tindakan t ON pm.id_pemeriksaan = t.id_pemeriksaan INNER JOIN pelayanan p ON t.id_pelayanan = p.id_pelayanan INNER JOIN dokter d ON pm.id_dokter = d.id_dokter INNER JOIN diagnosa dg ON dg.id_diagnosa = pm.id_diagnosa WHERE a.id_pasien = '$_GET[id_pasien]' AND t.id_pelayanan != 1 ORDER BY a.waktu ASC");
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=history_pemeriksaan_$valpasien[nama].xls");	
 ?>
 	<center>
 		<h4>History Pemeriksaan</h4>
 		<table class="table">
 			<tr>
 				<td><b>No RM</b></td>
 				<td><?php echo "RM".$valpasien['id_pasien'] ?></td>
 				<td></td>
 				<td>&ensp;<b>Usia</b></td>
 				<td><?php echo $usia ?></td>
 			</tr>
 			<tr>
 				<td><b>Nama Pasien</b></td>
 				<td><?php echo $valpasien['nama'] ?></td>
 				<td></td>
 				<td>&ensp;<b>Alamat</b></td>
 				<td><?php echo $valpasien['alamat'] ?></td>
 			</tr>
 			<tr>
 				<td><b>Gender</b></td>
 				<td><?php echo $valpasien['gender'] ?></td>
 				<td></td>
 				<td>&ensp;<b>Kategori</b></td>
 				<td><?php echo $valpasien['kategori'] ?></td>
  			</tr>
 		</table>
 		<br>
 		<br>
 		<table border="1">
 			<tr>
 				<th>No</th>
 				<th>Tanggal</th>
 				<th>Keluhan</th>
 				<th>Diagnosa</th>
 				<th>Tindakan</th>
 				<th>Dokter</th>
 			</tr>
 			<?php
 				$no = 1; 
 				while ($val = mysqli_fetch_assoc($qpemeriksaan)) {
 					$tgl = explode(" ", $val['waktu']);
 					$tgl = $tgl[0];
 					$tgl = date("d-m-Y", strtotime($tgl));
 			?>
 				<tr>
 					<td><?php echo $no ?></td>
 					<td><?php echo $tgl ?></td>
 					<td><?php echo $val['keluhan'] ?></td>
 					<td><?php echo $val['diagnosa'] ?></td>
 					<td><?php echo $val['pelayanan'] ?></td>
 					<td><?php echo $val['nm_dokter'] ?></td>
 				</tr>
 			<?php 
 				$no++;
 				}
 			?>
 		</table>
 	</center>