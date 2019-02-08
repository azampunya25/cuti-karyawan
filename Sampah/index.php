<?php
include 'core.php';
atas();

            
                if (isset($_GET['Beranda'])){
?>
            <article>
                <header>
                    <h2>Berita</h2>
                    <p>Pilih dan baca berita selengkapnya.</p>
                </header>

<div id="wowslider-container1">
	<div class="ws_images">
        <ul>
<?php
    $q = mysql_query("SELECT * from berita order by id_berita DESC");
    while($h = mysql_fetch_array($q)){
    $isi=substr($h['isi'],0,30);   
?>
            <li><a href="?detail=<?php echo $h['id_berita'];?>"><img src="data1/images/<?php echo $h['foto'];?>"  title="<?php echo $h['judul'];?>" /></a><?php echo $isi ;?></li>
<?php } ?>            
	   </ul>
    </div>
	
</div>


<?php
    $senin = mysql_query("SELECT * from jadwal order by id desc limit 3");
    while($h1 = mysql_fetch_array($senin)){ 
?>
<div class="box" align="center">
        <?php allfoto($h1['cover']); ?><br>
        <?php echo"$h1[nama]"; ?>
        <p><?php echo"$h1[hari] "."$h1[pukul]"; ?></p>
    </div>
<?php } ?>
            </article>
<?php
                } else if (isset($_GET['Sejarah'])) {
                    include 'Sejarah.php';
                } else if (isset($_GET['Visi'])) {
                    include 'Visi.php';
                } else if (isset($_GET['Berita'])) {
                    include 'Berita.php';
                } else if (isset($_GET['Galeri'])) {
                    include 'galeri.php';
                } else if (isset($_GET['Jadwal'])) {
                    include 'jadwal.php';
                } else if (isset($_GET['detail'])) {
                    include 'detail.php';
                } else {
?>
            <article>
                <header>
                    <h2>Berita</h2>
                    <p>Sidebar on the right, content on the left.</p>
                </header>

<div id="wowslider-container1">
	<div class="ws_images">
        <ul>
<?php
    $q = mysql_query("SELECT * from berita order by id_berita DESC");
    while($h = mysql_fetch_array($q)){
    $isi=substr($h['isi'],0,30);   
?>
            <li><a href="?detail=<?php echo $h['id_berita'];?>"><img src="data1/images/<?php echo $h['foto'];?>" title="<?php echo $h['judul'];?>" /></a><a href="?detail=<?php echo $h['id_berita'];?>"><?php echo $isi ;?></a></li>
<?php } ?>            
	   </ul>
    </div>
	
</div>
                <?php
    $senin = mysql_query("SELECT * from jadwal order by id desc limit 3");
    while($h1 = mysql_fetch_array($senin)){ 
?>
<div class="box" align="center">
        <?php allfoto($h1['cover']); ?><br>
        <?php echo"$h1[nama]"; ?>
        <p><?php echo"$h1[hari] "."$h1[pukul]"; ?></p>
    </div>
<?php } ?>
                
            </article>
<?php
                }
    
kanan();    
bawah();
?>