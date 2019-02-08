<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "class_paging.php";

// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='ADMIN'){

$jam=date("H:i:s");
$tgl=tgl_indo(date("Y m d")); 	
  echo "<br /><p align=center>Hai <b>$_SESSION[nama]</b>, selamat datang di halaman Administrator. 
          Silahkan klik menu pilihan untuk mengelola content website. <br /> <b>$hari_ini, $tgl, $jam </b>WIB</p><br />";

echo "  <div style=\"display: inline-block; width: 100%; margin-bottom: 15px; clear: both;\">
        <div style=\"float: left; width: 49%;\">
        <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">Komentar Terbaru</div>";          
echo "<table class=\"list\">
            <thead>
            <tr>
             <td class=\"left\">Nama</td>
              <td class=\"left\">Isi Komentar</td>
              <td class=\"left\">Tanggal</td>
              <td class=\"left\">Aksi</td>
            </tr>
          </thead>";
    $tampil=mysql_query("SELECT * FROM komentar ORDER BY id_komentar DESC LIMIT 2");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
		$tgl=tgl_indo(date($r[tgl]));
      echo "<tbody><tr>
                <td class=\"left\">$r[nama_komentar]</td>
                <td class=\"left\">$r[isi_komentar]</td>
                <td class=\"left\" width='70'>$tgl</td>
                <td class=\"left\"><a href=?module=komentar&act=editkomentar&id=$r[id_komentar]>edit</a></td>                
                </tr>";
    $no++;
    }
    echo "</tbody></table>";
echo "</div>";
echo "<div style=\"float: right; width: 49%;\">
        <div style=\"background: #FFF; color: #547C96; border: 1px solid #8EAEC3; padding: 5px; font-size: 14px; font-weight: bold;\">Buku Tamu Terbaru</div>";          
  echo "<table class=\"list\">
            <thead>
            <tr>
             <td class=\"left\">Nama </td>
              <td class=\"left\">Isi Buku Tamu</td>
              <td class=\"left\">Tanggal</td>
              <td class=\"left\">Aksi</td>
            </tr>
          </thead>";
    $tampil=mysql_query("SELECT * FROM buku_tamu ORDER BY id_bukutamu DESC LIMIT 2");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo(date($r[tgl]));
  
      echo "<tbody><tr>
                <td class=\"left\">$r[nama]</td>
                <td class=\"left\">$r[isi_bukutamu]</td>
                <td class=\"left\">$tgl</td>
                <td class=\"left\"><a href=?module=hubungi&act=editbukutamu&id=$r[id_bukutamu]>balas</a></td>                
                </tr>";
    $no++;
    }
    echo "</tbody></table>";
    echo "</div></div>";


  }
  elseif ($_SESSION['leveluser']=='STAFF' or $_SESSION['leveluser']=='KEPALA' or $_SESSION['leveluser']=='PEGAWAI' or $_SESSION['leveluser']=='KADIS'){
  echo "<h2>Selamat Datang</h2>
  		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p align=center>Hai <b>$_SESSION[nama]</b>,Selamat datang di halaman Sistem Dinas Kelautan dan Perikanan Prov. Kalteng.<br> 
          Silahkan klik menu pilihan yang berada di sebelah atas untuk mengelola website. </p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>

          <p align=right>Login : $hari_ini, ";
  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo " WIB</p>";
 	}
}

// Bagian Pengguna
elseif ($_GET['module']=='user'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_users/mod_user.php";
  }
}

// Bagian Link
elseif ($_GET['module']=='link'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_link/link.php";
  }
}

// Bagian Kontak
elseif ($_GET['module']=='kontak'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_kontak/kontak.php";
  }
}

// Bagian Kategori
elseif ($_GET['module']=='kategori'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_kategori/kategori.php";
  }
}

// Bagian Berita
elseif ($_GET['module']=='berita'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_berita/berita.php";                            
  }
}

// Bagian Artikel
elseif ($_GET['module']=='artikel'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_artikel/artikel.php";                            
  }
}

// Bagian SuratMasuk
elseif ($_GET['module']=='suratmasuk'){
  if ($_SESSION['leveluser']=='STAFF' OR $_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_surat/suratmasuk.php";                            
  }
}

// Bagian SuratMasuk
elseif ($_GET['module']=='suratkeluar'){
  if ($_SESSION['leveluser']=='STAFF' OR $_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_surat/suratkeluar.php";                            
  }
}

// Bagian Histori SuratMasuk
elseif ($_GET['module']=='historismasuk'){
  if ($_SESSION['leveluser']=='STAFF' OR $_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_histori/historismasuk.php";                            
  }
}

// Bagian Histori SuratKeluar
elseif ($_GET['module']=='historiskeluar'){
  if ($_SESSION['leveluser']=='STAFF' OR $_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_histori/historiskeluar.php";                            
  }
}

// Bagian Laporan
elseif ($_GET[module]=='laporan'){
  if ($_SESSION['leveluser']=='ADMIN' OR $_SESSION['leveluser']=='STAFF'){
    include "modul/mod_laporan/laporan.php";
  }
}

// Bagian Pegawai
elseif ($_GET['module']=='pangkat'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_pangkat/pangkat.php";                            
  }
}

// Bagian Pegawai
elseif ($_GET['module']=='golongan'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_golongan/golongan.php";                            
  }
}

elseif ($_GET['module']=='bagian'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_bagian/bagian.php";                            
  }
}

elseif ($_GET['module']=='unit'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_unit/unit.php";                            
  }
}

// Bagian Pegawai
elseif ($_GET['module']=='pegawai'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_pegawai/pegawai.php";                            
  }
}

// Bagian PegawaiView
elseif ($_GET['module']=='pegawaiview'){
  if ($_SESSION['leveluser']=='KEPALA'){
    include "modul/mod_pegawaiview/pegawaiview.php";                            
  }
}

elseif ($_GET['module']=='pegawaiviewkadis'){
  if ($_SESSION['leveluser']=='KADIS'){
    include "modul/mod_pegawaiviewkadis/pegawaiviewkadis.php";                            
  }
}

// Bagian PegawaiView
elseif ($_GET['module']=='persetujuan_cuti'){
  if ($_SESSION['leveluser']=='KEPALA'){
    include "modul/mod_persetujuan_cuti/mod_persetujuan_cuti.php";                            
  }
}

elseif ($_GET['module']=='persetujuan_cutikadis'){
  if ($_SESSION['leveluser']=='KADIS'){
    include "modul/mod_persetujuan_cutikadis/mod_persetujuan_cutikadis.php";                            
  }
}

// Bagian PegawaiView
elseif ($_GET['module']=='permohonan_cuti'){
  if ($_SESSION['leveluser']=='PEGAWAI'){
    include "modul/mod_permohonan_cuti/mod_permohonan_cuti.php";                            
  }
}

elseif ($_GET['module']=='pembatalan_cuti'){
  if ($_SESSION['leveluser']=='PEGAWAI'){
    include "modul/mod_pembatalan_cuti/mod_pembatalan_cuti.php";                            
  }
}

// Bagian PegawaiView
elseif ($_GET['module']=='riwayat_cuti'){
  if ($_SESSION['leveluser']=='PEGAWAI'){
    include "modul/mod_riwayat_cuti/mod_riwayat_cuti.php";                            
  }
}

// Bagian PegawaiView
elseif ($_GET['module']=='datapribadi'){
  if ($_SESSION['leveluser']=='PEGAWAI'){
    include "modul/mod_datadiri/datapribadi.php";                            
  }
}

// Bagian Pegawai
elseif ($_GET['module']=='jabatan'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_jabatan/jabatan.php";                            
  }
}

// Bagian Periode
elseif ($_GET['module']=='periode'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_periode/periode.php";                            
  }
}

// Bagian Periode
elseif ($_GET['module']=='libur'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_hari_libur/libur.php";                            
  }
}
// Bagian Periode
elseif ($_GET['module']=='cetakijin'){
  if ($_SESSION['leveluser']=='PEGAWAI'){
    include "modul/mod_suratijin/mod_suratijin.php";                            
  }
}

// Bagian Periode
elseif ($_GET['module']=='lapadmin'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_suratijin/mod_suratijinadmin.php";                            
  }
}

// Bagian Periode
elseif ($_GET['module']=='riwayat_cuti_all'){
  if ($_SESSION['leveluser']=='KEPALA'){
    include "modul/mod_riwayat_cuti_all/mod_riwayat_cuti_all.php";                            
  }
}

elseif ($_GET['module']=='riwayat_cuti_allkadis'){
  if ($_SESSION['leveluser']=='KADIS'){
    include "modul/mod_riwayat_cuti_allkadis/mod_riwayat_cuti_allkadis.php";                            
  }
}

// Bagian JenisCuti
elseif ($_GET['module']=='jnscuti'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_jcuti/jnscuti.php";                            
  }
}
// Bagian Komentar Berita
elseif ($_GET['module']=='komentar'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_komentar/komentar.php";
  }
}

// Bagian Banner
elseif ($_GET['module']=='banner'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_banner/banner.php";
  }
}

// Bagian Hubungi Kami
elseif ($_GET['module']=='hubungi'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_hubungi/hubungi.php";
  }
}

// Bagian Album
elseif ($_GET['module']=='album'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_album/album.php";
  }
}

// Bagian Galeri Foto
elseif ($_GET['module']=='galerifoto'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_galerifoto/galerifoto.php";
  }
}

// Bagian Halaman Statis
elseif ($_GET['module']=='halamanstatis'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_halamanstatis/halamanstatis.php";
  }
}

// Bagian Sekilas Info
elseif ($_GET['module']=='sekilasinfo'){
  if ($_SESSION['leveluser']=='ADMIN'){
    include "modul/mod_sekilasinfo/sekilasinfo.php";
  }
}

elseif(isset($_GET[errj]))  {
echo "maaf kode jabatan sudah ada
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[erru]))  {
echo "maaf user dengan NIP tersebut sudah ada
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[errk]))  {
echo "maaf pegawai dengan NIP tersebut sudah ada <input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[errjc]))  {
echo "maaf jenis cuti tersebut sudah ada<input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[errhr]))  {
echo "maaf hari libur tersebut sudah ada
<input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[errtanggal]))  {
echo "maaf tanggal awal tidak boleh lebih besar dari tanggal akhir
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[errtanggal1]))  {
echo "maaf tanggal tidak boleh kosong
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[erralasan]))  {
echo "maaf alasan tidak boleh kosong
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[errperiode]))  {
echo "maaf tanggal cuti tidak sesuai dengan periode cuti tahunan
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[errtolakcuti]))  {
echo "maaf permohonan cuti ditolak karena sudah melebihi stok cuti
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET[errtolakcuti2]))  {
echo "maaf permohonan cuti ditolak karena tidak sesuai dengan tahun
<br><input type=button value=Kembali onclick=self.history.back()>";
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
