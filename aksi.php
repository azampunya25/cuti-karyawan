<?php
session_start();
include "config/koneksi.php";
include "config/library.php";

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

$module=isset($_GET['module']);
$act=isset($_GET['act']);

// Menghapus data
if (isset($module) AND $act=='hapus'){
  mysqli_query($mysqli, "DELETE FROM ".$module." WHERE id_".$module."='$_GET[id]'");
  header('location:media.php?module='.$module);
}

// Input user
elseif ($module=='user' AND $act=='input'){

    $s = "SELECT * FROM user WHERE nik='$_POST[nik]'";
	$s1 = mysqli_query($mysqli,$s);
		if (mysqli_num_rows($s1) > 0)
		{
		 //header('location:media.php?err&module='.$module);
		 header('location:media.php?erru');
         exit();
        }

  $pass=md5($_POST['password']);
  mysqli_query($mysqli, "INSERT INTO user(nik,
                                password,
                                level)
	                       VALUES('$_POST[nik]',
                                '$pass',
                                '$_POST[level]')");
  header('location:media.php?module='.$module);
}

// Update user
elseif ($module=='user' AND $act=='update'){
  // Apabila password tidak diubah
  if (empty($_POST['password'])) {
    mysqli_query($mysqli, "UPDATE user SET nik         = '$_POST[nik]',
                                    level    = '$_POST[level]'
                           WHERE id_user     = '$_POST[id]'");
  }
  // Apabila password diubah
  else{
    $pass=md5($_POST['password']);
    mysqli_query($mysqli, "UPDATE user SET nik         = '$_POST[nik]',
                                 password    = '$pass',
                                 level       = '$_POST[level]'
                           WHERE id_user     = '$_POST[id]'");
  }
  header('location:media.php?module='.$module);
}


// Input modul
elseif ($module=='modul' AND $act=='input'){
  mysqli_query($mysqli, "INSERT INTO modul(nama_modul,
                                 link,
                                 publish,
                                 aktif,
                                 status,
                                 urutan)
	                       VALUES('$_POST[nama_modul]',
                                '$_POST[link]',
                                '$_POST[publish]',
                                '$_POST[aktif]',
                                '$_POST[status]',
                                '$_POST[urutan]')");
  header('location:media.php?module='.$module);
}

// Update modul
elseif ($module=='modul' AND $act=='update'){
  mysqli_query($mysqli, "UPDATE modul SET nama_modul = '$_POST[nama_modul]',
                                link       = '$_POST[link]',
                                publish    = '$_POST[publish]',
                                aktif      = '$_POST[aktif]',
                                status     = '$_POST[status]',
                                urutan     = '$_POST[urutan]'
                          WHERE id_modul   = '$_POST[id]'");
  header('location:media.php?module='.$module);
}

//input jabatan
elseif ($module=='jabatan' AND $act=='input'){
	$s = "SELECT * FROM jabatan WHERE kd_jabatan='$_POST[kd_jabatan]'";
	$s1 = mysqli_query($mysqli, $s);
		if (mysqli_num_rows($s1) > 0)
		{
		 //header('location:media.php?err&module='.$module);
		 header('location:media.php?errj');
         exit();
        }

	mysqli_query($mysqli, "INSERT INTO jabatan(kd_jabatan,
	                                 nm_jabatan,
	                                 keterangan)
	                          VALUES('$_POST[kd_jabatan]',
	                                 '$_POST[nm_jabatan]',
	                                 '$_POST[keterangan]')");
   header('location:media.php?module='.$module);
}

// Update jabatan
elseif ($module=='jabatan' AND $act=='update'){
	mysqli_query($mysqli, "UPDATE jabatan SET kd_jabatan = '$_POST[kd_jabatan]',
	                                nm_jabatan = '$_POST[nm_jabatan]',
	                                keterangan = '$_POST[keterangan]'
	                        WHERE id_jabatan   = '$_POST[id]'");
  header('location:media.php?module='.$module);
	}

//input karyawan
elseif ($module=='karyawan' AND $act=='input'){
	$s = "SELECT * FROM karyawan WHERE nik='$_POST[nik]'";
	$s1 = mysqli_query($mysqli, $s);
		if (mysqli_num_rows($s1) > 0)
		{
		 //header('location:media.php?err&module='.$module);
		 header('location:media.php?errk');
         exit();
        }

	mysqli_query($mysqli, "INSERT INTO karyawan(nik,
	                                 nama,
	                                 kd_jabatan,
	                                 kelamin,
	                                 status_kawin,
	                                 pendidikan,
	                                 alamat_tinggal,
	                                 alamat_asal,
	                                 tgl_masuk,
	                                 status_upah,
	                                 status_karyawan,
	                                 nik_atasan)
	                          VALUES('$_POST[nik]',
	                                 '$_POST[nama]',
	                                 '$_POST[kd_jabatan]',
	                                 '$_POST[kelamin]',
	                                 '$_POST[status_kawin]',
	                                 '$_POST[pendidikan]',
	                                 '$_POST[alamat_tinggal]',
	                                 '$_POST[alamat_asal]',
	                                 '$_POST[tgl_masuk]',
	                                 '$_POST[status_upah]',
	                                 '$_POST[status_karyawan]',
	                                 '$_POST[atasan]')");
   header('location:media.php?module='.$module);
}

// Update karyawan
elseif ($module=='karyawan' AND $act=='update'){
	mysqli_query($mysqli, "UPDATE karyawan SET nik       = '$_POST[nik]',
	                                nama       = '$_POST[nama]',
	                                kd_jabatan = '$_POST[kd_jabatan]',
	                                kelamin    = '$_POST[kelamin]',
	                                status_kawin = '$_POST[status_kawin]',
	                                pendidikan   = '$_POST[pendidikan]',
	                                alamat_tinggal = '$_POST[alamat_tinggal]',
	                                alamat_asal    = '$_POST[alamat_asal]',
	                                tgl_masuk      = '$_POST[tgl_masuk]',
	                                status_upah    = '$_POST[status_upah]',
	                                status_karyawan = '$_POST[status_karyawan]',
	                                nik_atasan='$_POST[atasan]'
	                        WHERE id_karyawan   = '$_POST[id]'");
  header('location:media.php?module='.$module);
	}

//input jenis cuti
elseif ($module=='jenis_cuti' AND $act=='input'){
	$s = "SELECT * FROM jenis_cuti WHERE kd_jcuti='$_POST[kd_jcuti]'";
	$s1 = mysqli_query($mysqli, $s);
		if (mysqli_num_rows($s1) > 0)
		{
		 //header('location:media.php?err&module='.$module);
		 header('location:media.php?errjc');
         exit();
        }

	mysqli_query($mysqli, "INSERT INTO jenis_cuti(kd_jcuti,
	                                 nama_jcuti,
	                                 lama_jcuti,
	                                 keterangan)
	                          VALUES('$_POST[kd_jcuti]',
	                                 '$_POST[nama_jcuti]',
	                                 '$_POST[lama_jcuti]',
	                                 '$_POST[keterangan]')");
   header('location:media.php?module='.$module);
}

// Update jenis cuti
elseif ($module=='jenis_cuti' AND $act=='update'){
	mysqli_query($mysqli, "UPDATE jenis_cuti SET kd_jcuti = '$_POST[kd_jcuti]',
	                                nama_jcuti = '$_POST[nama_jcuti]',
	                                lama_jcuti = '$_POST[lama_jcuti]',
	                                keterangan = '$_POST[keterangan]'
	                        WHERE id_jenis_cuti   = '$_POST[id]'");
  header('location:media.php?module='.$module);
	}


//input hari libur
elseif ($module=='hari_libur' AND $act=='input'){
	$s = "SELECT * FROM hari_libur WHERE tanggal='$_POST[tanggal]'";
	$s1 = mysqli_query($mysqli, $s);
		if (mysqli_num_rows($s1) > 0)
		{
		 //header('location:media.php?err&module='.$module);
		 header('location:media.php?errhr');
         exit();
        }

	mysqli_query($mysqli, "INSERT INTO hari_libur(tanggal,
	                                    keterangan)
	                          VALUES('$_POST[tanggal]',
	                                 '$_POST[keterangan]')");
   header('location:media.php?module='.$module);

}

//Persetujuan Cuti
elseif ($module=='persetujuan_cuti' AND $act=='setuju'){
	$id_pcuti=$_GET['id_pcuti'];
	$nik=$_GET['nik'];
	$nama=$_GET['nama'];
    //echo "setuju";
    mysqli_query($mysqli, "UPDATE permohonan_cuti,karyawan SET
                permohonan_cuti.status_pengajuan='setuju',karyawan.status_karyawan='cuti'
                 WHERE permohonan_cuti.id_pcuti='$id_pcuti' AND karyawan.nik='$nik'");

    header('location:media.php?module='.$module);
}

//Persetujuan Cuti Tidak disetujui
elseif ($module=='persetujuan_cuti' AND $act=='tdksetuju'){
	$id_pcuti=$_GET['id_pcuti'];
	$nik=$_GET['nik'];
	$nama=$_GET['nama'];
    //echo "setuju";
    mysqli_query($mysqli, "UPDATE permohonan_cuti,karyawan SET
                permohonan_cuti.status_pengajuan='tidak',karyawan.status_karyawan='aktif'
                 WHERE permohonan_cuti.id_pcuti='$id_pcuti' AND karyawan.nik='$nik'");

    header('location:media.php?module='.$module);
}

//lanjut permohonan cuti
elseif ($module=='permohonan_cuti' AND $act=='input'){

   $nik=$_POST['nik'];
   $nama=$_POST['nama'];
   $tahun=$_POST['tahun'];
   $kd_jcuti=$_POST['kd_jcuti'];
   $tgl_mulai=$_POST['tgl_mulai'];
   $tgl_akhir=$_POST['tgl_akhir'];
   $alasan=$_POST['alasan'];
   $jenis_cuti=$_POST['jenis_cuti'];
   //$nik_atasan=$_POST['nik_atasan'];


  $jumM=JumMinggu($tgl_mulai,$tgl_akhir);
  $jumS=JumSabtu($tgl_mulai,$tgl_akhir);
  $sql=mysqli_query($mysqli, "SELECT COUNT(*) as jumLibur FROM hari_libur WHERE
   tanggal between '$tgl_mulai' AND '$tgl_akhir'");
  $t=mysqli_fetch_assoc($sql);
  $LiburNas=$t['jumLibur'];
  $JumHari = dateDiff("-", $tgl_akhir, $tgl_mulai);
  $JumHari1=$JumHari+1;
  $totallibur=$jumM + $jumS + $LiburNas;
  $totalcuti=$JumHari1 - $totallibur;

  $sp=mysqli_query($mysqli, "SELECT * FROM periode_cuti
  WHERE nik='$_SESSION[namauser]' and kd_jcuti='$jenis_cuti'");
  $dp=mysqli_fetch_array($sp);
  if ($tgl_mulai>$tgl_akhir){
  	//echo "tanggal awal tidak boleh lebih besar dari tanggal akhir";
  	header('location:media.php?errtanggal');
  	exit();
  	}
  elseif (($tgl_mulai=='') || ($tgl_akhir=='')){
  	//echo "Tanggal tidak boleh kosong";
  	header('location:media.php?errtanggal1');
  	exit();
  	}
  elseif ($alasan==''){
  	//echo "Alasan tidak boleh kosong";
  	header('location:media.php?erralasan');
  	exit();
  	}
  elseif ($jenis_cuti=='CThn'){
   if(($tgl_mulai<$dp['awalcuti']) OR ($tgl_akhir>$dp['akhircuti']))
   {
    header('location:media.php?errperiode');
    exit();
  	}

   else{
  		    $s = "SELECT * FROM jenis_cuti
            WHERE kd_jcuti='$jenis_cuti'";
            $s1 = mysqli_query($mysqli, $s);
            $data=mysqli_fetch_array($s1);
            $lama_cuti=$data['lama_jcuti']-$totalcuti;
    		$sql="SELECT * FROM permohonan_cuti WHERE nik='$nik' and tahun='$tahun' and kd_jcuti='$jenis_cuti'
    		order by id_pcuti desc";
    		$hsl= mysqli_query($mysqli, $sql);
    		$data2=mysqli_fetch_array($hsl);
           
    		   if (mysqli_num_rows($hsl)>0){
            if($totalcuti>$data2['sisa_cuti']){
            	header('location:media.php?errtolakcuti');
 			        exit();
            	}
              else{         		   
    		       $lama_cuti2=$data2['sisa_cuti']-$totalcuti;
        		   mysqli_query($mysqli, "INSERT INTO permohonan_cuti(nik,tahun,kd_jcuti,
                                                   tgl_mulai,tgl_akhir,
                                                   lama_cuti,sisa_cuti,
                                                   alasan,status_pengajuan)
                                           VALUES('$nik','$tahun','$jenis_cuti',
                                                  '$tgl_mulai','$tgl_akhir',
                                                  '$totalcuti','$lama_cuti2','$alasan',
                                                  'belum')");
        		  header('location:media.php?module=riwayat_cuti');
                }
           }     

    		   else{
          		mysqli_query($mysqli, "INSERT INTO permohonan_cuti(nik,tahun,kd_jcuti,
                                                   tgl_mulai,tgl_akhir,
                                                   lama_cuti,sisa_cuti,
                                                   alasan,status_pengajuan)
                                           VALUES('$nik','$tahun','$jenis_cuti',
                                                  '$tgl_mulai','$tgl_akhir',
                                                  '$totalcuti','$lama_cuti','$alasan','belum')");
         		 header('location:media.php?module=riwayat_cuti');

         	   }

  	exit();
    }
  	exit();
    }

    elseif($jenis_cuti<>'CThn'){
    $s = "SELECT * FROM jenis_cuti
    WHERE kd_jcuti='$jenis_cuti'";
    $s1 = mysqli_query($mysqli, $s);
    $data=mysqli_fetch_array($s1);
    //$lama_cuti=$data['lama_jcuti']-$totalcuti;
    $lama_cuti=$data['lama_jcuti']-$JumHari1;
    $sql="SELECT * FROM permohonan_cuti WHERE nik='$nik' and tahun='$tahun' and kd_jcuti='$jenis_cuti'
    order by id_pcuti desc";
    $hsl= mysqli_query($mysqli, $sql);
    $data2=mysqli_fetch_array($hsl);


    if (mysqli_num_rows($hsl)>0){
      if($totalcuti>$data2['sisa_cuti']){
            	header('location:media.php?errtolakcuti');
 			        exit();
            	}else{
        //$lama_cuti2=$data2['sisa_cuti']-$totalcuti;
        $lama_cuti2=$data2['sisa_cuti']-$JumHari1;
        mysqli_query($mysqli, "INSERT INTO permohonan_cuti(nik,tahun,kd_jcuti,
                                                   tgl_mulai,tgl_akhir,
                                                   lama_cuti,sisa_cuti,
                                                   alasan,status_pengajuan)
                                           VALUES('$nik','$tahun','$jenis_cuti',
                                                  '$tgl_mulai','$tgl_akhir',
                                                  '$JumHari1','$lama_cuti2','$alasan',
                                                  'belum')");
        header('location:media.php?module=riwayat_cuti');
    }
    }
    else{
          mysqli_query($mysqli, "INSERT INTO permohonan_cuti(nik,tahun,kd_jcuti,
                                                   tgl_mulai,tgl_akhir,
                                                   lama_cuti,sisa_cuti,
                                                   alasan,status_pengajuan)
                                           VALUES('$nik','$tahun','$jenis_cuti',
                                                  '$tgl_mulai','$tgl_akhir',
                                                  '$JumHari1','$lama_cuti','$alasan','belum')");
          header('location:media.php?module=riwayat_cuti');

           }

  	}

}
//input periode cuti
elseif ($module=='periode_cuti' AND $act=='input'){
$thn=date("Y");
 mysqli_query($mysqli, "INSERT INTO periode_cuti(nik,kd_jcuti,tahun,awalcuti,akhircuti)
              VALUES('$_POST[nik]','$_POST[kd_jcuti]','$_POST[thn]','$_POST[awalcuti]','$_POST[akhircuti]')");
              header('location:media.php?module='.$module);
}

//Update periode cuti
elseif ($module=='periode_cuti' AND $act=='update'){
	$thn=date("Y");
 mysqli_query($mysqli, "UPDATE periode_cuti SET tahun='$_POST[thn]',
 									awalcuti='$_POST[awalcuti]',
                                    akhircuti='$_POST[akhircuti]'
                                    WHERE id_periode_cuti='$_POST[id]'");
              header('location:media.php?module='.$module);
}


?>
