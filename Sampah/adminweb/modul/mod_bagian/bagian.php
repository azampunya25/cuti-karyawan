<script language="javascript">
function validasi(form){
  if (form.id_bagian.value == ""){
    alert("Anda belum mengisikan kode bagian...!!");
    form.id_bagian.focus();
    return (false);
  }
    if (form.nm_bagian.value == ""){
    alert("Anda belum mengisikan nama bagian...!!");
    form.nm_bagian.focus();
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
$aksi="modul/mod_bagian/aksi_bagian.php";
switch($_GET[act]){
  // Tampil bagian
  default:
    echo "<h2>Bidang</h2>
          <input type=button value='Tambah Bidang' onclick=location.href='?module=bagian&act=tambahbagian'>
          <table id='NoInfo' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
          <th>No</th>
          <th>Kode Bidang</th>
          <th>Nama Bidang</th>
          <th>Aksi</th>
          </tr></thead><tbody>";

      $tampil=mysql_query("SELECT * FROM bagian ORDER BY id_bagian DESC");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td  class='center'>$no</td>
                <td class='center'>$r[id_bagian]</td>
                <td>$r[nm_bagian]</td>
                <td class='center'><a href=?module=bagian&act=editbagian&id=$r[id_bagian]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href=$aksi?module=bagian&act=hapus&id=$r[id_bagian] \" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";
    echo "<div class=>$linkHalaman</div><br>";

    break;

  
  case "tambahbagian":
    echo "<h2>Tambah Bagian</h2>
          <form method=POST action='$aksi?module=bagian&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td class='left'>Kode Bagian</td>      <td> : <input type=text name='id_bagian' size=20 required></td></tr>
          <tr><td class='left'>Nama Bagian</td>  <td> : <input type=text name='nm_bagian' size=40 required></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Data bagian ??')\">
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;
  

  case "editbagian":
    $edit = mysql_query("SELECT * FROM bagian WHERE id_bagian='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit bagian</h2>
          <form method=POST action=$aksi?module=bagian&act=update>
          <input type=hidden name=id value=$r[id_bagian]>
          <table class='list'><tbody>
          <tr><td class='left'>Kode bagian</td>      <td> : <input type=text name='id_bagian' value='$r[id_bagian]' readonly></td></tr>
		  <tr><td class='left'>Nama bagian</td>      <td> : <input type=text name='nm_bagian' value='$r[nm_bagian]' required></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Data bagian ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
