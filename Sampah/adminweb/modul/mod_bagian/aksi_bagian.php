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

// Hapus bagian
if ($module=='bagian' AND $act=='hapus'){
  mysql_query("DELETE FROM bagian WHERE id_bagian='$_GET[id]'");
  echo"<meta http-equiv=refresh content=0;URL='../../media.php?module=$module'>";
  	echo"<script>alert('Data Berhasil Dihapus');</script>";
	exit;
}

// Input bagian
elseif ($module=='bagian' AND $act=='input'){
			$s = "SELECT * FROM bagian WHERE id_bagian='$_POST[id_bagian]'";
	$s1 = mysql_query($s);
		if (mysql_num_rows($s1) > 0)
		{
		 //header('location:media.php?err&module='.$module);
		// header('location:../../media.php?errk');
		echo "<script>alert('maaf, data sudah ada!!');window.location.href='../../media.php?module=bagian';</script>";
         exit();
        }
  mysql_query("INSERT INTO bagian(id_bagian,nm_bagian) 
					                VALUES('$_POST[id_bagian]','$_POST[nm_bagian]')");
  echo"<meta http-equiv=refresh content=0;URL='../../media.php?module=$module'>";
  	echo"<script>alert('Data Berhasil Ditambah');</script>";
	exit;
}

// Update bagian
elseif ($module=='bagian' AND $act=='update'){
  mysql_query("UPDATE bagian SET id_bagian        = '$_POST[id_bagian]',
                                 nm_bagian  = '$_POST[nm_bagian]' 
                           WHERE id_bagian   = '$_POST[id]'");
  echo"<meta http-equiv=refresh content=0;URL='../../media.php?module=$module'>";
  	echo"<script>alert('Data Berhasil Ubah');</script>";
	exit;
}
}
?>
