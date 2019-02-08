<?php    
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}

$aksi="modul/mod_surat/aksi_suratkeluar.php";
switch($_GET[act]){
  // Tampil SuratKeluar
  default:
    echo "<h2>Histori Surat Keluar</h2>
		<table id='suratkeluar' class='list display' cellspacing='0' width='100%'><thead>  
          <tr><th>No</th>
          <th>No Surat</th>
		  <th>Tgl Surat</th>
		  <th>Pengirim</th>
          <th>Tujuan</th>
		  <th>Perihal</th>
		  <th>File</th>
          </tr></thead>";

      $tampil = mysql_query("SELECT * FROM historiskeluar INNER JOIN bagian
    ON historiskeluar.id_bagian=bagian.id_bagian ORDER BY tgl_surat DESC");

    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center' width='25'>$no</td>
                <td class='left'>$r[no_sk]</td>
				<td class='center'>".tgl_indo($r['tgl_surat'])."</td>
				<td class='left'>$r[nm_bagian]</td>
				<td class='left'>$r[tujuan]</td>
                <td class='left'>$r[perihal]</td>
				<td class='center'><a href='?module=historiskeluar&act=detail&id=$r[id_sm]'>Detail</a></span></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
echo "<div class=> $linkHalaman</div><br>";
    break;
	
	case "detail":
	$ambil=mysql_query("SELECT * FROM historiskeluar INNER JOIN bagian
    ON historiskeluar.id_bagian=bagian.id_bagian where id_sm='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2>Detail Surat</h2>
	<table class='list'>
	<tr>
		<td class='center'>Gambar</td>
		<td class='center' colspan='3'>Identitas</td>
	</tr>
	<tr><td class='center' rowspan='7' width='200'>";
        if ($t[gambar]==''){
			echo "<img src='../foto/foto_suratkeluar/thumb_no_image.jpg' width='200' height='240' />";
		} else {
            echo "<img src='../foto/foto_suratkeluar/medium2_$t[gambar]'>";  
        }
    echo "</td>
		<td class='left' height='5' width='100'>No Surat</td>
		<td class='left' width='5'>:</td>
		<td class='left'>$t[s_no_sk]$t[no_sk]</td>			
	</tr>
	<tr>
		<td class='left' height='5'>Tanggal Surat</td>
		<td class='left'>:</td>
		<td class='left'>".tgl_indo($t['tgl_surat'])."</td>
	</tr>
		<td class='left' height='5'>Pengirim</td>
		<td class='left'>:</td>
		<td class='left'>$t[nm_bagian]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Tujuan</td>
		<td class='left'>:</td>
		<td class='left'>$t[tujuan]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Perihal</td>
		<td class='left'>:</td>
		<td class='left'>$t[perihal]</td>
	</tr>
	<tr>
		<td colspan='3' ><a href=?module=suratkeluar&act=editsuratkeluar&id=$t[id_sk]><input type=button value=Edit></a> <input type=button value=Kembali onclick=self.history.back()></td>
	</tr>
	</table></form>";
	break;	
}
?>