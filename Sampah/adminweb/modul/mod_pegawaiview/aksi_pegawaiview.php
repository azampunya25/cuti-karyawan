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

// Hapus sekilas info
if ($module=='pegawai' AND $act=='hapus'){
  $data=mysql_fetch_array(mysql_query("SELECT gambar FROM pegawai WHERE nip='$_GET[id]'"));
  if ($data['gambar']!=''){
  mysql_query("DELETE FROM pegawai WHERE nip='$_GET[id]'");
     unlink("../../../foto/foto_pegawai/$_GET[namafile]");   
     unlink("../../../foto/foto_pegawai/kecil_$_GET[namafile]");   
  }
  else{
  mysql_query("DELETE FROM pegawai WHERE nip='$_GET[id]'");  
  }
  header('location:../../media.php?module='.$module);
}

// Input sekilas info
elseif ($module=='pegawai' AND $act=='input'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];   
  $acak           = rand(000000,999999);
  $nama_file_unik = $acak.$nama_file; 
  
  // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=pegawai')</script>";
    }
    else{
    UploadPegawai($nama_file_unik);
    mysql_query("INSERT INTO pegawai(nip,
                                    nama,
                                    kd_jabatan,
									kelamin,
									status_kawin,
									pendidikan,
									almt_tinggal,
									almt_asal,
									tgl_masuk,
									tgl_input,
									status_pegawai,
                                    gambar) 
                            VALUES('$_POST[nip]',
                                   '$_POST[nama]',
								   '$_POST[kd_jabatan]',
								   '$_POST[kelamin]',
                                   '$_POST[status_kawin]',
                                   '$_POST[pendidikan]',
								   '$_POST[almt_tinggal]',
								   '$_POST[almt_asal]',
								   '$_POST[tgl_masuk]',
								   '$_POST[tgl_input]',
								   '$_POST[status_pegawai]',
                                   '$nama_file_unik')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO pegawai(nip,
                                    nama,
                                    kd_jabatan,
									kelamin,
									status_kawin,
									pendidikan,
									almt_tinggal,
									almt_asal,
									tgl_masuk,
									tgl_input,
									status_pegawai) 
                            VALUES('$_POST[nip]',
                                   '$_POST[nama]',
								   '$_POST[kd_jabatan]',
								   '$_POST[kelamin]',
                                   '$_POST[status_kawin]',
                                   '$_POST[pendidikan]',
								   '$_POST[almt_tinggal]',
								   '$_POST[almt_asal]',
								   '$_POST[tgl_masuk]',
								   '$_POST[tgl_input]',
								   '$_POST[status_pegawai]')");
  header('location:../../media.php?module='.$module);
  }
}

// Update sekilas info
elseif ($module=='sekilasinfo' AND $act=='update'){
  $lokasi_file = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file   = $_FILES['fupload']['name'];

  // Apabila gambar tidak diganti
  if (empty($lokasi_file)){
    mysql_query("UPDATE sekilasinfo SET info = '$_POST[info]'
                             WHERE id_sekilas = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  else{
   if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=sekilasinfo')</script>";
    }
    else{
    UploadInfo($nama_file);
    mysql_query("UPDATE sekilasinfo SET info = '$_POST[info]',
                                   gambar    = '$nama_file'   
                             WHERE id_sekilas= '$_POST[id]'");
  header('location:../../media.php?module='.$module);
  }
  }
}
}
?>
