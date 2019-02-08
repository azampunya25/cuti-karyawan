 <script type="text/javascript" src="../js/jquery144.min.js"></script>
 <script type="text/javascript">
$(function() {
	$("#cmbJenisCuti").change(getAjaxJenisCuti);
	function getAjaxJenisCuti(){
		$("img#imgLoadMerk").show();
		var idJenisCuti = $("#cmbJenisCuti").val();

		$.ajax({
		   type: "POST",
		   dataType: "html",
		   url : "getPeriode.php",

		   data: "idJenisCuti="+idJenisCuti,
		   success: function(msg){
			  if(msg == ''){
					$("select#cmbPeriode").html('<option value="">--Pilih Periode--</option>');
			  }else{
			  		$("select#cmbPeriode").html(msg);
			  }
			  $("img#imgLoadMerk").hide();
		   }
		});
	}
});
</script>

<script language="javascript">
function validasi(form){
	if (form.tahun.value == ""){
    alert("Belum ada tahun cuti, silahkan hubungi admin/staff...!!");
    form.tahun.focus();
    return (false);
  }
	if (form.jenis_cuti.value == "0"){
    alert("Anda belum memilih jenis cuti...!!");
    form.jenis_cuti.focus();
    return (false);
  }
	if (form.tgl_mulai.value == ""){
    alert("Anda belum memilih tanggal mulai...!!");
    form.tgl_mulai.focus();
    return (false);
  }
    if (form.tgl_akhir.value == ""){
    alert("Anda belum memilih tanggal akhir...!!");
    form.tgl_akhir.focus();
    return (false);
  }

    if (form.alasan.value == ""){
    alert("Anda belum mengisikan alasan cuti anda...!!");
    form.alasan.focus();
    return (false);
  }
        if (form.fupload.value == ""){
    alert("Anda upload data");
    form.fupload.focus();
    return (false);
  }
}
</script>

<?php
$aksi="modul/mod_permohonan_cuti/aksi_permohonan.php";
switch($_GET[act]){
  // Tampil Permohonan Cuti
  default:
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
	//DATE_FORMAT(tgl_masuk,'%d-%b-%Y') AS tgl_masuk
     $s1=mysql_query("SELECT * FROM periode_cuti WHERE nip='$_SESSION[namauser]'");
     $r1=mysql_fetch_array($s1);
	//, DATE_FORMAT(awalcuti,'%d-%b-%Y') AS awalcuti, DATE_FORMAT(akhircuti,'%d-%b-%Y') AS akhircuti
				//<tr><td>Sisa Cuti</td>	<td> 		: <input type='text' name='sisa' >*)Tahunan<br>
			//: <input type='text' name='sisa' >*)Hamil<br>
			//: <input type='text' name='sisa' >*)Alasan Penting<br></td></tr>
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

