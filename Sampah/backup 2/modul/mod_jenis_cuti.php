<?php
switch($_GET[act]){
  // Tampil Jenis Cuti
  default:
    echo "<h2>Jenis Cuti</h2>
          <input type=button value='Tambah Jenis Cuti' onclick=location.href='?module=jenis_cuti&act=tambahjenis_cuti'>
          <table>
          <tr><th>no</th><th>kode jenis cuti</th><th>nama cuti</th><th>lama cuti (hari)</th><th>keterangan</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM jenis_cuti ORDER BY id_jenis_cuti");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[kd_jcuti]</td>
             <td>$r[nama_jcuti]</td>
             <td>$r[lama_jcuti]</td>
             <td>$r[keterangan]</td>
		     <td><a href=?module=jenis_cuti&act=editjenis_cuti&id=$r[id_jenis_cuti]>Edit</a> |
	               <a href=./aksi.php?module=jenis_cuti&act=hapus&id=$r[id_jenis_cuti]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;

  case "tambahjenis_cuti":
    echo "<h2>Tambah Jenis Cuti</h2>
          <form method=POST action='./aksi.php?module=jenis_cuti&act=input'>
          <table>
          <tr><td>Kode</td>         <td> : <input type=text name='kd_jcuti'></td></tr>
          <tr><td>Nama Cuti</td> <td> : <input type=text name='nama_jcuti'></td></tr>
          <tr><td>Lama Cuti</td> <td> : <input type=text name='lama_jcuti'></td></tr>
          <tr><td>Keterangan</td>   <td> : <textarea name='keterangan' cols='25' rows='3'></textarea></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;

  case "editjenis_cuti":
    $edit=mysql_query("SELECT * FROM jenis_cuti WHERE id_jenis_cuti='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Jenis Cuti</h2>
          <form method=POST action=./aksi.php?module=jenis_cuti&act=update>
          <input type=hidden name=id value='$r[id_jenis_cuti]'>
          <table>
          <tr><td>Kode Jenis Cuti</td><td> : <input type=text name='kd_jcuti' value='$r[kd_jcuti]'></td></tr>
          <tr><td>Nama Cuti</td>   <td> : <input type=text name='nama_jcuti' value='$r[nama_jcuti]'></td></tr>
          <tr><td>Lama Cuti</td>   <td> : <input type=text name='lama_jcuti' value='$r[lama_jcuti]'></td></tr>
          <tr><td>Keterangan</td>     <td> : <textarea name='keterangan' cols='25' rows='3'>$r[keterangan]</textarea></td></tr>
            <tr><td colspan=2><input type=submit value=Update>
              <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
?>
