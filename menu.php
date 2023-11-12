<?php
include "config/koneksi.php";

if ($_SESSION['leveluser']=='admin'){
  $sql=mysqli_query($mysqli, "select * from modul where aktif='Y' order by urutan");
}
elseif ($_SESSION['leveluser']=='karyawan'){
  $sql=mysqli_query($mysqli, "select * from modul where status='karyawan' and aktif='Y' order by urutan");
}
else{
	$sql=mysqli_query($mysqli, "select * from modul where publish='N' order by urutan");
}
while ($data=mysqli_fetch_array($sql)){
  echo "<li><a href='$data[link]'>$data[nama_modul]</a></li>";
}
?>
