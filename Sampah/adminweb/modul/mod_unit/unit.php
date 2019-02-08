<script language="javascript">
function validasi(form){
  if (form.id_unit.value == ""){
    alert("Anda belum mengisikan kode unit...!!");
    form.id_unit.focus();
    return (false);
  }
    if (form.nm_unit.value == ""){
    alert("Anda belum mengisikan nama unit...!!");
    form.nm_unit.focus();
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
$aksi="modul/mod_unit/aksi_unit.php";
switch($_GET[act]){
  // Tampil unit
  default:
    echo "<h2>Unit</h2>
          <input type=button value='Tambah unit' onclick=location.href='?module=unit&act=tambahunit'>
          <table id='NoFilter' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
          <th>No</th>
          <th>Kode Unit</th>
		  <th>Kode Bidang</th>
          <th>Nama Unit</th>
		  <th>Nama Bidang</th>
          <th>Aksi</th>
          </tr></thead><tbody>";

      $tampil=mysql_query("SELECT * FROM unitkerja INNER JOIN bagian
    ON unitkerja.id_bagian=bagian.id_bagian ORDER BY id_unt DESC");
	  

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td  class='center'>$no</td>
                <td class='center'>$r[id_unit]</td>
				<td class='center'>$r[id_bagian]</td>
                <td>$r[nm_unit]</td>
				<td>$r[nm_bagian]</td>
                <td class='center'><a href=?module=unit&act=editunit&id=$r[id_unit]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href=$aksi?module=unit&act=hapus&id=$r[id_unit] \" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";
    echo "<div class=>$linkHalaman</div><br>";

    break;

  
  case "tambahunit":
    echo "<h2>Tambah unit</h2>
          <form method=POST action='$aksi?module=unit&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td class='left'>Kode Unit</td>      <td> : <input type=text name='id_unit' size=20 required></td></tr>
		  <tr><td class='left'>Bidang</td><td class='left'> : 
				<select name='id_bagian' required>
				<option required disabled value=0 selected>- Pilih Bidang -</option>";
				$tampil=mysql_query("SELECT * FROM bagian ORDER BY id_bagian");
				while($r=mysql_fetch_array($tampil)){
					echo "<option value=$r[id_bagian]>$r[nm_bagian]</option>";
				}
	echo "</select></td></tr>
          <tr><td class='left'>Nama Unit</td>  <td> : <input type=text name='nm_unit' size=40 required></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Data unit ??')\">
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;
  

  case "editunit":
    $edit = mysql_query("SELECT * FROM unit WHERE id_unit='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit unit</h2>
          <form method=POST action=$aksi?module=unit&act=update>
          <input type=hidden name=id value=$r[id_unit]>
          <table class='list'><tbody>
          <tr><td class='left'>Kode unit</td>      <td> : <input type=text name='id_unit' value='$r[id_unit]' readonly></td></tr>
		  <tr><td class='left'>Nama unit</td>      <td> : <input type=text name='nm_unit' value='$r[nm_unit]' required></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Data unit ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
