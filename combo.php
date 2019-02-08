<?include "config/koneksi.php";
         $sql="SELECT * FROM jenis_cuti";
         $h=mysql_query($sql);
         //$getCombojenis_cuti = mysql_query($sql,$conn) or die ('Query Gagal');


?>

<html>
<head>
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

 </head>

<body>
<select name="jenis_cuti" id="cmbJenisCuti">
<option value="">---pilih---</option>
 <?php
  while($data=mysql_fetch_array($h))
  {
   echo "<option value=$data[kd_jcuti]>$data[nama_jcuti]</option>";  	}
 ?>
</select>
<img src="loading.gif" width="18" id="imgLoadMerk"/>
<select name="periode" id="cmbPeriode">
 <option value="----"></option>

</select>
</body>
</html>
