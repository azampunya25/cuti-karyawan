<?php
$server = "server226.web-hosting.com";
$username = "rumacsnc_cuti";
$password = "dukateuing";
$database = "rumacsnc_cuti";

// Koneksi dan memilih database di server
$conn=mysql_connect($server, $username, $password);

mysql_connect($server,$username,$password) or die("Koneksi gagal");
mysql_select_db($database) or die("Database tidak bisa dibuka");
?>
