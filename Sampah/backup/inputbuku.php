<?php
session_start();
include "config/koneksi.php";
include "config/library.php";
include "config/fungsi_badword.php";


$nama=trim($_POST['nama']);
$bukutamu=trim($_POST['isi_bukutamu']);

if (empty($nama)){
  echo "Anda belum mengisikan NAMA<br/>
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (empty($bukutamu)){
  echo "Anda belum mengisikan BUKU TAMU<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
elseif (strlen($_POST['isi_bukutamu']) > 1000) {
  echo "ISI BUKU TAMU Anda kepanjangan, dikurangin atau dibagi jadi beberapa bagian.<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
}
else{
function antiinjection($data){
  $filter_sql = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter_sql;
}

$nama = antiinjection($_POST['nama']);
$email = antiinjection($_POST['email']);
$isi_bukutamu = antiinjection($_POST['isi_bukutamu']);

if(!empty($email)){
$regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/'; 
if (!preg_match($regex, $email)) {
 echo "Format E-Mail yang dimasukkan salah.<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b>";
		  exit;
}
}

	if(!empty($_POST['kode'])){
		if($_POST['kode']==$_SESSION['captcha_session']){

// Mengatasi input komentar tanpa spasi
$split_text = explode(" ",$isi_bukutamu);
$split_count = count($split_text);
$max = 57;

for($i = 0; $i <= $split_count; $i++){
if(strlen($split_text[$i]) >= $max){
for($j = 0; $j <= strlen($split_text[$i]); $j++){
$char[$j] = substr($split_text[$i],$j,1);
if(($j % $max == 0) && ($j != 0)){
  $v_text .= $char[$j] . ' ';
}else{
  $v_text .= $char[$j];
}
}
}else{
  $v_text .= " " . $split_text[$i] . " ";
}
}

    $sql = mysql_query("INSERT INTO buku_tamu(nama,email,isi_bukutamu, hari, tgl, jam) 
                        VALUES('$nama','$email','$v_text', '$hari_ini', '$tgl_sekarang','$jam_sekarang')");

    echo "<meta http-equiv='refresh' content='0; url=home.php?module=bukutamu'>";
		}else{
			echo "Kode yang Anda masukkan tidak cocok<br />
			      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
		}
	}else{
		echo "Anda belum memasukkan kode<br />
  	      <a href=javascript:history.go(-1)><b>Ulangi Lagi</b></a>";
	}
}

?>
