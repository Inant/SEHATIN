<?php 
	include '../koneksi.php';
	$query = mysqli_query($con, "SELECT DISTINCT p.nama, p.kategori, pb.grand_total, pb.waktu, pb.total_bayar, pb.kembalian FROM pasien p INNER JOIN antrian a ON a.id_pasien = p.id_pasien INNER JOIN pembayaran pb ON a.id_antrian = pb.id_antrian WHERE pb.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' AND a.status = 'Selesai'  ORDER BY pb.waktu");

  $qpendapatan = mysqli_query($con, "SELECT SUM(pb.grand_total) as pendapatan FROM pembayaran pb INNER JOIN antrian a ON a.id_antrian = pb.id_antrian WHERE pb.waktu BETWEEN '$_GET[dari] 00:00:00' AND '$_GET[sampai] 23:59:59' AND a.status = 'Selesai' ");
  $pendapatan = mysqli_fetch_assoc($qpendapatan);
  $pendapatan = $pendapatan['pendapatan'];
  $dari = date("d-m-Y", strtotime($_GET['dari']));
  $sampai = date("d-m-Y", strtotime($_GET['sampai']));
  header("Content-type application/vnd-ms-excel");
  header("Content-Disposition: attachment; filename=data pembayaran tanggal $dari sampai $sampai.xls");
 ?>
 <center>
 	<h4>Data Pembayaran Dari Tanggal <?php echo $dari ?> Sampai Tanggal <?php echo $sampai ?></h4>
 	<table border="1">
 		<thead>
 			<tr>
 				<th>No</th>
				<th>Nama Pasien</th>
				<th>Kategori</th>
				<th>Tanggal</th>
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
					$time = $time[0];
					$time = date("d-m-Y", strtotime($time));
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