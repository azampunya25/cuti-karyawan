<?php
include "config/koneksi.php";

if ($_SESSION[leveluser]=='admin'){
  $sql=mysql_query("select * from modul where aktif='Y' order by urutan");
}
elseif ($_SESSION[leveluser]=='karyawan'){
  $sql=mysql_query("select * from modul where status='karyawan' and aktif='Y' order by urutan");
}
else{
while ($data=mysql_fetch_array($sql)){
  echo "<li><a href='$data[link]'>&#187; $data[nama_modul]</a></li>";
}
?>