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
if ($module=='suratmasuk' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM suratmasuk WHERE id_sm='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM suratmasuk WHERE id_sm='$_GET[id]'");
     unlink("../../../foto/foto_suratmasuk/$_GET[namafile]");   
	 unlink("../../../foto/foto_suratmasuk/medium_$_GET[namafile]"); 
     unlink("../../../foto/foto_suratmasuk/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM suratmasuk WHERE id_sm='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input berita
elseif ($module=='suratmasuk' AND $act=='input'){
	function ubahformatTgl($tanggal) {
		$pisah = explode('-',$tanggal);
		$urutan = array($pisah[2],$pisah[1],$pisah[0]);
		$satukan = implode('-',$urutan);
		return $satukan;
	}
	
	function ubahformatTgl1($tanggal) {
		$pisah = explode('-',$tanggal);
		$urutan = array($pisah[2],$pisah[1],$pisah[0]);
		$satukan = implode('-',$urutan);
		return $satukan;
	}
    
	// Ambil variabel dari form
    //$no_agenda = $_POST['no_agenda'];
    $asal_surat = $_POST['asal_surat'];
	$tgl_terima = $_POST['tgl_terima'];
	$tgl_surat = $_POST['tgl_surat'];
    $no_surat = $_POST['no_surat'];
	$sifat = $_POST['sifat'];
	$perihal = $_POST['perihal'];
	$diteruskan = $_POST['bagian'];
	$petunjuk = $_POST['petunjuk'];
	$disposisi = $_POST['disposisi'];
	$s_no_agenda=$_POST['id_bagian'].$_POST['id_miring'].$_POST['id_unit'];
	$no_agenda=$_POST['id_nomor'].$_POST['id_thn'];
	$no_agendah=$_POST['id_bagian'].$_POST['id_miring'].$_POST['id_unit'].$_POST['id_nomor'].$_POST['id_thn'];
	
	//$no_agenda1 = $_POST['no_agenda'];
    $asal_surat1 = $_POST['asal_surat'];
	$tgl_terima1 = $_POST['tgl_terima'];
	$tgl_surat1 = $_POST['tgl_surat'];
    $no_surat1 = $_POST['no_surat'];
	$sifat1 = $_POST['sifat'];
	$perihal1 = $_POST['perihal'];
	$diteruskan1 = $_POST['bagian'];
	$petunjuk1 = $_POST['petunjuk'];
	$disposisi1 = $_POST['disposisi'];
	$no_agenda2=$_POST['id_bagian'].$_POST['id_miring'].$_POST['id_unit'].$_POST['id_nomor'].$_POST['id_thn'];
	
	//Cara penggunaan function ubahTgl
	$ubahtglsurat = ubahformatTgl($tgl_surat);
	$ubahtglterima = ubahformatTgl1($tgl_terima);
	
		$ubahtglsurat1 = ubahformatTgl($tgl_surat);
	$ubahtglterima1 = ubahformatTgl1($tgl_terima);
  
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
	$nama_file_unik = $acak.$nama_file; 
  
  
    if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=suratmasuk')</script>";
    }
    else{
  // Apabila ada gambar yang diupload
//  if (!empty($lokasi_file)){
//    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
  //  echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
 //       window.location=('../../media.php?module=suratmasuk)</script>";
  //  }
  //  else{
    UploadSuratMasuk($nama_file_unik);

    mysql_query("INSERT INTO suratmasuk (s_no_agenda,no_agenda,no_agenda_st,asal_surat,tgl_terima,tgl_surat,no_surat,sifat, perihal, id_bagian, petunjuk, disposisi,gambar)
                            VALUES('$s_no_agenda','$no_agenda','$no_agendah','$asal_surat','$ubahtglterima','$ubahtglsurat','$no_surat','$sifat','$perihal','$diteruskan','$petunjuk','$disposisi','$nama_file_unik')");
	mysql_query("INSERT INTO historismasuk (no_agenda,asal_surat,tgl_terima,no_surat,id_bagian,gambar)
                            VALUES('$no_agendah','$asal_surat1','$ubahtglterima1','$no_surat1','$diteruskan1','$nama_file_unik')");
	header('location:../../media.php?module='.$module);
	}
  }
  else{
    mysql_query("INSERT INTO suratmasuk(s_no_agenda,no_agenda,no_agenda_st,asal_surat,tgl_terima,tgl_surat,no_surat,sifat, perihal, id_bagian, petunjuk, disposisi) 
                            VALUES('$s_no_agenda','$no_agenda','$no_agendah','$asal_surat','$ubahtglterima','$ubahtglsurat','$no_surat','$sifat','$perihal','$diteruskan','$petunjuk','$disposisi')");
	mysql_query("INSERT INTO historismasuk(no_agenda,asal_surat,tgl_terima,tgl_surat,no_surat,sifat, perihal, id_bagian, petunjuk, disposisi) 
                            VALUES('$no_agendah','$asal_surat1','$ubahtglterima1','$ubahtglsurat1','$no_surat1','$sifat1','$perihal1','$diteruskan1','$petunjuk1','$disposisi1')");
  header('location:../../media.php?module='.$module);
  }
}

// Update berita
elseif ($module=='suratmasuk' AND $act=='update'){
	$s_no_agenda=$_POST['id_bagian'].$_POST['id_miring'].$_POST['id_unit'];
	$no_agendah=$_POST['id_bagian'].$_POST['id_miring'].$_POST['id_unit'].$_POST['id_sk'];
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE suratmasuk SET 
	s_no_agenda	= '$s_no_agenda',
	no_agenda_st	= '$no_agendah',
                                   asal_surat 		= '$_POST[asal_surat]',
                                   tgl_terima    		= '$_POST[tgl_terima]',
								   tgl_surat    		= '$_POST[tgl_surat]',
                                   no_surat  		= '$_POST[no_surat]',  
								   sifat = '$_POST[sifat]',
								   perihal='$_POST[perihal]',
								   id_bagian ='$_POST[bagian]',
								   petunjuk = '$_POST[petunjuk]',
								   disposisi = '$_POST[disposisi]'  
                             WHERE id_sm   = '$_POST[id]'");	
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=suratmasuk')</script>";
    }
    else{
    UploadSuratMasuk($nama_file_unik);
    mysql_query("UPDATE suratmasuk SET 
	s_no_agenda	= '$s_no_agenda',
	no_agenda_st	= '$no_agendah',
                                   asal_surat 		= '$_POST[asal_surat]',
                                   tgl_terima    		= '$_POST[tgl_terima]',
								   tgl_surat    		= '$_POST[tgl_surat]',
                                   no_surat  		= '$_POST[no_surat]',  
								   sifat = '$_POST[sifat]',
								   perihal='$_POST[perihal]',
								   id_bagian ='$_POST[bagin]',
								   petunjuk = '$_POST[petunjuk]',
								   disposisi = '$_POST[disposisi]',
                                   gambar     		 = '$nama_file_unik'   
                             WHERE id_sm   = '$_POST[id]'");
   header('location:../../media.php?module='.$module);
   }
  }
}
}
?>
