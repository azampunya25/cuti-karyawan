    <link rel="stylesheet" href="jq/development-bundle/themes/base/jquery.ui.all.css">
    <script src="jq/js/jquery-1.7.1.min.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.core.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.widget.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <!--<link rel="stylesheet" href="jq/development-bundle/demos/demos.css">-->
    <script>
    $(function() {

        $( "#tgl" ).datepicker({ altFormat: 'yy-mm-dd' });
        $( "#tgl" ).change(function() {
             $( "#tgl" ).datepicker( "option", "dateFormat","yy-mm-dd" );
         });

   });
    </script>



<?php
switch($_GET[act]){
  // Tampil Karyawan
  default:
    echo "<h2>Karyawan</h2>
          <input type=button value='Tambah Karyawan' onclick=location.href='?module=karyawan&act=tambahkaryawan'>
          <table>
          <tr><th>no</th><th>nip</th><th>nama</th><th>kd_jabatan</th>
          <th>alamat tinggal</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM karyawan ORDER BY nik");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td><a href='?module=karyawan&act=editkaryawan&id=$r[id_karyawan]'>$r[nik]</a></td>
             <td>$r[nama]</td>
             <td>$r[kd_jabatan]</td>
             <td>$r[alamat_tinggal]</td>
             <td><a href=./aksi.php?module=karyawan&act=hapus&id=$r[id_karyawan]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;

  case "editkaryawan":
     echo "<h2>Detail Karyawan</h2>";
     echo"<table>
     <form method=POST action=./aksi.php?module=karyawan&act=update>";

     $tampil=mysql_query("SELECT * FROM karyawan WHERE id_karyawan='$_GET[id]'");
     $r=mysql_fetch_array($tampil);
     echo"<tr><th>Nip</th><td><input type='text' name='nik' value='$r[nik]'></td></tr>
          <tr><th>Nama</th><td><input type='text' name='nama' value='$r[nama]'></td></tr>
          <tr><th>Kd Jabatan</th><td><select name='kd_jabatan'>";
          $res=mysql_query("select * from jabatan");
                           	//if(mysql_num_rows($res)==0) echo "tidak ada data..";
							//	else
								for($i=0;$i<mysql_num_rows($res);$i++) {
								$row=mysql_fetch_assoc($res);
                                if ($row[kd_jabatan]==$r[kd_jabatan]) echo "<option value=$r[kd_jabatan] selected>$r[kd_jabatan]</option>";
								else{
							       echo"<option value=$row[kd_jabatan]>$row[kd_jabatan]</option>";
								}
							  }
      echo"</select></td></tr>
          <tr><th>Kelamin</th>";
          if ($r[kelamin]=='P'){          	echo"<td><input type='radio' name='kelamin' value='P' checked>Pria
          	         <input type='radio' name='kelamin' value='W'>Wanita</td></tr>";
          }
          else{
          echo"<td><input type='radio' name='kelamin' value='P'>Pria
          	       <input type='radio' name='kelamin' value='W' checked>Wanita</td></tr>";
          }
     echo"<tr><th>Status Kawin</th>";
          if ($r[status_kawin]=='TK'){          echo"<td><input type='radio' name='status_kawin' value='TK' checked>Tidak Kawin
               <input type='radio' name='status_kawin' value='K'>Kawin</td></tr>";
          }
          else{          echo"<td><input type='radio' name='status_kawin' value='TK'>Tidak Kawin
               <input type='radio' name='status_kawin' value='K' checked>Kawin</td></tr>";
          }
     echo"<tr><th>Pendidikan</th><td><select name='pendidikan'>";
         if ($r[pendidikan]=='SD'){          	 echo"<option value='SD' selected>SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";            }
         elseif ($r[pendidikan]=='SMP'){       	 	 echo"<option value='SD'>SD</option>";
             echo"<option value='SMP' selected>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}

         elseif ($r[pendidikan]=='SMA'){       	 	 echo"<option value='SD'>SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA' selected>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}

         elseif ($r[pendidikan]=='D1'){       	 	 echo"<option value='SD' >SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1' selected>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}

         elseif ($r[pendidikan]=='D3'){         	 echo"<option value='SD' >SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3' selected>D3</option>";
             echo"<option value='S1'>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}


         elseif ($r[pendidikan]=='S1'){         	echo"<option value='SD' >SD</option>";
             echo"<option value='SMP'>SMP</option>";
             echo"<option value='SMA'>SMA</option>";
             echo"<option value='D1'>D1</option>";
             echo"<option value='D3'>D3</option>";
             echo"<option value='S1' selected>S1</option>";
             echo"<option value='S2'>S2</option>";
             echo"<option value='S3'>S3</option>";
           	}

         elseif ($r[pendidikan]=='S2'){          	 echo"<option value='SD' >SD</option>";
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
        if ($r[status_upah]=='harian'){        	echo"<option value='harian' selected>harian</option>";
        	echo"<option value='mingguan'>mingguan</option>";
        	echo"<option value='bulanan'>bulanan</option>";        	}
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
       if ($r[status_karyawan]=='aktif'){       	   echo"<option value='aktif' selected>aktif</option>";
       	   echo"<option value='tidak aktif'>tidak aktif</option>";
       	   echo"<option value='cuti'>cuti</option>";       	}
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
    echo "<h2>Tambah Karyawan</h2>
          <form method=POST action='./aksi.php?module=karyawan&act=input'>
          <table>
          <tr><td>NIP</td>         <td> : <input type=text name='nik'></td></tr>
          <tr><td>Nama</td>        <td> : <input type=text name='nama'></td></tr>
          <tr><td>Kode jabatan</td><td> : <select name='kd_jabatan'>";
          $kdjab=mysql_query("SELECT * FROM jabatan");
          while ($d=mysql_fetch_array($kdjab)){          	echo "<option value=$d[kd_jabatan]>$d[kd_jabatan]-$d[nm_jabatan]</option>";          }
          echo "</select></td></tr>
          <tr><td>Kelamin</td>    <td> : <input type='radio' name='kelamin' value='P' checked>Pria
                                         <input type='radio' name='kelamin' value='W'>Wanita
                                         </td></tr>
          <tr><td>Status Kawin</td><td> : <input type='radio' name='status_kawin' value='TK' checked>Tidak Kawin
                                          <input type='radio' name='status_kawin' value='K'>Kawin
                                          </td></tr>
          <tr><td>Pendidikan</td>  <td> : <select name='pendidikan'>
                                          <option value='SD' checked>SD</option>
                                          <option value='SMP'>SMP</option>
                                          <option value='SMA'>SMA</option>
                                          <option value='D1'>D1</option>
                                          <option value='D3'>D3</option>
                                          <option value='S1'>S1</option>
                                          <option value='S2'>S2</option>
                                          <option value='S3'>S3</option>
                                          </select></td></tr>
          <tr><td>Alamat Tinggal</td><td> : <input type='text' name='alamat_tinggal' size='75'></td></tr>
          <tr><td>Alamat Asal</td><td> : <input type='text' name='alamat_asal' size='75'></td></tr>
          <tr><td>Tanggal Masuk</td><td> : <input type='text' name='tgl_masuk' id='tgl'>
                                           klik kotak teks disamping untuk menampilkan tanggal</td></tr>
          <tr><td>Status Upah</td><td> : <select name='status_upah'>
                                        <option value='harian' checked>harian</option>
                                        <option value='mingguan'>mingguan</option>
                                        <option value='bulanan'>bulanan</option>
                                        </select></td></tr>
          <tr><td>Status Karyawan</td><td> : <select name='status_karyawan'>
                                        <option value='aktif' checked>aktif</option>
                                        <option value='tidak aktif'>tidak aktif</option>
                                        <option value='cuti'>cuti</option>
                                        </select></td></tr>
          <tr><td>Atasan</td><td> : <input type='text' name='atasan'></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br>";
  break;

  /*case "editkaryawan":
   $edit=mysql_query("SELECT * FROM karyawan WHERE id_jabatan='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Jabatan</h2>
          <form method=POST action=./aksi.php?module=jabatan&act=update>
          <input type=hidden name=id value='$r[id_jabatan]'>
          <table>
          <tr><td>Kode</td>           <td> : <input type=text name='kd_jabatan' value='$r[kd_jabatan]'></td></tr>
          <tr><td>Nama Jabatan</td>   <td> : <input type=text name='nm_jabatan' value='$r[nm_jabatan]'></td></tr>
          <tr><td>Keterangan</td>     <td> : <textarea name='keterangan' cols='25' rows='3'>$r[keterangan]</textarea></td></tr>
                                                                                                                                                                        <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
          echo $_GET[id];
          echo $_GET[act];
    break;                 */
}
?>
