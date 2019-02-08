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

// Hapus Golongan
if ($module=='golongan' AND $act=='hapus'){
  mysql_query("DELETE FROM golongan WHERE id_gol='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input Golongan
elseif ($module=='golongan' AND $act=='input'){
	//	$cekdata="select id_gol from golongan where id_gol='$_POST[id_gol]'"; 
	///	$ada=mysql_query($cekdata) or die(mysql_error()); 
	//	if(mysql_num_rows($ada)>0) { 
	//	echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');</script>"; } else {
	//	$query="INSERT INTO golongan(id_gol,nm_pangkat,nm_gol,ruang) 
	//				                VALUES('$_POST[id_gol]','$_POST[nm_pangkat]','$_POST[nm_gol]','$_POST[ruang]')";
  mysql_query("INSERT INTO golongan(id_gol,nm_pangkat,nm_gol,ruang) 
				                VALUES('$_POST[id_gol]','$_POST[nm_pangkat]','$_POST[nm_gol]','$_POST[ruang]')");
	//	mysql_query($query) or die("Gagal menyimpan data karena : ($query)").mysql_error();
  header('location:../../media.php?module='.$module);
}

// Update Golongan
elseif ($module=='golongan' AND $act=='update'){
  mysql_query("UPDATE golongan SET id_gol        = '$_POST[id_gol]',
                                 nm_pangkat  = '$_POST[nm_pangkat]',
                                 nm_gol      = '$_POST[nm_gol]',
								 ruang      = '$_POST[ruang]'  
                           WHERE id_gol   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
