<?php
$aksi="modul/mod_users/aksi_users.php";
switch($_GET[act]){
  // Tampil User
  default:
  //<input type=button value='Tambah Pengguna' onclick=location.href='?module=user&act=tambahuser'>
    echo "<h2>Pengguna</h2>
          
		  <table id='jabatan' class='list display' cellspacing='0' width='100%'><thead>
          <tr>
          <th>No</th>
          <th>NIP</th>
          <th>Nama Lengkap</th>
		  <th>Level</th>
		  <th>Status</th>
          <th>Aksi</th>
          </tr></thead> "; 
		  
    $tampil=mysql_query("SELECT user.*,pegawai.* FROM user inner join
    pegawai on user.nip=pegawai.nip WHERE aktif='Y' ORDER BY id_user");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
       echo "<tr><td class='center' width='25'>$no</td>
                <td class='left'>$r[nip]</td>
                <td class='left'>$r[nama]</td>
				<td class='left'>$r[level]</td>
				<td class='center'>$r[status]</td>
                <td class='center'  width='85'><a href=?module=user&act=edituser&id=$r[id_user]><img src='images/edit.png' border='0' title='edit' /></a>
				<a href=$aksi?module=user&act=hapus&id=$r[id_user]><img src='images/del.png' border='0' title='hapus' /></a>

		        </tr>";
      $no++;
    }
    echo "</table>";
	    echo "<div class=>$linkHalaman</div><br>";
    break;

  case "tambahuser":
    echo "<h2>Tambah Pengguna</h2>
          <form method=POST action='$aksi?module=user&act=input'>
          <table class='list1'><tbody>
          <tr><td class='left'>NIP</td>      <td> : <input type=text name='nip' size=30></td></tr>
          <tr><td class='left'>Password</td>  <td> : <input type=text name='password' size=30></td></tr>
		  <tr><td class='left'>Level</td>        <td> : <select name='level'>
                                            <option value='PEGAWAI'checked>Pegawai</option>
											<option value='KEPALA'>Kepala</option>
											<option value='STAFF'>Staff</option>
 										  	<option value='ADMIN'>Admin</option>
                                           </select>
          </td></tr>
          <tr><td class='left' colspan=2><input type=submit value=Simpan>
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
     break;

  case "edituser":
    $edit=mysql_query("SELECT * FROM user WHERE id_user='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    echo "<h2>Edit Pengguna</h2>
          <form method=POST action=$aksi?module=user&act=update>
          <input type=hidden name=id value='$r[id_user]'>
          <table class='list'><tbody>
          <tr><td class='left'>NIP</td>     <td> : <input type=text name='nip' value='$r[nip]' readonly> **)</td></tr>
          <tr><td class='left'>Password</td>     <td> : <input type=text name='password'> *) </td></tr>";

     if ($r[level]=='KEPALA'){
     echo "<tr><td>Level</td> <td> :   <input type=radio name='level' value='KEPALA' checked>KEPALA BAGIAN
                                       <input type=radio name='level' value='PEGAWAI'>PEGAWAI
									   <input type=radio name='level' value='STAFF'>STAFF
									   <input type=radio name='level' value='KADIS'>KEPALA DINAS
                                       </td></tr>";
    }
    elseif ($r[level]=='PEGAWAI'){
      echo "<tr><td>Level</td> <td> : <input type=radio name='level' value='KEPALA'>KEPALA BAGIAN
                                       <input type=radio name='level' value='PEGAWAI' checked>PEGAWAI
									   <input type=radio name='level' value='STAFF'>STAFF
									   <input type=radio name='level' value='KADIS'>KEPALA DINAS
                                       </td></tr>";
    }
	elseif ($r[level]=='STAFF'){
      echo "<tr><td>Level</td> <td> : <input type=radio name='level' value='KEPALA'>KEPALA BAGIAN
                                       <input type=radio name='level' value='PEGAWAI'>PEGAWAI
                                       <input type=radio name='level' value='STAFF' cheked>STAFF
									   <input type=radio name='level' value='KADIS'>KEPALA DINAS
                                       </td></tr>";
    }
	else {
      echo "<tr><td>Level</td> <td> : <input type=radio name='level' value='KEPALA'>KEPALA BAGIAN
                                       <input type=radio name='level' value='PEGAWAI'>PEGAWAI
                                       <input type=radio name='level' value='STAFF'>STAFF
									   <input type=radio name='level' value='KADIS' cheked>KEPALA DINAS
                                       </td></tr>";
    }
 //   else{
 //     echo "<tr><td>Level</td> <td> : <input type=radio name='level' value='KEPALA'>KEPALA BAGIAN
 //                                      <input type=radio name='level' value='PEGAWAI'>PEGAWAI
//									   <input type=radio name='level' value='STAFF'>STAFF
//									   <input type=radio name='level' value='KADIS'>KEPALA DINAS
 //                                      <input type=radio name='level' value='ADMIN' checked>ADMIN</td></tr>";
 //   }
//
    if ($r[status]=='N'){
      echo "<tr><td class='left'>Blokir</td>     <td> : <input type=radio name='blokir' value='Y'> Y   
                                           <input type=radio name='blokir' value='N' checked> N </td></tr>";
    }
    else{
      echo "<tr><td class='left'>Blokir</td>     <td> : <input type=radio name='blokir' value='Y' checked> Y  
                                          <input type=radio name='blokir' value='N'> N </td></tr>";
    }
     echo"<tr><td class='left' colspan=2>*) Apabila password tidak diubah, dikosongkan saja.<br />
                            **) NIP tidak bisa diubah.</td></tr>
          <tr><td colspan=2><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table></form>";
    break;
}
?>
