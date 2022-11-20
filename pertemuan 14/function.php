<?php
// koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "phpdasar");


function query($query)
{
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	return $rows;
}


function tambah($data)
{
	global $conn;

	$nrp = htmlspecialchars($data["nrp"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);
	$gambar = '';

	if (isset($_FILES['gambar'])) {
		$gambar = uploadPhoto($_FILES['gambar']);
	}

	$query = "INSERT INTO mahasiswa
				VALUES
			('', '$nrp', '$nama', '$email', '$jurusan', '$gambar')
			";
	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function hapus($id)
{
	global $conn;
	mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = $id");
	return mysqli_affected_rows($conn);
}


function ubah($data)
{
	global $conn;

	$id = $data['id'];
	$nrp = htmlspecialchars($data["nrp"]);
	$nama = htmlspecialchars($data["nama"]);
	$email = htmlspecialchars($data["email"]);
	$jurusan = htmlspecialchars($data["jurusan"]);


	// cek apakah user pilih gambar baru atau tidak
	// if ($_FILES['gambar']['error'] === 4) {
	// 	$gambar = htmlspecialchars($data["gambarlama"]);
	// } else {
	// 	$gambar = uploadPhoto($_FILES['gambar']);
	// }

	if (isset($_FILES['gambar'])) {
		$gambar = uploadPhoto($_FILES['gambar']);
	} else {
		$gambar = htmlspecialchars($data["gambarlama"]);
	}


	$query = "UPDATE mahasiswa SET
				nrp = '$nrp',
				nama = '$nama',
				email = '$email',
				jurusan = '$jurusan',
				gambar = '$gambar'
			    WHERE id = '$id'
			";

	mysqli_query($conn, $query);

	return mysqli_affected_rows($conn);
}


function cari($keyword)
{
	$query = "SELECT * FROM mahasiswa
				WHERE
			nama LIKE '%$keyword%' OR
			nrp LIKE '%$keyword%' OR
			email LIKE '%$keyword%' OR
			jurusan LIKE '%$keyword%'
			";
	return query($query);
}

function uploadPhoto($file, $allowed = ['jpg', 'jpeg', 'png'])
{
	$name = $file['name'];
	$size = $file['size'];
	$error = $file['error'];
	$tmp_name = $file['tmp_name'];

	if ($error === 4) {
		echo "<script>alert('Foto wajib diisi!');</script>";
		return false;
	}

	$ext = explode('.', $name);
	if (!in_array(strtolower(end($ext)), $allowed)) {
		echo "<script>alert('File yang diupload harus berupa gambar!');</script>";
		return false;
	}

	if ($size > 1000000) {
		echo "<script>alert('Ukuran gambar terlalu besar!');</script>";
		return false;
	}

	$newName = uniqid() . '.' . strtolower(end($ext));
	move_uploaded_file($tmp_name, 'img/' . $newName);

	return $newName;
}

function registrasi($data)
{
	global $conn;
	$email = strtolower(stripslashes($data["email"]));
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["password2"]);

	//cek username sudah ada atau belum
	$result = mysqli_query($conn, "select username from users where username = '$username'");
	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
		alert('username sudah terdaftar')
		</script>";
		return false;
	}

	//cek konfirmasi password
	if ($password != $password2) {
		echo "<script> alert('konfirmasi password tidak sesuai')</script>";
		return false;
	}
	//enskripsi password
	$password = password_hash($password, PASSWORD_DEFAULT);
	//tambahkan user baru ke databases
	mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password','$email')");
	return mysqli_affected_rows($conn);
}
