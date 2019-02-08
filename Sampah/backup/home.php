<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<html xmlns="#">
<head>
<title>Dinas Kelautan dan Perikanan Prov. Kalteng</title>
<script src="<?php echo "jsc/highphp/js/jquery.min.js" ?>" type="text/javascript"></script>
<script src="<?php echo "jsc/highphp/js/highcharts.js"?>" type="text/javascript"></script>
  
<link href="menu_source/stylesmenu.css" rel="stylesheet" type="text/css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="logoKKP.ico" />
<link rel="stylesheet" type="text/css" href="css/coin-slider.css" />
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/cufon-titillium-600.js"></script>
<script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="js/script.js"></script>
<script type="text/javascript" src="js/coin-slider.min.js"></script>
<link href="style.css" rel="stylesheet" type="text/css" />

<style>	
	ul.lof-main-wapper li{
		position:relative;	
	}
</style>

<link rel="stylesheet" href="<?php echo "js/lightbox/themes/default/jquery.lightbox.css" ?>" type="text/css" />
<script src="<?php echo "js/lightbox/jquery.lightbox.min.js" ?>" type="text/javascript"></script>
<script type="text/javascript">
		$(document).ready(function() {
		    $('.lightbox').lightbox();		    
		});
</script>
	  
<script src="<?php echo "js/clock.js" ?>" type="text/javascript"></script>
<script src="<?php echo "js/tabs.js" ?>" type="text/javascript"></script>
<script src="<?php echo "js/newsticker.js" ?>" type="text/javascript"></script>
</head>

<body>
<div class="main">
  <div class="header">
    <div class="header_resize">
      <div class="clr">
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
      </div> 
      <div id='cssmenu'>
        <ul>
          <li <?php echo ($_GET['module']=='home')?"class=active":""; ?> ><a href="?module=home"><span>Beranda</span></a></li>
          <li <?php echo (($_GET['module']=='sejarah')||($_GET['module']=='visimisi')||($_GET['module']=='tujuan')||($_GET['module']=='kompetensi'))?"class=active":""; ?> ><a><span>Profil</span></a>
              <ul>
                <li><b><a href="?module=sejarah">Sejarah</a></b></li>
                <li><b><a href="?module=visimisi">Visi Dan Misi</a></b></li>
                <li><b><a href="?module=tujuan">Struktur Organisasi</a></b></li>
                <li><b><a href="?module=kompetensi">Tugas & Fungsi</a></b></li>
              </ul>
          </li>
		   <li <?php echo ($_GET['module']=='berita')?"class=active":""; ?> ><a href="?module=berita"><span>Berita</span></a></li>          
          <li <?php echo ($_GET['module']=='galeri')?"class=active":""; ?>><a href="?module=galeri"><span>Galeri</span></a></li>
          <li <?php echo ($_GET['module']=='bukutamu')?"class=active":""; ?>><a href="?module=bukutamu"><span>Buku Tamu</span></a></li>
		  <li <?php echo ($_GET['module']=='info')?"class=active":""; ?>><a href='adminweb/index.php' target='_blank'><span>Login</span></a></li>
        </ul>
      </div>
      
      
      <div class="clr"></div>
    </div>
  </div>
  <div class="content">
  <div class="welcome"><marquee><span style="font:'Times New Roman', Times, serif"><strong>.::Selamat Datang di Website Dinas Kelautan dan Perikanan Prov. Kalteng::</strong>&nbsp; &nbsp;<?php include "banner.php" ?></span></marquee></div>
    <div class="content_resize">
      <div class="mainbar">
        <div class="article">
          <?php include "kanan.php" ?>
        </div>
      </div>
      <div class="sidebar">
        <div class="gadget">
          <?php include "kiri.php" ?>
		  
          <br/>

          <?php include "calendar.php" ?>
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c3">
        <?php include "contact.php" ?>
      </div>
      <div class="col c1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
      <div class="col c2">
        <?php include "link.php" ?>
        <ul class="fbg_ul">
          <li></li>
          <li></li>
          <li></li>
        </ul>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="footer">
    <div class="footer_resize">
      <p class="lf"><b>&copy; Copyright  <a href="#">2015</b></a>.</p>
      <p class="rf"><b>Design by <a href="#">All reserved</b></a></p>
      <div style="clear:both;"></div>
    </div>
  </div>
</div>
<div align=center>Copyright © 2015 by Dinas Kelautan dan Perikanan Prov. Kalteng. All rights reserved.</a></div>
</body>
</html>
