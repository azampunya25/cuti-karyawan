<script language="javascript">
function validasi(form){
  if (form.dari.value == ""){
    alert("Anda belum memilih tanggal awal!!");
    form.dari.focus();
    return (false);
  }
    if (form.sampai.value == ""){
    alert("Anda belum memilih tanggal akhir!!");
    form.sampai.focus();
    return (false);
  }
}
</script>

<?php
switch($_GET[act]){
  // Tampil Riwayat Cuti
  default:
  	echo "<h2>Laporan Cuti Pegawai</h2>
          <form method=POST action='modul/mod_suratijin/laporan.php' target='_blank' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'>
          <tr><td>Dari Tanggal</td><td> : <input type=text id='tgllap3' name='dari'></td></tr>
          <tr><td>s/d Tanggal</td><td> : <input type=text id='tgllap4' name='sampai'></td></tr>
          <tr><td colspan=2><input type=submit value=Proses >
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table>
          </form>";	  
  	//echo "<div class=>$linkHalaman</div><br>";
    echo "<h2>Cetak Surat Ijin Cuti Tahunan</h2>";
    echo"<table id='NoInfo' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th>No</th>
		  <th>ID</th>
          <th>Tahun</th>
		  <th>NIP</th>
		  <th>Nama</th>
          <th>Jenis Cuti</th>
          <th>Tanggal Mulai</th>
		  <th>Lama Cuti (Hari)</th>
		  <th>Aksi</th>
		  </tr></thead><tbody>";

    $no=1;
    $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jns_cuti on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
	inner join pegawai on permohonan_cuti.nip=pegawai.nip
     WHERE permohonan_cuti.status_pengajuankadis='setuju'  And permohonan_cuti.id_jcuti='CThn' order by permohonan_cuti.id_pcuti desc");
    while ($r2=mysql_fetch_array($s2)){
		//And permohonan_cuti.id_jcuti='CThn'
    echo"<tr><td class='center'>$no</td>
	<td class='center'>$r2[id_pcuti]</td>
     		 <td class='center'>$r2[tahun]</td>
			 <td class='center'>$r2[nip]</td>
			 <td class='center'>$r2[nama]</td>
             <td class='left'>$r2[nm_jcuti]</td>
             <td class='left'>".tgl_indo($r2['tgl_mulai'])." s/d ".tgl_indo($r2['tgl_akhir'])."</td>
             <td class='center'>$r2[lama_cuti]</td>
	                  <td><a href='../adminweb/modul/mod_suratijin/lapijincutithn.php?id=$r2[id_pcuti]' target='_blank'><img src='images/print-icon.png' width='25px' height='25px' title='Cetak Surat Ijin'></a></td>";
    $no++;
    }
    echo "</table>";
	
	echo "<div class=>$linkHalaman</div><br>";
 // break;
  
      echo "<h2>Cetak Surat Ijin Hamil</h2>";
    echo"<table id='NoInfo1' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th>No</th>
		  <th>ID</th>
          <th>Tahun</th>
		  <th>NIP</th>
		  <th>Nama</th>
          <th>Jenis Cuti</th>
          <th>Tanggal Mulai</th>
		  <th>Tanggal Akhir</th>
		  <th>Lama Cuti (Hari)</th>
		  <th>Aksi</th>
		  </tr></thead><tbody>";

    $no=1;
    $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jns_cuti on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
	inner join pegawai on permohonan_cuti.nip=pegawai.nip
     WHERE permohonan_cuti.status_pengajuan='setuju' and permohonan_cuti.id_jcuti='CHml' order by permohonan_cuti.id_pcuti desc");
    while ($r2=mysql_fetch_array($s2)){
		//And permohonan_cuti.id_jcuti='CThn'
    echo"<tr><td class='center'>$no</td>
	<td class='center'>$r2[id_pcuti]</td>
     		 <td class='center'>$r2[tahun]</td>
			 <td class='center'>$r2[nip]</td>
			 <td class='center'>$r2[nama]</td>
             <td class='left'>$r2[nm_jcuti]</td>
             <td class='left'>$r2[tgl_mulai]</td>
             <td class='left'>$r2[tgl_akhir]</td>
             <td class='center'>$r2[lama_cuti]</td>
	                  <td><a href='../adminweb/modul/mod_suratijin/lapijincutihml.php?id=$r2[id_pcuti]' target='_blank'><img src='images/print-icon.png' width='25px' height='25px' title='Cetak Surat Ijin'></a></td>";
    $no++;
    }
    echo "</table>";
	
	echo "<div class=>$linkHalaman</div><br>";
 // break;
  
      echo "<h2>Cetak Surat Ijin Cuti Alasan Penting</h2>";
    echo"<table id='NoInfo2' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th>No</th>
		  <th>ID</th>
          <th>Tahun</th>
		  <th>NIP</th>
		  <th>Nama</th>
          <th>Jenis Cuti</th>
          <th>Tanggal Mulai</th>
		  <th>Tanggal Akhir</th>
		  <th>Lama Cuti (Hari)</th>
		  <th>Aksi</th>
		  </tr></thead><tbody>";

    $no=1;
    $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jns_cuti on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
	inner join pegawai on permohonan_cuti.nip=pegawai.nip
     WHERE permohonan_cuti.status_pengajuan='setuju'  And permohonan_cuti.id_jcuti='CAls' order by permohonan_cuti.id_pcuti desc");
    while ($r2=mysql_fetch_array($s2)){
		//And permohonan_cuti.id_jcuti='CThn'
    echo"<tr><td class='center'>$no</td>
	<td class='center'>$r2[id_pcuti]</td>
     		 <td class='center'>$r2[tahun]</td>
			 <td class='center'>$r2[nip]</td>
			 <td class='center'>$r2[nama]</td>
             <td class='left'>$r2[nm_jcuti]</td>
             <td class='left'>$r2[tgl_mulai]</td>
             <td class='left'>$r2[tgl_akhir]</td>
             <td class='center'>$r2[lama_cuti]</td>
	                  <td><a href='../adminweb/modul/mod_suratijin/lapijincutipenting.php?id=$r2[id_pcuti]' target='_blank'><img src='images/print-icon.png' width='25px' height='25px' title='Cetak Surat Ijin'></a></td>";
    $no++;
    }
    echo "</table>";
	
	echo "<div class=>$linkHalaman</div><br>";
  break;
}
?>
