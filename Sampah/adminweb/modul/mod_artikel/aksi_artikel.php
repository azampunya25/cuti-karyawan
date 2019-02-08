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
include "../../../config/fungsi_seo.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus berita
if ($module=='artikel' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM artikel WHERE id_artikel='$_GET[id]'"));
  if ($data['gambar']!=''){
     mysql_query("DELETE FROM artikel WHERE id_artikel='$_GET[id]'");
     unlink("../../../foto/foto_artikel/$_GET[namafile]");   
     unlink("../../../foto/foto_artikel/small_$_GET[namafile]");   
  }
  else{
     mysql_query("DELETE FROM artikel WHERE id_artikel='$_GET[id]'");
  }
  header('location:../../media.php?module='.$module);
}

// Input berita
elseif ($module=='artikel' AND $act=='input'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 
  
  if (!empty($_POST['tag_seo'])){
    $tag_seo = $_POST['tag_seo'];
    $tag=implode(',',$tag_seo);
  }            
  $judul_seo      = seo_title($_POST['judul']);

  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=artikel)</script>";
    }
    else{
    UploadArtikel($nama_file_unik);

    mysql_query("INSERT INTO artikel(judul,
                                    judul_seo,
                                    id_artikel,
                                    headline,
                                    username,
                                    isi_artikel,
                                    jam,
                                    tanggal,
                                    hari,
                                    tag, 
                                    gambar) 
                            VALUES('$_POST[judul]',
                                   '$judul_seo',
                                   '$_POST[kategori]',
                                   '$_POST[headline]', 
                                   '$_SESSION[namauser]',
                                   '$_POST[isi_artikel]',
                                   '$jam_sekarang',
                                   '$tgl_sekarang',
                                   '$hari_ini',
                                   '$tag',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO artikel(judul,
                                    judul_seo, 
                                    id_kategori,
                                    headline,
                                    username,
                                    isi_artikel,
                                    jam,
                                    tanggal,
                                    tag, 
                                    hari) 
                            VALUES('$_POST[judul]',
                                   '$judul_seo',
                                   '$_POST[kategori]',
                                   '$_POST[headline]', 
                                   '$_SESSION[namauser]',
                                   '$_POST[isi_artikel]',
                                   '$jam_sekarang',
                                   '$tgl_sekarang',
                                   '$tag',
                                   '$hari_ini')");
  header('location:../../media.php?module='.$module);
  }
  
  $jml=count($tag_seo);
  for($i=0;$i<$jml;$i++){
    mysql_query("UPDATE tag SET count=count+1 WHERE tag_seo='$tag_seo[$i]'");
  }
}

// Update berita
elseif ($module=='artikel' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file; 

  if (!empty($_POST['tag_seo'])){
    $tag_seo = $_POST['tag_seo'];
    $tag=implode(',',$tag_seo);
  }

  $judul_seo = seo_title($_POST['judul']);

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE artikel SET judul       = '$_POST[judul]',
                                   judul_seo   = '$judul_seo', 
                                   id_kategori = '$_POST[kategori]',
                                   headline    = '$_POST[headline]',
                                   tag         = '$tag',
                                   isi_artikel  = '$_POST[isi_artikel]'  
                             WHERE id_artikel   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=artikel')</script>";
    }
    else{
    UploadArtikel($nama_file_unik);
    mysql_query("UPDATE artikel SET judul       = '$_POST[judul]',
                                   judul_seo   = '$judul_seo', 
                                   id_kategori = '$_POST[kategori]',
                                   headline    = '$_POST[headline]',
                                   tag         = '$tag',
                                   isi_artikel  = '$_POST[isi_artikel]',
                                   gambar      = '$nama_file_unik'   
                             WHERE id_artikel   = '$_POST[id]'");
   header('location:../../media.php?module='.$module);
   }
  }
}
}
?>
