<?php
	include "koneksi.php";
	


//-----------------------------------------------------------------------------------//
if (isset($_GET['ia'])) {
	$ia=$_GET['ia'];

$sql= mysql_query("delete from berita where id_berita = $ia ");
if ($sql){
echo "<script> alert ('Data berhasil dihapus.');
history.go(-1)</script>";

} else {
echo "<script>alert('Gagal'); history.go(-1)</script>";
}
}
//-----------------------------------------------------------------------------------//
if (isset($_GET['ga'])) {
	$ga=$_GET['ga'];

$sql= mysql_query("delete from galeri where id = $ga ");
if ($sql){
echo "<script> alert ('Data berhasil dihapus.');
history.go(-1)</script>";

} else {
echo "<script>alert('Gagal'); history.go(-1)</script>";
}
}

//-----------------------------------------------------------------------------------//
if (isset($_GET['bt'])) {
	$bt=$_GET['bt'];

$sql= mysql_query("delete from pesan where id_pesan = $bt ");
if ($sql){
echo "<script> alert ('Data berhasil dihapus.');
history.go(-1)</script>";

} else {
echo "<script>alert('Gagal'); history.go(-1)</script>";
}
}
//-----------------------------------------------------------------------------------//

//-----------------------------------------------------------------------------------//
if (isset($_GET['pd'])) {
	$pd=$_GET['pd'];

$sql= mysql_query("delete from anggota where id_anggota = $pd ");
if ($sql){
echo "<script> alert ('Data berhasil dihapus.');
history.go(-1)</script>";

} else {
echo "<script>alert('Gagal'); history.go(-1)</script>";
}
}
//-----------------------------------------------------------------------------------//

//-----------------------------------------------------------------------------------//
if (isset($_GET['fr'])) {
	$fr=$_GET['fr'];

$sql= mysql_query("delete from formulir  where id_form = $fr ");
if ($sql){
echo "<script> alert ('Data berhasil dihapus.');
history.go(-1)</script>";

} else {
echo "<script>alert('Gagal'); history.go(-1)</script>";
}
}
//-----------------------------------------------------------------------------------//

//-----------------------------------------------------------------------------------//
if (isset($_GET['i'])) {
	$i=$_GET['i'];

$sql= mysql_query("delete from  where id_ = $i ");
if ($sql){
echo "<script> alert ('Data berhasil dihapus.');
history.go(-1)</script>";

} else {
echo "<script>alert('Gagal'); history.go(-1)</script>";
}
}
//-----------------------------------------------------------------------------------//

?>


	
 