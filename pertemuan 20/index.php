<?php
session_start();
if (!isset($_SESSION["login"])) {
	header("Location: login.php");
	exit;
}
require 'function.php';
//pagination
//konfigurasi
$jumlahdataperhalaman = 2;
$result = mysqli_query($conn, "select * from mahasiswa");
$jumlahdata = mysqli_num_rows($result);
$jumlahhalaman = $jumlahdata / $jumlahdataperhalaman;
$halamanaktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awaldata = ($jumlahdataperhalaman * $halamanaktif) - $jumlahdataperhalaman;
$mahasiswa = query("SELECT * FROM mahasiswa LIMIT $awaldata, $jumlahdataperhalaman");
// tombol cari ditekan
if (isset($_POST["cari"])) {
	$mahasiswa = cari($_POST["keyword"]);
}

?>
<!DOCTYPE html>
<html>

<head>
	<title>Halaman Admin</title>
	<style>
		.loader {
			width: 100px;
			position: absolute;
			top: 100px;
			display: none;
		}
		@media print {
			.logout, .tambah, .from-cari, .navigasi {
				display: none;

			}
		}
	</style>
</head>

<body>
	<a href="logout.php" class="logout">Logout</a> | <a href="cetak.php" target="_blank">cetak</a>
	<h1>Daftar Mahasiswa</h1>
	<a href="tambah.php" class="tambah">Tambah data mahasiswa</a>
	<br><br>

	<form action="" method="post" class="from-cari">

		<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
		<button type="submit" name="cari" id="tombol-cari">Cari!</button>
	<img src="img/loader.gif" class="loader">
	</form>
	<div class="navigasi">
	<Br></Br>
	<!--navigasi-->
	<?php if ($halamanaktif > 1) : ?>
		<a href="?halaman=<?= $halamanaktif - 1; ?>">&laquo;</a>
	<?php endif; ?>
	<?php for ($i = 1; $i <= $jumlahhalaman; $i++) : ?>
		<?php if ($i == $halamanaktif) : ?>
			<a href="?halaman=<?= $i; ?>" style="font-weight:bold; color:aqua;"><?= $i; ?></a>
		<?php else : ?>
			<a href="?halaman=<?= $i; ?>"><?= $i; ?></a>
		<?php endif; ?>
	<?php endfor; ?>
	<?php if ($halamanaktif < $jumlahhalaman) : ?>
		<a href="?halaman=<?= $halamanaktif + 1; ?>">&raquo;</a>
	<?php endif; ?>
	</div>
	<br>
	<div id="container">
		<table border="1" cellpadding="10" cellspacing="0">
			<tr>
				<th>No.</th>
				<th>Aksi</th>
				<th>Gambar</th>
				<th>NRP</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Jurusan</th>
			</tr>
			<?php $i = 1; ?>
			<?php foreach ($mahasiswa as $row) : ?>
				<tr>
					<td><?= $i; ?></td>
					<td>
						<a href="ubah.php?id=<?= $row["id"]; ?>">ubah</a> |
						<a href="hapus.php?id=<?= $row["id"]; ?>" onclick="return confirm('yakin?');">hapus</a>
					</td>
					<td><img src="img/<?= $row["gambar"] ?>" width="100" height="100">
					</td>
					<td><?= $row["nrp"]; ?></td>
					<td><?= $row["nama"]; ?></td>
					<td><?= $row["email"]; ?></td>
					<td><?= $row["jurusan"]; ?></td>
				</tr>
				<?php $i++; ?>
			<?php endforeach; ?>

		</table>
	</div>
	<script src="js/jquery.js"></script>
	<script src="js/script.js"></script>
</body>

</html