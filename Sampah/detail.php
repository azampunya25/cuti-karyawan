<article>
    

<?php
    $q = mysql_query("SELECT * from berita where id_berita='$_GET[detail]'");
    $h = mysql_fetch_array($q);   
?>
<header>
        <h2><?php echo $h['judul'];?></h2>
        <p>Tanggal Upload: <i><?php echo TanggalIndo($h['tgl']);?></i></p>
</header>
    <span class="image featured"><img src="data1/images/<?php echo $h['foto'];?>" alt="" /></span>
    
    <?php echo $h['isi'];?>

</article>