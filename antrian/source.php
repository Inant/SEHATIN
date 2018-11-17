<?php
  if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    header("Content-Type: application/json; charset=UTF-8");
    include '../koneksi.php';

    $nama = $_GET["query"];

    $query = mysqli_query($con, "SELECT id_pasien, nama FROM pasien WHERE nama LIKE '%$nama%' ORDER BY nama ASC");

    while($data = mysqli_fetch_assoc($query)) {
      $output['suggestions'][] = [
        'value' => $data['nama'],
        'nama' => $data['nama']
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
