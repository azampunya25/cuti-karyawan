<script language="javascript">
//	function isTGL() {
//		var dari=parseFloat(document.getElementById("dari").value);
//		var sampai=parseFloat(document.getElementById("sampai").value);
//		if(dari<=sampai) {
//      document.getElementById("cd").innerHTML="dari&lt;sampai";
//    }
//    else {
//      document.getElementById("cd").innerHTML="<b style='color:#f00'>dari&gt;sampai</b>";
//    }
//  }
//</script>

<script language="javascript">
function validasi(form){
  if (form.dari.value == ""){
    alert("Anda belum memilih tanggal awal!!");
    form.dari.focus();
    return (false);
  }
    if (form.sampai.value == ""){
    alert("Anda belum memilih tanggal akhir!!");
    form.sampai.focus();
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
   echo "<h2>Laporan Surat Masuk</h2>
          <form method=POST action='modul/mod_laporan/lmasuk.php' target='_blank' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'>
          <tr><td>Dari Tanggal</td><td> : <input type=text id='tgllap1' name='dari' required></td></tr>
          <tr><td>s/d Tanggal</td><td> : <input type=text id='tgllap2' name='sampai' required></td></tr>
          <tr><td colspan=2><input type=submit value=Proses >
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table>
          </form>";	  
    //break;
	
	echo "<h2>Laporan Surat Keluar</h2>
          <form method=POST action='modul/mod_laporan/lkeluar.php' target='_blank' enctype='multipart/form-data' onSubmit='return validasi(this)'>
          <table class='list'>
          <tr><td>Dari Tanggal</td><td> : <input type=text id='tgllap3' name='dari'></td></tr>
          <tr><td>s/d Tanggal</td><td> : <input type=text id='tgllap4' name='sampai'></td></tr>
          <tr><td colspan=2><input type=submit value=Proses >
          <input type=button value=Batal onclick=self.history.back()></td></tr>
          </table>
          </form>";	  
    break;
}
?>
