<style type="text/css">
a {
	font-family: Tahoma, Geneva, sans-serif;
	font-size: 12px;
}
</style>


<table width=150% cellspacing=5>
<?php
include "config/koneksi.php";
//Cari Berita
echo "<table class='cari' width=100%>";
echo "<td><span><form method='get' action='home.php'><img src='images/cari.ico' width=20px height=20px style='border:1px;float:left;padding-right:5px;'/>
	  <input type='text' name='judul' value='Cari Berita' />
	  <input type='submit' name='cari' value='Cari' /><input type='hidden' name='module' value='berita'/>
	  </form></span></td>";

	if(isset($_GET['judul'])){
		$where="where judul like '%$_GET[judul]%'";
	}else{
		$where="";

	}
echo "</table><hr color='#d5d5d5' noshade='noshade' /><br/><br/>";
?>

<?php
//Berita Populer
echo "<span class='judulkiri'><img src='images/beritapopuler.jpg'></span><br />";
$berita=mysql_query("SELECT * FROM berita 
                    ORDER BY dibaca DESC LIMIT 5");
while($b=mysql_fetch_array($berita)){
	echo"<table width='100%'>";
    echo "<td class=jdl>&bull;</td><td><span class=jdl><a href=?module=detailberita&id=$b[id_berita]>$b[judul]</a>&nbsp;&nbsp;&nbsp;&nbsp;($b[dibaca])</td></span><br />";
	echo"</table>";
	}

?>

<br/>
<br/>
<?php

// Menu Kategori
echo "<span class='judulkiri'><img src='images/kategori.jpg'></span><br /><br />";
$kategori=mysql_num_rows(mysql_query("select * from kategori"));
// Apabila modul Kategori diaktifkan Publish=Y, maka tampilkan modul Kategori
if ($kategori > 0){
  $kategori=mysql_query("SELECT kategori .*, 
	kategori.id_kategori, 
	COUNT(berita.id_kategori) AS jml 
        FROM kategori INNER JOIN berita ON kategori.id_kategori=berita.id_kategori 
                         GROUP BY nama_kategori DESC LIMIT 5");
  //select kategori, kategori.id_kategori,   
                         //count(berita.id_kategori) as jml 
                        // from kategori left join berita 
                        // on berita.id_kategori=kategori.id_kategori 
                         //group by kategori DESC LIMIT 5
  while($k=mysql_fetch_array($kategori)){
    echo "<span class=judul>&bull; <a href='?module=detailkategori&id=$k[id_kategori]'> $k[nama_kategori] </a> ($k[jml])</span><br />";
}
	}
?>


<br/>
<br/>
</table>
