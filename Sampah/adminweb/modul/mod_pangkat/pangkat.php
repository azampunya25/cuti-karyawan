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
          <table class='list1'><thead>
          <tr>
          <td class='left'>no</th>
          <td class='left'>Kode Jabatan</th>
          <td class='left'>Nama Jabatan</th>
          <td class='left'>Keterangan</th>
          <td class='center'>aksi</th>
          </tr></thead><tbody>";

    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);

      $tampil=mysql_query("SELECT * FROM jabatan ORDER BY id_jabatan DESC LIMIT $posisi,$batas");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='left' width='25'>$no</td>
                <td class='left'>$r[kd_jabatan]</td>
                <td class='left'>$r[nm_jabatan]</td>
                <td class='left'>$r[keterangan]</td>
                <td class='center'  width='85'><a href=?module=jabatan&act=editjabatan&id=$r[id_jabatan]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href=$aksi?module=jabatan&act=hapus&id=$r[id_jabatan]><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";

      $jmldata = mysql_num_rows(mysql_query("SELECT * FROM jabatan"));

    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

echo "<div class=\"pagination\"> $linkHalaman</div>";

    break;

  
  case "tambahjabatan":
    echo "<h2>Tambah Jabatan</h2>
          <form method=POST action='$aksi?module=jabatan&act=input'>
          <table class='list'><tbody>
          <tr><td class='left'>Kode Jabatan</td>      <td> : <input type=text name='kd_jabatan' size=20></td></tr>
          <tr><td class='left'>Nama Jabatan</td>  <td> : <input type=text name='nm_jabatan' size=40></td></tr>
          <tr><td class='left'>Keterangan</td>    <td> <textarea name='keterangan' style='width: 270px; height: 100px;'></textarea></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Simpan>
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
          <tr><td class='left'>Kode Jabatan</td>      <td> : <input type=text name='kd_jabatan' size=60 value='$r[kd_jabatan]'></td></tr>
		  <tr><td class='left'>Nama Jabatan</td>      <td> : <input type=text name='nm_jabatan' size=60 value='$r[nm_jabatan]'></td></tr>
		  <tr><td class='left'>Keterangan</td>      <td> : <input type=text name='keterangan' size=60 value='$r[keterangan]'></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
