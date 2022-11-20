<?php
require 'function.php';
//cek apakah tombol submit sudah di tekan atau belum
    if(isset($_POST['submit'])) {
        if(tambah($_POST) > 0 ) {
            echo "
            <script>
            alert('data berhasil di tambahkan!');
            document.location.href = 'index.php';
            </script>";
        } else {
            echo "
            <script>
            alert('data gagal di tambahkan!');
            document.location.href = 'index.php';
            </script>";
        }
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>tambah data mahasiswa</title>
</head>
<body>
    <h1>tambah data mahasiswa</h1>
    <form enctype="multipart/form-data" method="POST">
    <ul>
        <li>
            <label for="nrp">nrp : </label>
            <input type="text" name="nrp" id="nrp" required>
        </li>
        <li>
        <label for="nama">nama : </label>
            <input type="text" name="nama" id="nama" required>
            </li>
        <li>
        <label for="email">email : </label>
            <input type="text" name="email" id="email" required>
        </li>
        <li>
        <label for="jurusan">jurusan : </label>
            <input type="text" name="jurusan" id="jurusan" required>
        </li>
        <li>
        <label for="gambar">gambar : </label> <br>
        <img src="img/<?= $mhs['gambar']; ?>" width="100"> <br>
            <input type="file" name="gambar" id="gambar" required>
        </li>
        <li>
            <button type="submit" name="submit">tambah data</button>
        </li>
        </form>
    </ul>
</body>
</html>