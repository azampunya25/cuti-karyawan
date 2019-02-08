<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SISTEM INFORMASI KEPEGAWAIAN</title>
<link rel="stylesheet" href="css/style.css" type="text/css"  />
<link rel="shortcut icon" href="images/logoKKP.ico" />

<script language="javascript">
function getkey(e)
{
if (window.event)
   return window.event.keyCode;
else if (e)
   return e.which;
else
   return null;
}
function goodchars(e, goods, field)
{
var key, keychar;
key = getkey(e);
if (key == null) return true;
 
keychar = String.fromCharCode(key);
keychar = keychar.toLowerCase();
goods = goods.toLowerCase();
 
// check goodkeys
if (goods.indexOf(keychar) != -1)
    return true;
// control keys
if ( key==null || key==0 || key==8 || key==9 || key==27 )
   return true;
    
if (key == 13) {
    var i;
    for (i = 0; i < field.form.elements.length; i++)
        if (field == field.form.elements[i])
            break;
    i = (i + 1) % field.form.elements.length;
    field.form.elements[i].focus();
    return false;
    };
// else return false
return false;
}
</script>
</head>

<body>
<div id="cont-pegawai">
<?php
include "../config/koneksi.php";
include "../config/fungsi_indotgl.php";
include "../config/class_paging.php";
//include "../config/kode_auto.php";
include "../config/fungsi_combobox.php";
//include "../config/fungsi_nip.php";

$aksi="modul/mod_pegawai/aksi_register.php";
echo "<h2 class='hd-r'>REGISTRASI PEGAWAI</h2>
	<form method=POST action='$aksi?module=pegawai&act=register' enctype='multipart/form-data enctype='multipart/form-data' class='f-r' >
	<table class='tabelform tabpad'>
	<tr>
	<td>Nip</td><td>:</td><td><input name='nip' type='text' placeholder='masukan NIP anda' onKeyPress=\"return goodchars(event,'0123456789',this)\" maxlength='18' required></td>
	</tr>
	<tr>
	<td>Password</td><td>:</td><td><input class='input' name='psl' type='password' required></td>
	</tr>
	<tr>
	<td>Nama Pegawai</td><td>:</td><td><input class='input' name='nama' type='text' required></td>
	</tr>
	<tr>
	<td>Jenis Kelamin</td><td>:</td><td><input name='jk' type='radio' value='P' />Pria <input name='jk' type='radio' value='W' / required>Wanita</td>
	</tr>
	<tr>
	<td>Status Kawin</td><td>:</td><td><input name='sk' type='radio' value='K' />Kawin <input name='sk' type='radio' value='TK' / required>Tidak Kawain</td>
	</tr>
	<tr>
	<td>Pendidikan</td><td>:</td><td><select name='pendidikan' required>
						<option required disabled value=0 selected>Pilih Pendidikan</option>
						<option value='SD'>SD</option>
						<option value='SMP'>SMP</option>
						<option value='SMA'>SMA</option>
						<option value='S1'>S1</option>
						<option value='S2'>S2</option>
						
		  </select> </td>
	</tr>
	<tr>
	<td>Alamat</td><td>:</td><td><textarea name='almt' cols='36' rows='5' required></textarea></td>
	</tr>
	<tr>
	<td>Tanggal Masuk</td><td>:</td><td>
	<select name='hm' required>
                <option required disabled value='none' selected='selected'>Tgl*</option>";
			for($h=1; $h<=31; $h++) 
			{ 
				echo"<option value=",$h,">",$h,"</option>";
			} 
	echo"</select>
	<select name='bm' required>
            	<option required disabled value='none' selected='selected'>Bulan*</option>
				<option value='1'>Januari</option>
				<option value='2'>Februari</option>
				<option value='3'>Maret</option>
				<option value='4'>April</option>
				<option value='5'>Mei</option>
				<option value='6'>Juni</option>
				<option value='7'>Juli</option>
				<option value='8'>Agustus</option>
				<option value='9'>September</option>
				<option value='10'>Oktober</option>
				<option value='11'>November</option>
				<option value='12'>Desember</option>
			</select>
	<select name='tm' required>
            <option required disabled value='none' selected='selected'>Tahun*</option>";
			$now =  date("Y");
			$saiki = 2000;
			for($l=$saiki; $l<=$now; $l++)
			{
				echo"<option value=",$l,">",$l,"</option>";
			}	
	echo "</select>
	</td>
	</tr>
	
	<tr>
	<td>Jabatan</td><td>:</td><td><select name='jabatan' required>
	<option required disabled value='' selected >Pilih Jabatan</option>";
		$jab=mysql_query("select * from jabatan");
		while($j=mysql_fetch_array($jab)){
		echo "<option value='$j[id_jabatan]'>$j[nm_jabatan]</option>";
		}
	echo "</select></td>
	</tr>
	
	<tr>
	<td>Golongan</td><td>:</td><td><select name='golongan' required>	
	<option required disabled value='' selected>Pilih Golongan</option>";
		$jab=mysql_query("select * from golongan");
		while($j=mysql_fetch_array($jab)){
		echo "<option value=$j[id_gol]>$j[nm_gol] | $j[ruang] | $j[nm_pangkat]</option>";
		}
	echo "</select></td>
	</tr>
	<tr>
	<td>NIP Atasan</td><td>:</td><td><input class='input' name='nipatasan' type='text' maxlength='18' onKeyPress=\"return goodchars(event,'0123456789',this)\" required></td>
	</tr>
	<tr>
	<td>Foto</td><td>:</td><td><input name='fupload' type='file' /required></td>
	</tr>
	<tr>
	<td></td><td></td><td><input type=submit value=Simpan>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>
	"; ?>
</div>
</body>
</html>
