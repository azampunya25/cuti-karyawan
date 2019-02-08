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

// Hapus Hari Libur
if ($module=='libur' AND $act=='hapus'){
  mysql_query("DELETE FROM hari_libur WHERE id_hari_libur='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input Hari Libur
elseif ($module=='libur' AND $act=='input'){
	$s = "SELECT * FROM hari_libur WHERE tanggal='$_POST[tanggal]'";
	$s1 = mysql_query($s);
		if (mysql_num_rows($s1) > 0)
		{
		 //header('location:media.php?err&module='.$module);
		 header('location:../../media.php?errhr');
         exit();
        }
  mysql_query("INSERT INTO hari_libur(tanggal,
                                  keterangan) 
					                VALUES('$_POST[tanggal]',
                                 '$_POST[keterangan]')");
  header('location:../../media.php?module='.$module);
}

// Update Hari Libur
elseif ($module=='libur' AND $act=='update'){
  mysql_query("UPDATE hari_libur SET tanggal        = '$_POST[tanggal]', 
                                 keterangan    = '$_POST[keterangan]'  
                           WHERE id_hari_libur   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
