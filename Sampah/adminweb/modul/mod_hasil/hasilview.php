<?php
$aksi="modul/mod_pegawaiview/aksi_pegawaiview.php";
switch($_GET[act]){
  // Tampil Pegawai
  default:
    echo "<h2>Data Pribadi</h2>";
	$sql_pcuti  ="SELECT permohonan_cuti.*,jns_cuti.nama_jcuti FROM permohonan_cuti,jns_cuti ";
	$sql_pcuti .="WHERE jns_cuti.kd_jcuti=permohonan_cuti.kd_jcuti AND permohonan_cuti.kd_pcuti='$kd_pcuti'";
	$sql_pcuti .="AND permohonan_cuti.nik='$nik_login_k'";

	$qr_pcuti =mysql_query($sql_pcuti, $koneksi) or die ("Gagal Query Karyawan");
	$hs_pcuti =mysql_fetch_array($qr_pcuti);
	
     echo"<table class='list'><tbody>      
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
	
	case "pegawaidetail":
    $edit = mysql_query("SELECT * FROM pegawai WHERE nip='$_GET[id]'");
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
