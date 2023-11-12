<?php
$server = "127.0.0.1:3306";
$username = "root";
$password = "root@123";
$database = "dbcuti";

// Koneksi dan memilih database di server
// $conn=mysql_connect($server, $username, $password);

// mysql_connect($server,$username,$password) or die("Koneksi gagal");
// mysql_select_db($database) or die("Database tidak bisa dibuka");

$mysqli = new mysqli($server, $username, $password, $database);

mysqli_connect($server,$username,$password) or die("Koneksi gagal");
mysqli_select_db($mysqli, $database) or die("Database tidak bisa dibuka");
?>