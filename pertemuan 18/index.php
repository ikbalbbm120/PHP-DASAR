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
</head>

<body>

	<h1>Daftar Mahasiswa</h1>

	<a href="tambah.php">Tambah data mahasiswa</a>
	<a href="logout.php">Logout</a>
	<br><br>

	<form action="" method="post">

		<input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian.." autocomplete="off" id="keyword">
		<button type="submit" name="cari" id="tombol-cari">Cari!</buttonitu>

	</form>
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
	<script src="js/script.js"></script>
</body>

</html