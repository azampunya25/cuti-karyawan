<script language="javascript">
function validasi(form){
  if (form.id_jabatan.value == ""){
    alert("Anda belum mengisikan kode jabatan...!!");
    form.id_jabatan.focus();
    return (false);
  }
    if (form.nm_jabatan.value == ""){
    alert("Anda belum mengisikan nama jabatan...!!");
    form.nm_jabatan.focus();
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
$aksi="modul/mod_jabatan/aksi_jabatan.php";
switch($_GET[act]){
  // Tampil Jabatan
  default:
    echo "<h2>Jabatan</h2>
          <input type=button value='Tambah Jabatan' onclick=location.href='?module=jabatan&act=tambahjabatan'>
          <table id='NoFilter' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
          <th>No</th>
          <th>Kode Jabatan</th>
          <th>Nama Jabatan</th>
          <th>Keterangan</th>
          <th>Aksi</th>
          </tr></thead><tbody>";

      $tampil=mysql_query("SELECT * FROM jabatan ORDER BY id_jabatan DESC");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td  class='center'>$no</td>
                <td class='center'>$r[id_jabatan]</td>
                <td>$r[nm_jabatan]</td>
                <td>$r[keterangan]</td>
                <td class='center'><a href=?module=jabatan&act=editjabatan&id=$r[id_jabatan]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href=$aksi?module=jabatan&act=hapus&id=$r[id_jabatan] \" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";
    echo "<div class=>$linkHalaman</div><br>";

    break;

  
  case "tambahjabatan":
  	$sql ="SELECT max(id_jabatan) as terakhir from jabatan"; 
	$tgl = date('Y');
	$hasil = mysql_query($sql);
	$data2 = mysql_fetch_array($hasil);
	$lastID = $data2['terakhir'];
	$lastNoUrut = substr($lastID, 4, 9);
	$nextNoUrut = $lastNoUrut + 1;
	$nextID = "JB".sprintf("%03s",$nextNoUrut);
    echo "<h2>Tambah Jabatan</h2>
          <form method=POST action='$aksi?module=jabatan&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td class='left'>Kode Jabatan</td>      <td> : <input type=text name='id_jabatan' value='$nextID' readonly size=20></td></tr>
          <tr><td class='left'>Nama Jabatan</td>  <td> : <input type=text name='nm_jabatan' size=40 required></td></tr>
          <tr><td class='left'>Keterangan</td>    <td> <textarea name='keterangan' style='width: 270px; height: 100px;' required></textarea></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Data Jabatan ??')\">
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;
  

  case "editjabatan":
    $edit = mysql_query("SELECT * FROM jabatan WHERE id_jabatan='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Jabatan</h2>
          <form method=POST action=$aksi?module=jabatan&act=update>
          <input type=hidden name=id value=$r[id_jabatan]>
          <table class='list'><tbody>
          <tr><td class='left'>Kode Jabatan</td>      <td> : <input type=text name='id_jabatan' value='$r[id_jabatan]' readonly></td></tr>
		  <tr><td class='left'>Nama Jabatan</td>      <td> : <input type=text name='nm_jabatan' value='$r[nm_jabatan]' required></td></tr>
		  <tr><td class='left'>Keterangan</td>      <td> : <input type=text name='keterangan' value='$r[keterangan]' required></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Data Jabatan ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
