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

// Hapus Periode
if ($module=='periode' AND $act=='hapus'){
  mysql_query("DELETE FROM periode_cuti WHERE id_periode_cuti ='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input Periode
elseif ($module=='periode' AND $act=='input'){
		$thn=date("Y");
  mysql_query("INSERT INTO periode_cuti(nip,id_jcuti,tahun,awalcuti,akhircuti)
              VALUES('$_POST[nip]','$_POST[id_jcuti]','$_POST[thn]','$_POST[awalcuti]','$_POST[akhircuti]')");
  header('location:../../media.php?module='.$module);
}

// Update Periode
elseif ($module=='periode' AND $act=='update'){
		$thn=date("Y");
  mysql_query("UPDATE periode_cuti SET tahun='$_POST[tahun]',
 									awalcuti='$_POST[awalcuti]',
                                    akhircuti='$_POST[akhircuti]'
                                    WHERE id_periode_cuti='$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
