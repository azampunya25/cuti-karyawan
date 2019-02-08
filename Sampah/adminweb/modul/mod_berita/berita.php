<script language="javascript">
function validasi(form){
  if (form.judul.value == ""){
    alert("Anda belum mengisikan judul berita...!!");
    form.judul.focus();
    return (false);
  }
    if (form.kategori.value == "0"){
    alert("Anda belum memilih kategori berita...!!");
    form.kategori.focus();
    return (false);
  }
      if (form.isi_berita.value == "0"){
    alert("Anda belum memilih kategori berita...!!");
    form.isi_berita.focus();
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
$aksi="modul/mod_berita/aksi_berita.php";
switch($_GET[act]){
  // Tampil Berita
  default:
    echo "<h2>Berita</h2>
	<input type=button value='Tambah Berita' onclick=location.href='?module=berita&act=tambahberita'>
		<table id='jabatan' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th class='center'>No</th>
          <th class='center'>Judul</th>
          <th class='center'>Tgl. Posting</th>
          <th class='center'>Aksi</th>
          </tr></thead><tbody>";

      $tampil = mysql_query("SELECT * FROM berita ORDER BY id_berita DESC");

    $no = $posisi+1;
    while($r=mysql_fetch_array($tampil)){
      $tgl_posting=tgl_indo($r[tanggal]);
      echo "<tr><td class='center'>$no</td>
                <td>$r[judul]</td>
                <td class='center'>$tgl_posting</td>
		            <td class='center'><a href=?module=berita&act=editberita&id=$r[id_berita]><img src='images/edit.png' border='0' title='edit' /></a>
		                <a href=\"$aksi?module=berita&act=hapus&id=$r[id_berita]&namafile=$r[gambar]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a></td>
		        </tr>";
      $no++;
    }
    echo "</table>";
echo "<div class=> $linkHalaman</div><br>";
    break;    
  
  case "tambahberita":
    echo "<h2>Tambah Berita</h2>
          <form method=POST action='$aksi?module=berita&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'><tbody>
          <tr><td width=70>Judul</td>     <td> : <input type=text name='judul' size=60 required></td></tr>
          <tr><td>Kategori</td>  <td> : 
          <select name='kategori' required>
            <option required disabled value=0 selected>- Pilih Kategori -</option>";
            $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
            while($r=mysql_fetch_array($tampil)){
              echo "<option value=$r[id_kategori]>$r[nama_kategori]</option>";
            }
    echo "</select></td></tr>
          <tr><td>Isi Berita</td>  <td> <textarea name='isi_berita' id='loko' style='width: 600px; height: 350px;'></textarea></td></tr>
          <tr><td>Gambar</td>      <td> : <input type=file name='fupload' size=40> *)
                                          <br>Tipe gambar harus JPG/JPEG dan ukuran lebar maks: 400 px<br>*)Gambar boleh dikosongkan</td>
										  </tr>";
    echo "</td></tr>
          <tr><td colspan=2><input type=submit value=Simpan \" onClick=\"return confirm('Apakah Anda Yakin Tambah Berita ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
     break;
    
  case "editberita":
    $edit = mysql_query("SELECT * FROM berita WHERE id_berita='$_GET[id]'");
    $r    = mysql_fetch_array($edit);
    echo "<h2>Edit Berita</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=berita&act=update>
          <input type=hidden name=id value=$r[id_berita]>
          <table class='list'><tbody>
          <tr><td width=70>Judul</td>     <td> : <input type=text name=\"judul\" size=60 value=\"$r[judul]\" required></td></tr>
          <tr><td>Kategori</td>  <td> : <select name='kategori' required>";
 
          $tampil=mysql_query("SELECT * FROM kategori ORDER BY nama_kategori");
          if ($r[id_kategori]==0){
            echo "<option required disabled value=0 selected>- Pilih Kategori -</option>";
          }   
          while($w=mysql_fetch_array($tampil)){
            if ($r[id_kategori]==$w[id_kategori]){
              echo "<option value=$w[id_kategori] selected>$w[nama_kategori]</option>";
            }
            else{
              echo "<option value=$w[id_kategori]>$w[nama_kategori]</option>";
            }
          }
    echo "</select></td></tr>";
    echo "<tr><td>Isi Berita</td>   <td> <textarea id='loko' name='isi_berita' style='width: 600px; height: 350px;'>$r[isi_berita]</textarea></td></tr>
          <tr><td>Gambar</td>       <td> :  ";
          if ($r[gambar]!=''){
              echo "<img src='../foto/foto_berita/small_$r[gambar]'>";  
          }
    echo "</td></tr>
          <tr><td>Ganti Gbr</td>    <td> : <input type=file name='fupload' size=30> *)Apabila gambar tidak diubah, dikosongkan saja.</td></tr>";
    echo  "<tr><td colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Berita ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
         </tbody></table></form>";
    break;  
}
}
?>
