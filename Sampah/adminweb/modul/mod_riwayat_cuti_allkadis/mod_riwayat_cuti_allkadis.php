<?php
switch($_GET[act]){
  // Tampil Riwayat Cuti
  default:
    echo "<h2>Riwayat Cuti</h2>";
    echo"<form action='?module=riwayat_cuti_allkadis' method='post'>
	<table class='list'><tbody>
	<tr><td>Nip : <td><input type='text' name='carinik'>
         <input type='submit' name='submit' value='Cari'></td></tr></tbody></table>
         </form>";

     if ((isset($_POST['submit'])) and ($_POST['carinik']<>"")){      $carinik=$_POST['carinik'];
      $s=mysql_query("SELECT 
	 pegawai.*,
	 jabatan.nm_jabatan,
	 golongan.*
	 FROM pegawai INNER JOIN jabatan ON jabatan.id_jabatan = pegawai.id_jabatan
	 INNER JOIN golongan ON golongan.id_gol = pegawai.id_gol
      WHERE pegawai.nip='$carinik'");
      $r=mysql_fetch_array($s);

      echo"<table class='list'>
          <tr><td>Nip</td>         <td> : <input type=text name='nip' value='$r[nip]' readonly></td>
              <td>Jabatan</td>     <td> : <input type=text name='kd_jabatan' value='$r[nm_jabatan]' readonly></td>
          </tr>
          <tr><td>Nama</td>         <td> : <input type=text name='nama' value='$r[nama]' readonly></td>
              <td>Tanggal Masuk</td><td> : <input type=text name='tgl_masuk' value='$r[tgl_masuk]' readonly></td>
           </tr></table>";
      echo"
          <table class='list'><thead>
          <tr>
          <td class='center'>NO</th>
          <td class='center'>TAHUN</th>
          <td class='center'>JENIS CUTI</th>
          <td class='center'>TANGGAL MULAI</th>
		  <td class='center'>TANGGAL AKHIR</th>
		  <td class='center'>LAMA CUTI (HARI)</th>
		  <td class='center'>SISA CUTI</th>
          <td class='center'>ALASAN</th>
		  <td class='center'>PERSETUJUAN KABID</th>
		  <td class='center'>PERSETUJUAN KADIS</th>
          </tr></thead><tbody>";


      $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jns_cuti
      on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
      WHERE permohonan_cuti.nip='$carinik' order by permohonan_cuti.id_pcuti desc");

      if (mysql_num_rows($s2)>0){
       $no=1;
       while ($r2=mysql_fetch_array($s2)){
       echo"<tr><td class='center'>$no</td>
     		 <td class='center'>$r2[tahun]</td>
             <td>$r2[nm_jcuti]</td>
             <td class='center'>".tgl_indo($r2['tgl_mulai'])."</td>
             <td class='center'>".tgl_indo($r2['tgl_akhir'])."</td>
             <td class='center'>$r2[lama_cuti]</td>
             				<td class='center'>";
				if($r2[sisa_cuti]<0){
					echo "-";
					}
					else{
						echo $r2[sisa_cuti];
						}
    echo"    </td>
             <td>$r2[alasan]</td>
             <td class='center'>$r2[status_pengajuan]</td>
			 <td class='center'>$r2[status_pengajuankadis]</td>";
       $no++;
       }
      }
      else{      	echo "Belum pernah cuti";
       	  }
      echo "</table>";
     }

  break;


}
?>
