 <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript">
	function cek(){ 
	    $.ajax({ 
	        url: "cekpesan.php", 
	        cache: false, 
	        success: function(msg){ 
	            $("#notifikasi").html(msg); 
	        } 
	    }); 
	    var waktu = setTimeout("cek()",3000); 
	} 
  </script>
  
<?php
switch($_GET[act]){
  // Tampil Persetujuan Cuti
  default:
    echo "<h2>Persetujuan Cuti Kepala Bidang</h2>";
     echo"<table class='list'><tr>
			<td class='center' width='50'><img src='images/User-Administrator-Red-icon.png' border='0' title='detail'/><br><b>Kepala Bidang :</td><td width='80'><b>NIP : $_SESSION[namauser]</td> <td><b>Nama : $_SESSION[nama]</td></tr><tbody>";
    echo "<table class='list'><thead>
          <tr>
          <td class='center'>NO</th>
          <td class='center'>NIP</th>
		  <td class='center'>NAMA</th>
          <td class='center'>JENIS CUTI</th>
          <td class='center'>TANGGAL CUTI</th>
		  <td class='center'>LAMA CUTI</th>
		  <td class='center'>SISA CUTI</th>
		  <td class='center'>FILE</th>
		  <td class='center'>ALASAN</th>
		  <td class='center'>STATUS</th>
          <td colspan='2' class='center'>AKSI</th>
          </tr></thead><tbody>";

    $p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	//, DATE_FORMAT(tgl_mulai,'%d-%b-%Y') AS tgl_mulai, DATE_FORMAT(tgl_akhir,'%d-%b-%Y') AS tgl_akhir  
    $tampil=mysql_query("SELECT *FROM permohonan_cuti
     inner join pegawai on permohonan_cuti.nip=pegawai.nip
     inner join jns_cuti on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
     where pegawai.nip_atasan='$_SESSION[namauser]' and status_pengajuan='belum'
     order by permohonan_cuti.id_pcuti desc");
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
		$file_download = $r['file'];
      echo "<tr><td class='left' width='25'>$no</td>
                <td class='left'>$r[nip]</td>
				<td class='left'>$r[nama]</td>
				<td class='left'>$r[nm_jcuti]</td>
				<td class='left'>".tgl_indo($r['tgl_mulai'])." s/d ".tgl_indo($r['tgl_akhir'])."</td>
				<td class='center'>$r[lama_cuti]</td>				
				<td class='center'>";
				if($r[sisa_cuti]<0){
					echo "-";
					}
					else{
						echo $r[sisa_cuti];
						}
    echo"    </td>
				<td class='left'><a href='../foto/lampiran/$r[file]' target='_blank'>Download</a></td>
				<td class='left'>$r[alasan]</td>
				<td class='center'>$r[status_pengajuan]</td>
				<td><a href='./aksi.php?module=persetujuan_cuti&act=setuju&id_pcuti=$r[id_pcuti]&nip=$r[nip]&nama=$r[nama]' \" onClick=\"return confirm('Apakah Anda yakin untuk meyetujuinya?')\"><img src='images/Like-icon.png' width='25px' height='25px' title='Setuju'></a></td>
	                  <td><a href='./aksi.php?module=persetujuan_cuti&act=tdksetuju&id_pcuti=$r[id_pcuti]&nip=$r[nip]&nama=$r[nama]' \" onClick=\"return confirm('Apakah Andayakin tidak menyutujuinya?')\"><img src='images/Unlike-icon.png' width='25px' height='25px' title='Tidak Setuju'></a></td>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";
    $jmldata = mysql_num_rows(mysql_query("SELECT * FROM permohonan_cuti"));

    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

echo "<div class=\"pagination\"> $linkHalaman</div>";
break;

}
?>
