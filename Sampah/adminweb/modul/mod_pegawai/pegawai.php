<script language="javascript">
function validasi(form){
  if (form.nip.value == ""){
    alert("Anda belum mengisikan nip...!!");
    form.nip.focus();
    return (false);
  }
  if (form.nama.value == ""){
    alert("Anda belum mengisikan nama...!!");
    form.nama.focus();
    return (false);
  }
  if (form.id_jabatan.value == "0"){
    alert("Anda belum memilih Jabatan!");
    form.id_jabatan.focus();
    return (false);
  }
  if (form.id_gol.value == "0"){
    alert("Anda belum memilih Golongan!");
    form.id_gol.focus();
    return (false);
  }
    if (form.pendidikan.value == "0"){
    alert("Anda belum memilih Pendidikan!");
    form.pendidikan.focus();
    return (false);
  }
   if (form.almt_tinggal.value == ""){
    alert("Anda belum mengisi alamat!!");
    form.almt_tinggal.focus();
    return (false);
  }
   if (form.tgl_masuk.value == ""){
    alert("Anda belum mengisi alamat!!");
    form.tgl_masuk.focus();
    return (false);
  }
   if (form.status_pegawai.value == "0"){
    alert("Anda belum memilih status pegawai!");
    form.status_pegawai.focus();
    return (false);
  }
  
   if (form.nip_atasan.value == ""){
    alert("Anda belum mengisi nip atasan!");
    form.nip_atasan.focus();
    return (false);
  }
  return (true);
}
</script>

<SCRIPT TYPE="text/javascript">
<!--
// copyright 1999 Idocs, Inc. http://www.idocs.com
// Distribute this script freely but keep this notice in place
function numbersonly(myfield, e, dec)
{
var key;
var keychar;

if (window.event)
key = window.event.keyCode;
else if (e)
key = e.which;
else
return true;
keychar = String.fromCharCode(key);

// control keys
if ((key==null) || (key==0) || (key==8) ||
(key==9) || (key==13) || (key==27) )
return true;

// numbers
else if ((("0123456789").indexOf(keychar) > -1))
return true;

// decimal point jump
else if (dec && (keychar == "."))
{
myfield.form.elements[dec].focus();
return false;
}
else
return false;
}

//-->
</SCRIPT>
<?php
$aksi="modul/mod_pegawai/aksi_pegawai.php";
switch($_GET[act]){
  // Tampil Pegawai
  default:
    echo "<h2>Pegawai</h2>
          <input type=button value='Tambah Pegawai' onclick=location.href='?module=pegawai&act=tambahpegawai'>
          <br/>
          <table   id='jabatan' class='list display' cellspacing='0' width='100%'>
		  <thead>
          <tr>
		  <th>No</th>
		  <th>NIP</th>
          <th>Nama Pegawai</th>
          <th>Kelamin</th>
		  <th>Alamat</th>
		  <th>Status</th>
		  <th>Detail</th>
          <th>Aksi</th>
		  </tr></thead>
		  <tbody>";
		  
    $tampil=mysql_query("SELECT * FROM pegawai ORDER BY nip DESC");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center'>$no</td>
				<td>$r[nip]</td>
                <td>$r[nama]</td>
                <td class='center'>$r[kelamin]</td>
				<td>$r[almt_tinggal]</td>
				<td class='center'>$r[status_pegawai]</td>
				<td class='center'><a href='?module=pegawai&act=pegawaidetail&id=$r[nip]'>Detail</td>
                <td class='center'><a href=?module=pegawai&act=editpegawai&id=$r[nip]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href='$aksi?module=pegawai&act=hapus&id=$r[nip]&namafile=$r[gambar]' onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
    $no++;
    }
    echo "</tbody></table>";

    echo "<div class=>$linkHalaman</div><br>";
 
    break;
  
  case "tambahpegawai":
      echo "<h2>Tambah Pegawai</h2>
          <form method=POST action='$aksi?module=pegawai&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td class='left'>NIP</td>				<td class='left'> : <input type=text name='nip' size=20 onKeyPress='return numbersonly(this, event)' required></td></tr>
		  <tr><td class='left'>Password</td>			<td class='left'> : <input type=text name='pass' required></td></tr>
		  <tr><td class='left'>Nama</td>			<td class='left'> : <input type=text name='nama' size=60 required></td></tr>
		  <tr><td class='left'>Jabatan</td><td class='left'> : 
				<select name='id_jabatan' required>
				<option required disabled value=0 selected>- Pilih Jabatan -</option>";
				$tampil=mysql_query("SELECT * FROM jabatan ORDER BY id_jabatan");
				while($r=mysql_fetch_array($tampil)){
					echo "<option value=$r[id_jabatan]>$r[nm_jabatan]</option>";
				}
    echo "</select></td></tr>
			  <tr><td class='left'>Golongan</td><td class='left'> : 
				<select name='id_gol' required>
				<option required disabled value=0 selected>- Pilih Golongan -</option>";
				$tampil=mysql_query("SELECT * FROM golongan ORDER BY id_gol");
				while($r=mysql_fetch_array($tampil)){
					echo "<option value=$r[id_gol]>$r[nm_gol] | $r[ruang] | $r[nm_pangkat]</option>";
				}
	echo "</select></td></tr>
		  <tr><td class='left'>Kelamin</td>			<td> : 	<input type=radio name='kelamin' value='P' checked>Pria  
															<input type=radio name='kelamin' value='W'> Wanita</td></tr>
		  <tr><td class='left'>Status Kawin</td>	<td> : 	<input type=radio name='status_kawin' value='TK' checked>Tidak Kawin  
															<input type=radio name='status_kawin' value='K'> Kawin</td></tr>
		  <tr><td>Pendidikan</td><td> : 
		  <select name='pendidikan' required>
						<option required disabled value=0 selected>Pilih Pendidikan</option>
						<option value='SD'>SD</option>
						<option value='SMP'>SMP</option>
						<option value='SMA'>SMA</option>
						<option value='S1'>S1</option>
						<option value='S2'>S2</option>
						
		  </select> 
		  <tr><td>Alamat Tinggal</td>	<td class='left'> : <textarea name='almt_tinggal' style='width: 200; height: 50;' required></textarea></td></tr>
		  <tr><td class='left'>Tgl Masuk</td>		<td class='left'> : <input type=text name='tgl_masuk' id='pegawaix' required></td></tr>
		  <tr><td>Status Pegawai</td><td> : 
		  <select name='status_pegawai' required>
						<option required disabled value=0 selected>Pilih Status</option>
						<option value='Aktif'>Aktif</option>
						<option value='Cuti'>Cuti</option>
						<option value='Tidak Aktif'>Tidak Aktif</option>
		  </select>
		  <tr><td class='left'>NIP Atasan</td>			<td class='left'> : <input type=text name='nip_atasan' size=30 size=20 onKeyPress='return numbersonly(this, event)' required></td></tr>
          <tr><td class='left'>Gambar</td><td class='left'> : <input type=file name='fupload' size=40 required></td></tr>
          <tr><td colspan=2 'left'><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
     break;
    
   case "editpegawai":
   	 $tampil=mysql_query("SELECT * FROM pegawai WHERE nip='$_GET[id]'");
     $r=mysql_fetch_array($tampil);
     echo "<h2>Ubah Pegawai</h2>
	 <table class='list'><tbody>
	 <form method=POST enctype='multipart/form-data' action=$aksi?module=pegawai&act=update enctype='multipart/form-data' onSubmit='return validasi(this)'>
     <input type=hidden name=id value=$r[nip]>
     <tr><td class='left' width='100'>Nip</td><td class='left'> : <input type='text' name='nip' value='$r[nip]' size=20 required></td></tr>
          <tr><td class='left'>Nama</td><td class='left'> : <input type='text' name='nama' value='$r[nama]' required></td></tr>
          <tr><td>Jabatan</td>  <td> : <select name='id_jabatan' required>";
				$tampil=mysql_query("SELECT * FROM jabatan ORDER BY nm_jabatan");
					if ($r[id_jabatan]==0){
						echo "<option required disabled value=0 selected>- Pilih Jabatan -</option>";
						echo "<option required disabled value=0 selected>- - -</option>";
					}   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_jabatan]==$w[id_jabatan]){
              echo "<option value=$w[id_jabatan] selected>$w[nm_jabatan]</option>";
            }
            else{
              echo "<option value=$w[id_jabatan]>$w[nm_jabatan]</option>";
            }
          }
    echo"</select></td></tr>
	            <tr><td>Golongan</td>  <td> : <select name='id_gol' required>";
				$tampil=mysql_query("SELECT * FROM golongan ORDER BY nm_gol");
					if ($r[id_gol]==0){
						echo "<option required disabled value=0 selected>- Pilih Golongan -</option>";
					}   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_gol]==$w[id_gol]){
              echo "<option value=$w[id_gol] selected>$w[nm_gol]</option>";
            }
            else{
              echo "<option value=$w[id_gol]>$w[nm_gol]</option>";
            }
          }
	echo"</select></td></tr>
          <tr><td class='left'>Kelamin</td>";
          if ($r[kelamin]=='P'){
          	echo"<td><input type='radio' name='kelamin' value='P' checked>Pria
          	         <input type='radio' name='kelamin' value='W'>Wanita</td></tr>";
          }
          else{
          echo"<td><input type='radio' name='kelamin' value='P'>Pria
          	       <input type='radio' name='kelamin' value='W' checked>Wanita</td></tr>";
          }
     echo"<tr><td class='left'>Status Kawin</td>";
          if ($r[status_kawin]=='TK'){
          echo"<td><input type='radio' name='status_kawin' value='TK' checked>Tidak Kawin
               <input type='radio' name='status_kawin' value='K'>Kawin</td></tr>";
          }
          else{
          echo"<td><input type='radio' name='status_kawin' value='TK'>Tidak Kawin
               <input type='radio' name='status_kawin' value='K' checked>Kawin</td></tr>";
          }
     echo"<tr><td class='left'>Pendidikan</td><td class='left'> : <select name='pendidikan'>";
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
       echo"<tr><td class='left'>ALamat Tinggal</td><td class='left'> : <input type='text' name='almt_tinggal' value='$r[almt_tinggal]' required></td></tr>
          <tr><td class='left'>Tgl Masuk</th><td class='left'> : <input type='text' name='tgl_masuk' id='pegawaix' value='$r[tgl_masuk]' id='tgl' required></td></tr>
          <tr><td class='left'>Status Pegawai</th><td class='left'> : <select name='status_pegawai'>";
       if ($r[status_pegawai]=='aktif'){
       	   echo"<option value='AKTIF' selected>aktif</option>";
       	   echo"<option value='TIDAK AKTIF'>tidak aktif</option>";
       	   echo"<option value='CUTI'>cuti</option>";
       	}
       elseif ($r[status_pegawai]=='tidak aktif'){
       	   echo"<option value='AKTIF'>AKTIF</option>";
       	   echo"<option value='TIDAK AKTIF' selected>tidak aktif</option>";
       	   echo"<option value='CUTI'>cuti</option>";
       	}
       elseif ($r[status_pegawai]=='cuti'){
       	   echo"<option value='AKTIF'>aktif</option>";
       	   echo"<option value='TIDAK AKTIF'>tidak aktif</option>";
       	   echo"<option value='CUTI' selected>cuti</option>";
       	}
      echo"</selected></td></tr>
			<tr><td>Gambar</td>       <td> :  ";
          if ($r[gambar]==''){
			  echo "<img src='../foto/foto_pegawai/thumb_no_image.jpg' width='200' height='240' />";
		  } else {
              echo "<img src='../foto/foto_pegawai/kecil_$r[gambar]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
           <tr><td class='left'>Atasan</th><td class='left'> :  <input type='text' name='nip_atasan' value=$r[nip_atasan] required></td></tr>";
    echo  "<tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
							</tbody></table></form>";
  break;
  
	case "pegawaidetail":
    $edit = mysql_query("SELECT * FROM pegawai inner join jabatan on pegawai.id_jabatan=jabatan.id_jabatan WHERE nip='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Pegawai</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=pegawaiview&act=pegawaidetail>
          <input type=hidden name=id value=$r[nip]>
          <table class='list'><tbody>      
		  <tr>
			<td class='center'>Foto Pegawai</td>
			<td class='center' colspan='6'>Identitas Pegawai</td>
		  </tr>
          <tr>
			<td class='center' rowspan='7' width='200'> ";
		if ($r[gambar]==''){
			  echo "<img src='../foto/foto_pegawai/thumb_no_image.jpg' width='200' height='240' />";
		  } else {
              echo "<img src='../foto/foto_pegawai/kecil_$r[gambar]'>";  
          }
    echo "</td>
			<td class='left' width='100'>NIP</td>
			<td class='left' width='5'>:</td>
			<td class='left' width='120'>$r[nip]</td>
			<td class='left' width='100'>Alamat Tinggal</td>
			<td class='left' width='5'>:</td>
			<td class='left'>$r[almt_tinggal]</td>
		  </tr>
		  <tr>
			<td class='left'>Nama Pegawai</td>
			<td class='left'>:</td>
			<td class='left'>$r[nama]</td>
						<td class='left'>Tgl Masuk</td>
			<td class='left'>:</td>
			<td class='left'>".tgl_indo($r['tgl_masuk'])."</td>
		  </tr>
			<td class='left'>Jabatan</td>
			<td class='left'>:</td>
			<td class='left'>$r[nm_jabatan]</td>
						<td class='left'>Status Pegawai</td>
			<td class='left'>:</td>
			<td class='left'>$r[status_pegawai]</td>

		  </tr>
		  <tr>
			<td class='left'>Kelamin</td>
			<td class='left'>:</td>
			<td class='left'>";
		if($r['kelamin']=='P'){
			echo "Pria";
			} else {
			echo "Wanita";
			}	
		echo "</td>
			<td class='left' colspan='3' rowspan='3'>&nbsp</td>
		  </tr>
		  <tr>
			<td class='left'>Status Kawin</td>
			<td class='left'>:</td>
			<td class='left'>";
		if($r['status_kawin']=='TK'){
			echo "Tidak Kawin";
			} else {
			echo "Kawin";
			}	
		echo "</td>
			
		  </tr>
		  <tr>
			<td class='left'>Pendidikan</td>
			<td class='left'>:</td>
			<td class='left'>$r[pendidikan]</td>

		  </tr>
		  <tr>
			<td class='right' colspan='6'><input type=button value=Kembali onclick=self.history.back()></td>
		  </tr>
          </tbody></table></form>";

    break;  
}
?>
