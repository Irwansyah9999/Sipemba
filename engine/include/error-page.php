<?php
	$view = new View();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $view->getHeading() ?> Halaman tidak ditemukan</title>
    <link rel="stylesheet" href="<?= $view->url('engine/css/cb.css') ?>">
    <link rel="stylesheet" href="<?= $view->url('engine/css/anythink.css') ?>">
</head>
<body>
	<!-- container -->
	<div class="container">
		<!-- navigasi side left block -->
		<nav class="nav-side bg-black" id="side-menu">
				<button type="button" class="btn-lg bg-black float-right" id="close-side">&times;</button>

				<br>
				<br>
				<div id="profile">
					<center><div id="sub-profile" class="bd-radius-arround"></div></center>
				</div>
			
			<ol id="mn" class="over-y">
				<?php
					switch ($view->getSession('akses')) {
						case 'admin':
							?>
							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Admin/')?>">ADMIN</a></span></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Guru/')?>">GURU</a></span></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Mata-pelajaran/')?>">MATA PELAJARAN</a></span></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Santri/')?>">SANTRI</a></span></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Tahun-ajaran/')?>">TAHUN AJARAN</a></span></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Tingkat/')?>">TINGKAT</a></span></li>

							<li class="nav-li"><hr></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Jadwal-pelajaran/')?>">JADWAL PELAJARAN</a></span></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Nilai/')?>">NILAI</a></span></li>

							<li class="nav-li"><hr></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('User-profile/')?>">USER PROFILE</a></span></li>
							<?php
							break;
						case 'guru':
							?>
							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Santri/')?>">SANTRI</a></span></li>
							
							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Mata-pelajaran/')?>">MATA PELAJARAN</a></span></li>
					
							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Tingkat/')?>">TINGKAT</a></span></li>
					
							<li class="nav-li"><hr></li>
					
							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Jadwal-pelajaran/')?>">JADWAL PELAJARAN</a></span></li>
							
							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Nilai/')?>">NILAI</a></span></li>
					
							<li class="nav-li"><hr></li>
					
							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('User-profile/')?>">USER PROFILE</a></span></li>

							<?php
							break;
						case 'santri':
							?>
							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Mata-pelajaran/')?>">MATA PELAJARAN</a></span></li>

							<li class="nav-li"><hr></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Jadwal-pelajaran/')?>">JADWAL PELAJARAN</a></span></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('Nilai/')?>">NILAI</a></span></li>

							<li class="nav-li"><hr></li>

							<li class="nav-li"><span>O <a class="nav-a" href="<?= $view->url('User-profile/')?>">USER PROFILE</a></span></li>

							<?php
							break;
						default:
							
							break;
					}
				?>
				


			</ol>
		</nav>

		<!-- side konten -->
		<section id="side-content">

			<!-- nav inline-block -->
			<nav class="nav bg-black">
				<div class="nav-brand">
					<a href="<?= $view->url('')?>">
						<img src="<?= $view->url('engine/img/ponpes/logo.jpg') ?>" class="bd-radius-arround">
					</a>
				</div>

				<ol class="nav-navi">
					<li class="nav-li"><a class="nav-a" href="<?= $view->url('pencarian.php')?>">PENCARIAN</a></li>
				</ol>
				<ol class="nav-navi-right">
					<?php
						if($view->getSession('akses') != ''){ ?>
							<li class="nav-li"><a class="nav-a" href="">Notif</a></li>
							<li class="nav-li"><a class="nav-a" href="">Pesan</a></li>
						<?php
						}
					?>

					<li class="nav-li"><a class="nav-a"  href="">Tentang Kami</a></li>
					<li class="nav-li"><a class="nav-a"  href="">Kontak</a></li>
					
					<?php if($view->getSession('akses') != ''){ ?>
						<li class="nav-li"><span>O <a class="nav-a" href="javascript:confirmation('Apakah anda yakin','<?= $view->url('Login/aksi/logout.php')?>');">LOG OUT</a></span></li>
					<?php } ?>
				</ol>
			</nav>

			<!-- konten  -->
			<div class="offset-5pc-480px mg-top-10px">
				<div class="row">
					<h1>Halaman tidak ditemukan</h1>
				</div>

				<div class="row bd-thin bd-radius-5px">
					Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
					quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
					consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
					cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
					proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
				</div>
			</div>
			<!-- end konten -->
		</section>

	</div>
	<!-- end container -->
	<footer>
        Powered by Coding Bae
    </footer>

</body>
<script src="<?= $view->url('engine/js/cb.js') ?>" type="text/javascript"></script>
<script src="<?= $view->url('engine/js/anythink.js') ?>" type="text/javascript"></script>

<script type="text/javascript">
	addCssWithId('sub-santri',{
		display:"none"
	});

	clickDisplayV2('mn-santri','sub-santri','block');

	addCssWithId('sub-siswa',{
		display:"none"
	});

	clickDisplayV2('mn-siswa','sub-siswa','block');

</script>
</html>