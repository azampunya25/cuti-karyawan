<?php
switch($_GET[act]){
  // Tampil Modul
  default:
    echo "<h2>Modul</h2>
          <input type=button value='Tambah Modul' onclick=location.href='?module=modul&act=tambahmodul'>
          <table>
          <tr><th>no</th><th>nama modul</th><th>link</th><th>publish</th><th>aktif</th><th>status</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM modul ORDER BY urutan");
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td>$r[urutan]</td>
            <td>$r[nama_modul]</td>
            <td><a href=$r[link]>$r[link]</a></td>
            <td align=center>$r[publish]</td>
            <td align=center>$r[aktif]</td>
            <td align=center>$r[status]</td>
            <td><a href=?module=modul&act=editmodul&id=$r[id_modul]>Edit</a> |
	              <a href=./aksi.php?module=modul&act=hapus&id=$r[id_modul]>Hapus</a>
            </td></tr>";
    }
    echo "</table>";
    break;

  case "tambahmodul":
    echo "<h2>Tambah Modul</h2>
          <form method=POST action='./aksi.php?module=modul&act=input'>
          <table>
          <tr><td>Nama Modul</td> <td> : <input type=text name='nama_modul'></td></tr>
          <tr><td>Link</td>       <td> : <input type=text name='link' size=30></td></tr>
          <tr><td>Publish</td>    <td> : <input type=radio name='publish' value='Y' checked>Y
                                         <input type=radio name='publish' value='N'>N  </td></tr>
          <tr><td>Aktif</td>      <td> : <input type=radio name='aktif' value='Y' checked>Y
                                         <input type=radio name='aktif' value='N'>N  </td></tr>
          <tr><td>Status</td>     <td> : <input type=radio name='status' value='atasan' checked>atasan
                                         <input type=radio name='status' value='karyawan'>karyawan
                                         <input type=radio name='status' value='admin'>admin
                                         </td></tr>
          <tr><td>Urutan</td>     <td> : <input type=text name='urutan' size=1></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;

  case "editmodul":
    $edit = mysql_query("SELECT * FROM modul WHERE id_modul='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Modul</h2>
          <form method=POST action=./aksi.php?module=modul&act=update>
          <input type=hidden name=id value='$r[id_modul]'>
          <table>
          <tr><td>Nama Modul</td>     <td> : <input type=text name='nama_modul' value='$r[nama_modul]'></td></tr>
          <tr><td>Link</td>     <td> : <input type=text name='link' size=30 value='$r[link]'></td></tr>";
    if ($r[publish]=='Y'){
      echo "<tr><td>Publish</td> <td> : <input type=radio name='publish' value='Y' checked>Y
                                        <input type=radio name='publish' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Publish</td> <td> : <input type=radio name='publish' value='Y'>Y
                                        <input type=radio name='publish' value='N' checked>N</td></tr>";
    }
    if ($r[aktif]=='Y'){
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y' checked>Y
                                      <input type=radio name='aktif' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y'>Y
                                      <input type=radio name='aktif' value='N' checked>N</td></tr>";
    }
    if ($r[status]=='atasan'){
      echo "<tr><td>Status</td> <td> : <input type=radio name='status' value='atasan' checked>atasan
                                       <input type=radio name='status' value='karyawan'>karyawan
                                       <input type=radio name='status' value='admin'>admin
                                       </td></tr>";
    }
    elseif ($r[status]=='karyawan'){
      echo "<tr><td>Status</td> <td> : <input type=radio name='status' value='atasan'>atasan
                                       <input type=radio name='status' value='karyawan' checked>karyawan
                                       <input type=radio name='status' value='admin'>admin
                                       </td></tr>";
    }
    else{
      echo "<tr><td>Status</td> <td> : <input type=radio name='status' value='atasan'>atasan
                                       <input type=radio name='status' value='karyawan'>karyawan
                                       <input type=radio name='status' value='admin' checked>admin</td></tr>";
    }
    echo "<tr><td>Urutan</td>       <td> : <input type=text name='urutan' size=1 value='$r[urutan]'></td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
?>
