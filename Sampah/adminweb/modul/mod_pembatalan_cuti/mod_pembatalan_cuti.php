<?php
switch($_GET[act]){
  // Tampil Riwayat Cuti
  default:
    echo "<h2>Pembatalan Cuti</h2>";
     $s=mysql_query("SELECT 
	 pegawai.*,
	 jabatan.nm_jabatan,
	 golongan.*
	 FROM pegawai INNER JOIN jabatan ON jabatan.id_jabatan = pegawai.id_jabatan
	 INNER JOIN golongan ON golongan.id_gol = pegawai.id_gol
     WHERE pegawai.nip='$_SESSION[namauser]'");
     $r=mysql_fetch_array($s);

    echo"<table class='list' width=60%>
          <tr><td>Nip</td>         <td> : <input type=text name='nip' value='$r[nip]' readonly></td>
              <td>Jabatan</td>     <td> : <input type=text name='kd_jabatan' value='$r[nm_jabatan]' readonly></td>
			  			  <td>Golongan</td>     <td> : <input type=text name='kd_jabatan' value='$r[nm_pangkat]' readonly>
			  <input type=text name='kd_jabatan' value='$r[nm_gol]' size='3' readonly>
			  <input type=text name='kd_jabatan' value='$r[ruang]' size='3'readonly></td>
          </tr>
          <tr><td>Nama</td>         <td> : <input type=text name='nama' value='$r[nama]' readonly></td>
              <td>Tanggal Masuk</td><td> : <input type=text name='tgl_masuk' value='$r[tgl_masuk]' readonly></td>
          </tr></table>";
    echo"
	<table id='NoInfo' class='list display' cellspacing='0' width='100%'><thead>
          <tr><th class='center'>No</th>
          <th>Tahun</th>
          <th>Jenis Cuti</th>
          <th>Tanggal Mulai</th>
		  <th>Lama Cuti (Hari)</th>
		  <th>Sisa Cuti</th>
		  <th>Alasan</th>
          <th>Persetujuan Kabid</th>
		  <th>Persetujuan Kadis</th>
		  <th>Pembatalan</th>
		  </tr></thead><tbody>";

    $no=1;
    $s2=mysql_query("SELECT * FROM permohonan_cuti inner join jns_cuti on permohonan_cuti.id_jcuti=jns_cuti.id_jcuti
     WHERE permohonan_cuti.nip='$_SESSION[namauser]' and status_pengajuankadis='setuju'");
    while ($r2=mysql_fetch_array($s2)){
    echo"<tr><td class='center'>$no</td>
     		 <td class='center'>$r2[tahun]</td>
             <td class='left'>$r2[nm_jcuti]</td>
             <td class='center'>".tgl_indo($r2['tgl_mulai'])." s/d ".tgl_indo($r2['tgl_akhir'])."</td>
             <td class='center'>$r2[lama_cuti]</td>
             <td>";
             if($r2[sisa_cuti]<0){
             	echo "-";
             	}
             else{
             	echo $r2[sisa_cuti];
             	}
    echo"    </td>
             <td>$r2[alasan]</td>
             <td class='center'>$r2[status_pengajuan]</td>
			 <td class='center'>$r2[status_pengajuankadis]</td>
			 <td class='center'><a href='?module=pembatalan_cuti&act=detail&id=$r[id_sm]'>Detail</a></span></td>";
    $no++;
    }
    echo "</table>";
		    echo "<div class=>$linkHalaman</div><br>";
  break;
  
  case "detail":
    echo "<h2>Permohonan Cuti</h2>";
     $s=mysql_query("SELECT 
					 pegawai.*,
					 jabatan.nm_jabatan,
					 golongan.*,
					 DATE_FORMAT(tgl_masuk,'%d-%b-%Y') AS tgl_masuk
					 FROM pegawai INNER JOIN jabatan ON jabatan.id_jabatan = pegawai.id_jabatan
					 INNER JOIN golongan ON golongan.id_gol = pegawai.id_gol
					 WHERE nip='$_SESSION[namauser]'");
     $r=mysql_fetch_array($s);
     $thn=date('Y');
     $s1=mysql_query("SELECT * FROM periode_cuti WHERE nip='$_SESSION[namauser]'");
     $r1=mysql_fetch_array($s1);
    echo"<table class='list'>
        <tr><td >Nip</td><td> : 	<input type=text name='x' value='$r[nip]' readonly></td>
        <td>Jabatan</td><td> : 		<input type=text name='nm_jabatan' value='$r[nm_jabatan]' readonly></td>
		<td>Golongan</td><td>  : 	<input type=text name='nm_gol' value='$r[nm_gol]' size='2' readonly>
									<input type=text name='nm_pangkat' value='$r[nm_pangkat]' readonly>
									<input type=text name='ruang' value='$r[ruang]' size='2' readonly></td>
        </tr>
        <tr><td>Nama</td><td> : 			<input type=text name='nama' value='$r[nama]' readonly></td>
            <td>Tanggal Masuk</td><td> : 	<input type=text name='tgl_masuk' value='$r[tgl_masuk]'readonly></td>
        </tr>
        </table>";
    echo"<form method=POST name=cuti action=./aksi.php?module=permohonan_cuti&act=input enctype='multipart/form-data' onSubmit='return validasi(this)'>
         <table class='list'>
            <tr><td>Tahun</td><td> : 
			<input type='hidden' name='id_gol' value='$r[id_gol]' readonly>
			<input type='hidden' name='id_jabatan' value='$r[id_jabatan]' readonly>
			<input type='text' name='tahun' value='$thn' readonly></td>			
			<td class='center'><b>Keterangan</td></tr>
            <tr><td>Jenis Cuti</td><td> : <select name='jenis_cuti' id='cmbJenisCuti'>
            <option value='0'>----Jenis Cuti-----</option>";
                 $thn=date('Y');
                 $sj=mysql_query("SELECT * FROM jns_cuti");

                 while($rj=mysql_fetch_array($sj)){
                 echo "<option value='$rj[id_jcuti]'>$rj[nm_jcuti]</option>";
            }
            echo"</select>
            </td><td class='left' rowspan='8' width=200>
			1.Cuti Tahunan Max 12 Hari/Tahun diambil bagi setiap pegawai PNS dilingkup DKP.<br>
			2.Cuti Hamil/Cuti Bersalin Max 90 Hari/ 3 Bulan bagi setiap pegawai perempuan dilingkup DKP.<br>
			3.Cuti Alasan Penting Max 60 Hari/ 2 Bulan bagi setiap pegawai PNS dilingkup DKP.</td></tr>

            <tr><td>Tanggal mulai</td>	<td> 		: <input type='text' name='tgl_mulai' id='mohon1' ></td></tr>
            <tr><td>Tanggal akhir</td>	<td> 		: <input type='text' name='tgl_akhir' id='mohon2' ></td></tr>
            <tr><td>Alasan</td>			<td> 		: <textarea name='alasan' style='width: 270px; height: 100px;'></textarea></td></tr>
            <tr><td>Nip Atasan</td><td> 			: <input type='text' name='nip_atasan' value='$r[nip_atasan]' readonly></td></td></tr>
			<tr><td>Lampiran (Zip/Rar/Doc)</td><td> : <input type=file name='fupload' size=40></td></tr>
            <tr><td><input type='hidden' name='nip' value='$r[nip]'></td></tr>
            <tr><td><td><input type='submit' value='Simpan'>
         </table></form>";
	break;	


}
?>
