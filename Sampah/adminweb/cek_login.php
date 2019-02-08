<?php
include "../config/koneksi.php";

$pass=md5($_POST['password']);

$login=mysql_query("SELECT user.*,pegawai.nama FROM user inner join pegawai on user.nip=pegawai.nip WHERE user.nip='$_POST[username]' AND user.password='$pass' AND status='Y'");

$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){

	session_start();
	$_SESSION[namauser] = $r[nip];
	$_SESSION[passuser] = $r[password];
	$_SESSION[leveluser]= $r[level];
	$_SESSION[nama]= $r[nama];

	if($_SESSION[leveluser]==ADMIN){
		header('location:media.php?module=home');
	} else if($_SESSION[leveluser]==STAFF){
		header('location:media.php?module=home');
	} if($_SESSION[leveluser]==KEPALA){
		header('location:media.php?module=home');
	} if($_SESSION[leveluser]==KADIS){
		header('location:media.php?module=home');
	} if($_SESSION[leveluser]==PEGAWAI){
		header('location:media.php?module=home');
	}
}

else{
	include "error-login.php";
}

?>

