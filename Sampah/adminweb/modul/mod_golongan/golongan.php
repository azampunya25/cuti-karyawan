<script language="javascript">
function validasi(form){
  if (form.id_gol.value == ""){
    alert("Anda belum mengisikan kode golongan...!!");
    form.id_gol.focus();
    return (false);
  }
    if (form.nm_pangkat.value == ""){
    alert("Anda belum mengisikan nama pangkat...!!");
    form.nm_pangkat.focus();
    return (false);
  }
      if (form.nm_gol.value == ""){
    alert("Anda belum mengisikan nama golongan...!!");
    form.nm_gol.focus();
    return (false);
  }
    if (form.ruang.value == ""){
    alert("Anda belum mengisikan ruang...!!");
    form.ruang.focus();
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
$aksi="modul/mod_golongan/aksi_golongan.php";
switch($_GET[act]){
  // Tampil Golongan
  default:
    echo "<h2>Golongan</h2>
          <input type=button value='Tambah Golongan' onclick=location.href='?module=golongan&act=tambahgolongan'>
          <table id='NoFilter' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
          <th>No</th>
          <th>Kode</th>
          <th>Pangkat</th>
          <th>Golongan</th>
		  <th>Ruang</th>
          <th>Aksi</th>
          </tr></thead><tbody>";

      $tampil=mysql_query("SELECT * FROM golongan ORDER BY id_gol DESC");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td class='center'>$r[id_gol]</td>
                <td>$r[nm_pangkat]</td>
                <td class='center'>$r[nm_gol]</td>
				<td class='center'>$r[ruang]</td>
                <td class='center'><a href=?module=golongan&act=editgolongan&id=$r[id_gol]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href=$aksi?module=golongan&act=hapus&id=$r[id_gol] \" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";
echo "<div class=> $linkHalaman</div><br>";
    break;

  case "tambahgolongan":
	$sql ="SELECT max(id_gol) as terakhir from golongan"; 
	$tgl = date('Y');
	$hasil = mysql_query($sql);
	$data2 = mysql_fetch_array($hasil);
	$lastID = $data2['terakhir'];
	$lastNoUrut = substr($lastID, 4, 9);
	$nextNoUrut = $lastNoUrut + 1;
	$nextID = "GOL".sprintf("%03s",$nextNoUrut);
    echo "<h2>Tambah Golongan</h2>
          <form method=POST action='$aksi?module=golongan&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td class='left'>Kode</td>      <td> : <input type=text name='id_gol' value='$nextID' readonly size=20></td></tr>
          <tr><td class='left'>Nama Pangkat</td>  <td> : <input type=text name='nm_pangkat' size=40 required></td></tr>
		  <tr><td class='left'>Nama Golongan</td>  <td> : <input type=text name='nm_gol' size=40 required></td></tr>
		  <tr><td class='left'>Ruang</td>  <td> : <input type=text name='ruang' size=40 required></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Data Golongan ??')\">
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;
  
  case "editgolongan":
    $edit = mysql_query("SELECT * FROM golongan WHERE id_gol='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Golongan</h2>
          <form method=POST action=$aksi?module=golongan&act=update>
          <input type=hidden name=id value=$r[id_gol]>
          <table class='list'><tbody>
          <tr><td class='left'>Kode</td>      <td> : <input type=text name='id_gol' value='$r[id_gol]' readonly ></td></tr>
		  <tr><td class='left'>Nama Pangkat</td>      <td> : <input type=text name='nm_pangkat' value='$r[nm_pangkat]'required></td></tr>
		  <tr><td class='left'>Nama Golongan</td>      <td> : <input type=text name='nm_gol' value='$r[nm_gol]' required></td></tr>
		  <tr><td class='left'>Ruang</td>      <td> : <input type=text name='ruang' value='$r[ruang]' required></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Data Golongan ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
