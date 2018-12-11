<?php
  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    header("Content-Type: application/json; charset=UTF-8");
    include '../koneksi.php';
    date_default_timezone_set("Asia/Jakarta");
    $now = date("Y-m-d");
    $obat = $_GET["query"];


    $query = mysqli_query($con, "SELECT id_obat, nm_obat FROM obat WHERE nm_obat LIKE '%$obat%' AND stok > 0 AND tgl_kadaluarsa >= '$now' ORDER BY nm_obat ASC");

    while($data = mysqli_fetch_assoc($query)) {
      $output['suggestions'][] = [
        'value' => $data['nm_obat'],
        'obat' => $data['nm_obat']
      ];
    }

    if (!empty($output)) {
      echo json_encode($output);
    }
  }
  else {
    echo 'No direct acces souce!';
  }
 ?>
