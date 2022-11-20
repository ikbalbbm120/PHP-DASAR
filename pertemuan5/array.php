<?php
//array
$hari = ["senin","selasa","rabu"];
$bulan = ["januari","februari","maret"];
//menampilkan array
// var_dump($hari);
// echo "<br>";
// print_r($bulan);

//menampilkan 1 elemen pada array
// echo "<br>";
// echo $hari[1];
// echo "<br>";
// echo $bulan[1];

//menambahkan elemen baru pada array
var_dump($hari);
$hari[] = "kamis";
echo "<br>";
var_dump($hari);

?>