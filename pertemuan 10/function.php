<?php
//koneksi ke database 
$conn = mysqli_connect("localhost", "root", "", "phpdasar");

function query($query) {
    global $conn;
$result = mysqli_query($conn, $query);
$rows = [];
while( $row = mysqli_fetch_assoc($result) ) {
$rows[] = $row;
}
return $rows;

}

function tambah($data) {
global $conn;

$nrp = htmlspecialchars($data["nrp"]);
$nama = htmlspecialchars($data["nama"]);
$email = htmlspecialchars($data["email"]);
$jurusan = htmlspecialchars($data["jurusan"]);
$gambar = htmlspecialchars($data["gambar"]);
$query = "insert into mahasiswa values ('', '$nrp', '$nama', '$email', '$jurusan', '$gambar')";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);
}

function hapus($id) {
    global $conn;
    mysqli_query($conn,"delete from mahasiswa where id = $id");
    return mysqli_affected_rows($conn);
}

function update ($id, $data) {
    global $conn;

$nrp = htmlspecialchars($data["nrp"]);
$nama = htmlspecialchars($data["nama"]);
$email = htmlspecialchars($data["email"]);
$jurusan = htmlspecialchars($data["jurusan"]);
$gambar = htmlspecialchars($data["gambar"]);

$query = "update mahasiswa set 
    nrp = '$nrp',
    nama ='$nama',
    email = '$email', 
    jurusan = '$jurusan', 
    gambar = '$gambar' 
where id = $id";
mysqli_query($conn, $query);

return mysqli_affected_rows($conn);

}

?>