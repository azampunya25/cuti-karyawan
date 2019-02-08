<?php
switch($_GET['act']){
  // Tampil User
  default:
  echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Akun Karyawan</h3>
          </div>
          <div class='box-body'>
            <div class='row'>
              <div class='col-md-12'>
                <input type=button value='Tambah User' class='btn btn-defalut' onclick=location.href='?module=user&act=tambahuser'>
                  <table id='example' class='table table-bordered table-striped'>
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nip</th>
                      <th>Nama Lengkap</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>";
                    $tampil=mysql_query("SELECT user.*,karyawan.* FROM user inner join
                      karyawan on user.nik=karyawan.nik ORDER BY id_user");
                    $no=1;
                    while ($r=mysql_fetch_array($tampil)){
              echo "<tbody><tr>
                      <td>$no</td>
                      <td>$r[nik]</td>
                      <td>$r[nama]</td>
                      <td>
                        <a href=?module=user&act=edituser&id=$r[id_user] data-toggle='tooltip' title='Edit Data'>
                        <button class='btn btn-primary' type='button'><span class='glyphicon glyphicon-edit'></span>
                        </button></a>
                        <a href=./aksi.php?module=user&act=hapus&id=$r[id_user] data-toggle='tooltip' title='Hapus Data'>
                        <button class='btn btn-danger' type='button' onClick='return confirm('Apakah Anda benar-benar mau menghapusnya?')'><span class='glyphicon glyphicon-trash'></span>
                        </button></a>
                      </td>
                    </tr>
                    </tbody>";
                      $no++;
                    }
            echo "</table>
              </div>
            </div>
          </div>
        </div>";
  break;

  case "tambahuser":
  echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Tambah Akun Karyawan</h3>
          </div>
          <div class='box-body'>
            <form method=POST action='./aksi.php?module=user&act=input'>
            <div class='row'>
              <div class='col-md-2'>NIP</div>
              <div class='col-md-3'>
                <input type=text name='nik' class='form-control'>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Password</div>
              <div class='col-md-3'>
                <input type=text name='password' class='form-control'>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Level</div>
              <div class='col-md-3'>
                <select name='level' class='form-control'>
                  <option value='atasan' checked>atasan</option>
                  <option value='karyawan'>karyawan</option>
                  <option value='admin'>admin</option>
                </select>
              </div>
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

  case "edituser":
  $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
  $r=mysql_fetch_array($edit);

  echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Edit Akun Karyawan</h3>
          </div>
          <div class='box-body'>
            <form method=POST action=./aksi.php?module=user&act=update>
              <input type=hidden name=id value='$r[id_user]'>
              <div class='row'>
                <div class='col-md-2'>Username</div>
                <div class='col-md-3'><input type=text name='nik' value='$r[nik]'></div>
              </div>
              <div class='row'>
                <div class='col-md-2'>Password</div>
                <div class='col-md-3'><input type=text name='password'> *)</div>
              </div>
              <div class='row'>
                <div class='col-md-2'>Level</div>
                <div class='col-md-3'>";
                if ($r['level']=='atasan'){
                  echo "\<input type=radio name='level' value='atasan' checked>atasan
                  <input type=radio name='level' value='karyawan'>karyawan
                  <input type=radio name='level' value='admin'>admin
                  ";
                }
                elseif ($r['level']=='karyawan'){
                  echo "<input type=radio name='level' value='atasan'>atasan
                  <input type=radio name='level' value='karyawan' checked>karyawan
                  <input type=radio name='level' value='admin'>admin
                  ";
                }
                else{
                  echo "<input type=radio name='level' value='atasan'>atasan
                  <input type=radio name='level' value='karyawan'>karyawan
                  <input type=radio name='level' value='admin' checked>admin";
                }
                echo "</div>
              </div>";
              echo"
              <div class='row'>
                <div class='col-md-2'></div>
                <div class='col-md-5'>*) Apabila password tidak diubah, dikosongkan saja.</div>
              </div>
              <div class='row'>
                <div class='col-md-2'></div>
                <div class='col-md-3'><input type=submit value=Update class='btn btn-defalut'>
                <input type=button value=Batal onclick=self.history.back() class='btn btn-defalut'></div>
              </div>
            </form>
          </div>
        </div>";
  break;
}
?>
