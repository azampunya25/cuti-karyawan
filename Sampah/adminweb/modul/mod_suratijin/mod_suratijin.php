<?php
switch($_GET[act]){
  // Tampil Riwayat Cuti
  default:
    echo "<h2>Cetak Surat Ijin Cuti Tahunan</h2>";
    echo"<table id='NoInfo' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th>No</th>
		  <th>ID</th>
          <th>Tahun</th>
          <th>Jenis Cuti</th>
          <th>Tanggal Mulai</th>
		  <th>Lama Cuti (Hari)</th>
		  <th>Sisa Cuti</th>
		  <th>Alasan</th>
          <th>Status</th>
		  <th>Aksi</th>
		  </tr></thead><tbody>";

    $no=1;
    $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jns_cuti on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
     WHERE permohonan_cuti.nip='$_SESSION[namauser]' And permohonan_cuti.status_pengajuankadis='setuju'  And permohonan_cuti.id_jcuti='Cthn' order by permohonan_cuti.id_pcuti desc");
    while ($r2=mysql_fetch_array($s2)){
		//And permohonan_cuti.id_jcuti='CThn'
    echo"<tr><td class='center'>$no</td>
	<td class='center'>$r2[id_pcuti]</td>
     		 <td class='center'>$r2[tahun]</td>
             <td class='left'>$r2[nm_jcuti]</td>
             <td class='left'>".tgl_indo($r2['tgl_mulai'])." s/d ".tgl_indo($r2['tgl_akhir'])."</td>
             <td class='center'>$r2[lama_cuti]</td>
             <td>";
             if($r2[sisa_cuti]<0){             	echo "-";
             	}
             else{             	echo $r2[sisa_cuti];
             	}
    echo"    </td>
             <td>$r2[alasan]</td>
             <td>$r2[status_pengajuankadis]</td>
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
          <th>Jenis Cuti</th>
          <th>Tanggal Mulai</th>
		  <th>Lama Cuti (Hari)</th>
		  <th>Sisa Cuti</th>
		  <th>Alasan</th>
          <th>Status</th>
		  <th>Aksi</th>
		  </tr></thead><tbody>";

    $no=1;
    $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jns_cuti on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
     WHERE permohonan_cuti.nip='$_SESSION[namauser]' And permohonan_cuti.status_pengajuankadis='setuju' and permohonan_cuti.id_jcuti='CHml' order by permohonan_cuti.id_pcuti desc");
    while ($r2=mysql_fetch_array($s2)){
		//And permohonan_cuti.id_jcuti='CThn'
    echo"<tr><td class='center'>$no</td>
	<td class='center'>$r2[id_pcuti]</td>
     		 <td class='center'>$r2[tahun]</td>
             <td class='left'>$r2[nm_jcuti]</td>
             <td class='left'>".tgl_indo($r2['tgl_mulai'])." s/d ".tgl_indo($r2['tgl_akhir'])."</td>
             <td class='center'>$r2[lama_cuti]</td>
             <td>";
             if($r2[sisa_cuti]<0){
             	echo "-";
             	}
             else{
             	echo $r2[sisa_cuti];
             	}
    echo"    </td>
             <td>$r2[alasan]</td>
             <td>$r2[status_pengajuankadiskadis]</td>
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
          <th>Jenis Cuti</th>
          <th>Tanggal Mulai</th>
		  <th>Lama Cuti (Hari)</th>
		  <th>Sisa Cuti</th>
		  <th>Alasan</th>
          <th>Status</th>
		  <th>Aksi</th>
		  </tr></thead><tbody>";

    $no=1;
    $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jns_cuti on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
     WHERE permohonan_cuti.nip='$_SESSION[namauser]' And permohonan_cuti.status_pengajuankadis='setuju'  And permohonan_cuti.id_jcuti='CAls' order by permohonan_cuti.id_pcuti desc");
    while ($r2=mysql_fetch_array($s2)){
		//And permohonan_cuti.id_jcuti='CThn'
    echo"<tr><td class='center'>$no</td>
	<td class='center'>$r2[id_pcuti]</td>
     		 <td class='center'>$r2[tahun]</td>
             <td class='left'>$r2[nm_jcuti]</td>
             <td class='left'>".tgl_indo($r2['tgl_mulai'])." s/d ".tgl_indo($r2['tgl_akhir'])."</td>
             <td class='center'>$r2[lama_cuti]</td>
             <td>";
             if($r2[sisa_cuti]<0){
             	echo "-";
             	}
             else{
             	echo $r2[sisa_cuti];
             	}
    echo"    </td>
             <td>$r2[alasan]</td>
             <td>$r2[status_pengajuankadis]</td>
	                  <td><a href='../adminweb/modul/mod_suratijin/lapijincutipenting.php?id=$r2[id_pcuti]' target='_blank'><img src='images/print-icon.png' width='25px' height='25px' title='Cetak Surat Ijin'></a></td>";
    $no++;
    }
    echo "</table>";
	
	echo "<div class=>$linkHalaman</div><br>";
  break;
}
?>
