<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

function JumMinggu($tgl_mulai,$tgl_akhir) {
$adaysec =24*3600;
$tgla= strtotime($tgl_mulai);
$tglb= strtotime($tgl_akhir);
$minggu=0;
for ($i=$tgla; $i < $tglb; $i+=$adaysec){
	if (date("w",$i) =="0") {
		$minggu++;
		}
		}
		return $minggu;
		}

function JumSabtu($tgl_mulai,$tgl_akhir) {
$adaysec =24*3600;
$tgla= strtotime($tgl_mulai);
$tglb= strtotime($tgl_akhir);
$sabtu=0;
for ($i=$tgla; $i < $tglb; $i+=$adaysec){
	if (date("w",$i) =="6") {
		$sabtu++;
		}
		}
		return $sabtu;
		}

function dateDiff($dformat, $endDate, $beginDate){
	$date_parts1=explode($dformat, $beginDate);
	$date_parts2=explode($dformat, $endDate);
	$start_date=gregoriantojd($date_parts1[1],$date_parts1[2], $date_parts1[0]);
	$end_date=gregoriantojd($date_parts2[1],$date_parts2[2], $date_parts2[0]);
	return $end_date- $start_date;
	}

$module=$_GET['module'];
$act=$_GET['act'];

// Input download
if ($module=='download' AND $act=='input'){
	$lokasi_file = $_FILES['fupload']['tmp_name'];
	$nama_file   = $_FILES['fupload']['name'];
  
	$nip=$_POST['nip'];
	$tahun=$_POST['tahun'];
	$id_jcuti=$_POST['id_jcuti'];
	$jabatan=$_POST['id_jabatan'];
	$golongan=$_POST['id_gol'];
	$tgl_mulai=$_POST['tgl_mulai'];
	$tgl_akhir=$_POST['tgl_akhir'];
	$alasan=$_POST['alasan'];
	$jenis_cuti=$_POST['jenis_cuti'];

	$jumM=JumMinggu($tgl_mulai,$tgl_akhir);
	$jumS=JumSabtu($tgl_mulai,$tgl_akhir);
	$sql=mysql_query("SELECT COUNT(*) as jumLibur FROM hari_libur WHERE tanggal between '$tgl_mulai' AND '$tgl_akhir'");
	$t=mysql_fetch_assoc($sql);
	$LiburNas=$t['jumLibur'];
	$JumHari = dateDiff("-", $tgl_akhir, $tgl_mulai);
	$JumHari1=$JumHari+1;
	$totallibur=$jumM + $jumS + $LiburNas;
	$totalcuti=$JumHari1 - $totallibur;

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
  
  $file_extension = strtolower(substr(strrchr($nama_file,"."),1));

  switch($file_extension){
    case "pdf": $ctype="application/pdf"; break;
    case "exe": $ctype="application/octet-stream"; break;
    case "zip": $ctype="application/zip"; break;
    case "rar": $ctype="application/rar"; break;
    case "doc": $ctype="application/msword"; break;
    case "xls": $ctype="application/vnd.ms-excel"; break;
    case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
    case "gif": $ctype="image/gif"; break;
    case "png": $ctype="image/png"; break;
    case "jpeg":
    case "jpg": $ctype="image/jpg"; break;
    default: $ctype="application/proses";
  }

  if ($file_extension=='php'){
   echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload tidak bertipe *.PHP');
        window.location=('../../media.php?module=download')</script>";
  }
  else{
    UploadFile($nama_file);
    mysql_query("INSERT INTO download(judul,
                                    nama_file,
                                    tgl_posting) 
                            VALUES('$_POST[judul]',
                                   '$nama_file',
                                   '$tgl_sekarang')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO download(judul,
                                    tgl_posting) 
                            VALUES('$_POST[judul]',
                                   '$tgl_sekarang')");
  header('location:../../media.php?module='.$module);
  }
}
}
?>
