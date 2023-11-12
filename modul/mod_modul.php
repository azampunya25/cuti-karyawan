<?php
switch(isset($_GET['act'])){
  // Tampil Modul
  default:
  echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Modul</h3>
          </div>
          <div class='box-body'>
            <div class='row'>
              <div class='col-md-12'>
                <input type=button value='Tambah Modul' class='btn btn-defalut' onclick=location.href='?module=modul&act=tambahmodul'>
                <table id='example' class='table table-bordered table-striped'>
                  <tr>
                    <th>No</th>
                    <th>Nama Modul</th>
                    <th>Link</th>
                    <th>Publish</th>
                    <th>Aktif</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>";
                  $tampil=mysqli_query($mysqli, "SELECT * FROM modul ORDER BY urutan");
                  while ($r=mysqli_fetch_array($tampil)){
                  echo "
                  <tr>
                    <td>$r[urutan]</td>
                    <td>$r[nama_modul]</td>
                    <td><a href=$r[link]>$r[link]</a></td>
                    <td align=center>$r[publish]</td>
                    <td align=center>$r[aktif]</td>
                    <td align=center>$r[status]</td>
                    <td>
                    <a href=?module=modul&act=editmodul&id=$r[id_modul] data-toggle='tooltip' title='Edit Data'>
                    <button class='btn btn-primary' type='button'><span class='glyphicon glyphicon-edit'></span>
                    </button></a>
                    <a href=./aksi.php?module=modul&act=hapus&id=$r[id_modul] data-toggle='tooltip' title='Hapus Data'>
                    <button class='btn btn-danger' type='button' onClick='return confirm('Apakah Anda benar-benar mau menghapusnya?')'><span class='glyphicon glyphicon-trash'></span>
                    </button></a>
                    </td>
                  </tr>";
                }
                echo "</table>
              </div>
            </div>
          </div>
        </div>
  ";
  break;

  case "tambahmodul":
  echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Tambah Modul</h3>
          </div>
          <div class='box-body'>
            <form method=POST action='./aksi.php?module=modul&act=input'>
            <div class='row'>
            <div class='col-md-2'>Nama Modul</div>
            <div class='col-md-3'><input type=text name='nama_modul' class='form-control'></div>
            </div>
            <div class='row'>
            <div class='col-md-2'>Link</div>
            <div class='col-md-3'><input type=text name='link' size=30 class='form-control'></div>
            </div>
            <div class='row'>
            <div class='col-md-2'>Publish</div>
            <div class='col-md-3'>
            <input type=radio name='publish' value='Y' checked>Y
            <input type=radio name='publish' value='N'>N
            </div>
            </div>
            <div class='row'>
            <div class='col-md-2'>Aktif</div>
            <div class='col-md-3'>
            <input type=radio name='aktif' value='Y' checked>Y
            <input type=radio name='aktif' value='N'>N
            </div>
            </div>
            <div class='row'>
            <div class='col-md-2'>Status</div>
            <div class='col-md-3'>
            <input type=radio name='status' value='atasan' checked>atasan
            <input type=radio name='status' value='karyawan'>karyawan
            <input type=radio name='status' value='admin'>admin
            </div>
            </div>
            <div class='row'>
            <div class='col-md-2'>Urutan</div>
            <div class='col-md-3'><input type=text name='urutan' size=1 class='form-control'></div>
            </div>
            <div class='row'>
            <div class='col-md-2'></div>
            <div class='col-md-3'><input type=submit value=Simpan class='btn btn-defalut'>
            <input type=button value=Batal onclick=self.history.back() class='btn btn-defalut'></div>
            </div>
            </form>
          </div>
        </div>";
  break;

  case "editmodul":
  $edit = mysqli_query($mysqli, "SELECT * FROM modul WHERE id_modul='$_GET[id]'");
  $r    = mysqli_fetch_array($edit);

  echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Edit Modul</h3>
          </div>
          <div class='box-body'>
            <form method=POST action=./aksi.php?module=modul&act=update>
              <input type=hidden name=id value='$r[id_modul]'>
                <div class='row'>
                  <div class='col-md-2'>Nama Modul</div>
                  <div class='col-md-3'>
                    <input type=text name='nama_modul' class='form-control' value='$r[nama_modul]'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-2'>Link</div>
                  <div class='col-md-3'>
                    <input type=text name='link' size=30 class='form-control' value='$r[link]'>
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-2'>Publish</div>
                  <div class='col-md-3'>";
                    if ($r['publish']=='Y'){
                      echo "<input type=radio name='publish' value='Y' checked>Y
                      <input type=radio name='publish' value='N'> N";
                    }
                    else{
                      echo "<input type=radio name='publish' value='Y'>Y
                      <input type=radio name='publish' value='N' checked>N";
                    }
                    echo "
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-2'>Aktif</div>
                  <div class='col-md-3'>";
                    if ($r['aktif']=='Y'){
                      echo "<input type=radio name='aktif' value='Y' checked>Y
                      <input type=radio name='aktif' value='N'> N";
                    }
                    else{
                      echo "<input type=radio name='aktif' value='Y'>Y
                      <input type=radio name='aktif' value='N' checked>N";
                    }
                    echo ";
                  </div>
                </div>
                <div class='row'>
                  <div class='col-md-2'>Status</div>
                  <div class='col-md-3'>";
                    if ($r['status']=='atasan'){
                      echo "<input type=radio name='status' value='atasan' checked>atasan
                            <input type=radio name='status' value='karyawan'>karyawan
                            <input type=radio name='status' value='admin'>admin";
                    }
                    elseif ($r['status']=='karyawan'){
                      echo "<input type=radio name='status' value='atasan'>atasan
                            <input type=radio name='status' value='karyawan' checked>karyawan
                            <input type=radio name='status' value='admin'>admin";
                    }
                    else{
                      echo "<input type=radio name='status' value='atasan'>atasan
                            <input type=radio name='status' value='karyawan'>karyawan
                            <input type=radio name='status' value='admin' checked>admin";
                    }
              echo ";
                  </div>
                </div>
              <div class='row'>
                <div class='col-md-2'>Urutan</div>
                <div class='col-md-3'>
                  <input type=text name='urutan' size=1 class='form-control' value='$r[urutan]'>
                </div>
              </div>
              <div class='row'>
                <div class='col-md-2'></div>
                <div class='col-md-3'>
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
