<?php 
	include '../koneksi.php';
	if (!empty($_GET['dari']) && !empty($_GET['sampai']) && !empty($_GET['poli']) && !empty($_GET['diagnosa'])) {
    	$query = mysqli_query($con, "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, dg.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter INNER JOIN diagnosa dg ON dg.id_diagnosa = pm.id_diagnosa WHERE a.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' AND a.id_poli = '$_GET[poli]' AND pm.id_diagnosa = '$_GET[diagnosa]' ORDER BY a.waktu ASC");
    	$poli = mysqli_fetch_assoc($query);
    	$dari = date("d-m-Y", strtotime($_GET['dari']));
    	$sampai = date("d-m-Y", strtotime($_GET['sampai']));
    	$title = "Data Kunjungan Poli $poli[poli] <br> Dari Tanggal $dari Sampai Tanggal $sampai";
 	}
 	elseif (!empty($_GET['dari']) && !empty($_GET['sampai']) && empty($_GET['poli']) && empty($_GET['diagnosa'])) {
   		$query = mysqli_query($con, "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, dg.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter INNER JOIN diagnosa dg ON dg.id_diagnosa = pm.id_diagnosa WHERE a.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' ORDER BY a.waktu ASC");
   		$dari = date("d-m-Y", strtotime($_GET['dari']));
    	$sampai = date("d-m-Y", strtotime($_GET['sampai']));
   		$title = "Data Kunjungan <br> Dari Tanggal $dari Sampai Tanggal $sampai";
 	}
 	elseif( empty($_GET['dari']) && empty($_GET['sampai']) && !empty($_GET['poli']) && empty($_GET['diagnosa'])) {
   		$query = mysqli_query($con, "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, dg.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter INNER JOIN diagnosa dg ON dg.id_diagnosa = pm.id_diagnosa WHERE a.id_poli = '$_GET[poli]' ORDER BY a.waktu ASC");
   		$poli = mysqli_fetch_assoc($query);
   		$title = "Data Kunjungan Poli $poli[poli]";
 	}
  elseif( empty($_GET['dari']) && empty($_GET['sampai']) && !empty($_GET['poli']) && !empty($_GET['diagnosa'])) {
      $query = mysqli_query($con, "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, dg.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter INNER JOIN diagnosa dg ON dg.id_diagnosa = pm.id_diagnosa WHERE a.id_poli = '$_GET[poli]' AND pm.id_diagnosa = '$_GET[diagnosa]' ORDER BY a.waktu ASC");
      $poli = mysqli_fetch_assoc($query);
      $title = "Data Kunjungan Poli $poli[poli] Diagnosa $poli[diagnosa]";
  }
  elseif( empty($_GET['dari']) && empty($_GET['sampai']) && empty($_GET['poli']) && !empty($_GET['diagnosa'])) {
      $query = mysqli_query($con, "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, dg.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter INNER JOIN diagnosa dg ON dg.id_diagnosa = pm.id_diagnosa WHERE pm.id_diagnosa = '$_GET[diagnosa]' ORDER BY a.waktu ASC");
      $diagnosa = mysqli_fetch_assoc($query);
      $title = "Data Kunjungan Diagnosa $diagnosa[diagnosa]";
  }
    //header("Content-type: application/vnd-ms-excel");
    //header("Content-Disposition: attachment; filename=data_kunjungan.xls");
 ?>
 <center>
 	<h4><?php echo $title ?></h4>
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
           	$time = date("d-m-Y H:i", strtotime($val['waktu']));
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