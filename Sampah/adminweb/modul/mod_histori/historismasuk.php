<?php    
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
 }
 
switch($_GET[act]){
  // Tampil Histori Surat Masuk
  default:
    echo "<h2>Histori Surat Masuk</h2>
		<table id='suratmasuk' class='list display' cellspacing='0' width='100%'><thead>  
          <tr>
		  <th>No</th>
          <th>No Agenda</th>
          <th>Asal Surat</th>
		  <th>Tgl Terima</th>
		  <th>No Surat</th>
		  <th>Diteruskan</th>
		  <th>File</th>
          </tr></thead>";

    $tampil = mysql_query("SELECT * FROM historismasuk INNER JOIN bagian
    ON historismasuk.id_bagian=bagian.id_bagian ORDER BY tgl_terima DESC");
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center' width='25'>$no</td>
                <td class='center'>$r[no_agenda]</td>
                <td class='left'>$r[asal_surat]</td>
				<td class='center'>".tgl_indo($r['tgl_terima'])."</td>
				<td class='left'>$r[no_surat]</td>
				<td class='left'>$r[nm_bagian]</td>
				<td class='center'><a href='?module=historismasuk&act=detail&id=$r[id_sm]'>Detail</a></span></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	
echo "<div class=> $linkHalaman</div><br>";
 
    break;   
	
	case "detail":
	$ambil=mysql_query("select * from historismasuk INNER JOIN bagian
    ON historismasuk.id_bagian=bagian.id_bagian where id_sm='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2>Detail Surat</h2>
	<table class='list'>
	<tr>
		<td class='center'>Gambar</td>
		<td class='center' colspan='3'>Identitas</td>
	</tr>
	<tr><td class='center' rowspan='11' width='200'>";
        if ($t[gambar]==''){
			echo "<img src='../foto/foto_suratmasuk/thumb_no_image.jpg' width='200' height='240' />";
		} else {
            echo "<img src='../foto/foto_suratmasuk/medium2_$t[gambar]'>";  
        }
    echo "</td>
		<td class='left' height='5' width='100'>No Agenda</td>
		<td class='left' width='5'>:</td>
		<td class='left'>$t[s_no_agenda]$t[no_agenda]</td>			
	</tr>
	<tr>
		<td class='left' height='5'>Asal Surat</td>
		<td class='left'>:</td>
		<td class='left'>$t[asal_surat]</td>
	</tr>
		<td class='left' height='5'>Tgl Terima</td>
		<td class='left'>:</td>
		<td class='left'>".tgl_indo($t['tgl_terima'])."</td>
	</tr>

	<tr>
		<td class='left' height='5'>No Surat</td>
		<td class='left'>:</td>
		<td class='left'>$t[no_surat]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Diteruskan</td>
		<td class='left'>:</td>
		<td class='left'>$t[nm_bagian]</td>
	</tr>
	<tr>
		<td colspan='3' ><input type=button value=Kembali onclick=self.history.back()></td>
	</tr>
	</table></form>";
	break;	
}
?>	