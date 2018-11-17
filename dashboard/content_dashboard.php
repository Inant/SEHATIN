<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<div class="panel panel-headline">
						<div class="panel-heading">

							<h3 class="panel-title">Selamat Datang <?php echo $valnama['nama'];?></h3>
							<?php
								date_default_timezone_set("Asia/Jakarta");
							 ?>
							<p class="panel-subtitle">Tanggal : <?php echo date("d F Y"); ?> </p>
						</div>
						<div class="panel-body">
							<div class="row">
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="glyphicon glyphicon-user"></i></span>
										<p>
											<span class="number"> <?php echo(hitungJml("petugas","")) ?> </span>
											<span class="title">Petugas</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-wheelchair"></i></span>
										<p>
											<span class="number"><?php echo(hitungJml("pasien","")) ?></span>
											<span class="title">Pasien</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="fa fa-user-md"></i></span>
										<p>
											<span class="number"><?php echo(hitungJml("dokter","")) ?></span>
											<span class="title">Dokter</span>
										</p>
									</div>
								</div>
								<div class="col-md-3">
									<div class="metric">
										<span class="icon"><i class="lnr lnr-users"></i></span>
										<p>
											<span class="number"><?php echo ($jphi) ?></span>
											<span class="title">Pasien Hari Ini</span>
										</p>
									</div>
								</div>
							</div>

						</div>
					</div>
					<!-- END OVERVIEW -->




						</div>
					</div>
				</div>
			</div>
			<!-- END MAIN CONTENT -->

		<!-- END MAIN -->
