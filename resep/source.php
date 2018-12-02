<?php
  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    header("Content-Type: application/json; charset=UTF-8");
    include '../koneksi.php';

    $obat = $_GET["query"];

    $query = mysqli_query($con, "SELECT id_obat, nm_obat FROM obat WHERE nm_obat LIKE '%$obat%' ORDER BY nm_obat ASC");

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
