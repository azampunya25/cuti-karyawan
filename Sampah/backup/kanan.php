<?php
include "config/koneksi.php";
include "config/fungsi_indotgl.php";
include "config/library.php";
include "config/class_paging.php";

// Bagian Home
if ($_GET[module]=='home'){
?>

<!-- Awal Berita -->
<div id="kiri2">
<h1>Berita Terbaru</h1><hr/>
<br/>
<?php
//Cari Berita

// Tampilkan 5 headline berita terbaru dan hitung jumlah komentar masing-masing berita
 /* $p      = new Paging;
  $batas  = 4;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("select count(komentar.id_komentar) as jml, judul, jam, 
                       berita.id_berita, hari, tgl, gambar, isi_berita    
                       from berita left join komentar 
                       on berita.id_berita=komentar.id_berita
                       group by berita.id_berita DESC LIMIT 4");
*/  
 	$terkini= mysql_query("SELECT * FROM berita ORDER BY id_berita DESC LIMIT 5");	


	while($t=mysql_fetch_array($terkini)){
		$tgl = tgl_indo($t[tgl]);
		echo "<span class=date><img src=images/clock.gif> $t[hari], $tgl - $t[jam] WIB</span><br />";
		echo "<span class=judul><a href=?module=detailberita&id=$t[id_berita]>$t[judul]</a></span><br />";
 		// Apabila ada gambar dalam berita, tampilkan
    if ($t[gambar]!=''){
	echo "<span class=image1><img src='foto/foto_berita/small_$t[gambar]' width=110 border=0></span>";
		}
// Tampilkan hanya sebagian isi berita
    $isi_berita = htmlentities(strip_tags($t[isi_berita])); // mengabaikan tag html
    $isi = substr($isi_berita,0,220); // ambil sebanyak 220 karakter
    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat
	
  $idnya=$_GET[id];
  $komentar = mysql_query("select count(komentar.id_komentar) as jml from komentar WHERE id_berita='$idnya' AND aktif='Y'");
  $k = mysql_fetch_array($komentar); 
	echo "$isi ... <br/><a href=?module=detailberita&id=$t[id_berita]>Baca Selengkapnya</a> 
          <br /><br/><hr/>";

		  }

	echo "</ul>";	
	?>
	</p>
	<p>&nbsp;</p>
</div>
<!-- Akhir Berita -->

  <?php
}
// Bagian berita
if ($_GET[module]=='berita'){  
 	if(isset($_GET['judul'])){
		$where="where judul like '%$_GET[judul]%'";
		}else {
		$where="";
	}
echo "<h1>Berita</h1><hr/><br/>";	
 $p      = new Paging;
  $batas  = 5;
  $posisi = $p->cariPosisi($batas);
  // Tampilkan 8 headline berita terbaru dan hitung jumlah komentar masing-masing berita
  $terkini=mysql_query("select count(komentar.id_komentar) as jml, judul, jam, 
                       berita.id_berita, hari, tgl, gambar, isi_berita    
                       from berita left join komentar 
                       on berita.id_berita=komentar.id_berita
                       group by berita.id_berita DESC LIMIT $posisi,$batas");

    $terkini= mysql_query("SELECT * FROM berita $where ORDER BY id_berita DESC LIMIT $posisi,$batas");		 
	while($t=mysql_fetch_array($terkini)){
		$tgl = tgl_indo($t[tgl]);
		echo "<span class=date><img src=images/clock.gif> $t[hari], $tgl - $t[jam] WIB</span><br />";
		echo "<span class=judul><a href=?module=detailberita&id=$t[id_berita]>$t[judul]</a></span><br />";
 		// Apabila ada gambar dalam berita, tampilkan
    if ($t[gambar]!=''){
	echo "<span class=image1><img src='foto/foto_berita/small_$t[gambar]' width=110 border=0></span>";
		}
// Tampilkan hanya sebagian isi berita
    $isi_berita = htmlentities(strip_tags($t[isi_berita])); // mengabaikan tag html
    $isi = substr($isi_berita,0,220); // ambil sebanyak 220 karakter
    $isi = substr($isi_berita,0,strrpos($isi," ")); // potong per spasi kalimat

	echo "$isi ... <br/><a href=?module=detailberita&id=$t[id_berita]>Baca Selengkapnya</a>
          <br /></br><hr/>";
	}
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM berita"));	
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

  echo "<tr><td class=kembali>$linkHalaman</td></tr>";
	echo "</ul>";
}

// Modul detail berita
elseif ($_GET[module]=='detailberita'){
	$detail=mysql_query("SELECT * FROM berita, kategori 
	WHERE kategori.id_kategori = berita.id_kategori AND id_berita = '$_GET[id]'");
	$d   = mysql_fetch_array($detail);
	$tgl = tgl_indo($d[tanggal]);
	$baca = $d[dibaca]+1;
	echo "<span class=date><img src=images/clock.gif>$d[hari], $tgl - $d[jam] WIB</span><br />";
	echo "<span class=judul>$d[judul]</span><br />";
	echo "<span class=posting>Diposting oleh : <b>$d[username]</b><br/> 
        Kategori: <a href=?module=detailkategori&id=$d[id_kategori]><b>$d[nama_kategori]</b></a> 
        - Dibaca: <b>$baca</b> kali</span><br />";
// Apabila ada gambar dalam berita, tampilkan   
 	if ($d[gambar]!=''){
		echo "<span class=image1><img src='foto/foto_berita/medium_$d[gambar]' border=0></span>";
	}
	$isi_berita=nl2br($d[isi_berita]);
	echo "$d[isi_berita] <br />";	 		  
  
  // Apabila detail berita dilihat, maka tambahkan berapa kali dibacanya
  mysql_query("UPDATE berita SET dibaca=$d[dibaca]+1 
              WHERE id_berita='$_GET[id]'"); 


  // Hitung jumlah komentar
  $idnya=$_GET[id];
  $komentar = mysql_query("select count(komentar.id_komentar) as jml from komentar WHERE id_berita='$idnya' AND aktif='Y'");
  $k = mysql_fetch_array($komentar); 
  echo "<span class=judul><b>$k[jml]</b> Komentar : </span><br /><hr />";

  // Komentar berita
  $sql = mysql_query("SELECT * FROM komentar WHERE id_berita='$idnya' AND aktif='Y' ");
	$jml = mysql_num_rows($sql);
 // Apabila sudah ada komentar, tampilkan 
 if ($jml > 0){
    while ($s = mysql_fetch_array($sql)){
  	$tgl = tgl_indo($s[tgl]);

 	    if ($s['url']!=''){
		echo "<span class=date><img src=images/clock.gif> $tgl - $s[jam] WIB</span><br />";
        echo "<span class=komentar><a href='http://$s[url]' target='_blank'>$s[nama_komentar]</a></span><br />";
		
	    }
	    else{
        echo "<span class=komentar>$s[nama_komentar]</span><br />";  
      }
		
      $isian=nl2br($s['isi_komentar']); 
	  $balas=($s['balas']);
	  if (strlen($balas) ==0 )	  
	    echo "$isian <hr />";
		else 
		echo "$isian<hr/>&nbsp;&nbsp;&gt;&gt;&nbsp;&nbsp;<strong> <em>Admin&nbsp;&nbsp;:</strong>  $balas</em><hr/>";
	
    }
  }	

  // Form komentar
  echo "<b>Isi Komentar :</b>
        <table width=100% style='border: 1pt dashed #0000CC;padding: 10px;'>
        <form action=simpankomentar.php method=POST >
        <input type=hidden name=id_berita value=$idnya>
        <input type=hidden name=id value=$_GET[id]>
        <tr><td>Nama</td><td> : <input type=text name=nama_komentar size=40 required></td></tr>
        <tr><td>Website</td><td> : <input type=url name=url size=40 required></td></tr>
        <tr><td valign=top>Komentar</td><td> <textarea name='isi_komentar' style='width: 315px; height: 100px;' required></textarea></td></tr>
        <tr><td>&nbsp;</td><td><img src='captcha.php' required></td></tr>
        <tr><td>&nbsp;</td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6><br /></td></tr>
        <tr><td>&nbsp;</td><td><input type=submit name=submit value=Kirim></td></tr>
        </form></table><br />";
}

// Modul berita per kategori
elseif ($_GET[module]=='detailkategori'){
  // Tampilkan nama kategori
  $sq = mysql_query("SELECT nama_kategori from kategori where id_kategori='$_GET[id]'");
  $n = mysql_fetch_array($sq);
  echo "<span class=posting>&#187; Kategori : <b>$n[kategori]</b></span><br /><br />";
  
  // Tampilkan daftar berita sesuai dengan kategori yang dipilih
 	$sql   = "SELECT * FROM berita WHERE id_kategori='$_GET[id]' 
            ORDER BY id_berita DESC";		 
	$hasil = mysql_query($sql);
	$jumlah = mysql_num_rows($hasil);
	// Apabila ditemukan berita dalam kategori
	if ($jumlah > 0){
   while($r=mysql_fetch_array($hasil)){
		$tgl = tgl_indo($r[tanggal]);
		echo "<span class=date><img src=images/clock.gif>$r[hari], $tgl - $r[jam] WIB</span><br />";
		echo "<span class=judul><a href=?module=detailberita&id=$r[id_berita]>$r[judul]</a></span><br /><hr>";
		}
	 }
	 
  }

/* Bagian Profil
elseif ($_GET[module]=='profil'){
echo "<span> <img src='images/profil.png' width=55px height=65px style='float:left;padding-right:10px;'/></span><span><h3>Profil</h3>Profil Jurusan Ilmu Pemerintahan Fakultas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya<hr noshade='noshade' /></span>";	
$profil = mysql_query ("SELECT * FROM profil");
$view = mysql_fetch_array($profil);

echo "<tr><td class=isi>";
 if ($view[gambar_profil]!=''){
		echo "<img src='gambar/foto_banner/$view[gambar_profil]' width=170 height=140 align=left hspace=10>";
		}
echo"$view[isi_profil]</td><br />";

}
*/

//Bagian sejarah
elseif ($_GET[module]=='sejarah'){
echo "<span><h1>Sejarah</h1>Dinas Kelautan dan Perikanan Provinsi Kalimantan Tengah</span><hr/>";	
$sejarah = mysql_query ("SELECT * FROM halamanstatis where id_halaman=3");
$view = mysql_fetch_array($sejarah);

echo "<tr><td class=isi_halaman>";
 if ($view[gambar]!=''){
		echo "<img src='gambar/foto_link/$view[gambar]' width=130 height=130 align=left hspace=10>";
		}
echo"$view[isi_halaman]</td><br />";

}

// Bagian visi misi
elseif ($_GET[module]=='visimisi'){
echo "<span><h1>Visi & Misi</h1>Dinas Kelautan dan Perikanan Provinsi Kalimantan Tengah</span><hr/>";	
$visimisi= mysql_query ("SELECT * FROM halamanstatis where id_halaman=2");
$view = mysql_fetch_array($visimisi);

echo "<tr><td class=isi_halaman>";
 if ($view[gambar]!=''){
		echo "<img src='gambar/foto_banner/$view[gambar_visimisi]' width=170 height=140 align=left hspace=10>";
		}
echo"$view[isi_halaman]</td><br />";

}

// Bagian Tujuan
elseif ($_GET[module]=='tujuan'){
echo "<span><h1>Stuktur Organisasi</h1>Dinas Kelautan dan Perikanan Provinsi Kalimantan Tengah</span><hr/>";	
$tujuan = mysql_query ("SELECT * FROM halamanstatis where id_halaman=1");
$view = mysql_fetch_array($tujuan);

echo "<tr><td class=isi_halaman>";
 if ($view[gambar]!=''){
		echo "<img src='foto/foto_banner/$view[gambar]' align=center hspace=10>";
		}
echo"$view[isi_halaman]</td><br />";

}

// Bagian Kompetensi
elseif ($_GET[module]=='kompetensi'){
echo "<span><h1>Tugas dan Fungsi</h1>Dinas Kelautan dan Perikanan Provinsi Kalimantan Tengah</span><hr/>";	
$kompetensi = mysql_query ("SELECT * FROM halamanstatis where id_halaman=4");
$view = mysql_fetch_array($kompetensi);

echo "<tr><td class=isi_halaman>";
 if ($view[gambar]!=''){
		echo "<img src='gambar/foto_banner/$view[gambar_tatatertib]' width=170 height=140 align=left hspace=10>";
		}
echo"$view[isi_halaman]</td><br />";

}

/*
// Bagian Profil Dosen
elseif ($_GET[module]=='dosen'){
echo "<span> <img src='images/pegawai.png' width=55px height=65px style='float:left;padding-right:10px;'/></span><span><h3>Profil Dosen</h3>Berikut ini adalah Profil Dosen Jurusan Ilmu Pemerintahan Fakulas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya<hr noshade='noshade' /></span>";	
  $p      = new Paging;
  $batas  = 2;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("select * from dosen ORDER by id_dosen DESC limit $posisi,$batas");

	while($t=mysql_fetch_array($terkini)){
		 if ($t[gambar]!=''){
			echo "<span class=image align=left><img src='gambar/foto_dosen/small_$t[gambar]' width=110 border=0></span>";
		}
    echo "<br/><br/><br/><table>
	        <tr><td colspan=2><span class=judul><a href=?module=detaildosen&id=$t[id_dosen]>$t[nama]</a></span></td></tr>

		  <tr><td>NIP</td><td>:	$t[nip]</td></tr><br/>
		  <tr><td>Golongant</td><td>:	$t[golongan]</td></tr><br/>
		  <tr><td>Jabatan</td><td>:	$t[jabatan]</td></tr><br/>
		  <tr><td>Jenis Kelamin</td><td>:	$t[jenis_kel]</td></tr><br/>
		  <tr><td>Pendidikan Terakhir</td><td>:	$t[pend_akhir]</td></tr><br/></table><hr>";
		  }
  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM dosen"));	
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

  echo "<tr><td class=kembali>$linkHalaman</td></tr><br/><br/>";
	
	echo "</ul>";
}
// Bagian detail Dosen
elseif ($_GET[module]=='detaildosen'){
echo "<span> <img src='images/pegawai.png' width=55px height=65px style='float:left;padding-right:10px;'/></span><span><h3>Profil Dosen</h3>Berikut ini adalah Profil Dosen Jurusan Ilmu Pemerintahan Fakulas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya<hr noshade='noshade' /></span>";	
 $terkini=mysql_query("select * from dosen where id_dosen='$_GET[id]'");

	while($t=mysql_fetch_array($terkini)){
		 if ($t[gambar]!=''){
			echo "<span class=image align=left><img src='gambar/foto_dosen/small_$t[gambar]' width=110 border=0></span>";
		}
    echo "<br/><br/><br/><table>
	        <tr><td colspan=2><span class=judul><a href=?module=detaildosen&id=$t[id_dosen]>$t[nama]</a></span></td></tr>

		  <tr><td>NIP</td><td>:	$t[nip]</td></tr><br/>
		  <tr><td>Golongant</td><td>:	$t[golongan]</td></tr><br/>
		  <tr><td>Jabatan</td><td>:	$t[jabatan]</td></tr><br/>
		  <tr><td>Jenis Kelamin</td><td>:	$t[jenis_kel]</td></tr><br/>
		  <tr><td>Pendidikan Terakhir</td><td>:	$t[pend_akhir]</td></tr><br/></table><hr>";
		  }
	
	echo "</ul>";
}
*/

// Bagian profil dosen
elseif ($_GET[module]=='dosen'){
echo "<span><h1>Data Pegawai</h1>Jurusan Ilmu Pemerintahan Fakulas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya</span><hr/>";
//echo "<span><form method='get' action='home.php'>Pencarian &nbsp;: &nbsp;<input type='text' name='q' />&nbsp;<input type='submit' name='cari' value='Cari' /><input type='hidden' name='module' value='dosen'/></form><hr/></span>";

	if(isset($_GET['q'])){
		$where="where nama like '%$_GET[q]%'";
	}else{
		$where="";
	}
 
  $p      = new Paging;
  $batas  = 4;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("select * from dosen ORDER by nama ASC limit $posisi,$batas ");

	while($t=mysql_fetch_array($terkini)){
	
	 echo " <table width='80%' style='margin-top:-190px;'><br/><br/><br/>
	        <td colspan=3><span class=judul><a href=?module=detaildosen&id=$t[id_dosen]></a></span></td><td rowspan=13 valign='top'>";
		 if ($t[gambar]!=''){
			echo "<span class=image><img style='padding-top:5px' src='gambar/foto_dosen/small_$t[gambar]' width='110' hight='110' border=0></span>";
		}
    echo "<tr><td colspan=4><span class=judul><a href=?module=detaildosen&id=$t[id_dosen]>$t[nama]</a></span></td></tr>
		  <br/>
		  <tr><td>NIP</td><td>:	$t[nip]</td></tr><br/>
		  <br/>";
	echo " <tr><td>TTL</td><td>: $t[ttl]</td></tr><br/>
		  <br/>
		  <tr><td>Jenis Kelamin</td><td>: $t[jenis_kel]</td></tr><br/>
		  <br/></table><hr>";
		  }
  
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM dosen"));	
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

  echo "<tr><td class=kembali>$linkHalaman</td></tr><br/><br/>";
	
	echo "</ul>";

}

// Bagian detail dosen
elseif ($_GET[module]=='detaildosen'){
echo "<span><h1>Profil Dosen</h1>Jurusan Ilmu Pemerintahan Fakulas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya</span><br/><hr/>";	
 $terkini=mysql_query("select * from dosen where id_dosen='$_GET[id]'");
echo "<span class=judul_head>&#187; <a href=?module=dosen><b>Profil Dosen</b></a></span><br /><hr/>"; 
	while($t=mysql_fetch_array($terkini)){

		  if ($t[gambar]!=''){
			echo "<span><img align='right' style='padding-right:100px;padding-top:25px' src='gambar/foto_dosen/small_$t[gambar]' width='150' border=0></span>";
		}
    echo "<tr><td colspan=2><span class=judul><a href=?module=detaildosen&id=$t[id_dosen]>$t[nama]<br/><br/></a></span></td></tr>
	<tr><td>NIP &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>: $t[nip]</td></tr><br/>
	<br/>
	<tr><td>Jabatan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>: $t[jab]</td></tr><br/>
	<br/>
	<tr><td>TTL &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>: $t[ttl]</td></tr><br/>
	<br/>
	<tr><td>Jenis Kelamin &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>: $t[jenis_kel]</td></tr><br/>
    <br/>
	<tr><td>Jabatan Fungsional &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>: $t[jabatan]</td></tr><br/>
	<br/>
	<tr><td>Golongan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>: $t[golongan]</td></tr><br/>
	<br/>
	<tr><td>Pendidikan Terakhir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td>: $t[pend_akhir]</td></tr><br/></table><hr>";
	}	
	echo "</ul>";
}

// Bagian Mahasiswa
elseif ($_GET[module]=='mahasiswa'){
echo "<span><h1>Data Mahasiswa</h1>Jurusan Ilmu Pemerintahan Fakultas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya</span><hr/>";	

  $p      = new Paging;
  $batas  = 5;
  $posisi = $p->cariPosisi($batas);
 $terkini=mysql_query("select * from mahasiswa ORDER by id_mhs DESC LIMIT 5");

  $no =$posisi+1;					  

  echo "<ul>";   
  echo "<table cellpadding=5px>
<th align='center'>No</th>
<th align='center'>TAHUN ANGKATAN</th>
<th align='center'>JUMLAH MAHASISWA</th>";
while ($view = mysql_fetch_array($terkini)) {
echo"<tr align='center'>
	<td><b>$no</b></td>
	<td><b>$view[tahun]</td>
	<td align='center'><b>$view[jumlah] Orang</b></td>
	<tr><td colspan=3><hr/></td></tr>
	</tr>";
	$no++;
}

echo "</table><br/>";
echo "<span id='container'></span>";	
 
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM mahasiswa"));	
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

	
	echo "</ul>";

}



//Modul Mata Kuliah
elseif ($_GET[module]=='matakuliah'){
echo "<span><h1>Mata Kuliah</h1>Jurusan Ilmu Pemerintahan Fakultas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya<hr/></span>";	
 
 $p      = new Paging;
  $batas  =100;
  $posisi = $p->cariPosisi($batas);
 $terkini=mysql_query("select * from matkul ORDER by id_matkul ASC limit $posisi,$batas");
 $r = mysql_fetch_array($terkini);
 $no =$posisi+1;					   	

echo "<table width='100%' border='0'  cellpadding=5px>";
echo"<caption><h3>MATA KULIAH JURUSAN ILMU PEMERINTAHAN</h3></caption>";
//==MKWU==
echo"<tr><th>NO</th>
		<th>Kelompok</th>
		<th>SKS</th>
		<th>Mata Kuliah</th>
		<th>Kelompok2</th>
		<th>Semester</th>
		<th>KODE MK</th>";
If ($r[jns_matkul]=='MATA KULIAH WAJIB UMUM (MKWU)'){
echo"<tr><td colspan=7><h3>MATA KULIAH WAJIB UMUM (MKWU)</h3><hr/></td>";
}
while ($view = mysql_fetch_array($terkini)) {

If ($view[kelompok2]=='1.MKWU'){
echo"<tr align='center'>
    <td>$no</td>
	<td>$view[Kelompok]</td>
	<td>$view[jml_sks]</td>
	<td align='left'>$view[nama_matkul]</td>
	<td>$view[kelompok2]</td>
	<td>$view[semester]</td>
	<td>$view[kd_matkul]</td>
	</tr>";
	$no++;
}
}

//MKWF
$terkini=mysql_query("select * from matkul ORDER by id_matkul ASC limit $posisi,$batas");
 $r = mysql_fetch_array($terkini);
 $no =$posisi+1;					  
 
If ($r[jns_matkul]=='MATA KULIAH WAJIB UMUM (MKWU)'){
echo"<tr><td colspan=7><h3>MATA KULIAH WAJIB FAKULTAS (MKWF)</h3><hr/></td>";
}
while ($view = mysql_fetch_array($terkini)) {
if($view[kelompok2]=='2.MKWF'){
echo"<tr align='center'>
    <td>$no</td>
	<td>$view[Kelompok]</td>
	<td>$view[jml_sks]</td>
	<td align='left'>$view[nama_matkul]</td>
	<td>$view[kelompok2]</td>
	<td>$view[semester]</td>
	<td>$view[kd_matkul]</td>
	</tr>";
	$no++;
}
}

//MKWJ

$terkini=mysql_query("select * from matkul ORDER by id_matkul ASC limit $posisi,$batas");
 $r = mysql_fetch_array($terkini);
 $no =$posisi+1;					  
 
If ($r[jns_matkul]=='MATA KULIAH WAJIB UMUM (MKWU)'){
echo"<tr><td colspan=7><h3>MATA KULIAH WAJIB JURUSAN (MKWJ)</h3><hr/></td>";
}
while ($view = mysql_fetch_array($terkini)) {
if($view[kelompok2]=='3.MKWJ'){
echo"<tr align='center'>
    <td>$no</td>
	<td>$view[Kelompok]</td>
	<td>$view[jml_sks]</td>
	<td align='left'>$view[nama_matkul]</td>
	<td>$view[kelompok2]</td>
	<td>$view[semester]</td>
	<td>$view[kd_matkul]</td>
	</tr>";
	$no++;
}
}

//MKWKSPol

$terkini=mysql_query("select * from matkul ORDER by id_matkul ASC limit $posisi,$batas");
 $r = mysql_fetch_array($terkini);
 $no =$posisi+1;					  
 
If ($r[jns_matkul]=='MATA KULIAH WAJIB UMUM (MKWU)'){
echo"<tr><td colspan=7><h3>MATA KULIAH WAJIB KONSENTRASI POLITIK LOKAL & PEMERINTAHAN DAERAH (MKWKPol)</h3><hr/></td>";

while ($view = mysql_fetch_array($terkini)) {
if($view[kelompok2]=='4.MKWKPol'){
echo"<tr align='center'>
    <td>$no</td>
	<td>$view[Kelompok]</td>
	<td>$view[jml_sks]</td>
	<td align='left'>$view[nama_matkul]</td>
	<td>$view[kelompok2]</td>
	<td>$view[semester]</td>
	<td>$view[kd_matkul]</td>
	</tr>";
	$no++;
}
}
}
//MKWKSOto

$terkini=mysql_query("select * from matkul ORDER by id_matkul ASC limit $posisi,$batas");
 $r = mysql_fetch_array($terkini);
 $no =$posisi+1;					  
 
If ($r[jns_matkul]=='MATA KULIAH WAJIB UMUM (MKWU)'){
echo"<tr><td colspan=7><h3>MATA KULIAH WAJIB KONSENTRASI OTONOMI DESA & KELEMBAGAAN ADAT (MKWKOto)</h3><hr/></td>";

while ($view = mysql_fetch_array($terkini)) {
if($view[kelompok2]=='5.MKWKOto'){
echo"<tr align='center'>
    <td>$no</td>
	<td>$view[Kelompok]</td>
	<td>$view[jml_sks]</td>
	<td align='left'>$view[nama_matkul]</td>
	<td>$view[kelompok2]</td>
	<td>$view[semester]</td>
	<td>$view[kd_matkul]</td>
	</tr>";
	$no++;
}
}
}
//MKWKSLeg

$terkini=mysql_query("select * from matkul ORDER by id_matkul ASC limit $posisi,$batas");
 $r = mysql_fetch_array($terkini);
 $no =$posisi+1;					  
 
If ($r[jns_matkul]=='MATA KULIAH WAJIB UMUM (MKWU)'){
echo"<tr><td colspan=7><h3>MATA KULIAH WAJIB KONSENTRASI LEGISLASI & KEUANGAN DAERAH (MKWKLeg)</h3><hr/></td>";
}
while ($view = mysql_fetch_array($terkini)) {
if($view[kelompok2]=='6.MKWKLeg'){
echo"<tr align='center'>
    <td>$no</td>
	<td>$view[Kelompok]</td>
	<td>$view[jml_sks]</td>
	<td align='left'>$view[nama_matkul]</td>
	<td>$view[kelompok2]</td>
	<td>$view[semester]</td>
	<td>$view[kd_matkul]</td>
	</tr>";
	$no++;
}
}

//MKP

$terkini=mysql_query("select * from matkul ORDER by id_matkul ASC limit $posisi,$batas");
 $r = mysql_fetch_array($terkini);
 $no =$posisi+1;					  
 
If ($r[jns_matkul]=='MATA KULIAH WAJIB UMUM (MKWU)'){
echo"<tr><td colspan=7><h3>MATA KULIAH PILIHAN (MKP)</h3><hr/></td>";
}
while ($view = mysql_fetch_array($terkini)) {
if($view[kelompok2]=='7.MKP'){
echo"<tr align='center'>
    <td>$no</td>
	<td>$view[Kelompok]</td>
	<td>$view[jml_sks]</td>
	<td align='left'>$view[nama_matkul]</td>
	<td>$view[kelompok2]</td>
	<td>$view[semester]</td>
	<td>$view[kd_matkul]</td>
	</tr>";
	$no++;
}
}
echo "</table><br/>";
 
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM matkul "));	
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);
  
  echo "<tr><td class=kembali>$linkHalaman</td></tr><br/><br/>";
	
	echo "</ul>";
}

// Modul jadwal kuliah
elseif ($_GET[module]=='jadwalkul'){
echo "<span><h1>Jadwal Kuliah</h1>Jurusan Ilmu Pemerintahan Fakultas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya<hr/></span>";	
echo"<span><b>&#187; Silahkan pilih tahun akademik unuk melihat jadwal kuliah</b></span>";
echo "<table cellpadding=5px>
		<tr><td><img src='images/jadwal_kul.png' width=50px hight=50px style='border:1px;float:center;padding-top:0px;padding-left:0px;'/></td>
		<td align=left><span><form method='get' action='home.php'> <b>Jadwal Kuliah Tahun Akademik &nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;
		<select name='thun'>
			<option value=0 selected>-- Pilih Tahun Akademik--</option>";
				$tampil=mysql_query("SELECT * FROM tahun ORDER BY thn");
				while($r=mysql_fetch_array($tampil)){
				echo "<option value=$r[id_tahun]>$r[thn]</option>";
				} 
		echo"</select></br>
		<b>Semester (Genap/Ganjil)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b>&nbsp;&nbsp;&nbsp;&nbsp;
		<select name='smes'>
			<option value=0 selected>-- Pilih Semester--</option>
			<option value='Ganjil'>Ganjil</option>
			<option value='Genap'>Genap</option>";
				
		echo"</select>

	  <input type='submit' name='cari' value='Lihat' /><input type='hidden' name='module' value='detailjadwalkul'/>
	  </form></span></td></br></table><hr/>";


	 // echo"<img src='images/jadwal_kul.png' style='border:1px;float:center;padding-top:50px;padding-left:0px;'/>";
/*
echo "<form method='POST' action='' id='form'>  
<label for='txtsearch'>Jadwal Kuliah Tahun Akademik : 
<select name='kategori'>  
	<option value=0 selected>-- Pilih --</option>";
	$tampil=mysql_query("SELECT * FROM tahun ORDER BY thn");
    while($r=mysql_fetch_array($tampil)){
          echo "<option value=$r[id_tahun]>$r[thn]</option>";
            } 
echo"</select>
<input type='submit' value='Pilih' name='submit'/><hr/> ";
*/
/*
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun ORDER BY jam ASC limit $posisi,$batas");
  $no =$posisi+1;
 echo "<ul>";   
echo "<table width='100%' border='0' cellpadding=5px>";
echo"<caption><h3 align='center'>JADWAL KULIAH JURUSAN ILMU PEMERINTAHAN</h3></caption>";
//==SENIN==
echo"<tr><th>Hari/Pukul</th>
		<th>Mata Kuliah</th>
		<th>SKS</th>
		<th>Semester</th>
		<th>Dosen</th>";
echo"<tr align=center ><td ><h3>SENIN</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Senin'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}
//==SELASA==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
 $terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun ORDER BY jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>SELASA</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Selasa'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}

//==RABU==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
 $terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun ORDER BY jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>RABU</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Rabu'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}

//==KAMIS==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
 $terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun ORDER BY jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>KAMIS</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Kamis'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}


//==JUMAT==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun ORDER BY jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>JUMAT</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Jumat'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}

//==SABTU==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
 $terkini=mysql_query("select * from jadwal_kul, matkul where matkul.id_matkul=jadwal_kul.id_matkul ORDER by jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>SABTU</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Sabtu'){
echo"<tr align='center'>
	<td>$view[jam]<hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[smt]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}

echo "</table><br/>";
 
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM jadwal_kul"));	
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

 // echo "<tr><td class=kembali>$linkHalaman</td></tr><br/><br/>";
	
	echo "</ul>";
*/
	
}


// Modul Detail Jadwal Kuliah

elseif ($_GET[module]=='detailjadwalkul'){
echo "<span><h1>Jadwal Kuliah</h1>Jurusan Ilmu Pemerintahan Fakultas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya<hr/></span>";	
//echo "<span class=judul_head>&#187; <a href=?module=jadwalkul><b>Jadwal Kuliah</b></a></span><br />";
echo"<span><b>&#187; Silahkan pilih tahun akademik unuk melihat jadwal kuliah</b></span>";
echo "<table cellpadding=5px>
		<tr><td><img src='images/jadwal_kul.png' width=50px hight=50px style='border:1px;float:center;padding-top:0px;padding-left:0px;'/></td>
		<td align=left><span><form method='get' action='home.php'> <b>Jadwal Kuliah Tahun Akademik &nbsp;&nbsp;:</b>&nbsp;&nbsp;&nbsp;&nbsp;
		<select name='thun'>
			<option value=0 selected>-- Pilih Tahun Akademik--</option>";
				$tampil=mysql_query("SELECT * FROM tahun ORDER BY thn");
				while($r=mysql_fetch_array($tampil)){
				echo "<option value=$r[id_tahun]>$r[thn]</option>";
				} 
		echo"</select></br>
		<b>Semester (Genap/Ganjil)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; :</b>&nbsp;&nbsp;&nbsp;&nbsp;
		<select name='smes'>
			<option value=0 selected>-- Pilih Semester--</option>
			<option value='Ganjil'>Ganjil</option>
			<option value='Genap'>Genap</option>";
				
		echo"</select>

	  <input type='submit' name='cari' value='Lihat' /><input type='hidden' name='module' value='detailjadwalkul'/>
	  </form></span></td></br></table><hr/>";

	  if(isset($_GET['thun'])AND($_GET['smes'])){
/*
		$where="where thn like '%$_GET[thn]%'";
	}else{
		$where="";

	}
*/
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun AND jadwal_kul.id_tahun LIKE '%$_GET[thun]%' AND jadwal_kul.smt2 LIKE '%$_GET[smes]%' ORDER BY jam ASC");
  $no =$posisi+1;
 echo "<ul>";   
echo "<table width='100%' border='0' cellpadding=5px>";
echo"<caption><h3 align='center'><b>JADWAL KULIAH JURUSAN ILMU PEMERINTAHAN</b></h3></caption>";
echo"<h3 align='center'></h3>";
//==SENIN==
echo"<tr><th>Hari/Pukul</th>
		<th>Mata Kuliah</th>
		<th>SKS</th>
		<th>Semester</th>
		<th>Dosen</th>";
echo"<tr align=center ><td ><h3>SENIN</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Senin'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}

//==SELASA==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun AND jadwal_kul.id_tahun LIKE '%$_GET[thun]%' AND jadwal_kul.smt2 LIKE '%$_GET[smes]%' ORDER BY jam ASC");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>SELASA</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Selasa'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}

//==RABU==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun AND jadwal_kul.id_tahun LIKE '%$_GET[thun]%' AND jadwal_kul.smt2 LIKE '%$_GET[smes]%' ORDER BY jam ASC");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>RABU</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Rabu'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}

//==KAMIS==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun AND jadwal_kul.id_tahun LIKE '%$_GET[thun]%' AND jadwal_kul.smt2 LIKE '%$_GET[smes]%' ORDER BY jam ASC");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>KAMIS</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Kamis'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}


//==JUMAT==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("SELECT * FROM jadwal_kul, matkul, tahun where jadwal_kul.id_matkul=matkul.id_matkul AND jadwal_kul.id_tahun=tahun.id_tahun AND jadwal_kul.id_tahun LIKE '%$_GET[thun]%' AND jadwal_kul.smt2 LIKE '%$_GET[smes]%' ORDER BY jam ASC");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>JUMAT</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Jumat'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
/*
//==SABTU==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
 $terkini=mysql_query("select * from jadwal_kul, matkul where matkul.id_matkul=jadwal_kul.id_matkul ORDER by jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>SABTU</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Sabtu'){
echo"<tr align='center'>
	<td>$view[jam]<hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[smt]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}

*/
}

echo "</table><br/>";
 
//  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM jadwal_kul"));	
//  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
//  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

 // echo "<tr><td class=kembali>$linkHalaman</td></tr><br/><br/>";
	
	echo "</ul>";
}


// Modul jadwal semester pendek
elseif ($_GET[module]=='jadwalsp'){
echo "<span><h1>Jadwal Semester Pendek</h1>Jurusan Ilmu Pemerintahan Fakultas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya<hr/></span>";	
 
 echo"<span><b>&#187; Silahkan pilih tahun akademik unuk melihat jadwal semester pendek</b></span>";
echo "<table cellpadding=5px>
		<tr><td><img src='images/jadwal_kul.png' width=50px hight=50px style='border:1px;float:center;padding-top:0px;padding-left:0px;'/></td>
		<td align=left><span><form method='get' action='home.php'> <b>Jadwal Semester Pendek Tahun Akademik :</b></br>
		<select name='tahn'>
			<option value=0 selected>-- Pilih Tahun Akademik--</option>";
				$tampil=mysql_query("SELECT * FROM tahun ORDER BY thn");
				while($r=mysql_fetch_array($tampil)){
				echo "<option value=$r[id_tahun]>$r[thn]</option>";
				} 
		echo"</select>

	  <input type='submit' name='cari' value='Lihat' /><input type='hidden' name='module' value='detailjadwalsp'/>
	  </form></span></td></br></table><hr/>";
 
 
 /*
 $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("select * from jadwal_sp, matkul where matkul.id_matkul=jadwal_sp.id_matkul ORDER by jam ASC limit $posisi,$batas");
  $no =$posisi+1;
 echo "<ul>";   
echo "<table width='100%' border='0' cellpadding=5px>";
echo"<caption><h3 align='center'>JADWAL SEMESTER PENDEK JURUSAN ILMU PEMERINTAHAN</h3></caption>";
//==SENIN==
echo"<tr><th>Hari/Pukul</th>
		<th>Mata Kuliah</th>
		<th>SKS</th>
		<th>Semester</th>
		<th>Dosen</th>";
echo"<tr align=center ><td ><h3>SENIN</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Senin'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[smt]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}


//==SELASA==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("select * from jadwal_sp, matkul where matkul.id_matkul=jadwal_sp.id_matkul ORDER by jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>SELASA</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Selasa'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[smt]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}


//==RABU==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("select * from jadwal_sp, matkul where matkul.id_matkul=jadwal_sp.id_matkul ORDER by jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>RABU</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Rabu'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[smt]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}

//==KAMIS==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("select * from jadwal_sp, matkul where matkul.id_matkul=jadwal_sp.id_matkul ORDER by jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>KAMIS</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Kamis'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[smt]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}


//==JUMAT==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("select * from jadwal_sp, matkul where matkul.id_matkul=jadwal_sp.id_matkul ORDER by jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>JUMAT</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Jumat'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[smt]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}
/*
//==SABTU==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("select * from jadwal_sp, matkul where matkul.id_matkul=jadwal_sp.id_matkul ORDER by jam ASC limit $posisi,$batas");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>SABTU</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Selasa'){
if ($view[tahun]==$thn_sekarang){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[smt]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
}

echo "</table><br/>";
 
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM jadwal_sp"));	
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

 // echo "<tr><td class=kembali>$linkHalaman</td></tr><br/><br/>";
*/
	echo "</ul>";
}


// Modul Detail Jadwal Semester Pendek

elseif ($_GET[module]=='detailjadwalsp'){
echo "<span><h1>Jadwal Semester Pendek</h1>Jurusan Ilmu Pemerintahan Fakultas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya<hr/></span>";	
//echo "<span class=judul_head>&#187; <a href=?module=jadwalkul><b>Jadwal Kuliah</b></a></span><br />";
echo"<span><b>&#187; Silahkan pilih tahun akademik unuk melihat jadwal semester pendek</b></span>";
echo "<table cellpadding=5px>
		<tr><td><img src='images/jadwal_kul.png' width=50px hight=50px style='border:1px;float:center;padding-top:0px;padding-left:0px;'/></td>
		<td align=left><span><form method='get' action='home.php'> <b>Jadwal Semester Pendek Tahun Akademik :</b></br>
		<select name='tahn'>
			<option value=0 selected>-- Pilih Tahun Akademik--</option>";
				$tampil=mysql_query("SELECT * FROM tahun ORDER BY thn");
				while($r=mysql_fetch_array($tampil)){
				echo "<option value=$r[id_tahun]>$r[thn]</option>";
				} 
		echo"</select>

	  <input type='submit' name='cari' value='Lihat' /><input type='hidden' name='module' value='detailjadwalsp'/>
	  </form></span></td></br></table><hr/>";

	  if(isset($_GET['tahn'])){
/*
		$where="where thn like '%$_GET[thn]%'";
	}else{
		$where="";

	}
*/
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("SELECT * FROM jadwal_sp, matkul, tahun where jadwal_sp.id_matkul=matkul.id_matkul AND jadwal_sp.id_tahun=tahun.id_tahun AND jadwal_sp.id_tahun LIKE '%$_GET[tahn]%' ORDER BY jam ASC");
  $no =$posisi+1;
 echo "<ul>";   
echo "<table width='100%' border='0' cellpadding=5px>";
echo"<caption><h3 align='center'><b>JADWAL SEMESTER PENDEK JURUSAN ILMU PEMERINTAHAN</b></h3></caption>";
echo"<h3 align='center'></h3>";
//==SENIN==
echo"<tr><th>Hari/Pukul</th>
		<th>Mata Kuliah</th>
		<th>SKS</th>
		<th>Semester</th>
		<th>Dosen</th>";
echo"<tr align=center ><td ><h3>SENIN</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Senin'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}

//==SELASA==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("SELECT * FROM jadwal_sp, matkul, tahun where jadwal_sp.id_matkul=matkul.id_matkul AND jadwal_sp.id_tahun=tahun.id_tahun AND jadwal_sp.id_tahun LIKE '%$_GET[tahn]%' ORDER BY jam ASC");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>SELASA</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Selasa'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}

//==RABU==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("SELECT * FROM jadwal_sp, matkul, tahun where jadwal_sp.id_matkul=matkul.id_matkul AND jadwal_sp.id_tahun=tahun.id_tahun AND jadwal_sp.id_tahun LIKE '%$_GET[tahn]%' ORDER BY jam ASC");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>RABU</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Rabu'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}

//==KAMIS==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("SELECT * FROM jadwal_sp, matkul, tahun where jadwal_sp.id_matkul=matkul.id_matkul AND jadwal_sp.id_tahun=tahun.id_tahun AND jadwal_sp.id_tahun LIKE '%$_GET[tahn]%' ORDER BY jam ASC");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>KAMIS</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Kamis'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}


//==JUMAT==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("SELECT * FROM jadwal_sp, matkul, tahun where jadwal_sp.id_matkul=matkul.id_matkul AND jadwal_sp.id_tahun=tahun.id_tahun AND jadwal_sp.id_tahun LIKE '%$_GET[tahn]%' ORDER BY jam ASC");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>JUMAT</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Jumat'){
echo"<tr align='center'>
	<td><b>$view[jam]</b><hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[semester]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}
/*
//==SABTU==
  $p      = new Paging;
  $batas  = 50;
  $posisi = $p->cariPosisi($batas);
$terkini=mysql_query("SELECT * FROM jadwal_sp, matkul, tahun where jadwal_sp.id_matkul=matkul.id_matkul AND jadwal_sp.id_tahun=tahun.id_tahun AND jadwal_sp.id_tahun LIKE '%$_GET[tahn]%' ORDER BY jam ASC");
 $no =$posisi+1;					  

  echo "<ul>";   
echo"<tr align=center ><td ><h3>SABTU</h3><hr color=#000 noshade=noshade/></td></tr>";
while ($view = mysql_fetch_array($terkini)) {
if ($view[hari]=='Sabtu'){
echo"<tr align='center'>
	<td>$view[jam]<hr/></td>";
echo"<td align=left>$view[nama_matkul]<hr/></td>";
echo"<td>$view[jml_sks]<hr/></td>
	<td>$view[smt]<hr/></td>
	<td>$view[dosen_kood]<hr/></td>
	</tr>";
	$no++;
}
}

*/
}

echo "</table><br/>";
 
//  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM jadwal_kul"));	
//  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
//  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

 // echo "<tr><td class=kembali>$linkHalaman</td></tr><br/><br/>";
	
	echo "</ul>";
}





// Bagian Info Jurusan
elseif ($_GET[module]=='info'){
echo "<span><h1>Info Jurusan</h1>Jurusan Ilmu Pemerintahan Fakultas Ilmu Sosial & Ilmu Politik Universitas Palangka Raya<hr/></span>";	
$p      = new Paging;
  $batas  = 6;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("select * from info ORDER BY id_info DESC LIMIT $posisi,$batas");

 //$terkini=mysql_query("select * from pengumuman");

// 	$terkini= mysql_query("SELECT * FROM pengumuman ORDER BY id_pengumuman DESC LIMIT 4");		 
	while($t=mysql_fetch_array($terkini)){
		$tgl = tgl_indo($t[tgl]);
		echo "<span class=date><img src=images/clock.gif> $t[hari], $tgl - $t[jam] WIB</span><br />";
		echo "<span class=judul><a href=?module=detailinfo&id=$t[id_info]>$t[judul]</a></span><br />";
		 
 		// Apabila ada gambar dalam pengumuman, tampilkan
	if ($t[gambar]!=''){
	echo "<span class=image><img src='gambar/foto_berita/small_$t[gambar]' width=110 border=0></span>";
		}
    // Tampilkan hanya sebagian isi pengumuman
    $isi_info = htmlentities(strip_tags($t[isi_info])); // mengabaikan tag html
    $isi_info = substr($isi_info,0,100); // ambil sebanyak 100 karakter
    $isi_info = substr($isi_info,0,strrpos($isi_info," ")); // potong per spasi kalimat

    echo "$isi_info ... <br/><a href=?module=detailinfo&id=$t[id_info]>Baca Selengkapnya</a>
          <br /><hr noshade=noshade />";
	}
	echo "</ul>";
	
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM info"));	
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

  echo "<tr><td class=kembali>$linkHalaman</td></tr><br/><br/>";
	
 
}

// Bagian detail info
elseif ($_GET[module]=='detailinfo'){
 $terkini=mysql_query("select * from info WHERE id_info='$_GET[id]'");

	while($t=mysql_fetch_array($terkini)){
    	echo "<span class=date><img src=images/clock.gif> $t[hari], $tgl - $t[jam] WIB</span><br />";
		echo "<span class=judul><a href=?module=detailinfo&id=$t[id_info]>$t[judul]</a></span><br />";
		 if ($t[gambar]!=''){
			
			echo "<span class=image><img src='gambar/foto_berita/small_$t[gambar]' width=110 border=0></span>";
		}
	echo "$t[isi_info]";
		//Apabila ada lampiran file
	if ($t[nm_file]!=''){
	echo "<br/><br/>Silahkan download &nbsp;<a href='downlot.php?file=$t[nm_file]'><strong>disini</strong><a>";
	}
	
	}
	
	echo "</ul>";
}


// Modul semua album
elseif ($_GET['module']=='galeri'){
  echo "<div id='content'>          
        <div id='content-detail'>";
echo "<span><h1>Galeri Foto</h1><br/><hr/></span>";	
  echo "<span class=judul_head>&#187; <b>Album Foto</b></span><br/><br/>"; 
  // Tentukan kolom
  $col = 3;

  $a = mysql_query("SELECT jdl_album, album.id_album, gbr_album,  
                  COUNT(gallery.id_gallery) AS jumlah 
                  FROM album LEFT JOIN gallery 
                  ON album.id_album=gallery.id_album 
                  WHERE album.aktif='Y'  
                  GROUP BY jdl_album");
  echo "<table><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($a)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
  }
  $cnt++;


 echo "<th align=center valign=top><br />
    <a href='home.php?module=detailgaleri&id=$w[id_album]'>
    <img class='img2' src='foto/img_album/kecil_$w[gbr_album]' border=0 width=120 height=90><br />
    $w[jdl_album]</a><br />($w[jumlah] Foto)<br /></th>";
}
echo "</tr></table>";
  echo "</div>
    </div>";            
}


// Modul galeri foto berdasarkan album
elseif ($_GET['module']=='detailgaleri'){

  echo "<div id='content'>          
          <div id='content-detail'>";
echo "<span><h1>Galeri Foto</h1><br/><hr/></span>";		
  echo "<span class=judul_head>&#187; <a href=?module=galeri><b>Album Foto</b></a> &#187; <b>Foto</b></span><br />"; 
  $p      = new Paging;
  $batas  = 25;
  $posisi = $p->cariPosisi($batas);

  // Tentukan kolom
  $col = 5;

  $g = mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]' ORDER BY id_gallery DESC LIMIT $posisi,$batas");
  $ada = mysql_num_rows($g);
  
  if ($ada > 0) {
  echo "<table><tr>";
  $cnt = 0;
  while ($w = mysql_fetch_array($g)) {
    if ($cnt >= $col) {
      echo "</tr><tr>";
      $cnt = 0;
    }
    $cnt++;

   echo "<th align=center valign=top><br />
		<a href='foto/img_galeri/$w[gbr_gallery]' title='$w[keterangan]' class='lightbox' rel='group1'>
         
         <img src='foto/img_galeri/kecil_$w[gbr_gallery]' alt='$w[keterangan]' /></a><br />
         <b>$w[jdl_gallery]</b></a></th>";
  }
  echo "</tr></table><br />";

  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM gallery WHERE id_album='$_GET[id]'"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

  echo "Hal: $linkHalaman <br /><br />";
  }else{
    echo "<p>Belum ada foto.</p>";
  }
  echo "</div>
    </div>";            
}


// Bagian Tampil Buku Tamu
elseif ($_GET[module]=='bukutamu'){
echo "<span><h1>Buku Tamu</h1>Silahkan mengisi Buku Tamu di Bawah ini.<hr/></span>";	
  $p      = new Paging;
  $batas  = 5;
  $posisi = $p->cariPosisi($batas);
$sql = mysql_query ("SELECT * FROM buku_tamu where aktif='Y' ORDER by id_bukutamu ASC limit $posisi,$batas");
while ($r = mysql_fetch_array ($sql)) {
	$tgl = tgl_indo($r[tgl]);

echo "<span class=date><img src=images/clock.gif> $r[hari], $tgl - $r[jam] WIB</span>
	 <table><tr><td>Nama&nbsp;&nbsp; : &nbsp; $r[nama]</td></tr><br/>
	  <tr><td>Situs &nbsp;&nbsp;&nbsp; : &nbsp; <a href='$r[email]' target=_blank>$r[email]</a></td></tr><br/>
	  <tr><td>Pesan&nbsp; : &nbsp;$r[isi_bukutamu]</td></tr>";
if(!empty($r['balas'])) 
echo "<tr><td><hr/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong><em> Admin </strong>&nbsp; : &nbsp $r[balas]</em></td></tr>";
echo "</table><hr/> ";
}
  $jmldata     = mysql_num_rows(mysql_query("SELECT * FROM buku_tamu  where aktif='Y'"));	
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

  echo "<tr><td class=kembali>$linkHalaman</td></tr><br/><br/>";
 
echo "<br/><span class=judul>Isi Buku Tamu</span>
		 <table width=95% style='border: 1pt dashed #0000CC;padding: 5px;'>
		<form method=POST action='inputbuku.php' onSubmit='return validasi3(this)'>  
        <tr><td class=isi>Nama   </td><td>:</td><td> <input type=text name=nama size=35 required></td></tr>
        <tr><td class=isi>E-Mail </td><td>:</td><td> <input type=email name=email size=35 required></td></tr>
        <tr><td class=isi>Pesan  </td><td>:</td><td> <br><textarea name=isi_bukutamu rows=10 cols=50 required></textarea></td></tr>
		<tr><td></td><td></td><td><img src='captcha.php'></td></tr>
        <tr><td></td><td></td><td>(Masukkan 6 kode diatas)<br /><input type=text name=kode size=6><br /></td></tr>

        <tr><td></td><td></td><td><input name='inputbuku' input type=submit value=Simpan></td></tr>
        </form></table><br/>";
		
	
}
 
 elseif ($_GET['module']=='PEGAWAI'){
	include "modul/mod_pegawai/pegawai.php";	
}
?>