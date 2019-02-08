<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_hubungi/aksi_hubungi.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
    echo "<h2>Buku Tamu</h2>
          <table id='NoFilter' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th>No</th>
          <th>Nama</th>
          <th>Email</th>
          <th>Pesan</th>
		  <th>Tanggal</th>
          <th>Balasan</th>
		  <th>Aktif</th>
          <th>Aksi</th></tr></thead><tbody>";


    $tampil=mysql_query("SELECT * FROM buku_tamu ORDER BY id_bukutamu DESC");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl]);
      echo "<tr><td class='left' width='25'>$no</td>
                <td class='left'>$r[nama]</td>
                <td class='left'>$r[email]</td>
                <td class='left'>$r[isi_bukutamu]</td>
                <td class='center'>$tgl</a></td>
				<td class='left'>$r[balas]</td>
				<td class='center'>$r[aktif]</td>
						            <td class='center' width='85'><a href=?module=hubungi&act=editbukutamu&id=$r[id_bukutamu]><img src='images/edit.png' border='0' title='edit' /></a>
		                <a href=\"$aksi?module=hubungi&act=hapus&id=$r[id_bukutamu] onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a></td>
                </td></tr>";
    $no++;
    }
    echo "</tbody></table>";

    echo "<div>$linkHalaman</div><br>";
    break;

//Edit Buku Tamu
case "editbukutamu":
    $edit = mysql_query("SELECT * FROM buku_tamu WHERE id_bukutamu='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Kelola Buku Tamu</h2>
          <form method=POST action=$aksi?module=hubungi&act=update>
          <input type=hidden name=id value=$r[id_bukutamu]>
          <table class='list'>
          <tr><td>Nama</td><td>     : <input type=text name='nama' size=30 value='$r[nama]' readonly></td></tr>
          <tr><td>Email</td><td>  : <input type=text name='email' size=30 value='$r[email]' readonly></td></tr>
          <tr><td>Isi</td><td>: <textarea name=isi_bukutamu style='width: 200px; height: 50;' required>$r[isi_bukutamu]</textarea></td></tr>
		  <tr><td>Balasan</td><td>  : <input type=text name='balas' size=30 value='$r[balas]' required></td></tr>";
		  

    if ($r[aktif]=='N'){
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y'>Y  
                                      <input type=radio name='aktif' value='N'checked> N</td></tr>";
    }
    else{
      echo "<tr><td>Aktif</td> <td> : <input type=radio name='aktif' value='Y' checked>Y  
                                      <input type=radio name='aktif' value='N'>N</td></tr>";
    }

    echo "<tr><td colspan=2><input type=submit value=update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Buku Tamu ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
}
?>
