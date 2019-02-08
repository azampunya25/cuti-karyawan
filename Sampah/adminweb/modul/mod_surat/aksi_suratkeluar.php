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

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus berita
if ($module=='suratkeluar' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM suratkeluar WHERE id_sk='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM suratkeluar WHERE id_sk='$_GET[id]'");
     unlink("../../../foto/foto_suratkeluar/$_GET[namafile]");   
	 unlink("../../../foto/foto_suratkeluar/medium_$_GET[namafile]"); 
     unlink("../../../foto/foto_suratkeluar/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM suratkeluar WHERE id_sk='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input berita
elseif ($module=='suratkeluar' AND $act=='input'){
	function ubahformatTgl($tanggal) {
		$pisah = explode('-',$tanggal);
		$urutan = array($pisah[2],$pisah[1],$pisah[0]);
		$satukan = implode('-',$urutan);
		return $satukan;
	}
    
    // Ambil variabel dari form
	$no_sk = $_POST['no_sk'];
	$no= $_POST['id_nomor'];
	$tgl_surat = $_POST['tgl_surat'];
	$pengirim = $_POST['bagian'];
	$tujuan = $_POST['tujuan'];
	$perihal = $_POST['perihal'];
	$s_no_surat=$_POST['id_unit'].$_POST['id_miring'].$_POST['id_bagian'];
	$no_surat=$_POST['id_nomor'].$_POST['id_thn'];
	$no_agendah=$_POST['id_unit'].$_POST['id_miring'].$_POST['id_bagian'].$_POST['id_nomor'].$_POST['id_thn'];
	
	
	//Cara penggunaan function ubahTgl
	$ubahtglsurat = ubahformatTgl($tgl_surat);
	$ubahtglsurat1 = ubahformatTgl($tgl_surat);
  
	  $lokasi_file    = $_FILES['fupload']['tmp_name'];
	  $tipe_file      = $_FILES['fupload']['type'];
	  $nama_file      = $_FILES['fupload']['name'];
	  $acak           = rand(1,99);
	  $nama_file_unik = $acak.$nama_file; 
  
  
    if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=suratkeluar')</script>";
    }
    else{
    UploadSuratKeluar($nama_file_unik);

    mysql_query("INSERT INTO suratkeluar (s_no_sk,no_sk,no_sk_st,tgl_surat,id_bagian, tujuan, perihal,gambar)
                            VALUES('$s_no_surat','$no_surat','$no_agendah','$ubahtglsurat','$pengirim','$tujuan','$perihal','$nama_file_unik')");
								    mysql_query("INSERT INTO historiskeluar (no_sk,tgl_surat,id_bagian, tujuan, perihal,gambar)
                            VALUES('$no_agendah','$ubahtglsurat1','$pengirim','$tujuan','$perihal','$nama_file_unik')");
	header('location:../../media.php?module='.$module);
	}
  }
  else{
    mysql_query("INSERT INTO suratkeluar(s_no_sk,no_sk,no_sk_st,tgl_surat, id_bagian, tujuan, perihal) 
                            VALUES('$s_no_surat','$no_surat','$no_agendah','$ubahtglsurat','$pengirim','$tujuan','$perihal')");
								    mysql_query("INSERT INTO historiskeluar (no_sk,tgl_surat,id_bagian, tujuan, perihal)
                            VALUES('$no_agendah','$ubahtglsurat1','$pengirim','$tujuan','$perihal')");
  header('location:../../media.php?module='.$module);
  }
}

// Update berita
elseif ($module=='suratkeluar' AND $act=='update'){
	$s_no_surat=$_POST['id_unit'].$_POST['id_miring'].$_POST['id_bagian'];
	$no_agendah=$_POST['id_unit'].$_POST['id_miring'].$_POST['id_bagian'].$_POST['id_sk'];
	
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE suratkeluar SET s_no_sk			= '$s_no_surat', 
										no_sk_st		='$no_agendah',
										tgl_surat 		= '$_POST[tgl_surat]',
										id_bagian    	= '$_POST[bagian]',
										tujuan    		= '$_POST[tujuan]',
										perihal  		= '$_POST[perihal]'  
                             WHERE id_sk   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=suratkeluar')</script>";
    }
    else{
    UploadSuratKeluar($nama_file_unik);
    mysql_query("UPDATE suratkeluar SET  s_no_sk='$s_no_surat',
	no_sk_st		='$no_agendah',
                                   tgl_surat 		= '$_POST[tgl_surat]',
                                   id_bagian    		= '$_POST[bagian]',
								   tujuan    		= '$_POST[tujuan]',
                                   perihal  		= '$_POST[perihal]',
                                   gambar     		 = '$nama_file_unik'   
                             WHERE id_sk   = '$_POST[id]'");
   header('location:../../media.php?module='.$module);
   }
  }
}
}
?>
