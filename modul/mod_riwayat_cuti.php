<?php
switch($_GET['act']){
  // Tampil Riwayat Cuti
  default:
    echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Riwayat Cuti</h3>
          </div>
          <div class='box-body'>
            <div class='row'>";
                 $s=mysql_query("SELECT * FROM karyawan WHERE nik='$_SESSION[namauser]'");
                 $r=mysql_fetch_array($s);

        echo" 
                <div class='col-md-1'>NIP</div>  
                <div class='col-md-2'><input type=text name='nik' value='$r[nik]' readonly class='form-control'></div>
                <div class='col-md-2'>Jabatan</div>
                <div class='col-md-2'><input type=text name='kd_jabatan' value='$r[kd_jabatan]' readonly class='form-control'></div>
            </div>
            <div class='row'>
                <div class='col-md-1'>Nama</div> 
                <div class='col-md-2'><input type=text name='nama' value='$r[nama]' readonly class='form-control'></div>
                <div class='col-md-2'>Tanggal Masuk</div>
                <div class='col-md-2'><input type=text name='tgl_masuk' value='$r[tgl_masuk]' readonly class='form-control'></div>
            </div>
            <div class='row'>
                <div class='col-md-12'>
                    <table id='example' class='table table-bordered table-striped'>
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Tahun</th>
                            <th>Jenis Cuti</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Akhir</th>
                            <th>Lama Cuti (hari)</th>
                            <th>Sisa Cuti</th>
                            <th>Alasan</th>
                            <th>Persetujuan</th>
                        </tr>
                        </thead>";

                        $no=1;
                        $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jenis_cuti
                         on permohonan_cuti.kd_jcuti=jenis_cuti.kd_jcuti
                         WHERE permohonan_cuti.nik='$_SESSION[namauser]' order by permohonan_cuti.id_pcuti desc");
                        while ($r2=mysql_fetch_array($s2)){
                        echo"<tbody>
                                <tr>
                                    <td>$no</td>
                         		    <td>$r2[tahun]</td>
                                    <td>$r2[nama_jcuti]</td>
                                    <td>$r2[tgl_mulai]</td>
                                    <td>$r2[tgl_akhir]</td>
                                    <td>$r2[lama_cuti]</td>
                                    <td>";
                                 if($r2[sisa_cuti]<0){
                                 	echo "-";
                                 	}
                                 else{
                                 	echo $r2[sisa_cuti];
                                 	}
                        echo"    </td>
                         <td>$r2[alasan]</td>
                         <td>$r2[status_pengajuan]</td>
                         </tr>
                         </tbody>";
                        $no++;
                        }
            echo "  </table>
                </div>
            </div>
        </div>";
  break;
}
?>
