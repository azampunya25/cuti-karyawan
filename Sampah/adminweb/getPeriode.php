<?php
ini_set('display_errors',0);
require_once "../config/koneksi.php";

//ambil parameter
$idJenisCuti = $_POST['idJenisCuti'];
$nip=$_POST['nip'];

if($idJenisCuti == ''){
	exit;
}else{
	$sql = "SELECT * FROM periode_cuti WHERE id_jcuti = '$idJenisCuti'";
	//$getPeriode = mysql_query($sql,$conn) or die ('Query Gagal');
	$h=mysql_query($sql);
	while($data = mysql_fetch_array($h)){
		echo '<option value="'.$data['id_jcuti'].'">'.$data['nip'].' ( '.$data['awalcuti'].' s/d '.$data['akhircuti'].' )</option>';
	}
	exit;
}
?>
