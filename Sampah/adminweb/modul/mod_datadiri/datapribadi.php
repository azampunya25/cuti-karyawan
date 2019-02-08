<script language="javascript">
function validasi(form){
  if (form.pl.value == ""){
    alert("Anda belum mengisikan password lama...!!");
    form.pl.focus();
    return (false);
  }
    if (form.pb.value == ""){
    alert("Anda belum mengisikan password baru...!!");
    form.pb.focus();
    return (false);
  }
}
</script>
<?php
$aksi="modul/mod_users/aksi_users.php";
switch($_GET[act]){
  // Tampil Pegawai
  default:
    echo "<h2>Data Pribadi</h2>";
	//, DATE_FORMAT(tgl_masuk,'%d-%b-%Y') AS tgl_masuk FROM 
     $s=mysql_query("SELECT * FROM pegawai inner join jabatan on pegawai.id_jabatan=jabatan.id_jabatan where pegawai.nip='$_SESSION[namauser]'");
     $r=mysql_fetch_array($s);
     echo"<table class='list'><tbody>      
		  <tr>
			<td class='center'>Foto Pegawai</td>
			<td class='center' colspan='6'>Identitas Pegawai</td>
		  </tr>
          <tr>
			<td class='center' rowspan='7' width='200'><img src='../foto/foto_pegawai/kecil_$r[gambar]'></td>
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
			<td class='right' colspan='6'><a href=?module=datapribadi&act=pwd&id=$r[nip]><input type='submit' name='button' id='button' value='Edit Password'/><input type=button value=Kembali onclick=self.history.back()></td>
		  </tr>
          </tbody></table></form>";
    break; 
		
	case "pwd":
	echo "<h2>Ganti Password</h2>
	<form action='$aksi?module=user&act=pwd' method='post' enctype='multipart/form-data' onSubmit='return validasi(this)' >
	<table class='tabelform tabpad'>
	<tr>
	<td></td><td></td><td><input name='nip' type='hidden' value='$_GET[id]' readonly>
	</td>
	</tr>
	<tr>
	<td>Password Lama</td><td>:</td><td><input class='input' name='pl' type='password' required><span> </span></td>
	</tr>
	<tr>
	<td>Password Baru</td><td>:</td><td><input class='input' name='pb' type='text' required><span> </span></td>
	</tr>
	<td></td><td></td><td><input type=submit value=Simpan>
	<input type=button value=Batal onclick=self.history.back()>
	</td>
	</tr>
	</table>
	</form>
	";
	break;
}
//http://disdikhss.net/subag-umum-dan-kepegawaian/
//https://baguspramujo.wordpress.com/2008/04/21/persyaratan-persyaratan-kepegawaian-pns-dari-bkn/
?>

