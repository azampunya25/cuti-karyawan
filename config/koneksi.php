<?php
$server = "127.0.0.1:3307";
$username = "root";
$password = "";
$database = "rumacsnc_cuti";

// Koneksi dan memilih database di server
$conn=mysql_connect($server, $username, $password);

mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
