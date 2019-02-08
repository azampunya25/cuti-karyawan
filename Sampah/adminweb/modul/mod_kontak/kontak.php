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
$aksi="modul/mod_kontak/aksi_kontak.php";
switch($_GET[act]){
  // Tampil Kontak
  default:
    echo "<h2>Kontak</h2>
          <table id='NoInfo' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
          <th>No</th>
          <th>Alamat</th>
          <th>Telp</th>
          <th>Fax</th>
		  <th>Email</th>
          <th>Aksi</th>
          </tr></thead><tbody>";

      $tampil=mysql_query("SELECT * FROM kontak ORDER BY id_kontak DESC");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
                <td>$r[alamat]</td>
				<td>$r[telp]</td>
                <td>$r[fax]</td>
				<td>$r[email]</td>
                <td class='center'  width='85'><a href=?module=kontak&act=editkontak&id=$r[id_kontak]><img src='images/edit.png' border='0' title='edit' /></a>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";
    echo "<div class=>$linkHalaman</div><br>";

    break;

  case "editkontak":
    $edit = mysql_query("SELECT * FROM kontak WHERE id_kontak='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Kontak</h2>
          <form method=POST action=$aksi?module=kontak&act=update>
          <input type=hidden name=id value=$r[id_kontak]>
          <table class='list'><tbody>
          <tr><td class='left'>Alamat</td>      <td> : <input type=text name='alamat' value='$r[alamat]' required></td></tr>
		  <tr><td class='left'>Telp</td>      <td> : <input type=text name='telp' value='$r[telp]' required></td></tr>
		  <tr><td class='left'>Fax</td>      <td> : <input type=text name='fax' value='$r[fax]' required></td></tr>
		  <tr><td class='left'>Email</td>      <td> : <input type=email name='email' value='$r[email]' placeholder='Email' required></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Kontak ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
