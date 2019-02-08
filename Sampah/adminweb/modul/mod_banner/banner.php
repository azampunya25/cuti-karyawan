<script language="javascript">
function validasi(form){
  if (form.judul.value == ""){
    alert("Anda belum mengisikan nama situs...!!");
    form.judul.focus();
    return (false);
  }
    if (form.url.value == ""){
    alert("Anda belum mengisikan url situs...!!");
    form.url.focus();
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
$aksi="modul/mod_banner/aksi_banner.php";
switch($_GET[act]){
  // Tampil Banner
  default:
    echo "<h2>Link Partner</h2>
          <input type=button value='Tambah Partner' onclick=location.href='?module=banner&act=tambahbanner'>
          <table id='NoInfo' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th>No</th>
          <th>Nama Situs</th>
          <th>Url</th>
          <th>Aksi</th></tr></thead><tbody>";
    $tampil=mysql_query("SELECT * FROM link ORDER BY id_link DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td class='center' width='25'>$no</td>
                <td class='left'>$r[judul]</td>
                <td class='left'><a href=$r[url] target=_blank>$r[url]</a></td>
                <td class='center' width='85'><a href=?module=banner&act=editbanner&id=$r[id_link]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href='$aksi?module=banner&act=hapus&id=$r[id_link]&namafile=$r[gambar]' \" onClick=\"return confirm('Apakah Anda Yakin Menghapus Link $r[nm_situs] ??')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
    $no++;
    }
    echo "</tbody></table>";
	    echo "<div class=>$linkHalaman</div><br>";
    break;
  
  case "tambahbanner":
    echo "<h2>Tambah Partner</h2>
          <form method=POST action='$aksi?module=banner&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td class='left'>Nama Situs</td><td class='left'>  : <input type=text name='judul' size=30 required></td></tr>
          <tr><td class='left'>Url</td><td class='left'>   : <input type=url name='url' size=50 placeholder='URL dengan HTTP' required></td></tr>
          <tr><td class='left'>Gambar</td><td class='left'> : <input type=file name='fupload' size=40 required></td></tr>
          <tr><td class='left' colspan='2'><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Link ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
     break;
    
  case "editbanner":
    $edit = mysql_query("SELECT * FROM link WHERE id_link='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Partner</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=banner&act=update>
          <input type=hidden name=id value=$r[id_link]>
          <table class='list'><tbody>
          <tr><td class='left'>Judul</td><td class='left'>     : <input type=text name='judul' size=30 value='$r[judul]' required></td></tr>
          <tr><td class='left'>Url</td><td class='left'>      : <input type=url name='url' size=50 value='$r[url]' required></td></tr>
          <tr><td class='left'>Gambar</td><td class='left'>    : <img src='../foto/foto_banner/$r[gambar]'></td></tr>
          <tr><td class='left'>Ganti Gbr</td><td class='left'> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td class='left' colspan=2>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Link ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
