
<?php
switch($_GET[act]){
  // Tampil Persetujuan Cuti
  default:
    echo "<h2>Persetujuan Cuti</h2>";
     echo"<table><tr><td>Atasan :</td><td>$_SESSION[namauser]</td>
                 <td>$_SESSION[nama]</td></tr>
           </table>";

     $s=mysql_query("SELECT * FROM permohonan_cuti
     inner join karyawan on permohonan_cuti.nik=karyawan.nik
     inner join jenis_cuti on permohonan_cuti.kd_jcuti=jenis_cuti.kd_jcuti
     where karyawan.nik_atasan='$_SESSION[namauser]'
     order by permohonan_cuti.id_pcuti desc");

     echo"<table><tr><th>no</th><th>NIP</th><th>nama</th><th>jenis cuti</th><th>tanggal cuti</th>
     <th>lama cuti (hari)</th><th>sisa cuti</th><th>alasan</th><th>status</th><th>aksi</th></tr>";

    $no=1;
    while ($r2=mysql_fetch_array($s)){
    echo"<tr><td>$no</td>
     		 <td>$r2[nik]</td>
     		 <td>$r2[nama]</td>
             <td>$r2[nama_jcuti]</td>
             <td>$r2[tgl_mulai] s/d $r2[tgl_akhir]</td>
             <td>$r2[lama_cuti]</td>
             <td>$r2[sisa_cuti]</td>
             <td>$r2[alasan]</td>
             <td>$r2[status_pengajuan]</td>
             <td><a href='./aksi.php?module=persetujuan_cuti&act=setuju&id_pcuti=$r2[id_pcuti]&nik=$r2[nik]&nama=$r2[nama]'>setuju</a>
             <br><a href='./aksi.php?module=persetujuan_cuti&act=tdksetuju&id_pcuti=$r2[id_pcuti]&nik=$r2[nik]&nama=$r2[nama]'>tdk-setuju</a></td>";
    $no++;
    }
    echo "</table>";

  break;


}
?>
