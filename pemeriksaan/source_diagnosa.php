<?php 
	if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) && ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest')) {
    header("Content-Type: application/json; charset=UTF-8");
    include '../koneksi.php';

    $diagnosa = $_GET["query"];
    $query = mysqli_query($con, "SELECT id_diagnosa, diagnosa FROM diagnosa WHERE diagnosa LIKE '%$diagnosa%' AND status = 'Aktif' ORDER BY diagnosa ASC ");

    while($data = mysqli_fetch_assoc($query)) {
      $output['suggestions'][] = [
        'value' => $data['diagnosa'],
        'diagnosa' => $data['diagnosa']
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