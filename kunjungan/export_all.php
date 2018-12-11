<?php 
	include '../koneksi.php';
	if (!empty($_GET['dari']) && !empty($_GET['sampai']) && !empty($_GET['poli'])) {
    $query = "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, pm.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter WHERE a.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' AND a.id_poli = '$_GET[poli]' ORDER BY a.waktu ASC";
 	}
 	elseif (!empty($_GET['dari']) && !empty($_GET['sampai']) && empty($_GET['poli'])) {
   		$query = "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, pm.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter WHERE a.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' ORDER BY a.waktu ASC";
 	}
 	elseif( empty($_GET['dari']) && empty($_GET['sampai']) && !empty($_GET['poli'])) {
   		$query = "SELECT DISTINCT p.*, a.status, a.waktu, a.keluhan, poli.poli, pm.diagnosa, d.nm_dokter FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN poli ON a.id_poli = poli.id_poli INNER JOIN pemeriksaan pm ON pm.id_antrian = a.id_antrian INNER JOIN dokter d ON d.id_dokter = pm.id_dokter WHERE a.id_poli = '$_GET[poli]' ORDER BY a.waktu ASC";
 	}
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_kunjungan$tgl.xls");
 ?>