<?php
switch(isset($_GET['act'])){
  // Tampil Karyawan
  default:
    echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Karyawan</h3>
          </div>
          <div class='box-body'>
            <div class='row'>
              <div class='col-md-12'>
                <input type=button value='Tambah Karyawan' class='btn btn-defalut' onclick=location.href='?module=karyawan&act=tambahkaryawan'>
                <table id='example' class='table table-bordered table-striped'>
                <tr>
                  <th>No</th>
                  <th>NIP</th>
                  <th>Nama</th>
                  <th>Kode Jabatan</th>
                  <th>Alamat Tinggal</th>
                  <th>Aksi</th>
                </tr>";
                $tampil=mysqli_query($mysqli, "SELECT * FROM karyawan ORDER BY nik");
                $no=1;
                while ($r=mysqli_fetch_array($tampil)){
          echo "<tr><td>$no</td>
                  <td><a href='?module=karyawan&act=editkaryawan&id=$r[id_karyawan]'>$r[nik]</a></td>
                  <td>$r[nama]</td>
                  <td>$r[kd_jabatan]</td>
                  <td>$r[alamat_tinggal]</td>
                  <td>
                    <a href=./aksi.php?module=karyawan&act=hapus&id=$r[id_karyawan] data-toggle='tooltip' title='Hapus Data'>
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
        </div>
          ";
    break;

  case "editkaryawan":
     echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Detail Karyawan</h3>
          </div>
          <div class='box-body'>
            <div class='row'>
            </div>
          </div>
        </div>
     <h2>Detail Karyawan</h2>";
     echo"<table>
     <form method=POST action=./aksi.php?module=karyawan&act=update>";

     $tampil=mysqli_query($mysqli, "SELECT * FROM karyawan WHERE id_karyawan='$_GET[id]'");
     $r=mysqli_fetch_array($tampil);
     echo"<tr><th>Nip</th><td><input type='text' name='nik' value='$r[nik]'></td></tr>
          <tr><th>Nama</th><td><input type='text' name='nama' value='$r[nama]'></td></tr>
          <tr><th>Kd Jabatan</th><td><select name='kd_jabatan'>";
          $res=mysqli_query($mysqli, "select * from jabatan");
                           	//if(mysqli_num_rows($res)==0) echo "tidak ada data..";
							//	else
								for($i=0;$i<mysqli_num_rows($res);$i++) {
								$row=mysqli_fetch_assoc($res);
                                if ($row['kd_jabatan']==$r['kd_jabatan']) echo "<option value=$r[kd_jabatan] selected>$r[kd_jabatan]</option>";
								else{
							       echo"<option value=$row[kd_jabatan]>$row[kd_jabatan]</option>";
								}
							  }
      echo"</select></td></tr>
          <tr><th>Kelamin</th>";
          if ($r[kelamin]=='P'){
          	echo"<td><input type='radio' name='kelamin' value='P' checked>Pria
          	         <input type='radio' name='kelamin' value='W'>Wanita</td></tr>";
          }
          else{
          echo"<td><input type='radio' name='kelamin' value='P'>Pria
          	       <input type='radio' name='kelamin' value='W' checked>Wanita</td></tr>";
          }
     echo"<tr><th>Status Kawin</th>";
          if ($r[status_kawin]=='TK'){
          echo"<td><input type='radio' name='status_kawin' value='TK' checked>Tidak Kawin
               <input type='radio' name='status_kawin' value='K'>Kawin</td></tr>";
          }
          else{
          echo"<td><input type='radio' name='status_kawin' value='TK'>Tidak Kawin
               <input type='radio' name='status_kawin' value='K' checked>Kawin</td></tr>";
          }
     echo"<tr><th>Pendidikan</th><td><select name='pendidikan'>";
         if ($r[pendidikan]=='SD'){
          	 echo"<option value='SD' selected>SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
            }

         elseif ($r[pendidikan]=='SMP'){
       	 	 echo"<option value='SD'>SD</option>";
             echo"<option value='SMP' selected>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}

         elseif ($r[pendidikan]=='SMA'){
       	 	 echo"<option value='SD'>SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA' selected>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}

         elseif ($r[pendidikan]=='D1'){
       	 	 echo"<option value='SD' >SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1' selected>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}

         elseif ($r[pendidikan]=='D3'){
         	 echo"<option value='SD' >SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3' selected>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}


         elseif ($r[pendidikan]=='S1'){
         	echo"<option value='SD' >SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1' selected>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}

         elseif ($r[pendidikan]=='S2'){
          	 echo"<option value='SD' >SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2' selected>S2</option>";
             echo"<option value='S3'>S3</option>";
         	}

 		elseif ($r[pendidikan]=='S3'){
          	 echo"<option value='SD' >SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3' selected>S3</option>";
         	}
       echo"</select></td></tr>";
       echo"<tr><th>Alamat Tinggal</th><td><input type='text' name='alamat_tinggal' value='$r[alamat_tinggal]' size='75'></td></tr>
          <tr><th>Alamat Asal</th><td><input type='text' name='alamat_asal' value='$r[alamat_asal]' size='75'></td></tr>
          <tr><th>Tgl Masuk</th><td><input type='text' name='tgl_masuk' value='$r[tgl_masuk]' id='tgl'></td></tr>
          <tr><th>Status Upah</th><td><select name='status_upah'>";
        if ($r[status_upah]=='harian'){
        	echo"<option value='harian' selected>harian</option>";
        	echo"<option value='mingguan'>mingguan</option>";
        	echo"<option value='bulanan'>bulanan</option>";
        	}
        elseif ($r[status_upah]=='mingguan'){
        	echo"<option value='harian'>harian</option>";
        	echo"<option value='mingguan' selected>mingguan</option>";
        	echo"<option value='bulanan'>bulanan</option>";
        	}
        elseif ($r[status_upah]=='bulanan'){
        	echo"<option value='harian'>harian</option>";
        	echo"<option value='mingguan'>mingguan</option>";
        	echo"<option value='bulanan' selected>bulanan</option>";
        	}
       echo"</select></td></tr>
          <tr><th>Status Karyawan</th><td><select name='status_karyawan'>";
       if ($r[status_karyawan]=='aktif'){
       	   echo"<option value='aktif' selected>aktif</option>";
       	   echo"<option value='tidak aktif'>tidak aktif</option>";
       	   echo"<option value='cuti'>cuti</option>";
       	}
       elseif ($r[status_karyawan]=='tidak aktif'){
       	   echo"<option value='aktif'>aktif</option>";
       	   echo"<option value='tidak aktif' selected>tidak aktif</option>";
       	   echo"<option value='cuti'>cuti</option>";
       	}
       elseif ($r[status_karyawan]=='cuti'){
       	   echo"<option value='aktif'>aktif</option>";
       	   echo"<option value='tidak aktif'>tidak aktif</option>";
       	   echo"<option value='cuti' selected>cuti</option>";
       	}
      echo"</selected></td></tr>

           <tr><th>Atasan</th><td>  <input type='text' name='atasan' value=$r[nik_atasan]></td></tr>
          <tr><td>
          <input type=hidden name=id value='$r[id_karyawan]'>
          <input type=button value=Batal onclick=self.history.back()>
          <input type='submit' value='Ubah'>
          </td></tr>";

     echo"</table></form>";
  break;

  case "tambahkaryawan":
    echo "
        <div class='box box-default'>
          <div class='box-header with-border'>
            <h3 class='box-title'>Tambah Karyawan</h3>
          </div>
          <div class='box-body'>
          <form method=POST action='./aksi.php?module=karyawan&act=input'>
            <div class='row'>
              <div class='col-md-2'>NIP</div>
              <div class='col-md-2'><input type=text name='nik' class='form-control'></div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Nama</div>
              <div class='col-md-2'><input type=text name='nama' class='form-control'></div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Kode Jabatan</div>
              <div class='col-md-2'>
                <select name='kd_jabatan' class='form-control'>";
                  $kdjab=mysqli_query($mysqli, "SELECT * FROM jabatan");
                  while ($d=mysql_fetch_array($kdjab)){
                    echo "<option value=$d[kd_jabatan]>$d[kd_jabatan]-$d[nm_jabatan]</option>";
                  }
                  echo "</select>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Kelamin</div>
              <div class='col-md-2'>
                <input type='radio' name='kelamin' value='P' checked>Pria
                <input type='radio' name='kelamin' value='W'>Wanita
              </div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Status Kawin</div>
              <div class='col-md-2'>
                <input type='radio' name='status_kawin' value='TK' checked>Tidak Kawin
                <input type='radio' name='status_kawin' value='K'>Kawin</div>
              </div>
            <div class='row'>
              <div class='col-md-2'>Pendidikan</div>
              <div class='col-md-2'>
                <select name='pendidikan' class='form-control'>
                  <option value='SD' checked>SD</option>
                  <option value='SMP'>SMP</option>
                  <option value='SMA'>SMA</option>
                  <option value='D1'>D1</option>
                  <option value='D3'>D3</option>
                  <option value='S1'>S1</option>
                  <option value='S2'>S2</option>
                  <option value='S3'>S3</option>
                </select>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Alamat Tinggal</div>
              <div class='col-md-2'><input type='text' name='alamat_tinggal' size='75' class='form-control'></div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Tanggal Masuk</div>
              <div class='col-md-2'><input type='text' name='tgl_masuk' id='tgl' class='form-control'>
                                           klik kotak teks disamping untuk menampilkan tanggal</div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Status Upah</div>
              <div class='col-md-2'>
                <select name='status_upah' class='form-control'>
                  <option value='harian' checked>harian</option>
                  <option value='mingguan'>mingguan</option>
                  <option value='bulanan'>bulanan</option>
                </select>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Status Karyawan</div>
              <div class='col-md-2'>
                <select name='status_karyawan' class='form-control'>
                  <option value='aktif' checked>aktif</option>
                  <option value='tidak aktif'>tidak aktif</option>
                  <option value='cuti'>cuti</option>
                </select>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-2'>Atasan</div>
              <div class='col-md-2'>
                <input type='text' name='atasan' class='form-control'>
              </div>
            </div>
            <div class='row'>
              <div class='col-md-2'></div>
              <div class='col-md-2'>
                <input type=submit value=Simpan class='btn btn-defalut'>
                <input type=button value=Batal onclick=self.history.back() class='btn btn-defalut'>
              </div>
            </div>  
          </div>
        </div>
          
          </form>";
  break;
}
?>
