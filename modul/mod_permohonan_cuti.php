<?php
switch($_GET['act']){
  // Tampil Permohonan Cuti
  default:
  echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Permohonan Cuti</h3>
          </div>
          <div class='box-body'>
            <div class='row'>
              <div class='col-md-12'>";
                $s=mysql_query("SELECT * FROM karyawan WHERE nik='$_SESSION[namauser]'");
                $r=mysql_fetch_array($s);
                $thn=date('Y');

                $s1=mysql_query("SELECT * FROM periode_cuti
                   WHERE nik='$_SESSION[namauser]'");
                $r1=mysql_fetch_array($s1);

                echo"
                <div class='row'>
                  <div class=col-md-2>NIP</div>
                  <div class=col-md-4>
                    <input type=text name='nik' value='$r[nik]' readonly class='form-control'>
                  </div>
                  <div class=col-md-2>Jabatan</div>
                  <div class=col-md-4>
                    <input type=text name='kd_jabatan' value='$r[kd_jabatan]' readonly class='form-control'>
                  </div>
                </div>
                <div class='row'>
                  <div class=col-md-2>Nama</div>
                  <div class=col-md-4>
                    <input type=text name='nama' value='$r[nama]' readonly class='form-control'>
                  </div>
                  <div class=col-md-2>Tanggal Masuk</div>
                  <div class=col-md-4>
                    <input type=text name='tgl_masuk' value='$r[tgl_masuk]' readonly class='form-control'>
                  </div>
                </div>

                <form method=POST name=cuti action=./aksi.php?module=permohonan_cuti&act=input>
                  <div class='row'>
                    <div class=col-md-2>Tahun</div>
                    <div class=col-md-4>
                      <input type='text' name='tahun' value='$r1[tahun]' readonly class='form-control'>
                    </div>
                  </div>
                  <div class='row'>
                  <div class=col-md-2>Periode Cuti Tahunan</div>
                  <div class=col-md-2>
                    <input type='text' name='periodeawal' value=$r1[awalcuti] size=8 readonly class='form-control'></div>
                  <div class=col-md-2>
                    <input type='text' name='periodeakhir' value=$r1[akhircuti] size=8 readonly class='form-control'></div>
                  </div>
                  <div class='row'>
                    <div class=col-md-2>Jenis Cuti</div>
                    <div class=col-md-4>
                      <select name='jenis_cuti' id='cmbJenisCuti' class='form-control'>
                      <option value=''>----Jenis Cuti-----</option>";
                      $thn=date('Y');
                      $sj=mysql_query("SELECT * FROM jenis_cuti");

                      while($rj=mysql_fetch_array($sj)){
                        echo "<option value='$rj[kd_jcuti]'>$rj[nama_jcuti]</option>";
                      }
                      echo"
                      </select>
                    </div>
                  </div>
                  <div class='row'>
                    <div class=col-md-2>Tanggal mulai</div>
                    <div class=col-md-4>
                      <input type='text' name='tgl_mulai' id='tglmulai' value='0000-00-00' class='form-control'>
                    </div>
                  </div>
                  <div class='row'>
                    <div class=col-md-2>Tanggal akhir</div>
                    <div class=col-md-4>
                      <input type='text' name='tgl_akhir' id='tglakhir' value='0000-00-00' class='form-control'>
                    </div>
                  </div>

              <div class='row'>
              <div class=col-md-2>Alasan</div>
              <div class=col-md-4><textarea name='alasan' cols='25' rows='3' class='form-control'></textarea></div>
              </div>

              <div class='row'>
              <div class=col-md-2>Nip Atasan</div>
              <div class=col-md-4><input type='text' name='nik_atasan' value='$r[nik_atasan]' readonly class='form-control'></div>
              <input type='hidden' name='nik' value='$r[nik]'>
              </div>

              <div class='row'>
              <div class=col-md-2></div>
              <div class=col-md-4><input type='submit' value='Simpan' class='btn btn-defalut'></div>
              </div>
              </form>";
break;


}

?>

