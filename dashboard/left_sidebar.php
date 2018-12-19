<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<?php
	$nav = explode('/', $_SERVER['REQUEST_URI']);
	//$nav_dok = $nav[count($nav)]
	$nav = $nav[count($nav) - 2];
	echo $nav;
 ?>
<!-- LEFT SIDEBAR -->
<div id="sidebar-nav" class="sidebar">
	<div class="sidebar-scroll">
		<nav>
			<ul class="nav">
				<?php
					if ($_SESSION['level'] == 'Admin') {?>

						<li><a href="../dashboard/dashboard.php" class="<?php echo ($nav == 'dashboard' ? 'active' : '') ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="../poli/data_poli.php" class="<?php echo ($nav == "poli" ? 'active' : '') ?>"><i class="fa fa-hospital-o"></i> <span>Data Poli</span></a></li>
						<li><a href="../pasien/data_pasien.php" class="<?php echo ($nav == "pasien" ? 'active' : '') ?>"><i class="lnr lnr-wheelchair"></i> <span>Pasien</span></a></li>
						<li><a href="../dokter/data_dokter.php" class="<?php echo ($nav == "dokter" ? 'active' : '') ?>"><i class="fa fa-user-md"></i> <span>Data Dokter</span></a></li>
						<li><a href="../pelayanan/data_pelayanan.php" class="<?php echo ($nav == "pelayanan" ? 'active' : '') ?>"><i class="fa fa-stethoscope"></i> <span>Pelayanan</span></a></li>
						<li><a href="../petugas/data_petugas.php" class="<?php echo ($nav == "petugas" ? 'active' : '') ?>"><i class="lnr lnr-user"></i> <span>Data Petugas</span></a></li>
						<!-- <li><a href="../database/export.php" class="<?php echo ($nav == "database" ? 'active' : '') ?>"><i class="fa fa-database"></i> <span>Databaseta</span></a></li> -->
						<li><a href="#" class=""><i class="lnr lnr-alarm"></i> <span>Info Poliklinik</span></a></li>
				<?php
					}
					elseif ($_SESSION['level'] == 'Resepsionis') { ?>
						<li><a href="../dashboard/dashboard.php" class="<?php echo ($nav == "dashboard" ? 'active' : '') ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="../pasien/data_pasien.php" class="<?php echo ($nav == "pasien" ? 'active' : '') ?>"><i class="lnr lnr-wheelchair"></i> <span>Pasien</span></a></li>
						<li>
							<a href="#subPages1" data-toggle="collapse" class="<?php echo ($nav == "antrian" ? 'active' : '') ?>"><i class="lnr lnr-list"></i><span>Antrian</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages1" class="collapse">
								<ul class="nav">
									<li><a href="../antrian/tambah_antrian.php">Tambah Antrian</a> </li>
									<li><a href="../antrian/antrian_umum.php" class="">Antrian Poli Umum</a></li>
									<li><a href="../antrian/antrian_gigi.php" class="">Antrian Poli Gigi</a></li>
									<li><a href="../antrian/antrian_kia.php" class="">Antrian Poli KIA</a></li>
								</ul>
							</div>
						</li>
						<li>
							<a href="#subPages2" data-toggle="collapse" class="<?php echo ($nav == "kunjungan" ? 'active' : '') ?>"><i class="fa fa-file-text-o"></i><span>Data Kunjungan</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse">
								<ul class="nav">
									<li><a href="../kunjungan/semua_kunjungan.php">Semua Kunjungan</a></li>
									<li><a href="../kunjungan/pasien_hari_ini.php">Kunjungan hari ini</a></li>
									<li><a href="../kunjungan/pasien_bulan_ini.php">Kunjungan bulan ini</a></li>
								</ul>
								
							</div>
						</li>
				<?php
					}
					elseif ($_SESSION['level'] == 'Dokter') {
						$qpage = mysqli_query($con, "SELECT id_poli FROM dokter WHERE id_dokter = '$_SESSION[id_user]'");
						$rpage = mysqli_fetch_assoc($qpage);
						if ($rpage['id_poli'] == 1) {
							$page = 'antrian_umum.php';
						}
						elseif ($rpage['id_poli'] == 2) {
							$page = 'antrian_gigi.php';
						}
						else {
							$page = 'antrian_kia.php';
						}
				?>
						<li><a href="../dashboard/dashboard.php" class="<?php echo ($nav == "dashboard" ? 'active' : '') ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="../antrian/<?php echo $page ?>" class="<?php echo ($nav == "antrian" ? 'active' : '') ?>"><i class="lnr lnr-list"></i> <span>Antrian</span></a></li>
						<li><a href="../pelayanan/data_pelayanan.php" class="<?php echo ($nav == "pelayanan" ? 'active' : '') ?>"><i class="fa fa-stethoscope"></i> <span>Pelayanan</span></a></li>
						<li><a href="../kunjungan/pasien_perhari.php" class="<?php echo ($nav == "kunjungan" ? 'active' : '') ?>"><i class="glyphicon glyphicon-list-alt"></i> <span>Pasien Hari Ini</span></a></li>
						<li><a href="../obat/data_obat.php" class="<?php echo ($nav == "obat" ? 'active' : '') ?>"><i class="fa fa-medkit"></i> <span>Data Obat</span></a></li>
				<?php
					}

					elseif ($_SESSION['level'] == 'Kasir') { ?>
						<li><a href="../dashboard/dashboard.php" class="<?php echo ($nav == "dashboard" ? 'active' : '') ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="../pembayaran/antrian_pembayaran.php" class="<?php echo ($nav == "pembayaran" ? 'active' : '') ?>"><i class="fa fa-money"></i> <span>Antrian Pembayaran</span></a></li>
						<li>
							<a href="#subPages2" data-toggle="collapse" class="<?php echo ($nav == "data%20pembayaran" ? 'active' : '') ?>"><i class="fa fa-file-text-o"></i><span>Data Pembayaran</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages2" class="collapse">
								<ul class="nav">
									<li><a href="../data pembayaran/semua_pembayaran.php">Semua Pembayaran</a></li>
									<li><a href="../data pembayaran/pembayaran_hari_ini.php">Pembayaran hari ini</a></li>
									<li><a href="../data pembayaran/pembayaran_bulan_ini.php">Pembayaran bulan ini</a></li>
								</ul>
								
							</div>
						</li>
				<?php
					}
					elseif ($_SESSION['level'] == 'Apoteker') {
				?>
						<li><a href="../dashboard/dashboard.php" class="<?php echo ($nav == "dashboard" ? 'active' : '') ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li><a href="../resep/antrian_resep.php" class="<?php echo ($nav == "resep" ? 'active' : '') ?>"><i class="material-icons" style="font-size:21px">receipt</i> <span>Antrian Resep</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="<?php echo ($nav == "obat" ? 'active' : '') ?>"><i class="fa fa-medkit"></i><span>Obat</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse">
								<ul class="nav">
									<li><a href="../obat/kategori_obat.php" class="">Kategori Obat</a></li>
									<li><a href="../obat/satuan_obat.php" class="">Satuan Obat</a></li>
									<li><a href="../obat/data_obat.php" class="">List Obat</a></li>
									<li><a href="../obat/obat_keluar.php" class="">Obat Keluar</a></li>
								</ul>
							</div>
						</li>
						<li><a href="../obat_kadaluarsa/obat_kadaluarsa.php" class="<?php echo ($nav == "obat_kadaluarsa" ? 'active' : '') ?>"><i class="fa fa-calendar-times-o"></i> <span>Obat Kadaluarsa</span></a></li>
				<?php
					}
 				?>

					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
