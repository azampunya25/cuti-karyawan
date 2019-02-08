<article>
    <header>
        <h2>Visi Dan Misi</h2>
        <p>Visi dan Misi Radio Stars.</p>
    </header>

<?php
    $q = mysql_query("SELECT * from radio where nama='visi'");
    $h = mysql_fetch_array($q);
        echo $h['konten'];
?>

    
    
</article>