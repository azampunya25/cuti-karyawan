<?php
$aksi="modul/mod_pengguna/aksi_pengguna.php";
switch($_GET[act]){
  // Tampil Pegawai
  default:
    echo "<h2>Pengguna</h2>
          <input type=button value='Tambah Pegawai' onclick=location.href='?module=pegawai&act=tambahpegawai'>
          <table class='list'><thead>
          <tr><td class='center'>no</td>
          <td class='center'>Foto Pegawai</td>
          <td class='center'>Nama Pegawai</td>
          <td class='center'>Kelamin</td>
		  <td class='center'>Alamat Tinggal</td>
		  <td class='center'>Status Pegawai</td>
          <td class='center'>aksi</td></tr></thead><tbody>";
		  
	$p      = new Paging;
    $batas  = 10;
    $posisi = $p->cariPosisi($batas);
	
    $tampil=mysql_query("SELECT * FROM pegawai ORDER BY nip DESC LIMIT $posisi,$batas");
    $no=$posisi+1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tgl_posting]);
      echo "<tr><td class='center' width='25'>$no</td>
				<td class='center' width='120'><img src='../foto/foto_pegawai/kecil_$r[gambar]'></td>
                <td class='left'>$r[nama]</td>
                <td class='left'>$r[kelamin]</td>
				<td class='left'>$r[almt_tinggal]</td>
				<td class='left'>$r[status_pegawai]</td>
                <td class='center' width='85'><a href=?module=pegawai&act=editpegawai&id=$r[nip]><img src='images/edit.png' border='0' title='edit' /></a>
	                  <a href='$aksi?module=pegawai&act=hapus&id=$r[nip]&namafile=$r[gambar]'><img src='images/del.png' border='0' title='hapus' /></a>
		        </tr>";
    $no++;
    }
    echo "</tbody></table>";
	
	$jmldata = mysql_num_rows(mysql_query("SELECT * FROM pegawai"));
  
    $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
    $linkHalaman = $p->navHalaman($_GET[halaman], $jmlhalaman);

    echo "<div class=pagination>$linkHalaman</div><br>";
 
    break;
  
  case "tambahpegawai":
      echo "<h2>Tambah Pegawai</h2>
          <form method=POST action='$aksi?module=pegawai&act=input' enctype='multipart/form-data'>
          <table class='list'><tbody>
          <tr><td class='left'>NIP</td>				<td class='left'> : <input type=text name='nip' size=20></td></tr>
		  <tr><td class='left'>Nama</td>			<td class='left'> : <input type=text name='nama' size=60></td></tr>
		  <tr><td class='left'>Jabatan</td><td class='left'> : 
				<select name='kd_jabatan'>
				<option value=0 selected>- Pilih Jabatan -</option>";
				$tampil=mysql_query("SELECT * FROM jabatan ORDER BY nm_jabatan");
				while($r=mysql_fetch_array($tampil)){
				  echo "<option value=$r[kd_jabatan]>$r[nm_jabatan]</option>";
				}
    echo "</select></td></tr>
		  <tr><td class='left'>Kelamin</td>			<td> : 	<input type=radio name='kelamin' value='P' checked>Pria  
															<input type=radio name='kelamin' value='W'> Wanita</td></tr>
		  <tr><td class='left'>Status Kawin</td>	<td> : 	<input type=radio name='status_kawin' value='TK' checked>Tidak Kawin  
															<input type=radio name='status_kawin' value='K'> Kawin</td></tr>
		  <tr><td>Pendidikan</td><td> : 
		  <select name='pendidikan'>
						<option value=- selected>Pilih Pendidikan</option>
						<option value=0>----------------------</option>
						<option value='SD'>SD</option>
						<option value='SMP'>SMP</option>
						<option value='SMA'>SMA</option>
						<option value='S1'>S1</option>
						<option value='S2'>S2</option>
						
		  </select> 
		  <tr><td>Alamat Tinggal</td>	<td class='left'> : <textarea name='almt_tinggal' style='width: 300; height: 50;'></textarea></td></tr>
		  <tr><td>Alamat Asal</td>		<td class='left'> : <textarea name='almt_asal' style='width: 300; height: 50;'></textarea></td></tr>
		  <tr><td class='left'>Tgl Masuk</td>		<td class='left'> : <input type=text name='tgl_masuk' size=60></td></tr>
		  <tr><td class='left'>Tgl Input</td>		<td class='left'> : <input type=text name='tgl_input' size=60></td></tr>
		  <tr><td>Status Pegawai</td><td> : 
		  <select name='status_pegawai'>
						<option value=- selected>Pilih Status</option>
						<option value=0>----------------------</option>
						<option value='Aktif'>Aktif</option>
						<option value='Cuti'>Cuti</option>
						<option value='Tidak Aktif'>Tidak Aktif</option>
		  </select>
          <tr><td class='left'>Gambar</td><td class='left'> : <input type=file name='fupload' size=40></td></tr>
          <tr><td colspan=2 'left'><input type=submit value=Simpan>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
     break;
    
  case "editpegawai":
    $edit = mysql_query("SELECT * FROM pegawai WHERE nip='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<h2>Edit Pegawai</h2>
          <form method=POST enctype='multipart/form-data' action=$aksi?module=pegawai&act=update>
          <input type=hidden name=id value=$r[nip]>
          <table class='list'><tbody>          
		  <tr><td class='left'>Nama</td><td class='left'>     : <input type=text name='nama' size=100 value='$r[nama]'></td></tr>
          <tr><td class='left'>Foto Pegawai</td><td class='left'>    : <img src='../foto/foto_pegawai/kecil_$r[gambar]'></td></tr>
          <tr><td class='left'>Ganti Foto</td><td class='left'> : <input type=file name='fupload' size=30> *)</td></tr>
          <tr><td colspan=2  class='left'>*) Apabila gambar tidak diubah, dikosongkan saja.</td></tr>
          <tr><td colspan=2  class='left'><input type=submit value=Update>
                            <input type=button value=Batal onclick=self.history.back()></td></tr>
          </tbody></table></form>";
    break;  
}
?>
