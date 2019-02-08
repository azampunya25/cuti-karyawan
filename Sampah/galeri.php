Galeri Foto
<hr>
<div id="content">
    <?php
    $q = mysql_query("SELECT * from galeri order by id desc");
    while($h = mysql_fetch_array($q)){
    ?>
    <div class="box" align="center">
        <?php allfoto($h['foto']); ?><br>
        <?php echo"$h[nama_foto]"; ?>
    </div>
    <?php } ?>
    <div class=fix></div>
</div>