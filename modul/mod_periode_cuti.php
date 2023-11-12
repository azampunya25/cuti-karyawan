<?php
switch(isset($_GET['act'])){
  // Tampil Periode Cuti
  default:
  echo "<div class='box box-default'>
  <div class='box-header with-border'>
  <h3 class='box-title'>Periode Cuti</h3>
  </div>
  <div class='box-body'>
  <div class='row'>
  <div class='col-md-12'>
  catatan: Tombol <b>Tambah Periode Cuti</b> hanya disarankan 
  apabila NIP belum pernah terdaftar dalam periode cuti. (Tabel dibawah)<br>
  Jika akan merubah periode cuti karena perubahan periode berikutnya cukup <b>edit</b> saja.
  </div>
  </div>
  <div class='row'>
  <div class='col-md-12'>
  <input type=button value='Tambah Periode Cuti' onclick=location.href='?module=periode_cuti&act=tambahperiode_cuti' class='btn btn-defalut'>
  </div>
  </div>
  <div class='row'>
  <div class='col-md-12'>
  <table id='example' class='table table-bordered table-striped'>
  <tr><th>no</th><th>nip</th><th>jenis cuti</th><th>tahun</th><th>periode cuti</th><th>aksi</th></tr>";
  $tampil=mysqli_query($mysqli, ("SELECT * FROM periode_cuti inner join jenis_cuti
    on periode_cuti.kd_jcuti=jenis_cuti.kd_jcuti ORDER BY id_periode_cuti")
  $no=1;
  while ($r=mysql_fetch_array($tampil)){
   echo "<tr><td>$no</td>
   <td>$r[nik]</td>
   <td>$r[nama_jcuti]</td>
   <td>$r[tahun]</td>
   <td>$r[awalcuti] s/d $r[akhircuti]</td>
   <td>
   <a href=?module=periode_cuti&act=editperiode_cuti&id=$r[id_periode_cuti] data-toggle='tooltip' title='Edit Data'>
   <button class='btn btn-primary' type='button'><span class='glyphicon glyphicon-edit'></span>
   </button></a>
   <a href=./aksi.php?module=periode_cuti&act=hapus&id=$r[id_periode_cuti] data-toggle='tooltip' title='Hapus Data'>
   <button class='btn btn-danger' type='button' onClick='return confirm('Apakah Anda benar-benar mau menghapusnya?')'><span class='glyphicon glyphicon-trash'></span>
   </button></a>
   </td></tr>";
   $no++;
 }
 echo "</table></div>
 </div>
 </div>
 </div>
 ";
 break;

 case "tambahperiode_cuti":
 echo "
 <div class='box box-default'>
 <div class='box-header with-border'>
 <h3 class='box-title'>Tambah Periode Cuti</h3>
 </div>
 <div class='box-body'>
 <div class='row'>
 <form method=POST action='?module=periode_cuti&act=filterperiode'>
 <div class='col-md-2'>Nip</div>
 <div class='col-md-4'><input type=text name='nik' class='form-control'></div>
 <input type='submit' value='Filter' class='btn btn-defalut'>
 </form>
 </div>
 </div>
 </div>";
 break;

 case "filterperiode":
 echo "
 <div class='box box-default'>
 <div class='box-header with-border'>
 <h3 class='box-title'>Tambah Periode Cuti</h3>
 </div>
 <div class='box-body'>
 <div class='row'>


 <h2></h2>";
 $nik=$_POST['nik'];
          //if ((isset($_POST['submit'])) and ($nik<>"")){
 $s=mysqli_query($mysqli, ("SELECT * FROM karyawan WHERE nik='$nik'");
 $d=mysql_fetch_array($s);
 if(mysql_num_rows($s)>0){
  echo"<form method=POST action='./aksi.php?module=periode_cuti&act=input'>
  <table>
  <tr><td>Nip</td>        <td> : <input type=text name='nik' value='$nik' readonly></td></tr>
  <tr><td>Nama</td>        <td> : <input type=text name='nama' value='$d[nama]' readonly></td></tr>
  <tr><td>Tanggal Masuk</td> <td> : <input type=text name='tglmasuk' value='$d[tgl_masuk]' readonly></td></tr>
  <tr><td>Jenis Cuti</td> <td> : <select name='kd_jcuti'>";
  $sj=mysqli_query($mysqli, ("SELECT * FROM jenis_cuti");
  for($i=0;$i<mysql_num_rows($sj);$i++) {
    $dj=mysql_fetch_assoc($sj);
    echo"<option value=$dj[kd_jcuti]>$dj[nama_jcuti]</option>";
  }
  echo"</select></td></tr>
  <tr><td>Tahun</td><td>: <input type='text' name='thn'> *  tahun cuti diisi sesuai dengan tahun Periode Akhir cuti</td></tr>
  <tr><td>Periode Awal</td> <td> : <input type=text name='awalcuti' id='awalcuti' value='0000-00-00'></td></tr>
  <tr><td>Periode Akhir</td> <td> : <input type=text name='akhircuti' id='akhircuti' value='0000-00-00'></td></tr>
  <tr><td colspan=2><input type=submit value=Simpan>
  <input type=button value=Batal onclick=self.history.back()></td></tr>
  </table></form><br><br>";
}else{
 echo "karyawan tidak terdaftar
 <input type=button value=Kembali onclick=self.history.back()>";
}
break;

case "editperiode_cuti":
$edit=mysqli_query($mysqli, ("SELECT * FROM periode_cuti inner join jenis_cuti
  on periode_cuti.kd_jcuti=jenis_cuti.kd_jcuti
  WHERE periode_cuti.id_periode_cuti='$_GET[id]'");
$r=mysql_fetch_array($edit);

echo "
<div class='box box-default'>
<div class='box-header with-border'>
<h3 class='box-title'>Edit Periode Cuti</h3>
</div>
<div class='box-body'>
<form method=POST action=./aksi.php?module=periode_cuti&act=update>
<input type=hidden name=id value='$r[id_periode_cuti]'>
<table>
<tr><td>nip</td><td> : <input type=text name='nik' value='$r[nik]' readonly></td></tr>
<tr><td>Jenis Cuti</td>   <td> : <input type=text name='kd_jcuti' value='$r[nama_jcuti]' readonly></td></tr>
<tr><td>Tahun</td>   <td> : <input type=text name='thn' value='$r[tahun]'></td></tr>
<tr><td>Periode Awal</td>   <td> : <input type=text name='awalcuti' id='awalcuti' value='$r[awalcuti]'></td></tr>
<tr><td>Periode Akhir</td>   <td> : <input type=text name='akhircuti' id='akhircuti' value='$r[akhircuti]'></td></tr>
<tr><td colspan=2><input type=submit value=Update>
<input type=button value=Batal onclick=self.history.back()></td></tr>
</table></form></div></div>";
break;
}
?>
