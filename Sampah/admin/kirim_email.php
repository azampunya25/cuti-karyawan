
<?php

include "koneksi.php";
$sql=mysql_query("select * from anggota where id_anggota='$_GET[id]'");
$s=mysql_fetch_array($sql);

$kode=$s['kode'];

$to = $s['email'];
$subject = "My subject";
$txt = "Kode Verifikasi anda ". $kode;
$headers = "From: radioamor@contoh.com" . "\r\n" .
"CC: somebodyelse@example.com";

@mail($to,$subject,$txt,$headers);
if(@mail)
{
    mysql_query("update anggota set status='Y' where id_anggota='$_GET[id]'");	
    echo "<script>alert('Email sent successfully !!'); history.go(-1)</script>";
}
?>