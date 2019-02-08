<?php 
session_start();
include "koneksi.php";
include "function.php"; 
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) ){ 
echo "<script> window.location = 'login.php'</script>";
};
?>

<!DOCTYPE html>
<!--
Template Name: Admin Lab Dashboard build with Bootstrap v2.3.1
Template Version: 1.2
Author: Mosaddek Hossain
Website: http://thevectorlab.net/
-->
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
	<meta charset="utf-8" />
	<title> ADMIN </title>
	<?php header_admin(); ?>
	<!-- BEGIN CONTAINER -->
	<div id="container" class="row-fluid">
	<?php menu_utama(); ?>
		<!-- BEGIN PAGE -->
		<div id="main-content">
			<!-- BEGIN PAGE CONTAINER-->
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
					
					<!-- BEGIN THEME CUSTOMIZER-->
						
						<!-- END THEME CUSTOMIZER-->
                    
                       
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Dashboard
							<small>statistics and more</small>
						</h3>
						<ul class="breadcrumb">
							<li>
                                <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
							</li>
                            <li>
                                <a href="#">Admin Web</a> <span class="divider">&nbsp;</span>
                            </li>
							<li><a href="#">Dashboard</a><span class="divider-last">&nbsp;</span></li>
                           
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div id="page" class="dashboard">
				
                    <!--BEGIN NOTIFICATION-->
                    <div class="alert alert-info">
                        <button data-dismiss="alert" class="close">×</button>
                         Selamat datang <strong>Admin</strong>. Silahkan memodifikasi semua data & fitur yang ada pada website ini. Berikut data Statistik Web Pendaftaran Radio Mora :
                    </div>
                    <!--END NOTIFICATION-->
                    
					<!-- BEGIN OVERVIEW STATISTIC BARS-->
                   
                    <!-- END OVERVIEW STATISTIC BARS-->

                  
	</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	    </div>
	<!-- END CONTAINER -->
	<?php footer(); ?>