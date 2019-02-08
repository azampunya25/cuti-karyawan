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
	<title> Admin - Profil WEB</title>
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
                    
                       
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Dashboard
							<small>Halaman Kelola Profil WEB</small>
						</h3>
						<ul class="breadcrumb">
							<li>
                                <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
							</li>
                            <li>
                                <a href="#">Admin Web</a> <span class="divider">&nbsp;</span>
                            </li>
							<li><a href="#">Kelola Profil Website</a><span class="divider-last">&nbsp;</span></li>
                           
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div id="page" class="dashboard">
                    <!--BEGIN NOTIFICATION-->
                    <div class="alert alert-info">
                        <button data-dismiss="alert" class="close">+</button>
                         Selamat datang <strong>Admin</strong>. Silahkan memodifikasi Profil Website Pendaftaran Radio Mora.
                    </div>
					 <!--END NOTIFICATION-->
<?php
  if (isset($_POST['ts'])) {
      $seja=$_POST['sejarah'];
    $q=mysql_query("update radio set konten='$seja' where nama='sejarah'");
    if($q){
                ?>
                <script>
                alert('Berhasil');
                </script>    
                <?php
                  }else{
                 ?>
                <script>
                alert('ERROR!');
                </script>   
                <?php
        }  
    }   
    if (isset($_POST['tv'])) {
      $seja=$_POST['visi'];
    $q=mysql_query("update radio set konten='$seja' where nama='visi'");
    if($q){
                ?>
                <script>
                alert('Berhasil');
                </script>    
                <?php
                  }else{
                 ?>
                <script>
                alert('ERROR!');
                </script>   
                <?php
        }  
    }
    if (isset($_POST['tc'])) {
      $seja=$_POST['cara'];
    $q=mysql_query("update radio set konten='$seja' where nama='cara'");
    if($q){
                ?>
                <script>
                alert('Berhasil');
                </script>    
                <?php
                  }else{
                 ?>
                <script>
                alert('ERROR!');
                </script>   
                <?php
        }  
    }
    if (isset($_POST['tk'])) {
      $seja=$_POST['kontak'];
    $q=mysql_query("update radio set konten='$seja' where nama='kontak'");
    if($q){
                ?>
                <script>
                alert('Berhasil');
                </script>    
                <?php
                  }else{
                 ?>
                <script>
                alert('ERROR!');
                </script>   
                <?php
        }  
    }
                    
                    
$q=mysql_query("SELECT * from radio where id_radio='1'");
$h=mysql_fetch_array($q);
                    
$q2=mysql_query("SELECT * from radio where id_radio='2'");
$h2=mysql_fetch_array($q2);

$q3=mysql_query("SELECT * from radio where id_radio='3'");
$h3=mysql_fetch_array($q3);
                    
$q4=mysql_query("SELECT * from radio where id_radio='4'");
$h4=mysql_fetch_array($q4);
?>
                    
       <form enctype="multipart/form-data" method="post">
                    <div class="row-fluid">
					 <div class="widget">
                     <div class="widget-title">
                        <h4><i class=" icon-edit"></i> Kelola Sejarah </h4></div>
                     <div class="widget-body form">
							<div class="control-group">
							  <div class="controls">			
								 <textarea name="sejarah" id="editor1" rows="10" cols="80"><?php echo $h['konten'];?></textarea>
							  </div>
							</div>
						     <div class="form-actions">
                        <input type="submit" name="ts" class="btn btn-success" value="Simpan">  
                           </div>          
                     </div>
                  </div>
				   </div>
                    
				   <div class="row-fluid">
					 <div class="widget">
                     <div class="widget-title">
                        <h4><i class=" icon-edit"></i> Kelola Visi Dan Misi </h4></div>
                     <div class="widget-body form">
                         <div class="control-group">
							  <div class="controls">			
								 <textarea name="visi" id="editor2" rows="10" cols="80"><?php echo $h2['konten'];?></textarea>
							  </div>
							</div>
						     <div class="form-actions">
                        <input type="submit" name="tv" class="btn btn-success" value="Simpan">
                              
                           </div>          
                     </div>
                  </div>
				   </div>
            
           
                    </form>

          

                  
	</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	    </div>
	<!-- END CONTAINER -->
	<?php footer(); ?>