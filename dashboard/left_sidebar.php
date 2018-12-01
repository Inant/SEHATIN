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
						<li><a href="#" class=""><i class="lnr lnr-alarm"></i> <span>Info</span></a></li>
						<li><a href="../petugas/data_petugas.php" class="<?php echo ($nav == "petugas" ? 'active' : '') ?>"><i class="lnr lnr-user"></i> <span>Data Petugas</span></a></li>
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
						<li><a href="../kunjungan/data_kunjungan.php" class="<?php echo ($nav == "kunjungan" ? 'active' : '') ?>"><i class="lnr lnr-wheelchair"></i> <span>Pasien</span></a></li>

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
				<?php
					}

					elseif ($_SESSION['level'] == 'Kasir') { ?>

				<?php
					}
					elseif ($_SESSION['level'] == 'Apoteker') {
				?>
						<li><a href="../dashboard/dashboard.php" class="<?php echo ($nav == "dashboard" ? 'active' : '') ?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<li>
							<a href="#subPages" data-toggle="collapse" class="<?php echo ($nav == "obat" ? 'active' : '') ?>"><i class="fa fa-medkit"></i><span>Obat</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
							<div id="subPages" class="collapse">
								<ul class="nav">
									<li><a href="../obat/kategori_obat.php" class="">Kategori Obat</a></li>
									<li><a href="../obat/satuan_obat.php" class="">Satuan Obat</a></li>
									<li><a href="../obat/data_obat.php" class="">List Obat</a></li>
								</ul>
							</div>
						</li>
				<?php
					}
 				?>

					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
