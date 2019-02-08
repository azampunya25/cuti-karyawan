<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];
// Hapus unit
if ($module=='unit' AND $act=='hapus'){
  mysql_query("DELETE FROM unitkerja WHERE id_unit='$_GET[id]'");
  echo"<meta http-equiv=refresh content=0;URL='../../media.php?module=$module'>";
  	echo"<script>alert('Data Berhasil Dihapus');</script>";
	exit;
}

// Input unit
elseif ($module=='unit' AND $act=='input'){
  mysql_query("INSERT INTO unitkerja(id_unit,id_bagian,nm_unit) VALUES('$_POST[id_unit]','$_POST[id_bagian]','$_POST[nm_unit]')");
  echo"<meta http-equiv=refresh content=0;URL='../../media.php?module=$module'>";
  	echo"<script>alert('Data Berhasil Ditambah');</script>";
	exit;
}

// Update unit
elseif ($module=='unit' AND $act=='update'){
  mysql_query("UPDATE unitkerja SET id_unit        = '$_POST[id_unit]',
									nm_unit  = '$_POST[nm_unit]'  
									WHERE id_unit   = '$_POST[id]'");
  echo"<meta http-equiv=refresh content=0;URL='../../media.php?module=$module'>";
  	echo"<script>alert('Data Berhasil Ubah');</script>";
	exit;
}
}
?>
