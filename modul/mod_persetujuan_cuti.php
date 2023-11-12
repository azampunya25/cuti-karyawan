
<?php
switch(isset($_GET['act'])){
  // Tampil Persetujuan Cuti
  default:
    echo "
        <div class='box box-default'>
            <div class='box-header with-border'>
                <h3 class='box-title'>Persetujuan Cuti</h3>
            </div>
          <div class='box-body'>
            <div class='row'>
                <div class='col-md-12'>
                    <table>
                        <tr>
                            <td>Atasan :</td>
                            <td>$_SESSION[namauser]</td>
                            <td>$_SESSION[nama]</td>
                        </tr>
                    </table>";

                     $s=mysqli_query($mysqli, "SELECT * FROM permohonan_cuti
                     inner join karyawan on permohonan_cuti.nik=karyawan.nik
                     inner join jenis_cuti on permohonan_cuti.kd_jcuti=jenis_cuti.kd_jcuti
                     where karyawan.nik_atasan='$_SESSION[namauser]'
                     order by permohonan_cuti.id_pcuti desc");

                echo"
                    <table id='example' class='table table-bordered table-striped'>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIP</th>
                            <th>Nama</th>
                            <th>Jenis Cuti</th>
                            <th>Tanggal Cuti</th>
                            <th>Lama Cuti (Hari)</th>
                            <th>Sisa Cuti</th>
                            <th>Alasan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>";

                        $no=1;
                        while ($r2=mysqli_fetch_array($s)){
                    echo"<tbody>
                        <tr>
                            <td>$no</td>
                     		<td>$r2[nik]</td>
                     		<td>$r2[nama]</td>
                            <td>$r2[nama_jcuti]</td>
                            <td>$r2[tgl_mulai] s/d $r2[tgl_akhir]</td>
                            <td>$r2[lama_cuti]</td>
                            <td>$r2[sisa_cuti]</td>
                            <td>$r2[alasan]</td>
                            <td>$r2[status_pengajuan]</td>
                            <td>
                                <a href='./aksi.php?module=persetujuan_cuti&act=setuju&id_pcuti=$r2[id_pcuti]&nik=$r2[nik]&nama=$r2[nama]' data-toggle='tooltip' title='Setuju'>
                                    <button class='btn btn-primary' type='button'><span class='glyphicon glyphicon-edit'></span>
                                    </button>
                                </a>
                                <a href='./aksi.php?module=persetujuan_cuti&act=tdksetuju&id_pcuti=$r2[id_pcuti]&nik=$r2[nik]&nama=$r2[nama]' data-toggle='tooltip' title='Tidak Setuju'>
                                   <button class='btn btn-danger' type='button' onClick='return confirm('Apakah Anda benar-benar mau menghapusnya?')'><span class='glyphicon glyphicon-trash'></span>
                                   </button>
                                </a>
                            </td>
                        </tr>
                        </tbody>";
                    $no++;
                    }
            echo "  </table>
                </div>
            </div>
        </div>
    </div>";

  break;


}
?>
