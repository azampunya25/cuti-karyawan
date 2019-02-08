<script language="javascript">
function validasi(form){
  if (form.asal_surat.value == ""){
    alert("Anda belum mengisi asal surat...!!");
    form.asal_surat.focus();
    return (false);
  }
    if (form.tgl_surat.value == ""){
    alert("Anda belum mengisikan tanggal surat...!!");
    form.tgl_surat.focus();
    return (false);
  }
      if (form.tgl_terima.value == ""){
    alert("Anda belum mengisikan tanggal terima...!!");
    form.tgl_terima.focus();
    return (false);
  }
      if (form.no_surat.value == ""){
    alert("Anda belum mengisikan no surat...!!");
    form.perihal.focus();
    return (false);
  }
        if (form.sifat.value == "0"){
    alert("Anda belum memilih sifat surat...!!");
    form.sifat.focus();
    return (false);
  }
        if (form.perihal.value == ""){
    alert("Anda belum mengisikan perihal surat...!!");
    form.perihal.focus();
    return (false);
  }
        if (form.diteruskan.value == "0"){
    alert("Anda belum memilih teruskan surat...!!");
    form.diteruskan.focus();
    return (false);
  }
        if (form.petunjuk.value == ""){
    alert("Anda belum mengisikan petunjuk surat...!!");
    form.petunjuk.focus();
    return (false);
  }
        if (form.disposisi.value == ""){
    alert("Anda belum mengisikan perihal surat...!!");
    form.disposisi.focus();
    return (false);
  }
  if (form.fupload.value == ""){
    alert("Anda belum memasukan upload...!!");
    form.fupload.focus();
    return (false);
  }
}
</script>

<?php    
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
 }
 
$aksi="modul/mod_surat/aksi_suratmasuk.php";
switch($_GET[act]){
  // Tampil Surat Masuk
  default:
    echo "<h2>Surat Masuk</h2>
	<input type=button value='Tambah Surat' onclick=location.href='?module=suratmasuk&act=tambahsurat'>
	<table id='suratmasuk' class='list display' cellspacing='0' width='100%'><thead>  
          <tr><th>No</th>
          <th>No Agenda</th>
          <th>Asal Surat</th>
		  <th>Tgl Terima</th>
		  <th>No Surat</th>
		  <th>Perihal</th>
		  <th>File</th>
          <th>Aksi</th>
          </tr></thead>";

    $tampil = mysql_query("SELECT * FROM suratmasuk INNER JOIN bagian
    ON suratmasuk.id_bagian=bagian.id_bagian ORDER BY tgl_terima DESC");
    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
		//".tgl_indo($r['tgl_surat'])."
		//DATE_FORMAT(tgl_surat,'%d-%b-%Y') AS tgl_surat, DATE_FORMAT(tgl_terima,'%d-%b-%Y') AS tgl_terima
      echo "<tr><td class='center' width='25'>$no</td>
                <td class='center'>$r[s_no_agenda]$r[no_agenda]</td>
                <td class='left'>$r[asal_surat]</td>
				<td class='center'>".tgl_indo($r['tgl_terima'])."</td>
				<td class='left'>$r[no_surat]</td>
				<td class='left'>$r[perihal]</td>
				<td class='center'><a href='?module=suratmasuk&act=detail&id=$r[id_sm]'>Detail</a></span></td></td>
		            <td class='center' width='85'><a href=?module=suratmasuk&act=editsuratmasuk&id=$r[id_sm]><img src='images/edit.png' border='0' title='edit' /></a>
		                <a href=\"$aksi?module=suratmasuk&act=hapus&id=$r[id_sm]&namafile=$r[gambar]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
	
echo "<div class=> $linkHalaman</div><br>";
 
    break;    
  
  case "tambahsurat":
  //SELECT max(no_agenda) as terakhir from suratmasuk
  //SELECT IFNULL(MAX('no_agenda')+1,1) AS 'no_agenda' FROM 'suratmasuk' 
//WHERE DATE_FORMAT('date','%Y%m')=DATE_FORMAT(NOW(),'%Y%m')
	$sql ="SELECT max(no_agenda) as terakhir from suratmasuk"; 
	$tgl = date('Y');
	$hasil = mysql_query($sql);
	$data2 = mysql_fetch_array($hasil);
	$lastID = $data2['terakhir'];
	$lastNoUrut = substr($lastID, 1,16);
	$nextNoUrut = $lastNoUrut + 1;
	$nextID = ".".sprintf($nextNoUrut);
	//$nextID = "TU".sprintf("%03s",$nextNoUrut)."/$tgl".".K";
	//"PERJ"
	//"/$tgl".
	//.".K"
	
    echo "<h2>Tambah Surat</h2>
          <form method=POST action='$aksi?module=suratmasuk&act=input'  enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
		  
		  <tr><td width=70>No Agenda</td><td> 	: <select name='id_bagian'>";
			$tampil=mysql_query("SELECT * FROM bagian ORDER BY id_bagian");
				while($w=mysql_fetch_array($tampil)){
					if ($r[id_bagian]==$w[id_bagian]){
					echo "<option value=$w[id_bagian] selected>$w[id_bagian]</option>";
					}
				else{
					echo "<option value=$w[id_bagian]>$w[id_bagian]</option>";
				}
			}
		echo"</select><select name='id_unit'>";
			$tampil=mysql_query("SELECT * FROM unitkerja ORDER BY id_unit");
				while($w=mysql_fetch_array($tampil)){
					if ($r[id_unit]==$w[id_unit]){
					echo "<option value=$w[id_unit] selected>$w[id_unit]</option>";
				}
					else{
					echo "<option value=$w[id_unit]>$w[id_unit]</option>";
				}
			}
		echo"</select><input type=hidden name=id_miring value='/'><input type=text name='id_nomor' value='$nextID' size= 3 readonly>
		
		<input type=text name='id_thn' value='/$tgl' size=4 readonly></td></tr>
		  <tr><td width=70>Asal Surat</td><td> 	: <input type=text name='asal_surat' size=60 required></td></tr>
		  <tr><td width=70>Tgl Surat</td><td> 	: <input type=text id='tglsm1' name='tgl_surat' required></td></tr>
		  <tr><td width=70>Tgl Terima</td><td> 	: <input type=text id='tglsm2' name='tgl_terima' required></td></tr>
		  <tr><td width=70>No Surat</td><td> 	: <input type=text name='no_surat' size=20 required></td></tr>
		  <tr><td>Sifat</td><td> : 
		  <select name='sifat' required>
						<option  required disabled value=0 selected>Pilih Sifat</option>
						<option value='Biasa'>Biasa</option>
						<option value='Penting'>Penting</option>
						<option value='Segera'>Segera</option>
						<option value='Rahasia'>Rahasia</option>
						<option value='Sangat Rahasia'>Sangat Rahasia</option>
						
		  </select> 
		  <tr><td width=70>Perihal</td><td> : <input type=text name='perihal' size=60 required></td></tr>		  
		  <tr><td class='left'>Diteruskan</td><td class='left'> : 
				<select name='bagian' required>
				<option  required disabled value=0 selected>- Pilih -</option>";
				$tampil=mysql_query("SELECT * FROM bagian ORDER BY id_bagian");
				while($r=mysql_fetch_array($tampil)){
					echo "<option value=$r[id_bagian]>$r[nm_bagian]</option>";
				}
	echo "</select></td></tr>
		  <tr><td>Petunjuk</td><td> : 
		  <select name='petunjuk' required>
						<option required disabled value=0 selected>Pilih Petunjuk</option>
						<option value='Utk. diketahui'>Utk. diketahui</option>
						<option value='Utk. ditandatangani'>Utk. ditandatangani</option>
						<option value='Utk. dilaksanakan'>Utk. dilaksanakan</option>
						<option value='Utk. bahan selanjutnya'>Utk. bahan selanjutnya</option>
						<option value='Utk. dikordinasikan'>Utk. dikordinasikan</option>
						<option value='Utk. dibahas/dijawab'>Utk. dibahas/dijawab</option>
						<option value='Utk. dipertimbangkan'>Utk. dipertimbangkan</option>
						
		  </select> 
		  <tr><td width=70>Disposisi</td><td> : <input type=text name='disposisi' size=60 required></td></tr>
		  <tr><td>Gambar</td><td> 				: <input type=file name='fupload' required> 
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px</td></tr>";
    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Data Surat ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
     break;
    
    
  case "editsuratmasuk":
    $edit = mysql_query("SELECT * FROM suratmasuk INNER JOIN bagian
    ON suratmasuk.id_bagian=bagian.id_bagian WHERE id_sm='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Surat Masuk</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=suratmasuk&act=update enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <input type=hidden name=id value=$r[id_sm]>
          <table class='list'><tbody>
				  <tr><td width=70>No Agenda</td><td> 	: <select name='id_bagian'>";
			$tampil=mysql_query("SELECT * FROM bagian ORDER BY id_bagian");
				while($w=mysql_fetch_array($tampil)){
					if ($r[id_bagian]==$w[id_bagian]){
					echo "<option value=$w[id_bagian] selected>$w[id_bagian]</option>";
					}
				else{
					echo "<option value=$w[id_bagian]>$w[id_bagian]</option>";
				}
			}
		echo"</select><select name='id_unit'>";
			$tampil=mysql_query("SELECT * FROM unitkerja ORDER BY id_unit");
				while($w=mysql_fetch_array($tampil)){
					if ($r[id_unit]==$w[id_unit]){
					echo "<option value=$w[id_unit] selected>$w[id_unit]</option>";
				}
					else{
					echo "<option value=$w[id_unit]>$w[id_unit]</option>";
				}
			}
		echo"</select><input type=hidden name=id_miring value='/'>
		<input type=hidden name=\"id_sk\" value=\"$r[no_agenda]\" readonly>
		<input type=text name='no_agenda' value='$r[s_no_agenda]$r[no_agenda]' readonly></td></tr>
		  <tr><td>Asal Surat</td><td> 	: <input type=text name='asal_surat' value='$r[asal_surat]'size=30 required</td></tr>
		  <tr><td>Tgl Terima</td><td> 	: <input type='text' id='tglsm1' name='tgl_terima' value='$r[tgl_terima]' required></td></tr>
		  <tr><td>Tgl Surat</td><td> 	: <input type='text' id='tglsm2' name='tgl_surat' value='$r[tgl_surat]' required></td></tr>
		  <tr><td>No Surat</td><td> 	: <input type=text name='no_surat' value='$r[no_surat]' size=30 required></td></tr>
		<tr><td class='left'>Sifat</td><td class='left'> : <select name='sifat'>";
         if ($r[sifat]=='Biasa'){
          	 echo"<option value='Biasa' selected>Biasa</option>";
             echo"<option value='Penting'>Penting</option>";
             echo"<option value='Segera'>Segera</option>";
             echo"<option value='Rahasia'>Rahasia</option>";
             echo"<option value='Sangat Rahasia'>Sangat Rahasia</option>";
            }

         elseif ($r[sifat]=='Penting'){
       	 	 echo"<option value='Biasa'>Biasa</option>";
             echo"<option value='Penting' selected>Penting</option>";
             echo"<option value='Segera'>Segera</option>";
             echo"<option value='Rahasia'>Rahasia</option>";
             echo"<option value='Sangat Rahasia'>Sangat Rahasia</option>";
           	}

         elseif ($r[sifat]=='Segera'){
       	 	 echo"<option value='Biasa'>Biasa</option>";
             echo"<option value='Penting'>Penting</option>";
             echo"<option value='Segera' selected>Segera</option>";
             echo"<option value='Rahasia'>Rahasia</option>";
             echo"<option value='Sangat Rahasia'>Sangat Rahasia</option>";
           	}

         elseif ($r[sifat]=='Rahasia'){
       	 	 echo"<option value='Biasa' >Biasa</option>";
             echo"<option value='Penting'>Penting</option>";
             echo"<option value='Segera'>Segera</option>";
             echo"<option value='Rahasia' selected>Rahasia</option>";
             echo"<option value='Sangat Rahasia'>Sangat Rahasia</option>";
           	}

         elseif ($r[sifat]=='Sangat Rahasia'){
         	 echo"<option value='Biasa' >Biasa</option>";
             echo"<option value='Penting'>Penting</option>";
             echo"<option value='Segera'>Segera</option>";
             echo"<option value='Rahasia'>Rahasia</option>";
             echo"<option value='Sangat Rahasia' selected>Sangat Rahasia</option>";
           	}
    echo "</select></td></tr>
		  <tr><td>Perihal</td><td> 		: <textarea name='perihal'  cols='45' rows='5'>$r[perihal]</textarea></td></tr>
		  		  <tr><td>Diteruskan</td>  <td> : <select name='bagian' required>";
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
		<tr><td class='left'>Petunjuk</td><td class='left'> : <select name='petunjuk'>";
         if ($r[petunjuk]=='Utk. diketahui'){
          	 echo"<option value='Utk. diketahui' selected>Utk. diketahui</option>";
             echo"<option value='Utk. ditandatangani'>Utk. ditandatangani</option>";
             echo"<option value='Utk. dilaksanakan'>Utk. dilaksanakan</option>";
             echo"<option value='Utk. bahan selanjutnya'>Utk. bahan selanjutnya</option>";
             echo"<option value='Utk. dikordinasikan'>Utk. dikordinasikan</option>";
			 echo"<option value='Utk. dibahas/dijawab'>Utk. dibahas/dijawab</option>";
			 echo"<option value='Utk. dipertimbangkan'>Utk. dipertimbangkan</option>";
            }

         elseif ($r[petunjuk]=='Utk. ditandatangani'){
          	 echo"<option value='Utk. diketahui'>Utk. diketahui</option>";
             echo"<option value='Utk. ditandatangani' selected>Utk. ditandatangani</option>";
             echo"<option value='Utk. dilaksanakan'>Utk. dilaksanakan</option>";
             echo"<option value='Utk. bahan selanjutnya'>Utk. bahan selanjutnya</option>";
             echo"<option value='Utk. dikordinasikan'>Utk. dikordinasikan</option>";
			 echo"<option value='Utk. dibahas/dijawab'>Utk. dibahas/dijawab</option>";
			 echo"<option value='Utk. dipertimbangkan'>Utk. dipertimbangkan</option>";
           	}

         elseif ($r[petunjuk]=='Utk. dilaksanakan'){
          	 echo"<option value='Utk. diketahui'>Utk. diketahui</option>";
             echo"<option value='Utk. ditandatangani'>Utk. ditandatangani</option>";
             echo"<option value='Utk. dilaksanakan' selected>Utk. dilaksanakan</option>";
             echo"<option value='Utk. bahan selanjutnya'>Utk. bahan selanjutnya</option>";
             echo"<option value='Utk. dikordinasikan'>Utk. dikordinasikan</option>";
			 echo"<option value='Utk. dibahas/dijawab'>Utk. dibahas/dijawab</option>";
			 echo"<option value='Utk. dipertimbangkan'>Utk. dipertimbangkan</option>";
           	}

         elseif ($r[petunjuk]=='Utk. bahan selanjutnya'){
          	 echo"<option value='Utk. diketahui'>Utk. diketahui</option>";
             echo"<option value='Utk. ditandatangani'>Utk. ditandatangani</option>";
             echo"<option value='Utk. dilaksanakan'>Utk. dilaksanakan</option>";
             echo"<option value='Utk. bahan selanjutnya' selected>Utk. bahan selanjutnya</option>";
             echo"<option value='Utk. dikordinasikan'>Utk. dikordinasikan</option>";
			 echo"<option value='Utk. dibahas/dijawab'>Utk. dibahas/dijawab</option>";
			 echo"<option value='Utk. dipertimbangkan'>Utk. dipertimbangkan</option>";
           	}

         elseif ($r[petunjuk]=='Utk. dikordinasikan'){
          	 echo"<option value='Utk. diketahui'>Utk. diketahui</option>";
             echo"<option value='Utk. ditandatangani'>Utk. ditandatangani</option>";
             echo"<option value='Utk. dilaksanakan'>Utk. dilaksanakan</option>";
             echo"<option value='Utk. bahan selanjutnya'>Utk. bahan selanjutnya</option>";
             echo"<option value='Utk. dikordinasikan' selected>Utk. dikordinasikan</option>";
			 echo"<option value='Utk. dibahas/dijawab'>Utk. dibahas/dijawab</option>";
			 echo"<option value='Utk. dipertimbangkan'>Utk. dipertimbangkan</option>";
           	}
		elseif ($r[petunjuk]=='Utk. dibahas/dijawab'){
          	 echo"<option value='Utk. diketahui'>Utk. diketahui</option>";
             echo"<option value='Utk. ditandatangani'>Utk. ditandatangani</option>";
             echo"<option value='Utk. dilaksanakan'>Utk. dilaksanakan</option>";
             echo"<option value='Utk. bahan selanjutnya'>Utk. bahan selanjutnya</option>";
             echo"<option value='Utk. dikordinasikan'>Utk. dikordinasikan</option>";
			 echo"<option value='Utk. dibahas/dijawab' selected>Utk. dibahas/dijawab</option>";
			 echo"<option value='Utk. dipertimbangkan'>Utk. dipertimbangkan</option>";
           	}
		elseif ($r[petunjuk]=='Utk. dipertimbangkan'){
          	 echo"<option value='Utk. diketahui'>Utk. diketahui</option>";
             echo"<option value='Utk. ditandatangani'>Utk. ditandatangani</option>";
             echo"<option value='Utk. dilaksanakan'>Utk. dilaksanakan</option>";
             echo"<option value='Utk. bahan selanjutnya'>Utk. bahan selanjutnya</option>";
             echo"<option value='Utk. dikordinasikan'>Utk. dikordinasikan</option>";
			 echo"<option value='Utk. dibahas/dijawab'>Utk. dibahas/dijawab</option>";
			 echo"<option value='Utk. dipertimbangkan' selected>Utk. dipertimbangkan</option>";
           	}
    echo "</select></td></tr>
		  <tr><td>Disposisi</td><td> : <textarea name='disposisi'  cols='45' rows='5'>$r[disposisi]</textarea></td></tr>
		  		  <tr><td>Gambar</td>       <td> :  ";
          if ($r[gambar]==''){
			  echo "<img src='../foto/foto_suratmasuk/thumb_no_image.jpg' width='200' height='240' />";
		  } else {
              echo "<img src='../foto/foto_suratmasuk/small_$r[gambar]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)Apabila gambar tidak diubah, dikosongkan saja.</td></tr>";
    echo  "<tr><td colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Data Surat ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </tbody></table></form>";
    break;  
	
	case "detail":
	$ambil=mysql_query("select * from suratmasuk INNER JOIN bagian
    ON suratmasuk.id_bagian=bagian.id_bagian where id_sm='$_GET[id]'");
	$t=mysql_fetch_array($ambil);
	echo "<h2>Detail Surat</h2>
	<table class='list'>
	<tr>
		<td class='center'>Gambar</td>
		<td class='center' colspan='3'>Identitas</td>
	</tr>
	<tr><td class='center' rowspan='11' width='200'>";
        if ($t[gambar]==''){
			echo "<img src='../foto/foto_suratmasuk/thumb_no_image.jpg' width='200' height='240' />";
		} else {
            echo "<img src='../foto/foto_suratmasuk/medium_$t[gambar]'>";  
        }
    echo "</td>
		<td class='left' height='5' width='100'>No Agenda</td>
		<td class='left' width='5'>:</td>
		<td class='left'>$t[s_no_agenda]$t[no_agenda]</td>			
	</tr>
	<tr>
		<td class='left' height='5'>Asal Surat</td>
		<td class='left'>:</td>
		<td class='left'>$t[asal_surat]</td>
	</tr>
		<td class='left' height='5'>Tgl Terima</td>
		<td class='left'>:</td>
		<td class='left'>".tgl_indo($t['tgl_terima'])."</td>
	</tr>
	<tr>
		<td class='left' height='5'>Tgl Surat</td>
		<td class='left'>:</td>
		<td class='left'>".tgl_indo($t['tgl_surat'])."</td>
	</tr>
	<tr>
		<td class='left' height='5'>No Surat</td>
		<td class='left'>:</td>
		<td class='left'>$t[no_surat]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Sifat</td>
		<td class='left'>:</td>
		<td class='left'>$t[sifat]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Perihal</td>
		<td class='left'>:</td>
		<td class='left'>$t[perihal]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Diteruskan</td>
		<td class='left'>:</td>
		<td class='left'>$t[nm_bagian]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Petunjuk</td>
		<td class='left'>:</td>
		<td class='left'>$t[petunjuk]</td>
	</tr>
	<tr>
		<td class='left' height='5'>Disposisi</td>
		<td class='left'>:</td>
		<td class='left'>$t[disposisi]</td>
	</tr>
	<tr>
		<td colspan='3' ><a href=?module=suratmasuk&act=editsuratmasuk&id=$t[id_sm]><img src='images/edit.png' border='0' title='edit' /></a> <input type=button value=Kembali onclick=self.history.back()></td>
	</tr>
	</table></form>";
	break;	
}
?>