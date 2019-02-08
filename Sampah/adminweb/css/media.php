<?php
session_start();
error_reporting(0);
include "timeout.php";
?>
<html>
<head>
<title>Dinas Kelautan dan Perikanan Prov. Kalteng</title>
<script src="../tinymcpuk/jscripts/tiny_mce/tiny_mce.js" type="text/javascript"></script>
<script src="../tinymcpuk/jscripts/tiny_mce/tiny_lokomedia.js" type="text/javascript"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="shortcut icon" href="images/logoKKP.ico" />



<script src="datepicker/lib/jquery.min.js"></script>
<script src="datepicker/lib/zebra_datepicker.js"></script>
<link rel="stylesheet" href="datepicker/lib/css/default.css" />
<script>
//var $jnoc = jQuery.noConflict();
    $(document).ready(function(){
        $('#tanggal').Zebra_DatePicker({
              direction: true,
			  format : "d-m-Y",
				pair: $('#tanggal1')
        });
		        $('#tanggal1').Zebra_DatePicker({
					direction:1,
            format: "d-m-Y",

        });
		$('#tglsk').Zebra_DatePicker({
            dateformat: "yy-m-d"
			direction:1,
        });
				$('#tglsmed').Zebra_DatePicker({
            dateformat: "yy-m-d"
			direction:1,
        });
				$('#tglsmed1').Zebra_DatePicker({
            dateformat: "yy-m-d"
			direction:1,
        });
		$('#tanggal3').Zebra_DatePicker({
			direction : true;
            dateformat: "yy-m-d",
			pair: $('#tanggal4')
        });
		$('#tanggal4').Zebra_DatePicker({
            direction:1,
			dateformat: "yy-m-d",
        });
		$('#tanggal5').Zebra_DatePicker({
            dateformat: "yy-m-d",
			pair: $('#x')
        });
		$('#x').Zebra_DatePicker({
			direction:1,
            dateformat: "yy-m-d",
        });
    });
</script>

</head>
<body>
<div id="header">  	
	<div id="menu">
		<div class="left">
	<?php 
	if ($_SESSION['leveluser']=='ADMIN'){
	?>
		<ul>
        <li><a href=?module=home>Home</a></li>
        <li><a>Pengaturan</a>
			<ul>
				<li><a href=?module=user>Pengguna</a></li>
				<li><a href=?module=banner>Link Partner</a></li>
				<li><a href=?module=kontak>Kontak</a></li>
			</ul>
		</li>
				<li><a>Publikasi</a>
			<ul>
				<li><a href=?module=kategori>Kategori Berita</a></li>
				<li><a href=?module=berita>Berita</a></li>
                <li><a href=?module=komentar>Komentar</a></li>
			</ul>
		</li>		
        <li><a href=?module=halamanstatis>Profil</a></li>           
        <li><a>Surat-Surat</a>
			<ul>
				<li><a href=?module=suratmasuk>Surat Masuk</a></li>
				<li><a href=?module=suratkeluar>Surat Keluar</a></li>
				<li><a href=?module=historismasuk>Histori Surat Masuk</a></li>
				<li><a href=?module=historiskeluar>Histroi Surat Keluar</a></li>
				<li><a href=?module=laporan>Laporan</a></li>
			</ul></li>
		<li><a>Data Master</a>
			<ul>
				<li><a href=?module=pegawai>Pegawai</a></li>
				<li><a href=?module=jabatan>Jabatan</a></li>
				<li><a href=?module=golongan>Golongan</a></li>
			</ul>
		</li>
		<li><a>Data Cuti</a>
			<ul>
				<li><a href=?module=jnscuti>Jenis Cuti</a></li>
				<li><a href=?module=periode>Periode Cuti</a></li>
				<li><a href=?module=libur>Hari Libur</a></li>
			</ul>
		</li>
		        <li><a>Galeri</a>
        	<ul>
				<li><a href=?module=album>Album Foto</a></li>
				<li><a href=?module=galerifoto>Galeri Foto</a></li>
			</ul></li>
		<li><a href=?module=hubungi>Hubungi Kami</a></li>
		</ul>
	<?php 
	}
	//---------------------------------------------------------------------KEPALA----------------------------------------------------
	if ($_SESSION['leveluser']=='KEPALA'){
	?>
	<ul>
	<li><a href=?module=home>Home</a></li>
	<li><a href=?module=pegawaiview>Data Pegawai</a></li>
	<li><a href=?module=persetujuan_cuti>Pengajuan Cuti</a></li>
	<li><a href=?module=riwayat_cuti_all>Riwayat Cuti Pegawai</a></li>
	</ul>
	<?php } 
	//---------------------------------------------------------------------PEGAWAI---------------------------------------------------
	if($_SESSION['leveluser']=='PEGAWAI'){
	?>
	<ul>
	<li><a href=?module=home>Home</a></li>
	<li><a href=?module=datapribadi>Data Pribadi</a></li>
	<li><a href=?module=permohonan_cuti>Pengajuan Cuti</a></li>
	<li><a href=?module=riwayat_cuti>Arsip Pengajuan</a></li>
	<li><a href=?module=cetakijin>Cetak Pengajuan</a></li>
    </ul>
	<?php }
	if($_SESSION['leveluser']=='STAFF'){
	?>
	<ul>
	<li><a href=?module=home>Home</a></li>
	<li><a href=?module=suratmasuk>Surat Masuk</a></li>
	<li><a href=?module=suratkeluar>Surat Keluar</a></li>
	<li><a href=?module=historismasuk>Histori Surat Masuk</a></li>
	<li><a href=?module=historiskeluar>Histori Surat Keluar</a></li>
	<li><a href=?module=laporan>Laporan Surat</a></li>
    </ul>
	<?php } ?>
		</div>
		<div class="right">
		 <ul class="topmenu">
		 <li><a target='_blank' href=../index.php>View Web</a></li>
		 <li><a href=logout.php>Logout</a></li></ul>
		</div>
	</div>
</div>
<div id="wrap">
  <div id="content">
		<?php include "content.php"; ?>
  </div>
  
		<div id="footer">
			Copyright &copy; 2015 by Dinas Kelautan dan Perikanan Prov. Kalteng. All rights reserved.
		</div>
</div>
</body>
</html>
<?php
?>