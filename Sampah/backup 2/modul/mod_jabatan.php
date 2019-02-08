<?php
switch($_GET[act]){
  // Tampil Jabatan
  default:
    echo "<h2>Jabatan</h2>
          <input type=button value='Tambah Jabatan' onclick=location.href='?module=jabatan&act=tambahjabatan'>
          <table>
          <tr><th>no</th><th>kode</th><th>nama jabatan</th><th>keterengan</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM jabatan ORDER BY id_jabatan");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[kd_jabatan]</td>
             <td>$r[nm_jabatan]</td>
             <td>$r[keterangan]</td>
		     <td><a href=?module=jabatan&act=editjabatan&id=$r[id_jabatan]>Edit</a> |
	               <a href=./aksi.php?module=jabatan&act=hapus&id=$r[id_jabatan]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;

  case "tambahjabatan":
    echo "<h2>Tambah Jabatan</h2>
          <form method=POST action='./aksi.php?module=jabatan&act=input'>
          <table>
          <tr><td>Kode</td>         <td> : <input type=text name='kd_jabatan'></td></tr>
          <tr><td>Nama Jabatan</td> <td> : <input type=text name='nm_jabatan'></td></tr>
          <tr><td>Keterangan</td>   <td> : <textarea name='keterangan' cols='25' rows='3'></textarea></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;

  case "editjabatan":
    $edit=mysql_query("SELECT * FROM jabatan WHERE id_jabatan='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Jabatan</h2>
          <form method=POST action=./aksi.php?module=jabatan&act=update>
          <input type=hidden name=id value='$r[id_jabatan]'>
          <table>
          <tr><td>Kode</td>           <td> : <input type=text name='kd_jabatan' value='$r[kd_jabatan]'></td></tr>
          <tr><td>Nama Jabatan</td>   <td> : <input type=text name='nm_jabatan' value='$r[nm_jabatan]'></td></tr>
          <tr><td>Keterangan</td>     <td> : <textarea name='keterangan' cols='25' rows='3'>$r[keterangan]</textarea></td></tr>
                            <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
?>
