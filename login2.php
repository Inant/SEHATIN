<!--Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title>Sehatin Login</title>
<style type="text/css">
	.error{
		color: #d32f2f;
		font-size: 12px;
		font-weight: bold;
	}
</style>
<!-- Custom Theme files -->
<link href="static-login/css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Static Login Form Responsive, Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<!--script-->
<script src="static-login/js/jquery.min.js"></script>
<script src="static-login/js/easyResponsiveTabs.js" type="text/javascript"></script>
		    <script type="text/javascript">
			    $(document).ready(function () {
			        $('#horizontalTab').easyResponsiveTabs({
			            type: 'default', //Types: default, vertical, accordion           
			            width: 'auto', //auto or any width like 600px
			            fit: true   // 100% fit in a container
			        });
			    });
				
</script>	
<!--script-->

</head>
<body>
	<?php 
		session_start();
		$gagal = "";
		
		include 'koneksi.php';
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$query = "SELECT * FROM petugas WHERE username = '$_POST[username]' AND password = '$_POST[password]' ";
			$result = mysqli_query($con, $query);
			$val = mysqli_fetch_array($result);
			if (mysqli_num_rows($result) > 0) {
				$_SESSION['username'] = $val['username'];
				$_SESSION['level'] = $val['level'];
				echo "<script> alert('Berhasil Login');
				window.location.href = 'dashboard.php';
				</script>";
			}
			else{
				$gagal = "* Username atau password salah";
				
			}
		}

	 ?>
	<div class="head">
		<div class="logo">
			<div class="logo-top">
				<h1>SEHATIN</h1>
			</div>
			
		</div>		
		<div class="login">
			<div class="sap_tabs">
				<div id="horizontalTab" style="display: block; width: 100%; margin: 0px;">
					<ul class="resp-tabs-list">
						<li class="resp-tab-item" aria-controls="tab_item-0" role="tab"><span>Login</span></li>
						
						<div class="clearfix"></div>
					</ul>				  	 
					<div class="resp-tabs-container">
						<div class="tab-1 resp-tab-content" aria-labelledby="tab_item-0">
							<div class="login-top">
								<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
									<input type="text" name="username" class="email" placeholder="Username" required=""/>
									<input type="password" name="password" class="password" placeholder="Password" required=""/>
									<br>
									<br>
									<span class="error"> <?php echo $gagal; ?></span>		
								
								<div class="login-bottom login-bottom1">
									<div class="submit">
										<input type="submit" value="LOGIN" name="submit" />
									</div>
									</form>
									<div class="clear"></div>
								</div>	
							</div>
						</div>
													
					</div>	
				</div>
			</div>	
		</div>	
		<div class="clear"></div>
	</div>	
	
	<div class="footer">
		<p>© 2018 Popeye Team </p>
	</div>
</body>
</html>