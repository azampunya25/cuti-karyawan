<?php
$aksi="modul/mod_pegawaiview/aksi_pegawaiview.php";
switch($_GET[act]){
  // Tampil Pegawai
  default:
    echo "<h2>Daftar Data Pegawai</h2>
          <table id='jabatan' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th>No</th>
          <th>Nip</th>
          <th>Nama Pegawai</th>
          <th>Jabatan</th>
		  <th>Status Pegawai</th>
		  <th>Status Kawin</th>
          <th>Aksi</th></tr></thead><tbody>";

	 
	 //"SELECT * FROM pegawai inner join jabatan on pegawai.id_jabatan=jabatan.id_jabatan ORDER BY nip DESC"
    $tampil=mysql_query("SELECT * FROM pegawai inner join jabatan on pegawai.id_jabatan=jabatan.id_jabatan
     where pegawai.nip_atasan='$_SESSION[namauser]'");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td class='center' width='25'>$no</td>
				<td class='left'>$r[nip]</td>
                <td class='left'>$r[nama]</td>
                <td class='left'>$r[nm_jabatan]</td>
				<td class='left'>$r[status_pegawai]</td>
				<td class='center'>";
				if($r['status_kawin']=='TK'){
				echo "Tidak Kawin";
					} else {
				echo "Kawin";
				}	
				echo "</td>
                <td class='center' width='85'><a href=?module=pegawaiview&act=pegawaidetail&id=$r[nip]><img src='images/folder-users-icon.png' border='0' title='detail' /></a>
		        </tr>";
				
    $no++;
    }
    echo "</tbody></table>";
	
    echo "<div class=>$linkHalaman</div><br>";
 
    break; 
	
	case "pegawaidetail":
    $edit = mysql_query("SELECT * FROM pegawai inner join jabatan on pegawai.id_jabatan=jabatan.id_jabatan WHERE nip='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Pegawai</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=pegawaiview&act=pegawaidetail>
          <input type=hidden name=id value=$r[nip]>
          <table class='list'><tbody>      
		  <tr>
			<td class='center'>Foto Pegawai</td>
			<td class='center' colspan='6'>Identitas Pegawai</td>
		  </tr>
          <tr>
			<td class='center' rowspan='7' width='200'><img src='../foto/foto_pegawai/kecil_$r[gambar]'></td>
			<td class='left' width='100'>NIP</td>
			<td class='left' width='5'>:</td>
			<td class='left' width='120'>$r[nip]</td>
			<td class='left' width='100'>Alamat Tinggal</td>
			<td class='left' width='5'>:</td>
			<td class='left'>$r[almt_tinggal]</td>
		  </tr>
		  <tr>
			<td class='left'>Nama Pegawai</td>
			<td class='left'>:</td>
			<td class='left'>$r[nama]</td>
						<td class='left'>Tgl Masuk</td>
			<td class='left'>:</td>
			<td class='left'>".tgl_indo($r['tgl_masuk'])."</td>
		  </tr>
			<td class='left'>Jabatan</td>
			<td class='left'>:</td>
			<td class='left'>$r[nm_jabatan]</td>
						<td class='left'>Status Pegawai</td>
			<td class='left'>:</td>
			<td class='left'>$r[status_pegawai]</td>

		  </tr>
		  <tr>
			<td class='left'>Kelamin</td>
			<td class='left'>:</td>
					<td class='left'>";
		if($r['kelamin']=='P'){
			echo "Pria";
			} else {
			echo "Wanita";
			}	
		echo "</td>
			<td class='left' colspan='3' rowspan='3'>&nbsp</td>
		  </tr>
		  <tr>
			<td class='left'>Status Kawin</td>
			<td class='left'>:</td>
			<td class='left'>";
		if($r['status_kawin']=='TK'){
			echo "Tidak Kawin";
			} else {
			echo "Kawin";
			}	
		echo "</td>
			
		  </tr>
		  <tr>
			<td class='left'>Pendidikan</td>
			<td class='left'>:</td>
			<td class='left'>$r[pendidikan]</td>

		  </tr>
		  <tr>
			<td class='right' colspan='6'><input type=button value=Kembali onclick=self.history.back()></td>
		  </tr>
          </tbody></table></form>";

    break;  
	
	case "datadiri":
    $edit = mysql_query("SELECT pegawai.*,jabatan.nm_jabatan FROM pegawai,jabatan WHERE jabatan.kd_jabatan=pegawai.kd_jabatan AND pegawai.nik='$nip'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Pegawai</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=pegawaiview&act=pegawaidetail>
          <input type=hidden name=id value=$r[id_pegawai]>
          <table class='list'><tbody>      
		  <tr>
			<td class='center'>Foto Pegawai</td>
			<td class='center' colspan='6'>Identitas Pegawai</td>
		  </tr>
          <tr>
			<td class='center' rowspan='7' width='200'><img src='../foto/foto_pegawai/kecil_$r[gambar]'></td>
			<td class='left' width='100'>NIP</td>
			<td class='left' width='5'>:</td>
			<td class='left' width='120'>$r[nip]</td>
			<td class='left' width='100'>Alamat Tinggal</td>
			<td class='left' width='5'>:</td>
			<td class='left'>$r[almt_tinggal]</td>
		  </tr>
		  <tr>
			<td class='left'>Nama Pegawai</td>
			<td class='left'>:</td>
			<td class='left'>$r[nama]</td>
			<td class='left'>Alamat Asal</td>
			<td class='left'>:</td>
			<td class='left'>$r[almt_asal]</td>
		  </tr>
			<td class='left'>Kode Jabatan</td>
			<td class='left'>:</td>
			<td class='left'>$r[jabatan]</td>
			<td class='left'>Tgl Masuk</td>
			<td class='left'>:</td>
			<td class='left'>$r[tgl_masuk]</td>
		  </tr>
		  <tr>
			<td class='left'>Kelamin</td>
			<td class='left'>:</td>
			<td class='left'>$r[kelamin]</td>
			<td class='left'>Status Pegawai</td>
			<td class='left'>:</td>
			<td class='left'>$r[status_pegawai]</td>
		  </tr>
		  <tr>
			<td class='left'>Status Kawin</td>
			<td class='left'>:</td>
			<td class='left'>$r[status_kawin]</td>
			<td class='left' colspan='3' rowspan='2'>&nbsp</td>
		  </tr>
		  <tr>
			<td class='left'>Pendidikan</td>
			<td class='left'>:</td>
			<td class='left'>$r[pendidikan]</td>

		  </tr>
		  <tr>
			<td class='right' colspan='6'><input type=button value=Kembali onclick=self.history.back()></td>
		  </tr>
          </tbody></table></form>";

    break;  
	
}
?>
