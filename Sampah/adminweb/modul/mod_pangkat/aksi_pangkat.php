<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus agenda
if ($module=='jabatan' AND $act=='hapus'){
  mysql_query("DELETE FROM jabatan WHERE id_jabatan='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input agenda
elseif ($module=='jabatan' AND $act=='input'){
  mysql_query("INSERT INTO jabatan(kd_jabatan,nm_jabatan,keterangan) 
					                VALUES('$_POST[kd_jabatan]','$_POST[nm_jabatan]','$_POST[keterangan]')");
  header('location:../../media.php?module='.$module);
}

// Update agenda
elseif ($module=='jabatan' AND $act=='update'){
  mysql_query("UPDATE jabatan SET kd_jabatan        = '$_POST[kd_jabatan]',
                                 nm_jabatan  = '$_POST[nm_jabatan]',
                                 keterangan      = '$_POST[keterangan]'  
                           WHERE id_jabatan   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
