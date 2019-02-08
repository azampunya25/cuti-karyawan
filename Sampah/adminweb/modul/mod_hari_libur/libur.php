

<script language="javascript">
function validasi(form){
  if (form.tanggal.value == ""){
    alert("Anda belum mengisikan tanggal...!!");
    form.tanggal.focus();
    return (false);
  }
}
</script>
<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_hari_libur/aksi_libur.php";
switch($_GET[act]){
  // Tampil Hari Libur
  default:
    echo "<h2>Hari Libur</h2>
          <input type=button value='Tambah Hari Libur' onclick=location.href='?module=libur&act=tambahlibur'>
          <table id='NoFilter' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
          <th>No</th>
          <th>Tanggal</th>
          <th>Keterangan</th>
          <th>Aksi</th>
          </tr></thead><tbody>";

    $tampil=mysql_query("SELECT * FROM `hari_libur` ORDER BY tanggal ASC");
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='center'>".tgl_indo($r['tanggal'])."</td>
                <td class='left'>$r[keterangan]</td>
                <td class='center'><a href=?module=libur&act=editlibur&id=$r[id_hari_libur]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href=$aksi?module=libur&act=hapus&id=$r[id_hari_libur] \" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";

echo "<div> $linkHalaman</div><br>";

    break;

  
  case "tambahlibur":
    echo "<h2>Tambah Hari Libur</h2>
          <form method=POST action='$aksi?module=libur&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td class='left'>Tanggal</td>      <td> : <input type='text' id='libur' name='tanggal'></td></tr>          
          <tr><td class='left'>Keterangan</td>    <td> : <input type=text name='keterangan' size=40></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Data Golongan ??')\">
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;
  

  case "editlibur":
    $edit = mysql_query("SELECT * FROM hari_libur WHERE id_hari_libur='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Hari Libur</h2>
          <form method=POST action=$aksi?module=libur&act=update enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <input type=hidden name=id value=$r[id_hari_libur]>
          <table class='list'><tbody>
          <tr><td class='left'>Tanggal</td>      <td> : <input type=text name='tanggal' id='libur' value='$r[tanggal]'></td></tr>          
          <tr><td class='left'>Keterangan</td>    <td> : <input type=text name='keterangan' size=40 value='$r[keterangan]'></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Data Golongan ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
