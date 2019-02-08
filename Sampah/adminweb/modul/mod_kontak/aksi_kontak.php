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

// Update Kontak
if ($module=='kontak' AND $act=='update'){
  mysql_query("UPDATE kontak SET alamat        = '$_POST[alamat]',
                                 telp  = '$_POST[telp]',
                                 email      = '$_POST[email]', 
								 fax      = '$_POST[fax]' 
                           WHERE id_kontak   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
