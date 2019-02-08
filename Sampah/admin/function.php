<?php 
function header_admin() {
?>
<meta content='width=device-width, initial-scale=1.0' name='viewport' />
		<meta content='' name='description' />
		<meta content='' name='author' />
		<link rel='icon' type='image/png' href='FP/a12.png'>
	
	<link href='assets/bootstrap/css/bootstrap.min.css' rel='stylesheet' />
	<link href='assets/bootstrap/css/bootstrap-responsive.min.css' rel='stylesheet' />
	<link href='assets/font-awesome/css/font-awesome.css' rel='stylesheet' />
	<link href='css/style.css' rel='stylesheet' />
	<link href='css/style_responsive.css' rel='stylesheet' />
	
	<link href='css/style_purple.css' rel='stylesheet' id='style_color' />
	
	<script src='assets/fancybox/source/jquery.fancybox.pack.js'></script>
	<link href='assets/fancybox/source/jquery.fancybox.css' rel='stylesheet' />
	<link rel='stylesheet' type='text/css' href='assets/uniform/css/uniform.default.css' />
	<link href='assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css' rel='stylesheet' />
	<link href='assets/jqvmap/jqvmap/jqvmap.css' media='screen' rel='stylesheet' type='text/css' />
	<script src="assets/ckeditor/ckeditor.js"></script>
    <script src="assets/ckfinder/ckfinder.js"></script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class='fixed-top'>
	<!-- BEGIN HEADER -->
    <div id='header' class='navbar navbar-inverse navbar-fixed-top'>
        <!-- BEGIN TOP NAVIGATION BAR -->
        <div class='navbar-inner'>
            <div class='container-fluid'>
                <!-- BEGIN LOGO -->
                <a class='brand' href='#'>
                    ADMIN Stars
                </a>
                <!-- END LOGO -->
                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                <a class='btn btn-navbar collapsed' id='main_menu_trigger' data-toggle='collapse' data-target='.nav-collapse'>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='arrow'></span>
                </a>
                <!-- END RESPONSIVE MENU TOGGLER -->
                <div id='top_menu' class='nav notify-row'>
                    <!-- BEGIN NOTIFICATION -->
                    <ul class='nav top-menu'>
                   
					
					
					
					<li class='dropdown' id='header_notification_bar'>

                </div>
                <!-- END  NOTIFICATION -->
                <div class='top-nav '>
                    <ul class='nav pull-right top-menu' >
                      
					  
					  
                        <!-- BEGIN USER LOGIN DROPDOWN -->
                        <li class='dropdown'>
                            <a href='#' class='dropdown-toggle' data-toggle='dropdown'>
                                <img src='img/avatar-mini.png' alt=''>
                                <?php
								$nama = $_SESSION['username'];
								$sql= mysql_query("select * from admin where nm_login='$nama' ");
								while ($isi= mysql_fetch_array($sql)){
								$nama = $isi['nama']; 
								$id = $isi['id_admin']; 
								}
    ?>
								
								
								
								
                                <span class='username'>Hai, <?php echo $nama; ?></span>
                                <b class='caret'></b>
                            </a>
                            <ul class='dropdown-menu'>
                                <li><a href='admin_profil.php'><i class='icon-user'></i> My Profile</a></li>
                                <li class='divider'></li>
                                <li><a href='logout.php'><i class='icon-key'></i> Log Out</a></li>
                            </ul>
                        </li>
                        <!-- END USER LOGIN DROPDOWN -->
                    </ul>
                    <!-- END TOP NAVIGATION MENU -->
                </div>
            </div>
        </div>
        <!-- END TOP NAVIGATION BAR -->
    </div>
	<!-- END HEADER -->
    
 <?php   
};
function menu_utama() {
echo "	<!-- BEGIN SIDEBAR -->
		<div id='sidebar' class='nav-collapse collapse'>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
			<div class='sidebar-toggler hidden-phone'></div>
			<!-- BEGIN SIDEBAR TOGGLER BUTTON -->

			
			<!-- BEGIN SIDEBAR MENU -->
            <ul class='sidebar-menu'>
                <li>
                    <a href='index.php' class=''>
                        <span class='icon-box'> <i class='icon-dashboard'></i></span> Dashboard
                      
                    </a>
                   
                </li>
				
				<li>
                    <a href='admin_profil.php' class=''>
                        <span class='icon-box'> <i class='icon-cog'></i></span>Kelola Profil Admin
            
                </li>
	
				
				<li>
                    <a href='profil_web.php' class=''>
                        <span class='icon-box'> <i class='icon-globe'></i></span>Kelola Profil Web
            
                </li>
				
				<li>
                    <a href='berita.php' class=''>
                        <span class='icon-box'> <i class='icon-bullhorn'></i></span>Kelola Berita
            
                </li>
				
				<li>
                    <a href='galeri.php' class=''>
                        <span class='icon-box'> <i class='icon-user'></i></span>Kelola Galeri
            
                </li>
                
                <li>
                    <a href='jadwal.php' class=''>
                        <span class='icon-box'> <i class='icon-edit'></i></span>Kelola Jadwal
            
                </li>
				
				<li>
                    <a href='pesan.php' class=''>
                        <span class='icon-box'> <i class='icon-envelope'></i></span>Kelola Pesan
            
                </li>
				
				

                
            </ul>
			<!-- END SIDEBAR MENU -->
		</div>
		<!-- END SIDEBAR -->";
};
function footer() {
?>
<!-- BEGIN FOOTER -->
	<div id='footer'>
        2016 &copy; Admin Dashboard.
		<div class='span pull-right'>
			<span class='go-top'><i class='icon-arrow-up'></i></span>
		</div>
	</div>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS -->
	<!-- Load javascripts at bottom, this will reduce page load time -->
	<script src='js/jquery-1.8.3.min.js'></script>
	<script src='assets/bootstrap/js/bootstrap.min.js'></script>
	<script src='assets/fancybox/source/jquery.fancybox.pack.js'></script>
	<script src='js/jquery.blockui.js'></script>
	<!-- ie8 fixes -->
	<!--[if lt IE 9]>
	<script src='js/excanvas.js'></script>
	<script src='js/respond.js'></script>
	<![endif]-->
	
   <script type='text/javascript' src='assets/data-tables/jquery.dataTables.js'></script>
   <script type='text/javascript' src='assets/data-tables/DT_bootstrap.js'></script>
   
	<script type='text/javascript' src='assets/uniform/jquery.uniform.min.js'></script>	
	<script type='text/javascript' src='assets/chosen-bootstrap/chosen/chosen.jquery.min.js'></script>
	<script src='js/scripts.js'></script>
        
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
	

	<script>
		jQuery(document).ready(function() {			
			// initiate layout and plugins
			App.init();
		});
	</script>
   <script language="javascript">
CKEDITOR.env.isCompatible = true;
CKEDITOR.replace( 'editor1', {
    filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: 'assets/ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl: 'assets/ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
    toolbar: [                                                                  
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Templates' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
    '/',
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    { name: 'insert', items: [ 'Image', 'Flash', 'Video', 'Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
    ]
} );</script>
        <script language="javascript">
CKEDITOR.replace( 'editor2', {
    filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: 'assets/ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl: 'assets/ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
} );</script>
        <script language="javascript">
CKEDITOR.replace( 'editor3', {
    filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: 'assets/ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl: 'assets/ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
} );</script>
        <script language="javascript">
CKEDITOR.replace( 'editor4', {
    filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
    filebrowserImageBrowseUrl: 'assets/ckfinder/ckfinder.html?type=Images',
    filebrowserFlashBrowseUrl: 'assets/ckfinder/ckfinder.html?type=Flash',
    filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
    filebrowserImageUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
    filebrowserFlashUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash'
} );</script>
        
	<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
<?php
};

function allfoto($foto) { ?>
<a class="fancybox" href="../<?php echo $foto; ?>" data-fancybox-group="gallery" ><img src="../<?php echo $foto; ?>" width="60px"></a>
<?php } ?>
<?php
function foto($foto) { ?>
<a class="fancybox" href="<?php echo $foto; ?>" data-fancybox-group="gallery" ><?php echo $foto; ?></a>
<?php } ?>