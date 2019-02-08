<article>
    <header>
        <h2>Cara Pendaftaran</h2>
        <p>Bagaimana mendaftar sebagai anggota pada Radio Amor?</p>
    </header>

<?php
    $q = mysql_query("SELECT * from radio where nama='cara'");
    $h = mysql_fetch_array($q);
        echo $h['konten'];
?>
</article>