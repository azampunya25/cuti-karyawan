<script language="javascript">
function validasi(form){
  if (form.thn.value == ""){
    alert("Anda belum mengisi tahun...!!");
    form.thn.focus();
    return (false);
  }
    if (form.awalcuti.value == ""){
    alert("Anda belum memilih tanggal awal cuti...!!");
    form.awalcuti.focus();
    return (false);
  }
      if (form.akhircuti.value == ""){
    alert("Anda belum memilih tanggal akhircuti...!!");
    form.akhircuti.focus();
    return (false);
  }
      if (form.perihal.value == ""){
    alert("Anda belum mengisikan perihal surat...!!");
    form.perihal.focus();
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
else{
	
$aksi="modul/mod_periode/aksi_periode.php";
switch($_GET[act]){
  // Tampil Periode Cuti
  default:
    echo "<h2>Periode Cuti</h2>
		<div id=paging>
          *) Catatan: Tombol <b>Tambah Periode Cuti</b> hanya disarankan apabila NIP belum pernah terdaftar dalam periode cuti. 
		  (Tabel dibawah). Jika akan merubah periode cuti karena perubahan periode berikutnya cukup <b>edit</b> saja.
        </div>
          <input type=button value='Tambah Periode' onclick=location.href='?module=periode&act=tambahperiode'>
          <table id='jabatan' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
          <th class='center'>No</th>
          <th class='center'>NIP</th>
          <th class='center'>Jenis Cuti</th>
          <th class='center'>Tahun</th>
		  <th class='center'>Periode Cuti</th>
          <th class='center'>Aksi</th>
          </tr></thead><tbody>";

    $tampil=mysql_query("SELECT *, DATE_FORMAT(awalcuti,'%d-%b-%Y') AS awalcuti, DATE_FORMAT(akhircuti,'%d-%b-%Y') AS akhircuti FROM periode_cuti INNER JOIN jns_cuti
    ON periode_cuti.id_jcuti=jns_cuti.id_jcuti ORDER BY id_periode_cuti DESC");
    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      echo "<tr><td class='center' width='25'>$no</td>
                <td class='center'>$r[nip]</td>
				<td class='left'>$r[nm_jcuti]</td>
				<td class='center'>$r[tahun]</td>
				<td class='center'>$r[awalcuti] s/d $r[akhircuti]</td>
                <td class='center'  width='85'><a href=?module=periode&act=editperiode&id=$r[id_periode_cuti]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href=$aksi?module=periode&act=hapus&id=$r[id_periode_cuti] \" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
      $no++;
    }
    echo "</tbody></table>";

echo "<div class=> $linkHalaman</div><br>";

    break;

  
  case "tambahperiode":
    echo "<h2>Tambah Periode</h2>
		<form method=POST action='?module=periode&act=filterperiode'>
          <table class='list'><tbody>
          <tr><td width=70>NIP</td><td> 	: <input type=text name='nip' size=20> <input type=submit value=Filter></td></tr>
          </tbody></table></form>";
    break;
  
     case "filterperiode":
          echo "<h2>Tambah Periode Cuti</h2>";
          $nip=$_POST['nip'];
          $s=mysql_query("SELECT * FROM pegawai WHERE nip='$nip'");
          $d=mysql_fetch_array($s);
          if(mysql_num_rows($s)>0){
          echo"<form method=POST action='$aksi?module=periode&act=input'  enctype='multipart/form-data' onSubmit='return validasi(this)'>
		  <table class='list'><tbody>
          <tr><td class='left'>NIP</td>      <td> : <input type=text name='nip' value='$nip' readonly ></td></tr>
		  <tr><td class='left'>Nama</td>      <td> : <input type=text name='nama' value='$d[nama]' disabled ></td></tr>
		  <tr><td class='left'>Tanggal Masuk</td>      <td> : <input type=text name='tgl_masuk' value='$d[tgl_masuk]' disabled></td></tr>
          <tr><td>Jenis Cuti</td> <td> : <select name='id_jcuti'>";
           $sj=mysql_query("SELECT * FROM jns_cuti");
           for($i=0;$i<mysql_num_rows($sj);$i++) {
	    	$dj=mysql_fetch_assoc($sj);
				echo"<option value=$dj[id_jcuti]>$dj[nm_jcuti]</option>";
			}
          echo"</select></td></tr>
          <tr><td>Tahun</td><td>: <input type='text' name='thn'> *  tahun cuti diisi sesuai dengan tahun Periode Akhir cuti</td></tr>
          <tr><td>Periode Awal</td> <td> : <input type=text name='awalcuti' id='per1'></td></tr>
          <tr><td>Periode Akhir</td> <td> : <input type=text name='akhircuti' id='per2'></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Data Golongan ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br>";
          }else{
          	echo "Pegawai tidak terdaftar
          	<input type=button value=Kembali onclick=self.history.back()>";
          	}
     break;

  case "editperiode":
      $edit = mysql_query("SELECT * FROM periode_cuti inner join jns_cuti
    on periode_cuti.id_jcuti=jns_cuti.id_jcuti
    WHERE periode_cuti.id_periode_cuti='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Periode Cuti</h2>
          <form method=POST action=$aksi?module=periode&act=update>
          <input type=hidden name=id value=$r[id_periode_cuti]>
          <table class='list'><tbody>
          <tr><td class='left'>NIP</td>      <td> : <input type=text name='nip' value='$r[nip]' disabled></td></tr>
		  <tr><td class='left'>Jenis Cuti</td>      <td> : <input type=text name='nm_cuti' value='$r[nm_jcuti]' disabled></td></tr>
          <tr><td class='left'>Tahun</td>    <td> : <input type=text name='tahun' value='$r[tahun]'></td></tr>
          <tr><td class='left'>Periode Awal</td>    <td> : <input type=text name='awalcuti' id='per1' value='$r[awalcuti]'></td></tr>
		  <tr><td class='left'>Periode Akhir</td>    <td> : <input type=text name='akhircuti' id='per2' value='$r[akhircuti]'></td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Data Golongan ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
}
?>
