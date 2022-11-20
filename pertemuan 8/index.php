<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

//ambil data dari database mahasiswa/query data mahasiswa
$result = mysqli_query($conn, "select * from mahasiswa");
//ambil data (fetch) dari mahasiswa dari object result
//mysqli_fetch_row() // mengembalikan array numerik
//mysqli_fetch_assoc() // mengembalikan array assoacitive
//mysqli_fetch_array() // mengembalikan keduanya
//mysqli_fetch_object()

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>halaman admin</title>
</head>
    <h1>daftar mahasiswa</h1>
<body>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>no.</th>
            <th>aksi</th>
            <th>gambar</th>
            <th>nrp</th>
            <th>nama</th>
            <th>email</th>
            <th>jurusan</th>
        </tr>
        
        <?php while( $row = mysqli_fetch_assoc($result) ) : ?>
        <tr>
            <td>1</td>
            <td> 
            <a href="">ubah</a> | 
            <a href="">hapus</a> 
            </td>
        <td>
            <img src="http://localhost/phpdasar/pertemuan%208/img/bg2.jpg" width="100" height="100"/>
        </td>
        <td>0864515</td>
        <td>ikbal</td>
        <td>ikbaljmbd@gmail.com</td>
        <td>sistem informasi</td>

        </tr>
        <?php endwhile; ?>
    </table>
</body>

</html>