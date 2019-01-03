<?php
  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    header("Content-Type: application/json; charset=UTF-8");
    include '../koneksi.php';

    $pelayanan = $_GET["query"];

    $query = mysqli_query($con, "SELECT id_pelayanan, pelayanan FROM pelayanan WHERE pelayanan LIKE '%$pelayanan%' AND id_pelayanan != 1 AND status = 'Aktif' ORDER BY pelayanan ASC");

    while($data = mysqli_fetch_assoc($query)) {
      $output['suggestions'][] = [
        'value' => $data['pelayanan'],
        'pelayanan' => $data['pelayanan']
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
