<style type="text/css">
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
</style>

<?php
include "config/koneksi.php";
  echo "<h1>Link Partner</h1><hr/>";
  $p      = new Paging;
  $batas  = 5;
  $posisi = $p->cariPosisi($batas);
  $terkini=mysql_query("select * from link ORDER by id_link DESC limit $posisi,$batas");
  $no =$posisi+1;					  
  echo "<ul>";
  echo "<table border='0px' cellpadding=2px>";
  while ($t = mysql_fetch_array($terkini)) {
  echo"<tr align='left'>
	   <td><a href='http://$t[url]' target='_blank'><img src='foto/foto_banner/$t[gambar]' width=45px height=45px style='float:right;padding-right:1px'; border=0></td>
	   <td class=link><a href='http://$t[url]' target='_blank'>$t[judul]</td>
	   </tr>";
	$no++;
}
echo "</table>";
    
?>
