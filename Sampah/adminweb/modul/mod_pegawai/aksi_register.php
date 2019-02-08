<?php
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";

$module=$_GET['module'];
$act=$_GET['act'];

// Hapus Pegawai
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

// Input Pegawai
elseif ($module=='pegawai' AND $act=='input'){
		$s = "SELECT * FROM pegawai WHERE nip='$_POST[nip]'";
	$s1 = mysql_query($s);
		if (mysql_num_rows($s1) > 0)
		{
		 //header('location:media.php?err&module='.$module);
		// header('location:../../media.php?errk');
		echo "<script>alert('maaf, nip yang anda masukan sudah ada, silahkan periksa lagi NIP nya!!');window.location.href='../../media.php?module=pegawai&act=tambahpegawai';</script>";
         exit();
        }
//		$x = "SELECT * FROM pegawai WHERE id_jabatan='JB002'";
	//	$x1 = mysql_query($x);
	//	if (mysql_num_rows($x1) > 0)
	//	{
		 //header('location:media.php?err&module='.$module);
		// header('location:../../media.php?errk');
	//	echo "<script>alert('maaf, Kepala Dinas tidak bisa lebih dari satu orang!!');window.location.href='../../media.php?module=pegawai&act=tambahpegawai';</script>";
 //        exit();
  //      }
		
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
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
                                    id_jabatan,
									id_gol,
									kelamin,
									status_kawin,
									pendidikan,
									almt_tinggal,
									tgl_masuk,
									status_pegawai,
									nip_atasan,
                                    gambar) 
                            VALUES('$_POST[nip]',
                                   '$_POST[nama]',
								   '$_POST[id_jabatan]',
								   '$_POST[id_gol]',
								   '$_POST[kelamin]',
                                   '$_POST[status_kawin]',
                                   '$_POST[pendidikan]',
								   '$_POST[almt_tinggal]',
								   '$_POST[tgl_masuk]',
								   '$_POST[status_pegawai]',
								   '$_POST[nip_atasan]',
                                   '$nama_file_unik')");
	mysql_query("insert into user set nip='$_POST[nip]', password=md5('$_POST[pass]'), level='PEGAWAI'");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
    mysql_query("INSERT INTO pegawai(nip,
                                    nama,
                                    id_jabatan,
									id_gol,
									kelamin,
									status_kawin,
									pendidikan,
									almt_tinggal,
									tgl_masuk,
									status_pegawai,
									nip_atasan) 
                            VALUES('$_POST[nip]',
                                   '$_POST[nama]',
								   '$_POST[id_jabatan]',
								   '$_POST[id_gol]',
								   '$_POST[kelamin]',
                                   '$_POST[status_kawin]',
                                   '$_POST[pendidikan]',
								   '$_POST[almt_tinggal]',
								   '$_POST[tgl_masuk]',
								   '$_POST[status_pegawai]',
								   '$_POST[nip_atasan]')");
	mysql_query("insert into user set nip='$_POST[nip]', password=md5('$_POST[pass]'), level='PEGAWAI'");
  header('location:../../media.php?module='.$module);
  }
}

elseif ($module=='pegawai' AND $act=='register'){
		$s = "SELECT * FROM pegawai WHERE nip='$_POST[nip]'";
	$s1 = mysql_query($s);
		if (mysql_num_rows($s1) > 0)
		{
		echo "<script>alert('maaf, nip yang anda masukan sudah ada, silahkan periksa lagi NIP nya!!');window.location.href='../../registrasi.php';</script>";
         exit();
        }	
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
	$nama_file_unik = $acak.$nama_file; 
	$tm="$_POST[tm]-$_POST[bm]-$_POST[hm]";
	
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../registrasi.php')</script>";
    }
    else{
    UploadPegawai($nama_file_unik);
    mysql_query("INSERT INTO pegawai(nip,nama,id_jabatan,id_gol,kelamin,status_kawin,pendidikan,
									almt_tinggal,tgl_masuk,status_pegawai,nip_atasan,gambar) 
                            VALUES('$_POST[nip]','$_POST[nama]','$_POST[jabatan]','$_POST[golongan]','$_POST[jk]',
                                   '$_POST[sk]','$_POST[pendidikan]','$_POST[almt]','$tm',
								   'aktif','$_POST[nipatasan]','$nama_file_unik')");
	mysql_query("insert into user set nip='$_POST[nip]', password=md5('$_POST[psl]'), level='PEGAWAI'");
  header('location:../../sukses.php');
  }
  }
  else{
    mysql_query("INSERT INTO pegawai(nip,nama,id_jabatan,id_gol,kelamin,status_kawin,pendidikan,
									almt_tinggal,tgl_masuk,status_pegawai,nip_atasan) 
                            VALUES('$_POST[nip]','$_POST[nama]','$_POST[jabatan]','$_POST[golongan]','$_POST[jk]',
                                   '$_POST[sk]','$_POST[pendidikan]','$_POST[almt]','$tm',
								   'aktif','$_POST[nipatasan]')");
	mysql_query("insert into user set nip='$_POST[nip]', password=md5('$_POST[psl]'), level='PEGAWAI'");
  header('location:../../sukses.php');
  }
}

// Update Pegawai
elseif ($module=='pegawai' AND $act=='update'){
	$lokasi_file    = $_FILES['fupload']['tmp_name'];
	$tipe_file      = $_FILES['fupload']['type'];
	$nama_file      = $_FILES['fupload']['name'];
	$acak           = rand(1,99);
	$nama_file_unik = $acak.$nama_file; 

  if (empty($lokasi_file)){
    mysql_query("UPDATE pegawai SET nip				= '$_POST[nip]',
                                   nama 			= '$_POST[nama]',
                                   id_jabatan    	= '$_POST[id_jabatan]',
								   id_gol    		= '$_POST[id_gol]',
								   kelamin    		= '$_POST[kelamin]',
                                   status_kawin  	= '$_POST[status_kawin]',  
								   pendidikan  		= '$_POST[pendidikan]',
								   almt_tinggal  	= '$_POST[almt_tinggal]',
								   tgl_masuk  		= '$_POST[tgl_masuk]',
								   status_pegawai  	= '$_POST[status_pegawai]',
								   nip_atasan  		= '$_POST[nip_atasan]'  
                             WHERE nip   = '$_POST[id]'");	
  header('location:../../media.php?module='.$module);
  }
  else{
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=suratmasuk')</script>";
    }
    else{
    UploadPegawai($nama_file_unik);
    mysql_query("UPDATE pegawai SET nip				= '$_POST[nip]',
                                   nama 			= '$_POST[nama]',
								   id_jabatan    	= '$_POST[id_jabatan]',
                                   id_gol    		= '$_POST[id_gol]',
								   kelamin    		= '$_POST[kelamin]',
                                   status_kawin  	= '$_POST[status_kawin]',  
								   pendidikan  		= '$_POST[pendidikan]',
								   almt_tinggal  	= '$_POST[almt_tinggal]',
								   tgl_masuk  		= '$_POST[tgl_masuk]',
								   status_pegawai  	= '$_POST[status_pegawai]',
								   nip_atasan  		= '$_POST[nip_atasan]',
                                   gambar     		= '$nama_file_unik'  
                             WHERE nip   = '$_POST[id]'");
   header('location:../../media.php?module='.$module);
   }
  }
}
?>
