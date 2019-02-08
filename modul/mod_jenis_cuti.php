<?php
switch($_GET['act']){
  // Tampil Jenis Cuti
  default:
    echo "
      <div class='box box-default'>
        <div class='box-header with-border'>
          <h3 class='box-title'>Jenis Cuti</h3>
        </div>
        <div class='box-body'>
          <div class='row'>
            <div class='col-md-12'>
              <input type=button value='Tambah Jenis Cuti' class='btn btn-defalut' onclick=location.href='?module=jenis_cuti&act=tambahjenis_cuti'>
              <table id='example' class='table table-bordered table-striped'>
                <tr>
                  <th>No</th>
                  <th>Kode Jenis Cuti</th>
                  <th>Nama Cuti</th>
                  <th>Lama Cuti (Hari)</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>";
                $tampil=mysql_query("SELECT * FROM jenis_cuti ORDER BY id_jenis_cuti");
                $no=1;
                while ($r=mysql_fetch_array($tampil)){
          echo "<tr>
                  <td>$no</td>
                  <td>$r[kd_jcuti]</td>
                  <td>$r[nama_jcuti]</td>
                  <td>$r[lama_jcuti]</td>
                  <td>$r[keterangan]</td>
    		          <td>
                    <a href=?module=jenis_cuti&act=editjenis_cuti&id=$r[id_jenis_cuti] data-toggle='tooltip' title='Edit Data'>
                      <button class='btn btn-primary' type='button'><span class='glyphicon glyphicon-edit'></span></button>
                    </a>
                    <a href=./aksi.php?module=jenis_cuti&act=hapus&id=$r[id_jenis_cuti] data-toggle='tooltip' title='Hapus Data'>
                      <button class='btn btn-danger' type='button' onClick='return confirm('Apakah Anda benar-benar mau menghapusnya?')'><span class='glyphicon glyphicon-trash'></span>
                      </button>
                    </a>
                  </td>
                </tr>";
          $no++;
        }
        echo "</table>
            </div>
          </div>
        </div>
      </div>";
    break;

  case "tambahjenis_cuti":
    echo "
          <div class='box box-default'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Tambah Jenis Cuti</h3>
            </div>
            <div class='box-body'>
              <form method=POST action='./aksi.php?module=jenis_cuti&act=input'>
                <div class='row'>
                  <div class=col-md-1>Kode</div>
                  <div class=col-md-2><input type=text name='kd_jcuti' class='form-control'></div>
                </div>
                <div class='row'>
                  <div class=col-md-1>Nama Cuti</div>
                  <div class=col-md-2><input type=text name='nama_jcuti' class='form-control'></div>
                </div>
                <div class='row'>
                  <div class=col-md-1>Lama Cuti</div>
                  <div class=col-md-2><input type=text name='lama_jcuti' class='form-control'></div>
                </div>
                <div class='row'>
                  <div class=col-md-1>Keterangan</div>
                  <div class=col-md-2><textarea name='keterangan' cols='25' rows='3' class='form-control'></textarea></div>
                </div>
                <div class='row'>
                  <div class=col-md-1></div>
                  <div class=col-md-2><input type=submit value=Simpan class='btn btn-defalut'>
                              <input type=button value=Batal onclick=self.history.back() class='btn btn-defalut'>
                  </div>
                </div>
              </form>
            </div>
          </div>";
     break;

  case "editjenis_cuti":
    $edit=mysql_query("SELECT * FROM jenis_cuti WHERE id_jenis_cuti='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "
          <div class='box box-default'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Edit Jenis Cuti</h3>
            </div>
            <div class='box-body'>
              <form method=POST action=./aksi.php?module=jenis_cuti&act=update>
                <input type=hidden name=id value='$r[id_jenis_cuti]'>
                <div class='row'>
                  <div class='col-md-1'>Kode Jenis Cuti</div>
                  <div class='col-md-2'><input type=text name='kd_jcuti' value='$r[kd_jcuti]' class='form-control'></div>
                </div>
                <div class='row'>
                  <div class='col-md-1'>Nama Cuti</div>
                  <div class='col-md-2'><input type=text name='nama_jcuti' value='$r[nama_jcuti]' class='form-control'></div>
                </div>
                <div class='row'>
                  <div class='col-md-1'>Lama Cuti</div>
                  <div class='col-md-2'><input type=text name='lama_jcuti' value='$r[lama_jcuti]' class='form-control'></div>
                </div>
                <div class='row'>
                  <div class='col-md-1'>Keterangan</div>
                  <div class='col-md-2'>
                    <textarea name='keterangan' cols='25' rows='3' class='form-control'>$r[keterangan]</textarea>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-1'></div>
                  <div class='col-md-2'>
                    <input type=submit value=Update class='btn btn-defalut'>
                    <input type=button value=Batal onclick=self.history.back() class='btn btn-defalut'>
                  </div>
                </div>
              </form>
            </div>
          </div>";
    break;
}
?>
