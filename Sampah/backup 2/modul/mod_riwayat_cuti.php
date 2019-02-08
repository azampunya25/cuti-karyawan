<link rel="stylesheet" href="jq/development-bundle/themes/base/jquery.ui.all.css">
    <script src="jq/js/jquery-1.7.1.min.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.core.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.widget.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <!--<link rel="stylesheet" href="jq/development-bundle/demos/demos.css">-->
    <script>
    $(function() {

        $( "#tglmulai" ).datepicker({ altFormat: 'yy-mm-dd' });
        $( "#tglmulai" ).change(function() {
             $( "#tglmulai" ).datepicker( "option", "dateFormat","yy-mm-dd" );
         });

        $( "#tglakhir" ).datepicker({ altFormat: 'yy-mm-dd' });
        $( "#tglakhir" ).change(function() {
             $( "#tglakhir" ).datepicker( "option", "dateFormat","yy-mm-dd" );
         });

   });


    </script>


<?php
switch($_GET[act]){
  // Tampil Riwayat Cuti
  default:
    echo "<h2>Riwayat Cuti</h2>";
     $s=mysql_query("SELECT * FROM karyawan inner join permohonan_cuti
     on karyawan.nik=permohonan_cuti.nik
     WHERE karyawan.nik='$_SESSION[namauser]'");
     $r=mysql_fetch_array($s);

    echo"<table>
          <tr><td>Nip</td>         <td> : <input type=text name='nik' value='$r[nik]' readonly></td>
              <td>Jabatan</td>     <td> : <input type=text name='kd_jabatan' value='$r[kd_jabatan]' readonly></td>
          </tr>
          <tr><td>Nama</td>         <td> : <input type=text name='nama' value='$r[nama]' readonly></td>
              <td>Tanggal Masuk</td><td> : <input type=text name='tgl_masuk' value='$r[tgl_masuk]' readonly></td>
          </tr></table>";
    echo"<table><tr><th>no</th><th>tahun</th><th>jenis cuti</th><th>tanggal mulai</th><th>tanggal akhir</th>
    <th>lama cuti (hari)</th><th>sisa cuti</th><th>alasan</th><th>persetujuan</th></tr>";

    $no=1;
    $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jenis_cuti
     on permohonan_cuti.kd_jcuti=jenis_cuti.kd_jcuti
     WHERE permohonan_cuti.nik='$_SESSION[namauser]' order by permohonan_cuti.id_pcuti desc");
    while ($r2=mysql_fetch_array($s2)){
    echo"<tr><td>$no</td>
     		 <td>$r2[tahun]</td>
             <td>$r2[nama_jcuti]</td>
             <td>$r2[tgl_mulai]</td>
             <td>$r2[tgl_akhir]</td>
             <td>$r2[lama_cuti]</td>
             <td>";
             if($r2[sisa_cuti]<0){             	echo "-";
             	}
             else{             	echo $r2[sisa_cuti];
             	}
    echo"    </td>
             <td>$r2[alasan]</td>
             <td>$r2[status_pengajuan]</td>";
    $no++;
    }
    echo "</table>";
  break;


}
?>
