<?php
ini_set('display_errors',0);
require_once "config/koneksi.php";

//ambil parameter
$idJenisCuti = $_POST['idJenisCuti'];
$nik=$_POST['nik'];

if($idJenisCuti == ''){
	exit;
}else{
	$sql = "SELECT * FROM periode_cuti WHERE kd_jcuti = '$idJenisCuti'";
	//$getPeriode = mysql_query($sql,$conn) or die ('Query Gagal');
	$h=mysql_query($sql);
	while($data = mysql_fetch_array($h)){
		echo '<option value="'.$data['kd_jcuti'].'">'.$data['nik'].' ( '.$data['awalcuti'].' s/d '.$data['akhircuti'].' )</option>';
	}
	exit;
}
?>
