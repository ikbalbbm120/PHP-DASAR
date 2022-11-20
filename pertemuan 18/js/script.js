//ambil elemen elemen yang di butuhkan
var keyword = document.getElementById('keyword');
var tombolcari = document.getElementById('tombol-cari');
var container = document.getElementById('container');

//tambahkan event ketika keyword di tulis
keyword.addEventListener('keyup',function() {
    //membuat objek ajax
    var xhr = new XMLHttpRequest();
    //cek kesiapan ajax
    xhr.onreadystatechange = function() {
        if(xhr.readyState == 4 && xhr.status == 200) {
            container.innerHTML = xhr.responseText;
        }
    }
    //eksekusi ajax
    xhr.open('POST', 'ajax/mahasiswa.php?keyword=' + keyword.value, true);
    xhr.send();
});