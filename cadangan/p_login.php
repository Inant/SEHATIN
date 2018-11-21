<?php 
		session_start();
		$gagal = "";
		include 'koneksi.php';
		
			$query = "SELECT * FROM petugas WHERE username = '$_POST[username]' AND password = '$_POST[password]'";
			$result = mysqli_query($con, $query);
			$val = mysqli_fetch_array($result);
			if (mysqli_num_rows($result) > 0) {
				$_SESSION['username'] = $val['username'];
				$_SESSION['level1'] = $val['level'];
				echo "<script> alert('Berhasil Login');
				
				</script>";
				echo $val['level']."<br>";
				//print_r($_SESSION);
			}
			else{
				$gagal = "* Username atau password salah";
				echo "<script> alert('Berhasil Login');
				
				</script>";

			}
		

	 ?>