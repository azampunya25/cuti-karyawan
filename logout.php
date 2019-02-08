<?php
  session_start();
  session_destroy();

// Apabila setelah logout langsung menuju halaman utama website, aktifkan baris di bawah ini:
header('location:index.php');
//  header('location:');
?>
