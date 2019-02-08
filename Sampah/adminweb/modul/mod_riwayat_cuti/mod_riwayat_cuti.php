<?php
switch($_GET[act]){
  // Tampil Riwayat Cuti
  default:
    echo "<h2>Riwayat Cuti</h2>";
     $s=mysql_query("SELECT 
	 pegawai.*,
	 jabatan.nm_jabatan,
	 golongan.*
	 FROM pegawai INNER JOIN jabatan ON jabatan.id_jabatan = pegawai.id_jabatan
	 INNER JOIN golongan ON golongan.id_gol = pegawai.id_gol
     WHERE pegawai.nip='$_SESSION[namauser]'");
     $r=mysql_fetch_array($s);

    echo"<table class='list' width=60%>
          <tr><td>Nip</td>         <td> : <input type=text name='nip' value='$r[nip]' readonly></td>
              <td>Jabatan</td>     <td> : <input type=text name='kd_jabatan' value='$r[nm_jabatan]' readonly></td>
			  			  <td>Golongan</td>     <td> : <input type=text name='kd_jabatan' value='$r[nm_pangkat]' readonly>
			  <input type=text name='kd_jabatan' value='$r[nm_gol]' size='3' readonly>
			  <input type=text name='kd_jabatan' value='$r[ruang]' size='3'readonly></td>
          </tr>
          <tr><td>Nama</td>         <td> : <input type=text name='nama' value='$r[nama]' readonly></td>
              <td>Tanggal Masuk</td><td> : <input type=text name='tgl_masuk' value='$r[tgl_masuk]' readonly></td>
          </tr></table>";
    echo"
	<table id='NoInfo' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th class='center'>No</th>
          <th>Tahun</th>
          <th>Jenis Cuti</th>
          <th>Tanggal Mulai</th>
		  <th>Lama Cuti (Hari)</th>
		  <th>Sisa Cuti</th>
		  <th>Alasan</th>
          <th>Persetujuan Kabid</th>
		  <th>Persetujuan Kadis</th>
		  </tr></thead><tbody>";

    $no=1;
    $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jns_cuti on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
     WHERE permohonan_cuti.nip='$_SESSION[namauser]' order by permohonan_cuti.id_pcuti desc");
    while ($r2=mysql_fetch_array($s2)){
    echo"<tr><td class='center'>$no</td>
     		 <td class='center'>$r2[tahun]</td>
             <td class='left'>$r2[nm_jcuti]</td>
             <td class='center'>".tgl_indo($r2['tgl_mulai'])." s/d ".tgl_indo($r2['tgl_akhir'])."</td>
             <td class='center'>$r2[lama_cuti]</td>
             <td>";
             if($r2[sisa_cuti]<0){             	echo "-";
             	}
             else{             	echo $r2[sisa_cuti];
             	}
    echo"    </td>
             <td>$r2[alasan]</td>
             <td class='center'>$r2[status_pengajuan]</td>
			 <td class='center'>$r2[status_pengajuankadis]</td>";
    $no++;
    }
    echo "</table>";
		    echo "<div class=>$linkHalaman</div><br>";
  break;


}
?>
