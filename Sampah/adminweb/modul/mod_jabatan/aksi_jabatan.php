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

// Hapus Jabatan
if ($module=='jabatan' AND $act=='hapus'){
  mysql_query("DELETE FROM jabatan WHERE id_jabatan='$_GET[id]'");
  echo"<meta http-equiv=refresh content=0;URL='../../media.php?module=$module'>";
  	echo"<script>alert('Data Berhasil Dihapus');</script>";
	exit;
}

// Input Jabatan
elseif ($module=='jabatan' AND $act=='input'){
  mysql_query("INSERT INTO jabatan(id_jabatan,nm_jabatan,keterangan) 
					                VALUES('$_POST[id_jabatan]','$_POST[nm_jabatan]','$_POST[keterangan]')");
  echo"<meta http-equiv=refresh content=0;URL='../../media.php?module=$module'>";
  	echo"<script>alert('Data Berhasil Ditambah');</script>";
	exit;
}

// Update Jabatan
elseif ($module=='jabatan' AND $act=='update'){
  mysql_query("UPDATE jabatan SET id_jabatan        = '$_POST[id_jabatan]',
                                 nm_jabatan  = '$_POST[nm_jabatan]',
                                 keterangan      = '$_POST[keterangan]'  
                           WHERE id_jabatan   = '$_POST[id]'");
  echo"<meta http-equiv=refresh content=0;URL='../../media.php?module=$module'>";
  	echo"<script>alert('Data Berhasil Ubah');</script>";
	exit;
}
}
?>
