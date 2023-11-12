<?php
switch(isset($_GET['act'])){
  // Tampil Jabatan
  default:
    echo "
          <div class='box box-default'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Jabatan</h3>
            </div>
            <div class='box-body'>
              <div class='row'>
                <div class='col-md-12'>
                  <input type=button value='Tambah Jabatan' class='btn btn-defalut' onclick=location.href='?module=jabatan&act=tambahjabatan'>
                  <table id='example' class='table table-bordered table-striped'>
                    <tr>
                      <th>No</th>
                      <th>Kode</th>
                      <th>Nama Jabatan</th>
                      <th>Keterengan</th>
                      <th>Aksi</th>
                    </tr>";
                    $tampil=mysqli_query($mysqli, "SELECT * FROM jabatan ORDER BY id_jabatan");
                    $no=1;
                    while ($r=mysqli_fetch_array($tampil)){
               echo "<tr>
                      <td>$no</td>
                      <td>$r[kd_jabatan]</td>
                      <td>$r[nm_jabatan]</td>
                      <td>$r[keterangan]</td>
                      <td>
                        <a href=?module=jabatan&act=editjabatan&id=$r[id_jabatan] data-toggle='tooltip' title='Edit Data'>
                          <button class='btn btn-primary' type='button'><span class='glyphicon glyphicon-edit'></span></button>
                        </a>
                        <a href=./aksi.php?module=jabatan&act=hapus&id=$r[id_jabatan] data-toggle='tooltip' title='Hapus Data'>
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

  case "tambahjabatan":
    echo "
          <div class='box box-default'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Tambah Jabatan</h3>
            </div>
            <div class='box-body'>
              <form method=POST action='./aksi.php?module=jabatan&act=input'>
                <div class='row'>
                  <div class=col-md-2>Kode</div>
                  <div class=col-md-2><input type=text name='kd_jabatan' class='form-control'></div>
                </div>
                <div class='row'>
                  <div class=col-md-2>Nama Jabatan</div>
                  <div class=col-md-2><input type=text name='nm_jabatan' class='form-control'></div>
                </div>
                <div class='row'>
                  <div class=col-md-2>Keterangan</div>
                  <div class=col-md-2><textarea name='keterangan' cols='25' rows='3' class='form-control'></textarea></div>
                </div>
                <div class='row'>
                  <div class=col-md-2></div>
                  <div class=col-md-2><input type=submit value=Simpan class='btn btn-defalut'>
                              <input type=button value=Batal onclick=self.history.back() class='btn btn-defalut'></div>
                </div>
              </form>
            </div>
          </div>";
     break;

  case "editjabatan":
    $edit=mysqli_query($mysqli, "SELECT * FROM jabatan WHERE id_jabatan='$_GET[id]'");
    $r=mysqli_fetch_array($edit);

    echo "
          <div class='box box-default'>
            <div class='box-header with-border'>
              <h3 class='box-title'>Edit Jabatan</h3>
            </div>
            <div class='box-body'>
              <form method=POST action=./aksi.php?module=jabatan&act=update>
              <input type=hidden name=id value='$r[id_jabatan]'>
                <div class='row'>
                  <div class=col-md-2>Kode</div>
                  <div class=col-md-2><input type=text name='kd_jabatan' class='form-control' value='$r[kd_jabatan]'></div>
                </div>
                <div class='row'>
                  <div class=col-md-2>Nama Jabatan</div>
                  <div class=col-md-2><input type=text name='nm_jabatan' class='form-control' value='$r[nm_jabatan]'></div>
                </div>
                <div class='row'>
                  <div class=col-md-2>Keterangan</div>
                  <div class=col-md-2><textarea name='keterangan' cols='25' rows='3' class='form-control'>$r[keterangan]</textarea></div>
                </div>
                <div class='row'>
                  <div class=col-md-2></div>
                  <div class=col-md-2><input type=submit value=Update class='btn btn-defalut'>
                              <input type=button value=Batal onclick=self.history.back() class='btn btn-defalut'></div>
                </div>
              </form>
            </div>
          </div>";
    break;
}
?>
