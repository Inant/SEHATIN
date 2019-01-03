<?php 
	include '../koneksi.php';
	date_default_timezone_set("Asia/Jakarta");
	$now = date('Y-m-d');
	$query = mysqli_query($con, "SELECT DISTINCT p.*, a.waktu, a.keluhan, poli.poli, dg.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter INNER JOIN diagnosa dg ON dg.id_diagnosa = pm.id_diagnosa WHERE waktu BETWEEN '$now 00:00:00' AND '$now 23:59:59' ORDER BY a.waktu ASC");
    $tgl = date('d-m-Y');
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_kunjungan_tanggal_$tgl.xls");
 ?>
 <center>
 	<h4>Data Kunjungan Tanggal <?php echo $tgl ?></h4>
 	<br>
 	<table border="1">
 		<thead>
         	<tr>
           	<th>No</th>
           	<th>Nama</th>
           	<th>Usia</th>
           	<th>Gender</th>
           	<th>Alamat</th>
           	<th>Kategori</th>
           	<th>Waktu</th>
           	<th>Poli</th>
           	<th>Keluhan</th>
           	<th>Diagnosa</th>
           	<th>Dokter</th>
         	</tr>
       	</thead>
       	<tbody>
         	<?php
         	$no = 1;
         	foreach ($query as $val) {
           	$today = new DateTime();
           	$tgl_lahir = new DateTime($val['tgl_lahir']);
           	$usia = $today->diff($tgl_lahir)->y;
           	$t = explode(" ", $val['waktu']);
           	$time = $t[1];
           	echo "<tr>
           	<td>$no</td>
           	<td>$val[nama]</td>
           	<td>$usia</td>
           	<td>$val[gender]</td>
           	<td>$val[alamat]</td>
           	<td>$val[kategori]</td>
           	<td>$time</td>
           	<td>$val[poli]</td>
           	<td>$val[keluhan]</td>
           	<td>$val[diagnosa]</td>
           	<td>$val[nm_dokter]</td>
           	</tr>
           	";
           	$no++;
         	}
         	?>
       	</tbody>
 	</table>
 </center>