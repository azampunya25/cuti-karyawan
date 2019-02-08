<?php
switch($_GET[act]){
  // Tampil User
  default:
  echo "<h2>User</h2>
  <input type=button value='Tambah User' onclick=location.href='?module=user&act=tambahuser'>
  <table id='rounded-corner'>
  <tr><th scope='col' class='rounded'>no</th><th scope='col' class='rounded'>nip</th><th scope='col' class='rounded'>nama lengkap</th><th scope='col' class='rounded'>aksi</th></tr>";
    $tampil=mysql_query("SELECT user.*,karyawan.* FROM user inner join
      karyawan on user.nik=karyawan.nik ORDER BY id_user");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
     echo "<tr><td>$no</td>
     <td>$r[nik]</td>
     <td>$r[nama]</td>
     <td><a href=?module=user&act=edituser&id=$r[id_user]>Edit</a> |
      <a href=./aksi.php?module=user&act=hapus&id=$r[id_user]>Hapus</a>
    </td></tr>";
    $no++;
  }
  echo "</table>";
  break;

  case "tambahuser":
  echo "<h2>Tambah User</h2>
  <form method=POST action='./aksi.php?module=user&act=input'>
    <table>
      <tr><td>NIP</td>          <td> : <input type=text name='nik'></td></tr>
      <tr><td>Password</td>     <td> : <input type=text name='password'></td></tr>
      <tr><td>Level</td>        <td> : <select name='level'>
        <option value='atasan' checked>atasan</option>
        <option value='karyawan'>karyawan</option>
        <option value='admin'>admin</option>
      </select>
    </td></tr>
    <tr><td colspan=2><input type=submit value=Simpan>
      <input type=button value=Batal onclick=self.history.back()></td></tr>
    </table></form><br><br>";
    break;

    case "edituser":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit User</h2>
    <form method=POST action=./aksi.php?module=user&act=update>
      <input type=hidden name=id value='$r[id_user]'>
      <table>
        <tr><td>Username</td>     <td> : <input type=text name='nik' value='$r[nik]'></td></tr>
        <tr><td>Password</td>     <td> : <input type=text name='password'> *) </td></tr>";

        if ($r[level]=='atasan'){
         echo "<tr><td>Level</td> <td> :   <input type=radio name='level' value='atasan' checked>atasan
         <input type=radio name='level' value='karyawan'>karyawan
         <input type=radio name='level' value='admin'>admin
       </td></tr>";
     }
     elseif ($r[level]=='karyawan'){
      echo "<tr><td>Level</td> <td> : <input type=radio name='level' value='atasan'>atasan
      <input type=radio name='level' value='karyawan' checked>karyawan
      <input type=radio name='level' value='admin'>admin
    </td></tr>";
  }
  else{
    echo "<tr><td>Level</td> <td> : <input type=radio name='level' value='atasan'>atasan
    <input type=radio name='level' value='karyawan'>karyawan
    <input type=radio name='level' value='admin' checked>admin</td></tr>";
  }


  echo"<tr><td colspan=2>*) Apabila password tidak diubah, dikosongkan saja.</td></tr>
  <tr><td colspan=2><input type=submit value=Update>
    <input type=button value=Batal onclick=self.history.back()></td></tr>
  </table></form>";
  break;
}
?>
