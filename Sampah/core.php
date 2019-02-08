<?php
function atas(){
    require_once("dbcontroller.php");
    $db_handle = new DBController();
?>
<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>Radio</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
        <link rel="stylesheet" type="text/css" href="engine1/style.css" />
        <script type="text/javascript" src="engine1/jquery.js"></script>
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
						<h1><a id="logo">Radio <em>STARS</em> 91.6 fm</a></h1>

					<!-- Nav -->
<?php
    function nav($data){
        if (isset($_GET[$data])){$a="current";}else{$a="";}
        echo $a;
    }
?>
						<nav id="nav">
							<ul>
								<li class="<?php nav(Beranda);?>"><a href="?Beranda">Beranda</a></li>
								<li>
									<a href="#">Profil</a>
									<ul>
										<li><a href="?Sejarah">Sejarah</a></li>
										<li><a href="?Visi">Visi Dan Misi</a></li>
								    </ul>
								</li>
								<li class="<?php nav(Berita);?>"><a href="?Berita">Berita</a></li>
								<li class="<?php nav(Galeri);?>"><a href="?Galeri">Galeri</a></li>
								<li class="<?php nav(Jadwal);?>"><a href="?Jadwal">Radio Streaming</a></li>
							</ul>
						</nav>

				</div>

			<!-- Main -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row 200%">
							<div class="8u 12u(narrower)">
								<div id="content">
<?php
}
function kanan(){
?>
                                    
								</div>
							</div>
							<div class="4u 12u(narrower)">
								<div id="sidebar">
<?php
    date_default_timezone_set("Asia/Jakarta");
    $tanggal = date('d-m-Y');
$day = date('D', strtotime($tanggal));
$dayList = array(
	'Sun' => 'Minggu',
	'Mon' => 'Senin',
	'Tue' => 'Selasa',
	'Wed' => 'Rabu',
	'Thu' => 'Kamis',
	'Fri' => 'Jumat',
	'Sat' => 'Sabtu'
);
    ?>
									<!-- Sidebar -->
                                    <table class="default">
                                        <thead>
                                            <th colspan="2">Jadwal Hari Ini, <?php echo $dayList[$day]." {$tanggal}";?></th>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                    
    $q= mysql_query("SELECT * from jadwal where hari='$dayList[$day]'");
    $cek=mysql_num_rows($q);
if($cek==0){echo"<td colspan='2'>Tidak Ada Jadwal Hari ini<td>";}else{
    while($h = mysql_fetch_array($q)){ 
    echo"<td>$h[nama]</td><td>$h[pukul]</td>";
    } }?>
                                                </tr>
                                            </tbody>
                                    </table><br>
                                    
                                    <table class="default">
                                        <thead>
                                            <th colspan="2">Kontak Kami</th>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Pin BBM</td><td>43dsr7</td>
                                                </tr>
                                                <tr>
                                                    <td>HP</td><td>0812345678</td>
                                                </tr>
                                                <tr>
                                                    <td>Email</td><td>Email@gmail.com</td>
                                                </tr>
                                            </tbody>
                                    </table>

								</div>
							</div>
						</div>
					</div>
				</section>
<?php    
}
function bawah(){
?>
			<!-- Footer -->
				<div id="footer">
					<div class="container" align="center">
<?php
     if (isset($_POST['pesan'])) {
         $nama=$_POST['name'];
         $email=$_POST['email'];
         $isi=$_POST['message'];
         $waktu= date("Y/m/d");
         $q=mysql_query("insert into pesan (nama,email,isi,waktu)values('$nama','$email','$isi','$waktu')"); 
         if($q){ ?>
                <script>alert("Pesan Berhasil Dikirim Ke Admin Radio Stars");</script>
             <?php
         }else{
             ?>
                <script>alert("Gagal Kirim Pesan");</script>
             <?php
         }
     }
    ?>	
								<h3>.: Buku Tamu :.</h3>
								<form>
									<div class="row 50%">
										<div class="6u 12u(mobilep)">
											<input type="text" name="name" id="name" placeholder="Nama" required/>
										</div>
										<div class="6u 12u(mobilep)">
											<input type="email" name="email" id="email" placeholder="Email" required/>
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<textarea name="message" id="message" placeholder="Pesan" rows="5" required></textarea>
										</div>
									</div>
									<div class="row 50%">
										<div class="12u">
											<ul class="actions">
												<li><input type="submit" name="pesan" class="button alt" value="Kirim" /></li>
											</ul>
										</div>
									</div>
								</form>
							
					</div>

					<!-- Icons -->
						

					<!-- Copyright -->
						<div class="copyright">
							<ul class="menu">
								<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
							</ul>
						</div>

				</div>

		</div>
	<script type="text/javascript" src="engine1/wowslider.js"></script>
	<script type="text/javascript" src="engine1/script.js"></script>  
		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>
        
        <!-- fancybox bob-->
        	<!-- Add jQuery library -->
	<script type="text/javascript" src="lib/jquery-1.10.1.min.js"></script>

	<!-- Add mousewheel plugin (this is optional) -->
	<script type="text/javascript" src="lib/jquery.mousewheel-3.0.6.pack.js"></script>

	<!-- Add fancyBox main JS and CSS files -->
	<script type="text/javascript" src="source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="source/jquery.fancybox.css?v=2.1.5" media="screen" />

	<!-- Add Button helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
	<script type="text/javascript" src="source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>

	<!-- Add Thumbnail helper (this is optional) -->
	<link rel="stylesheet" type="text/css" href="source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
	<script type="text/javascript" src="source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>

	<!-- Add Media helper (this is optional) -->
	<script type="text/javascript" src="source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

	<script type="text/javascript">
		$(document).ready(function() {
			/*
			 *  Simple image gallery. Uses default settings
			 */

			$('.fancybox').fancybox();

			/*
			 *  Different effects
			 */

			// Change title type, overlay closing speed
			$(".fancybox-effects-a").fancybox({
				helpers: {
					title : {
						type : 'outside'
					},
					overlay : {
						speedOut : 0
					}
				}
			});

			// Disable opening and closing animations, change title type
			$(".fancybox-effects-b").fancybox({
				openEffect  : 'none',
				closeEffect	: 'none',

				helpers : {
					title : {
						type : 'over'
					}
				}
			});

			// Set custom style, close if clicked, change title type and overlay color
			$(".fancybox-effects-c").fancybox({
				wrapCSS    : 'fancybox-custom',
				closeClick : true,

				openEffect : 'none',

				helpers : {
					title : {
						type : 'inside'
					},
					overlay : {
						css : {
							'background' : 'rgba(238,238,238,0.85)'
						}
					}
				}
			});

			// Remove padding, set opening and closing animations, close if clicked and disable overlay
			$(".fancybox-effects-d").fancybox({
				padding: 0,

				openEffect : 'elastic',
				openSpeed  : 150,

				closeEffect : 'elastic',
				closeSpeed  : 150,

				closeClick : true,

				helpers : {
					overlay : null
				}
			});

			/*
			 *  Button helper. Disable animations, hide close button, change title type and content
			 */

			$('.fancybox-buttons').fancybox({
				openEffect  : 'none',
				closeEffect : 'none',

				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,

				helpers : {
					title : {
						type : 'inside'
					},
					buttons	: {}
				},

				afterLoad : function() {
					this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
				}
			});


			/*
			 *  Thumbnail helper. Disable animations, hide close button, arrows and slide to next gallery item if clicked
			 */

			$('.fancybox-thumbs').fancybox({
				prevEffect : 'none',
				nextEffect : 'none',

				closeBtn  : false,
				arrows    : false,
				nextClick : true,

				helpers : {
					thumbs : {
						width  : 50,
						height : 50
					}
				}
			});

			/*
			 *  Media helper. Group items, disable animations, hide arrows, enable media and button helpers.
			*/
			$('.fancybox-media')
				.attr('rel', 'media-gallery')
				.fancybox({
					openEffect : 'none',
					closeEffect : 'none',
					prevEffect : 'none',
					nextEffect : 'none',

					arrows : false,
					helpers : {
						media : {},
						buttons : {}
					}
				});

			/*
			 *  Open manually
			 */

			$("#fancybox-manual-a").click(function() {
				$.fancybox.open('1_b.jpg');
			});

			$("#fancybox-manual-b").click(function() {
				$.fancybox.open({
					href : 'iframe.html',
					type : 'iframe',
					padding : 5
				});
			});

			$("#fancybox-manual-c").click(function() {
				$.fancybox.open([
					{
						href : '1_b.jpg',
						title : 'My title'
					}, {
						href : '2_b.jpg',
						title : '2nd title'
					}, {
						href : '3_b.jpg'
					}
				], {
					helpers : {
						thumbs : {
							width: 75,
							height: 50
						}
					}
				});
			});


		});
	</script>
	<style type="text/css">
		.fancybox-custom .fancybox-skin {
			box-shadow: 0 0 50px #222;
		}

	</style>

	</body>
</html>            
<?php            
}


function TanggalIndo($date){
    $BulanIndo = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    
    if ($date=="0000-00-00"){}else{
    $tahun = substr($date, 0, 4);
    $bulan = substr($date, 5, 2);
    $tgl   = substr($date, 8, 2);

    $result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;		
    echo $result;
    }
}

    function random($panjang)
{
   $pengacak = 'ABCDEFGHIJKLMNOPQRSTU1234567890';
   $string = '';
   for($i = 0; $i < $panjang; $i++) {
   $pos = rand(0, strlen($pengacak)-1);
   $string .= $pengacak{$pos};
   }
    return $string;
}
?>
<?php function foto($foto) { ?>
<a class="fancybox" href="<?php echo $foto; ?>" data-fancybox-group="gallery" ><?php echo $foto; ?></a>
<?php } ?>
<?php function allfoto($foto) { ?>
<a class="fancybox" href="<?php echo $foto; ?>" data-fancybox-group="gallery" ><img src="<?php echo $foto; ?>" width="80%"></a>
<?php } ?>