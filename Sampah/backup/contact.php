<style type="text/css">
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
</style>

<?php
include "config/koneksi.php";
  echo "<h1>Kontak</h1><hr/><br/><br/>";
  $p      = new Paging;
  $batas  = 3;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("select * from kontak ORDER by id_kontak DESC limit $posisi,$batas");

	while($t=mysql_fetch_array($terkini)){
	 echo "<table width='430px' style='margin-top:-190px;'>
	        <td colspan=2><span class=judul></span></td><td rowspan=13 valign='top'></td><br/>";
	 echo "<tr><td><strong>Alamat<strong></td><td>:&nbsp;&nbsp;<strong>$t[alamat]</strong></td></tr><br/>
		  <br/>
		  <tr><td><strong>Telepon</strong></td><td>:&nbsp;&nbsp;<strong>$t[telp]</strong></td></tr><br/>
		  <br/>
		  <tr><td><strong>Fax</strong></td><td>:&nbsp;&nbsp;<strong>$t[fax]</strong></td></tr><br/>
		  <br/>
		  <tr><td><strong>Email</strong></td><td>:&nbsp;&nbsp;<strong><a href='http://$t[email]' target='_blank'>$t[email]</strong></td></tr><br/><br/></table>";
		  }
?>
