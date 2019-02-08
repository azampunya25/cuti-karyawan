 <script type="text/javascript" src="jquery144.min.js"></script>
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

<link rel="stylesheet" href="jq/development-bundle/themes/base/jquery.ui.all.css">
    <script src="jq/js/jquery-1.7.1.min.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.core.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.widget.js"></script>
    <script src="jq/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <!--<link rel="stylesheet" href="jq/development-bundle/demos/demos.css">-->
    <script>
    $(function() {

        $( "#tglmulai" ).datepicker({ altFormat: 'yy-mm-dd' });
        $( "#tglmulai" ).change(function() {
             $( "#tglmulai" ).datepicker( "option", "dateFormat","yy-mm-dd" );
         });

        $( "#tglakhir" ).datepicker({ altFormat: 'yy-mm-dd' });
        $( "#tglakhir" ).change(function() {
             $( "#tglakhir" ).datepicker( "option", "dateFormat","yy-mm-dd" );
         });

   });


    </script>


<?php
switch($_GET[act]){
  // Tampil Permohonan Cuti
  default:
    echo "<h2>Permohonan Cuti</h2>";
     $s=mysql_query("SELECT * FROM karyawan WHERE nik='$_SESSION[namauser]'");
     $r=mysql_fetch_array($s);
     $thn=date('Y');

     $s1=mysql_query("SELECT * FROM periode_cuti
     WHERE nik='$_SESSION[namauser]'");
     $r1=mysql_fetch_array($s1);

    echo"<table>
          <tr><td>Nip</td>         <td> : <input type=text name='nik' value='$r[nik]' readonly></td>
              <td>Jabatan</td>     <td> : <input type=text name='kd_jabatan' value='$r[kd_jabatan]' readonly></td>
          </tr>
          <tr><td>Nama</td>         <td> : <input type=text name='nama' value='$r[nama]' readonly></td>
              <td>Tanggal Masuk</td><td> : <input type=text name='tgl_masuk' value='$r[tgl_masuk]' readonly></td>
          </tr>
          </table>";
    echo"<form method=POST name=cuti action=./aksi.php?module=permohonan_cuti&act=input>
         <table>

            <tr><td>Tahun</td><td> : <input type='text' name='tahun' value='$r1[tahun]' readonly></td></tr>
            <tr><td>Periode Cuti Tahunan</td><td> :
            <input type='text' name='periodeawal' value=$r1[awalcuti] size=8 readonly> s/d
            <input type='text' name='periodeakhir' value=$r1[akhircuti] size=8 readonly></td></tr>
            <tr><td>Jenis Cuti</td><td> : <select name='jenis_cuti' id='cmbJenisCuti'>
            <option value=''>----Jenis Cuti-----</option>";
                 $thn=date('Y');
                 $sj=mysql_query("SELECT * FROM jenis_cuti");

                 while($rj=mysql_fetch_array($sj)){
                 echo "<option value='$rj[kd_jcuti]'>$rj[nama_jcuti]</option>";
            }
            echo"</select>
            </td></tr>
            <tr><td>Tanggal mulai</td><td> : <input type='text' name='tgl_mulai' id='tglmulai' value='0000-00-00'></td></tr>
            <tr><td>Tanggal akhir</td><td> : <input type='text' name='tgl_akhir' id='tglakhir' value='0000-00-00'></td></tr>
            <tr><td>Alasan</td><td> : <textarea name='alasan' cols='25' rows='3'></textarea></td></tr>
            <tr><td>Nip Atasan</td><td> : <input type='text' name='nik_atasan' value='$r[nik_atasan]' readonly></td></tr>
            <tr><td><input type='hidden' name='nik' value='$r[nik]'></td></tr>
            <tr><td><input type='submit' value='Simpan'>
         </table></form>";
  break;


}

?>

