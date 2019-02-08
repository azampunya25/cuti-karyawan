<article>
    <header>
        <h2>Sejarah</h2>
        <p>Sejarah Berdirinya Radio Stars.</p>
    </header>
<?php
    $q = mysql_query("SELECT * from radio where nama='sejarah'");
    $h = mysql_fetch_array($q);
        echo $h['konten'];
?>
</article>