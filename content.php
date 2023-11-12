<?php
include "config/koneksi.php";
include "config/library.php";
include "config/fungsi_indotgl.php";
include "config/fungsi_combobox.php";
include "config/class_paging.php";

// Bagian Home
if ($_GET['module']=='home'){
  echo "<h2>Selamat Datang</h2>
          <p>Hai <b>$_SESSION[nama]</b>, silahkan klik menu pilihan yang berada
          di sebelah kiri untuk mengelola content website. </p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p>&nbsp;</p>
          <p align=right>Login Hari ini: ";
  echo tgl_indo(date("Y m d"));
  echo " | ";
  echo date("H:i:s");
  echo "</p>";
}

// Bagian User
elseif ($_GET['module']=='user'){
  include "modul/mod_user.php";
}

// Bagian Modul
elseif ($_GET['module']=='modul'){
  include "modul/mod_modul.php";
}

// Bagian Jabatan
elseif ($_GET['module']=='jabatan'){
  include "modul/mod_jabatan.php";
}

// Bagian Karyawan
elseif ($_GET['module']=='karyawan'){
  include "modul/mod_karyawan.php";
}

// Bagian Hubungi Kami
elseif ($_GET['module']=='hubungi'){
  include "modul/mod_hubungi.php";
}


// Bagian Jenis Cuti
elseif ($_GET['module']=='jenis_cuti'){
  include "modul/mod_jenis_cuti.php";
}

// Bagian Periode Cuti
elseif ($_GET['module']=='periode_cuti'){
  include "modul/mod_periode_cuti.php";
}

// Bagian Permohonan Cuti
elseif ($_GET['module']=='permohonan_cuti'){
  include "modul/mod_permohonan_cuti.php";
}

// Bagian Riwayat Cuti
elseif ($_GET['module']=='riwayat_cuti'){
  include "modul/mod_riwayat_cuti.php";
}

// Bagian Riwayat Cuti All
elseif ($_GET['module']=='riwayat_cuti_all'){
  include "modul/mod_riwayat_cuti_all.php";
}

// Bagian Persetujuan Cuti
elseif ($_GET['module']=='persetujuan_cuti'){
  include "modul/mod_persetujuan_cuti.php";
}

// Bagian hari Libur
elseif ($_GET['module']=='hari_libur'){
  include "modul/mod_hari_libur.php";
}

elseif(isset($_GET['errj']))  {
echo "maaf kode jabatan sudah ada
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['erru']))  {
echo "maaf user dengan Nik tersebut sudah ada
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['errk']))  {
echo "maaf karyawan dengan Nik tersebut sudah ada
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['errjc']))  {
echo "maaf jenis cuti tersebut sudah ada
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['errhr']))  {
echo "maaf hari libur tersebut sudah ada
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['errtanggal']))  {
echo "maaf tanggal awal tidak boleh lebih besar dari tanggal akhir
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['errtanggal1']))  {
echo "maaf tanggal tidak boleh kosong
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['erralasan']))  {
echo "maaf alasan tidak boleh kosong
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['errperiode']))  {
echo "maaf tanggal cuti tidak sesuai dengan periode
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['errtolakcuti']))  {
echo "maaf permohonan cuti ditolak karena sudah melebihi stok cuti
<br><input type=button value=Kembali onclick=self.history.back()>";
}

elseif(isset($_GET['errtolakcuti2']))  {
echo "maaf permohonan cuti ditolak karena sudah melebihi stok cuti
<br><input type=button value=Kembali onclick=self.history.back()>";
}
// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA</b></p>";
}

?>