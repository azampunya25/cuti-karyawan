   <link rel="stylesheet" href="jq/development-bundle/themes/base/jquery.ui.all.css">
    <script src="jq/js/jquery-1.7.1.min.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.core.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.widget.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <!--<link rel="stylesheet" href="jq/development-bundle/demos/demos.css">-->
    <script>
    $(function() {

        $( "#tgllibur" ).datepicker({ altFormat: 'yy-mm-dd' });
        $( "#tgllibur" ).change(function() {
             $( "#tgllibur" ).datepicker( "option", "dateFormat","yy-mm-dd" );
         });

   });
    </script>


<?php
switch($_GET[act]){
  // Tampil Jabatan
  default:
    echo "<h2>Hari Libur</h2>
          <input type=button value='Tambah Hari Libur' onclick=location.href='?module=hari_libur&act=tambah_hari_libur'>
          <table>
          <tr><th>no</th><th>tanggal</th><th>keterangan</th><th>aksi</th></tr>";
    $tampil=mysql_query("SELECT * FROM hari_libur ORDER BY tanggal");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td>$no</td>
             <td>$r[tanggal]</td>
             <td>$r[keterangan]</td>
             <td><a href=?module=hari_libur&act=edit_hari_libur&id=$r[id_hari_libur]>Edit</a> |
	               <a href=./aksi.php?module=hari_libur&act=hapus&id=$r[id_hari_libur]>Hapus</a>
             </td></tr>";
      $no++;
    }
    echo "</table>";
    break;

  case "tambah_hari_libur":
    echo "<h2>Tambah Hari Libur</h2>
          <form method=POST action='./aksi.php?module=hari_libur&act=input'>
          <table>
          <tr><td>Tanggal</td>         <td> : <input type=text name='tanggal' id='tgllibur'></td></tr>
          <tr><td>Keterangan</td> <td> : <input type=text name='keterangan'></td></tr>
          <tr><td colspan=2><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form><br><br>";
     break;

  case "edit_hari_libur":
    $edit=mysql_query("SELECT * FROM hari_libur WHERE id_hari_libur='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Hari Libur</h2>
          <form method=POST action=./aksi.php?module=hari_libur&act=update>
          <input type=hidden name=id value='$r[id_hari_libur]'>
          <table>
          <tr><td>Tanggal</td>           <td> : <input type=text name='tanggal' value='$r[tanggal]' id='tgllibur'></td></tr>
          <tr><td>Keterangan</td>   <td> : <input type=text name='keterangan' value='$r[keterangan]'></td></tr>
                            <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
?>
