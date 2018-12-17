<?php 
	include '../koneksi.php';
	date_default_timezone_set("Asia/Jakarta");
	$now = date('Y-m-d');
  $tgl = date('d-m-Y');
	$query = mysqli_query($con, "SELECT p.nama, p.kategori, pb.grand_total,pb.waktu, pb.total_bayar, pb.kembalian FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN pembayaran pb ON a.id_antrian = pb.id_antrian WHERE pb.waktu BETWEEN '$now 00:00:00' AND '$now 23:59:59' AND a.status = 'Selesai' ORDER BY pb.waktu ASC ");
	$qpendapatan = mysqli_query($con, "SELECT SUM(grand_total) as pendapatan FROM pembayaran INNER JOIN antrian a ON a.id_antrian = pembayaran.id_antrian WHERE pembayaran.waktu BETWEEN '$now 00:00:00' AND '$now 23:59:59' AND a.status = 'Selesai' ");
  $pendapatan = mysqli_fetch_assoc($qpendapatan);
  $pendapatan = $pendapatan['pendapatan'];
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=data_pembayaran_tanggal_$tgl.xls");

 ?>
 <center>
 	<br>
	<h4>Data Pembayaran Tanggal <?php echo $tgl ?></h4>
	<br>
	<table border="1">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama Pasien</th>
				<th>Kategori</th>
				<th>Waktu</th>
				<th>Grand Total</th>
				<th>Total Bayar</th>
				<th>Kembalian</th>
			</tr>
		</thead>
		<tbody>
			<?php 
				$no = 1;
				foreach ($query as $val) {
					$time = explode(" ", $val['waktu']);
					$time = $time[1];
					$time = date("H:i", strtotime($time));
					echo "<tr>
									<td>$no</td>
									<td>$val[nama]</td>
									<td>$val[kategori]</td>
                  <td>$time</td>
                  <td>$val[grand_total]</td>
                  <td>$val[total_bayar]</td>
                  <td>$val[kembalian]</td>
								</tr>";
					$no++;
				}

			 ?>
		</tbody>
		<tfoot>
			<tr>
				<th colspan="4" style="text-align: center;">Pendapatan</th><th colspan="3" style="text-align: left;"><?php echo "Rp ".$pendapatan ?></th>
			</tr>
		</tfoot>
	</table>
 </center>