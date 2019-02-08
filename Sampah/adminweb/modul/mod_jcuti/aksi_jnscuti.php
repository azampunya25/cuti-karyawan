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

// Hapus Jenis Cuti
if ($module=='jnscuti' AND $act=='hapus'){
  mysql_query("DELETE FROM jns_cuti WHERE id_jcuti='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input Jenis Cuti
elseif ($module=='jnscuti' AND $act=='input'){
	$s = "SELECT * FROM jns_cuti WHERE id_jcuti='$_POST[id_jcuti]'";
	$s1 = mysql_query($s);
		if (mysql_num_rows($s1) > 0)
		{
		 //header('location:media.php?err&module='.$module);
		 header('location:../../media.php?errjc');
         exit();
        }
  mysql_query("INSERT INTO jns_cuti(id_jcuti,nm_jcuti,lama_jcuti,keterangan) 
					                VALUES('$_POST[id_jcuti]','$_POST[nm_jcuti]','$_POST[lama_jcuti]','$_POST[keterangan]')");
  header('location:../../media.php?module='.$module);
}

// Update Jenis Cuti
elseif ($module=='jnscuti' AND $act=='update'){
  mysql_query("UPDATE jns_cuti SET id_jcuti        = '$_POST[id_jcuti]',
                                 nm_jcuti  = '$_POST[nm_jcuti]',
								 lama_jcuti  = '$_POST[lama_jcuti]',
                                 keterangan      = '$_POST[keterangan]'  
                           WHERE id_jcuti   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
