<?php

// panggil fungsi validasi xss dan injection

require_once('fungsi_validasi.php');



// definisikan koneksi ke database

$server = "server226.web-hosting.com";

$username = "rumacsnc_rumahsoftwareit";

$password = "dukateuing";

$database = "rumacsnc_db_rumahsoftwareit";



// Koneksi dan memilih database di server

mysql_connect($server,$username,$password) or die("Koneksi gagal");

mysql_select_db($database) or die("Database tidak bisa dibuka");



// buat variabel untuk validasi dari file fungsi_validasi.php

$val = new Lokovalidasi;

?>

