<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_komentar/aksi_komentar.php";
switch($_GET[act]){
  // Tampil Komentar
  default:
    echo "<h2>Komentar</h2>
          <table id='NoFilter' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th>No</th>
          <th>Nama</th>
          <th>Komentar</th>
		  <th>Balasan</th>
		  <th>Berita</th>
          <th>Aktif</th>
          <th>Aksi</th></tr></thead>";

    $tampil=mysql_query("SELECT * FROM komentar ORDER BY id_komentar DESC");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
				$q=mysql_query("select * from berita where id_berita=$r[id_berita]");
		$ff=mysql_fetch_array($q);
      echo "<tr><td class='center'>$no</td>
                <td>$r[nama_komentar]</td>
                <td>$r[isi_komentar]</td>
				<td>$r[balas]</td>
				<td>$ff[judul]</td>
                <td class='center'>$r[aktif]</td>
                <td><a href=?module=komentar&act=editkomentar&id=$r[id_komentar]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href=$aksi?module=komentar&act=hapus&id=$r[id_komentar] \" onClick=\"return confirm('Apakah Anda Yakin Menghapus komentar dari : $r[nama_komentar] ??')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
      $no++;
    }
    echo "</table>";

echo "<div class=> $linkHalaman</div><br>";
    break;
  
  case "editkomentar":
    $edit = mysql_query("SELECT * FROM komentar WHERE id_komentar='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Komentar</h2>
          <form method=POST action=$aksi?module=komentar&act=update>
          <input type=hidden name=id value=$r[id_komentar]>
          <table class='list'><tbody>
          <tr><td class='left'>Nama</td><td class='left'>     : <input type=text name='nama_komentar' size=30 value='$r[nama_komentar]' readonly></td></tr>
          <tr><td class='left'>Website</td><td class='left'>  : <input type=text name='url' size=30 value='$r[url]' readonly></td></tr>
          <tr><td class='left'>Isi Komentar</td><td class='left'> <textarea name='isi_komentar' id='loko' style='width: 600px; height: 150px;'>$r[isi_komentar]</textarea></td></tr>
		  <tr><td class='left'>Balas</td><td class='left'>  : <input type=text name='balas' size=30 value='$r[balas]' required></td></tr>";

    if ($r[aktif]=='Y'){
      echo "<tr><td class='left'>Aktif</td> <td class='left'> : <input type=radio name='aktif' value='Y' checked>Y  
                                      <input type=radio name='aktif' value='N'> N</td></tr>";
    }
    else{
      echo "<tr><td class='left'>Aktif</td> <td class='left'> : <input type=radio name='aktif' value='Y'>Y  
                                      <input type=radio name='aktif' value='N' checked>N</td></tr>";
    }

    echo "<tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Komentar ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
