<script language="javascript">
function validasi(form){
  if (form.id_jcuti.value == ""){
    alert("Anda belum mengisikan kode cuti...!!");
    form.id_jcuti.focus();
    return (false);
  }
    if (form.nm_jcuti.value == ""){
    alert("Anda belum mengisikan nama cuti...!!");
    form.nm_jcuti.focus();
    return (false);
  }
    if (form.lama_jcuti.value == ""){
    alert("Anda belum mengisikan nama lama cuti...!!");
    form.lama_jcuti.focus();
    return (false);
  }
}
</script>

<SCRIPT TYPE="text/javascript">
<!--
// copyright 1999 Idocs, Inc. http://www.idocs.com
// Distribute this script freely but keep this notice in place
function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
key = window.event.keyCode;
else if (e)
key = e.which;
else
return true;
keychar = String.fromCharCode(key);

// control keys
if ((key==null) || (key==0) || (key==8) ||
(key==9) || (key==13) || (key==27) )
return true;

// numbers
else if ((("0123456789").indexOf(keychar) > -1))
return true;

// decimal point jump
else if (dec && (keychar == "."))
{
myfield.form.elements[dec].focus();
return false;
}
else
return false;
}

//-->
</SCRIPT>

<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_jcuti/aksi_jnscuti.php";
switch($_GET[act]){
  // Tampil Jabatan
  default:
    echo "<h2>Jenis Cuti</h2>
          <input type=button value='Tambah Jenis Cuti' onclick=location.href='?module=jnscuti&act=tambahjnscuti'>
          <table id='NoFilter' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
          <th>No</th>
          <th>Kode Cuti</th>
          <th>Nama Cuti</th>
		  <th>Lama Cuti</th>
          <th>Keterangan</th>
          <th>Aksi</th>
          </tr></thead><tbody>";

      $tampil=mysql_query("SELECT * FROM jns_cuti ORDER BY id_jcuti DESC");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center' width='25'>$no</td>
                <td class='center'>$r[id_jcuti]</td>
                <td class='left'>$r[nm_jcuti]</td>
				<td class='center'>$r[lama_jcuti]</td>
                <td class='left'>$r[keterangan]</td>
                <td class='center'  width='85'><a href=?module=jnscuti&act=editjnscuti&id=$r[id_jcuti]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href=$aksi?module=jnscuti&act=hapus&id=$r[id_jcuti] \" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";
echo "<div> $linkHalaman</div><br>";

    break;

  
  case "tambahjnscuti":
    echo "<h2>Tambah Jenis Cuti</h2>
          <form method=POST action='$aksi?module=jnscuti&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td class='left'>Kode Cuti</td>      <td> : <input type=text name='id_jcuti' required></td></tr>
		  <tr><td class='left'>Nama Cuti</td>      <td> : <input type=text name='nm_jcuti' required></td></tr>
		  <tr><td class='left'>Lama Cuti</td>      <td> : <input type=text name='lama_jcuti' onKeyPress='return numbersonly(this, event)' required></td></tr>
          <tr><td class='left'>Keterangan</td>  <td> : <textarea name='keterangan' style='width: 300px; height: 50px;' required></textarea></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Data ??')\">
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;
  

  case "editjnscuti":
    $edit = mysql_query("SELECT * FROM jns_cuti WHERE id_jcuti='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Jenis Cuti</h2>
          <form method=POST action=$aksi?module=jnscuti&act=update>
          <input type=hidden name=id value=$r[id_jcuti]>
          <table class='list'><tbody>
          <tr><td class='left'>Kode Jenis Cuti</td>      <td> : <input type=text name='id_jcuti' size=60 value='$r[id_jcuti]' required></td></tr>
		  <tr><td class='left'>Nama Cuti</td>      <td> : <input type=text name='nm_jcuti' size=60 value='$r[nm_jcuti]' required></td></tr>
	  <tr><td class='left'>Lama Cuti</td>      <td> : <input type=text name='lama_jcuti' size=60 value='$r[lama_jcuti]'required></td></tr>
		  <tr><td class='left'>Keterangan</td>      <td> : <input type=text name='keterangan' size=60 value='$r[keterangan]' required></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Data ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
