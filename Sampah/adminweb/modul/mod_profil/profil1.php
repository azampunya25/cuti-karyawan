<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_profil/aksi_profil1.php";
switch($_GET[act]){
  // Tampil Profil
  default:
    echo "<h2>Profil</h2>
          <table  class='list'><thead>
          <tr><td class='left'>no</td>
          <td class='left'>Judul</td>
          <td class='center'>Isi Profil</td>
          <td class='center'>aksi</td></tr></thead>"; 
    $tampil=mysql_query("SELECT * FROM profil ORDER BY id_profil DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tbody><tr><td class='left' width='25'>$no</td>
             <td class='left'>$r[judul]</td>
             <td class='center'>$r[isi]</td>
             <td class='center' width='40'><a href=?module=profil1&act=editprofil1&id=$r[id_profil]><img src='images/edit.png' border='0' title='edit' /></a>
             </td></tr>";
      $no++;
    }
    echo "<tbody></table>";
    echo "<div id=paging>*) Data pada Profil tidak bisa dihapus, tapi bisa dirubah melalui Edit Profil.</div><br>";
    break;
  
  // Form Edit Kategori  
  case "editprofil1":
    $edit=mysql_query("SELECT * FROM profil WHERE id_profil='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Profil</h2>
          <form method=POST action=$aksi?module=profil1&act=update>
          <input type=hidden name=id value='$r[id_profil]'>
          <table class='list'>
          <tr><td class='left'>Judul</td><td> : <input type=text name='judul' value='$r[judul]'></td></tr>
		  <tr><td>Isi</td>   <td> <textarea id='loko' name='isi' style='width: 600px; height: 350px;'>$r[isi]</textarea></td></tr>";

    echo "<tr><td class='left' colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
