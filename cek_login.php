<?php
include "config/koneksi.php";
$pass=md5($_POST['password']);

$login=mysql_query("SELECT user.*,karyawan.nama FROM user inner join karyawan
on user.nik=karyawan.nik WHERE user.nik='$_POST[username]'
AND user.password='$pass'");

$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);
// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  //session_register("namauser");
  //session_register("passuser");
  //session_register("leveluser");
  //session_register("nama");

  $_SESSION['namauser'] = $r[nik];
  $_SESSION['passuser'] = $r[password];
  $_SESSION['leveluser']= $r[level];
  $_SESSION['nama']= $r[nama];
  //echo $r[nama];
  header('location:media.php?module=home');
}
else{
  echo "<link href=config/adminstyle.css rel=stylesheet type=text/css>";
  echo "<center>Login gagal! username & password tidak benar<br>";
  echo "<a href=index.php><b>ULANGI LAGI</b></a></center>";
}
?>
