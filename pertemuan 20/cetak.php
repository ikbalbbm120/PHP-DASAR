<?php
require_once __DIR__ . '/vendor/autoload.php';
require 'function.php';
$mahasiswa = query("SELECT * from mahasiswa");
$mpdf = new \Mpdf\Mpdf();

$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar mahasiswa</title>
    </head>
<body>
    <h1>Daftar mahasiswa</h1>
    <table border="1" cellpadding="10" cellspacing="0">
			<tr>
				<th>No.</th>
				<th>Gambar</th>
				<th>NRP</th>
				<th>Nama</th>
				<th>Email</th>
				<th>Jurusan</th>
			</tr>';
            $i = 1;
foreach($mahasiswa as $row) {
    $html .= '<tr>
    <td>'.$i++.'</td>
    <td><img src="img/'.$row["gambar"] .'" width="50"></td>
    <td>'.$row["nrp"].'</td>
    <td>'.$row["nama"].'</td>
    <td>'.$row["email"].'</td>
    <td>'.$row["jurusan"].'</td>
    </tr>';
}
$html .='</table>
</body>
</html>';



$mpdf->WriteHTML($html);
$mpdf->Output('daftar-mahasiswa.pdf', 'I');
?>