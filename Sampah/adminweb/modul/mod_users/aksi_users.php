<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";

$module=$_GET[module];
$act=$_GET[act];

// Menghapus data
if (isset($module) AND $act=='hapus'){
  mysql_query("DELETE FROM ".$module." WHERE id_".$module."='$_GET[id]'");
  header('location:media.php?module='.$module);
}


// Input user
if ($module=='user' AND $act=='input'){
	
	$s = "SELECT * FROM user WHERE nip='$_POST[nip]'";
	$s1 = mysql_query($s);
		if (mysql_num_rows($s1) > 0)
		{
		 header('location:../../media.php?erru');
         exit();
        }

  $pass=md5($_POST[password]);
  mysql_query("INSERT INTO user (nip,
                                 password,
                                 level) 
	                       VALUES('$_POST[nip]',
                                '$pass',
                                '$_POST[level]')");
  header('location:../../media.php?module='.$module);
}

// Update user
elseif ($module=='user' AND $act=='update'){
//	$s = "SELECT * FROM user WHERE user.level='KADIS'";
//	$s1 = mysql_query($s);
//		if (mysql_num_rows($s1) > 1)
//		{
//		 header('location:../../media.php?erru');
 //        exit();
 //       }
  // Apabila password tidak diubah
  if (empty($_POST[password])) {
    mysql_query("UPDATE user SET nip         = '$_POST[nip]',
                                    status    = '$_POST[blokir]',
									level    = '$_POST[level]'
                           WHERE id_user     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST[password]);
    mysql_query("UPDATE user SET nip         = '$_POST[nip]',
                                 password    = '$pass',
                                 status    = '$_POST[blokir]',
								 level       = '$_POST[level]'
                           WHERE id_user     = '$_POST[id]'");
  }
  header('location:../../media.php?module='.$module);
}

elseif($module=='user' AND $act=='pwd' ){
	$pass1=md5($_POST[pl]);
	$cek=mysql_query("select * from user where nip='$_POST[nip]' and password='$pass1' ");
	if(mysql_num_rows($cek)==0){
	echo "<script>alert('Gagal ganti password !! pasword lama salah ! ');window.location.href='../../media.php?module=datapribadi&id=$_POST[nip]';</script>";
	} else {
		$pass=md5($_POST[pb]);
		mysql_query("update user set password='$pass' where nip='$_POST[nip]'");
		echo "<script>alert('Password sukses diubah !!');window.location.href='../../media.php?module=datapribadi&id=$_POST[nip]';</script>";
	}
}
}
?>
