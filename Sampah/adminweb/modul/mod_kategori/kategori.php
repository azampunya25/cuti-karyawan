<script language="javascript">
function validasi(form){
  if (form.nama_kategori.value == ""){
    alert("Anda belum mengisikan nama kategori...!!");
    form.nama_kategori.focus();
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
$aksi="modul/mod_kategori/aksi_kategori.php";
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<h2>Kategori</h2>
          <input type=button value='Tambah Kategori' onclick=\"window.location.href='?module=kategori&act=tambahkategori';\">
          <table  id='NoInfo' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
		  <th>No</th>
          <th>Nama Kategori</th>
          <th>Aksi</th>
		  </tr></thead><tbody>"; 
    $tampil=mysql_query("SELECT * FROM kategori ORDER BY id_kategori DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td class='center'>$no</td>
             <td class='center'>$r[nama_kategori]</td>
             <td class='center'> <a href=?module=kategori&act=editkategori&id=$r[id_kategori]><img src='images/edit.png' border='0' title='edit' /></a>
			 <a href=$aksi?module=kategori&act=hapus&id=$r[id_kategori] \" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><img src='images/del.png' border='0' title='hapus' /></a>
             </td></tr>";
      $no++;
    }
    echo "<tbody></table>";
	echo "<div class=>$linkHalaman</div><br>";
    //echo "<div id=paging>*) Data pada Kategori tidak bisa dihapus, tapi bisa di non-aktifkan melalui Edit Kategori.</div><br>";
    break;
  
  // Form Tambah Kategori
  case "tambahkategori":
    echo "<h2>Tambah Kategori</h2>
          <form method=POST action='$aksi?module=kategori&act=input' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'>
          <tr><td class='left'>Nama Kategori</td><td> : <input type=text name='nama_kategori' required></td></tr>
          <tr><td class='left' colspan=2><input type=submit name=submit value=Simpan onClick=\"return confirm('Apakah Anda Yakin Tambah Kategori ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
     break;
  
  // Form Edit Kategori  
  case "editkategori":
    $edit=mysql_query("SELECT * FROM kategori WHERE id_kategori='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Kategori</h2>
          <form method=POST action=$aksi?module=kategori&act=update>
          <input type=hidden name=id value='$r[id_kategori]'>
          <table class='list'>
          <tr><td class='left'>Nama Kategori</td><td> : <input type=text name='nama_kategori' value='$r[nama_kategori]' required></td></tr>";
    echo "<tr><td class='left' colspan=2><input type=submit value=Update \" onClick=\"return confirm('Apakah Anda Yakin Ubah Kategori ??')\">
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;  
}
}
?>
