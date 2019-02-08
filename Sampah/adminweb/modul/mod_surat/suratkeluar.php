<script language="javascript">
function validasi(form){
  if (form.tgl_surat.value == ""){
    alert("Anda belum mengisi tanggal surat...!!");
    form.tgl_surat.focus();
    return (false);
  }
  if (form.bagian.value == "0"){
    alert("Anda belum mengisikan pengirim surat...!!");
    form.bagian.focus();
    return (false);
  }
  if (form.tujuan.value == ""){
    alert("Anda belum mengisikan tujuan...!!");
    form.tujuan.focus();
	return (false);
  }
  if (form.perihal.value == ""){
    alert("Anda belum mengisikan perihal surat...!!");
    form.perihal.focus();
    return (false);
  }
  if (form.fupload.value == ""){
    alert("Anda belum memasukan upload...!!");
    form.fupload.focus();
    return (false);
  }
}
</script>

<script type="text/javascript">    
<?php echo $jsArray; ?>  
function changeValue(id){  
document.getElementById('prd_name').value = prdName[id].name;   
};  
</script> 

<?php    
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}

$aksi="modul/mod_surat/aksi_suratkeluar.php";
switch($_GET[act]){
  // Tampil SuratKeluar
  default:
    echo "<h2>Surat Keluar</h2>
	<input type=button value='Tambah Surat' onclick=location.href='?module=suratkeluar&act=tambahsurat'>
		<table id='suratkeluar' class='list display' cellspacing='0' width='100%'><thead>  
          <tr><th>No</th>
          <th>No Surat</th>
		  <th>Tgl Surat</th>
		  <th>Pengirim</th>
          <th>Tujuan</th>
		  <th>Perihal</th>
		  <th>File</th>
          <th>Aksi</th>
          </tr></thead>";

      $tampil = mysql_query("SELECT * FROM suratkeluar INNER JOIN bagian
    ON suratkeluar.id_bagian=bagian.id_bagian ORDER BY tgl_surat DESC");

    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center' width='25'>$no</td>
                <td class='center'>$r[s_no_sk]$r[no_sk]</td>
				<td class='center'>".tgl_indo($r['tgl_surat'])."</td>
				<td class='left'>$r[nm_bagian]</td>
				<td class='left'>$r[tujuan]</td>
                <td class='left'>$r[perihal]</td>
				<td class='center'><a href='?module=suratkeluar&act=detail&id=$r[id_sk]'>Detail</a></span></td></td>
		            <td class='center' width='85'><a href=?module=suratkeluar&act=editsuratkeluar&id=$r[id_sk]><img src='images/edit.png' border='0' title='edit' /></a>
		                <a href=\"$aksi?module=suratkeluar&act=hapus&id=$r[id_sk]&namafile=$r[gambar]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
echo "<div class=> $linkHalaman</div><br>";
    break;
  
  case "tambahsurat":
  	$sql ="SELECT max(no_sk) as terakhir from suratkeluar"; 
	$tgl = date('Y');
	$hasil = mysql_query($sql);
	$data2 = mysql_fetch_array($hasil);
	$lastID = $data2['terakhir'];
	$lastNoUrut = substr($lastID, 1,16);
	$nextNoUrut = $lastNoUrut + 1;
	$nextID = ".".sprintf($nextNoUrut);
	//."/".$tgl.".K"
	//$no_surat = "145/".$no_urut."/KEL-MTG/".$bln_skg."/".$thn_sekarang;
    echo "<h2>Tambah Surat</h2>
          <form id='selecttest' method=POST action='$aksi?module=suratkeluar&act=input'  enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td width=70>No Surat</td><td> 	: <select name='id_unit'>";
			$tampil=mysql_query("SELECT * FROM unitkerja ORDER BY id_unit");
				while($w=mysql_fetch_array($tampil)){
					if ($r[id_unit]==$w[id_unit]){
					echo "<option value=$w[id_unit] selected>$w[id_unit]</option>";
				}
					else{
					echo "<option value=$w[id_unit]>$w[id_unit]</option>";
				}
			}
		echo"</select><select name='id_bagian'>";
			$tampil=mysql_query("SELECT * FROM bagian ORDER BY id_bagian");
				while($w=mysql_fetch_array($tampil)){
					if ($r[id_bagian]==$w[id_bagian]){
					echo "<option value=$w[id_bagian] selected>$w[id_bagian]</option>";
					}
				else{
					echo "<option value=$w[id_bagian]>$w[id_bagian]</option>";
				}
			}
		echo"</select>
		<input type=hidden name=id_miring value='/'><input type=text name='id_nomor' value='$nextID' size= 3 readonly>
		<input type=text name='id_thn' value='/$tgl.K' size=4 readonly></td></tr>
		  <tr><td width=70>Tgl Surat</td><td> 	: <input type='text' id='tanggal' name='tgl_surat'></td></tr>
		  <tr><td class='left'>Pengirim</td><td class='left'> : 
				<select name='bagian' required>
				<option selected required disabled value=0 selected>- Pilih -</option>";
				$tampil=mysql_query("SELECT * FROM bagian ORDER BY id_bagian");
				while($r=mysql_fetch_array($tampil)){
					echo "<option value=$r[id_bagian]>$r[nm_bagian]</option>";
				}
	echo "</select></td></tr>
		  <tr><td width=70>Tujuan</td><td> 		: <input type=text name='tujuan' size=60 required></td></tr>
		  <tr><td width=70>Perihal</td><td> 	: <input type=text name='perihal' size=60 required></td></tr>
          <tr><td>Gambar</td><td> 				: <input type=file name='fupload' required> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>";
    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Data Surat ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
     break;
    
    
  case "editsuratkeluar":
      $edit = mysql_query("SELECT * FROM suratkeluar INNER JOIN bagian
    ON suratkeluar.id_bagian=bagian.id_bagian WHERE id_sk='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Surat Keluar</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=suratkeluar&act=update enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <input type=hidden name=id value=$r[id_sk]>
          <table class='list'><tbody>
          <tr><td>No Surat</td><td> 		: 
		  <select name='id_unit'>";
			$tampil=mysql_query("SELECT * FROM unitkerja ORDER BY id_unit");
				while($w=mysql_fetch_array($tampil)){
					if ($r[id_unit]==$w[id_unit]){
					echo "<option value=$w[id_unit] selected>$w[id_unit]</option>";
				}
					else{
					echo "<option value=$w[id_unit]>$w[id_unit]</option>";
				}
			}
		echo"</select><select name='id_bagian'>";
			$tampil=mysql_query("SELECT * FROM bagian ORDER BY id_bagian");
				while($w=mysql_fetch_array($tampil)){
					if ($r[id_bagian]==$w[id_bagian]){
					echo "<option value=$w[id_bagian] selected>$w[id_bagian]</option>";
					}
				else{
					echo "<option value=$w[id_bagian]>$w[id_bagian]</option>";
				}
			}
		echo"</select><input type=hidden name=id_miring value='/'><input type=hidden name=\"id_sk\" value=\"$r[no_sk]\" readonly>
		  <input type=text name=\"no_sk\" value=\"$r[s_no_sk]$r[no_sk]\" readonly></td></tr>
		  <tr><td>Tgl Surat</td><td> 		: <input type='text' id='tglsk' name='tgl_surat' value='$r[tgl_surat]'></td></tr>
		  <tr><td>Pengirim</td>  <td> : <select name='bagian' required>";
				$tampil=mysql_query("SELECT * FROM bagian ORDER BY nm_bagian");
					if ($r[id_bagian]==0){
						echo "<option required disabled value=0 selected>- Pilih -</option>";
					}   

          while($w=mysql_fetch_array($tampil)){
            if ($r[id_bagian]==$w[id_bagian]){
              echo "<option value=$w[id_bagian] selected>$w[nm_bagian]</option>";
            }
            else{
              echo "<option value=$w[id_bagian]>$w[nm_bagian]</option>";
            }
          }
    echo"</select></td></tr>
		  <tr><td>Tujuan</td><td> 			: <input type=text name=\"tujuan\"  value=\"$r[tujuan]\" size=60 required></td></tr>
		  <tr><td>Perihal</td><td> 		: <input type=text name=\"perihal\" value=\"$r[perihal]\" size=60 required></td></tr>
		  <tr><td>Gambar</td>       <td> :  ";
          if ($r[gambar]==''){
			  echo "<img src='../foto/foto_suratkeluar/thumb_no_image.jpg' width='200' height='240' />";
		  } else {
              echo "<img src='../foto/foto_suratkeluar/small_$r[gambar]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)Apabila gambar tidak diubah, dikosongkan saja.</td></tr>";
    echo  "<tr><td colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Data Surat??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </tbody></table></form>";
    break;  

	case "detail":
	$ambil=mysql_query("SELECT * FROM suratkeluar INNER JOIN bagian
    ON suratkeluar.id_bagian=bagian.id_bagian where id_sk='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2>Detail Surat</h2>
	<table class='list'>
	<tr>
		<td class='center'>Gambar</td>
		<td class='center' colspan='3'>Identitas</td>
	</tr>
	<tr><td class='center' rowspan='7' width='200'>";
        if ($t[gambar]==''){
			echo "<img src='../foto/foto_suratkeluar/thumb_no_image.jpg' width='200' height='240' />";
		} else {
            echo "<img src='../foto/foto_suratkeluar/medium_$t[gambar]'>";  
        }
    echo "</td>
		<td class='left' height='5' width='100'>No Surat</td>
		<td class='left' width='5'>:</td>
		<td class='left'>$t[s_no_sk]$t[no_sk]</td>			
	</tr>
	<tr>
		<td class='left' height='5'>Tanggal Surat</td>
		<td class='left'>:</td>
		<td class='left'>".tgl_indo($t['tgl_surat'])."</td>
	</tr>
		<td class='left' height='5'>Pengirim</td>
		<td class='left'>:</td>
		<td class='left'>$t[nm_bagian]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Tujuan</td>
		<td class='left'>:</td>
		<td class='left'>$t[tujuan]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Perihal</td>
		<td class='left'>:</td>
		<td class='left'>$t[perihal]</td>
	</tr>
	<tr>
		<td colspan='3' ><a href=?module=suratkeluar&act=editsuratkeluar&id=$t[id_sk]><input type=button value=Edit></a> <input type=button value=Kembali onclick=self.history.back()></td>
	</tr>
	</table></form>";
	break;	
}
?>