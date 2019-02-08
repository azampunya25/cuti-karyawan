<?php
include "config/koneksi.php";
//Berita Populer
echo "<class='welcome'>&nbsp;&nbsp;&nbsp;<strong>Berita Populer</strong>";
$berita=mysql_query("SELECT * FROM berita 
                    ORDER BY dibaca DESC LIMIT 2");
while($b=mysql_fetch_array($berita)){
    echo "<class='welcome'>&bull; <a href=?module=detailberita&id=$b[id_berita]> $b[judul]</a> ($b[dibaca])";
}
?>
