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
	<link rel="stylesheet" href="datepicker/lib/css/default.css" />

	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.min.css">-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">

	


	

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
								<li><a href=?module=user>Pengguna</a></span></li>
								<li><a href=?module=banner>Link Partner</a></li>
								<li><a href=?module=kontak>Kontak</a></li>
							</ul>
						</li>
						<li><a>Publikasi</a>
							<ul>
								<li><a href=?module=kategori>Kategori</a></li>
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
									<li><a href=?module=pegawai class="dp_caption">Pegawai</a></li>
									<li><a href=?module=jabatan>Jabatan</a></li>
									<li><a href=?module=golongan>Golongan</a></li>
									<li><a href=?module=bagian>Bidang</a></li>
									<li><a href=?module=unit>Unit Kerja</a></li>
								</ul>
							</li>
							<li><a>Data Cuti</a>
								<ul>
									<li><a href=?module=jnscuti>Jenis Cuti</a></li>
									<!--<li><a href=?module=periode>Periode Cuti</a></li>-->
									<li><a href=?module=libur>Hari Libur</a></li>
									<li><a href=?module=lapadmin>Laporan</a></li>
								</ul>
							</li>
							<li><a>Galeri</a>
								<ul>
									<li><a href=?module=album>Album Foto</a></li>
									<li><a href=?module=galerifoto>Galeri Foto</a></li>
								</ul></li>
								<li><a href=?module=hubungi>Buku Tamu</a></li>
							</ul>
							<?php 
						}
	//---------------------------------------------------------------------KEPALA BIDANG----------------------------------------------------
						if ($_SESSION['leveluser']=='KEPALA'){
							?>
							<ul>
								<li><a href=?module=home>Home</a></li>
								<li><a href=?module=pegawaiview>Data Pegawai</a></li>
								<li><a href=?module=persetujuan_cuti>Persetujuan Cuti</a></li>
								<li><a href=?module=riwayat_cuti_all>Riwayat Cuti Pegawai</a></li>
							</ul>
							<?php } 
	//---------------------------------------------------------------------KEPALA DINAS----------------------------------------------------
							if ($_SESSION['leveluser']=='KADIS'){
								?>
								<ul>
									<li><a href=?module=home>Home</a></li>
									<li><a href=?module=pegawaiviewkadis>Data Pegawai</a></li>
									<li><a href=?module=persetujuan_cutikadis>Persetujuan Cuti</a></li>
									<li><a href=?module=riwayat_cuti_allkadis>Riwayat Cuti Pegawai</a></li>
								</ul>
								<?php } 
	//---------------------------------------------------------------------PEGAWAI---------------------------------------------------
								if($_SESSION['leveluser']=='PEGAWAI'){
									?>
									<ul>
										<li><a href=?module=home>Home</a></li>
										<li><a href=?module=datapribadi>Data Pribadi</a></li>
										<li><a href=?module=permohonan_cuti>Permohonan Cuti</a></li>
										<li><a href=?module=riwayat_cuti>Riwayat Permohonan Cuti</a></li>
										<li><a href=?module=cetakijin>Cetak Surat Ijin</a></li>
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
								<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
								<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/js/bootstrap.min.js"></script>-->
								<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

								<script type="text/javascript">
									$(document).ready(function(){
										$('#jabatan').DataTable();
									});
								</script>

							</body>
							</html>
							<?php
							?>