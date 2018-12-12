<?php 
	include '../koneksi.php';
	$dari = date("Y-m-d", strtotime($_GET['dari']));
	$sampai = date("Y-m-d", strtotime($_GET['sampai']));
	$q = mysqli_query($con, "SELECT DISTINCT o.*, k.kategori, s.satuan, SUM(dt.jml) as jumlah, r.tanggal FROM obat o INNER JOIN kategori_obat k ON  o.id_kategori = k.id_kategori INNER JOIN satuan_obat s ON o.id_satuan = s.id_satuan INNER JOIN detail_resep dt ON dt.id_obat = o.id_obat INNER JOIN resep r ON r.id_resep = dt.id_resep WHERE r.tanggal BETWEEN '$dari 00:00:00' AND '$sampai 23:59:59' GROUP BY dt.id_obat ORDER BY jumlah DESC");
	$no = 1;
	header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=data_obat_keluar.xls");
 ?>
 <center>
 	<h4>Data Obat Keluar</h4>
 	<h5>Dari tanggal <?php echo date("d-m-Y", strtotime($_GET['dari'])) ?> sampai tanggal <?php echo date("d-m-Y", strtotime($_GET['sampai'])) ?></h5>
 	<table border="1">
 		<thead>
            <tr>
                <th>No</th>
                <th>Nama Obat</th>
                <th>Kategori</th>
                <th>Satuan</th>
                <th>Jumlah Keluar</th>
			</tr>
			<tbody>
				<?php 
					foreach ($q as $val) {
						$tgl_kadaluarsa = date("d-m-Y", strtotime($val['tgl_kadaluarsa']));
						echo "<tr>
							<td>$no</td>
							<td>$val[nm_obat]</td>
							<td>$val[kategori]</td>
							<td>$val[satuan]</td>
							<td>$val[jumlah]</td>
						</tr>";
						$no++;
					}
				 ?>
			</tbody>
        </thead>
 	</table>
 </center>