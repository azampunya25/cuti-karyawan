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

// Hapus banner
if ($module=='banner' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM link WHERE id_link='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM link WHERE id_link='$_GET[id]'");
     unlink("../../../foto/foto_banner/$_GET[namafile]");   
  }
  else{
    mysql_query("DELETE FROM link WHERE id_link='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input banner
elseif ($module=='banner' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=banner')</script>";
    }
    else{
    UploadBanner($nama_file);
    mysql_query("INSERT INTO link(judul,
                                    url,
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   '$_POST[url]',
                                   '$nama_file')");
   header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO link(judul,
                                    url) 
                            VALUES('$_POST[judul]',
                                   '$_POST[url]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update banner
elseif ($module=='banner' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE link SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]'
                             WHERE id_link = '$_POST[id]'");
   header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=banner')</script>";
    }
    else{
    UploadBanner($nama_file);
    mysql_query("UPDATE link SET judul     = '$_POST[judul]',
                                   url       = '$_POST[url]',
                                   gambar    = '$nama_file'   
                             WHERE id_link = '$_POST[id]'");
   header('location:../../media.php?module='.$module);
   }
  }
}
}
?>
