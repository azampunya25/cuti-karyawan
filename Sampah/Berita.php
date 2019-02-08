<article>
    <header>
        <h2>Berita</h2>
        <p>Pilih dan baca berita selengkapnya.</p>
    </header>

<?php
    $q = mysql_query("SELECT * from berita order by id_berita DESC");
    while($h = mysql_fetch_array($q)){
    $isi=substr($h['isi'],0,100);   
?>
<div>
    <h3><?php echo $h['judul'];?></h3>
    Tanggal Upload: <i><?php echo TanggalIndo($h['tgl']);?></i><br>
    <?php echo $isi ;?>
    <a href="?detail=<?php echo $h['id_berita'];?>">Baca selengkapnya</a>
</div>   <br><hr>
<?php } ?>
</article>