<?php
//array associative
//definisinya sama seperti array numerik,kecuali
//key-nya adalah string yang kita buat sendiri
$mahasiswa = [
    [
    "nama" =>  "ikbal",
    "nrp" => "03020908717",
    "email" => "ikbalpler@gmail.com",
    "jurusan" => "sistem infoormasi",
    ],
[
    "nama" =>  "jembud",
    "nrp" => "03020908717",
    "email" => "jembudngenntot@gmail.com",
    "jurusan" => "sistem infoormasi",
]
];
echo $mahasiswa[1]["email"];
?>