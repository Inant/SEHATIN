<?php
session_start();
unset($_SESSION['id_user']);
unset($_SESSION['username']);
unset($_SESSION['level']);
 ?>
 <script>
 	alert('Berhasil Logout');
window.location.href = "login.php";
  </script>
