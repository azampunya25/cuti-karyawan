<?php 
session_start();
include "../koneksi.php";
include "function.php"; 
$id_admin=$_SESSION['admin'];
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) ){ 
echo "<script> window.location = 'login.php'</script>";
}
else {



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
	<title> Admin - Buku Tamu</title>
	<?php header_admin(); ?>
	<!-- BEGIN CONTAINER -->
	<div id="container" class="row-fluid">
	<?php menu_utama(); ?>
		<!-- BEGIN PAGE -->
		<div id="main-content">
			<!-- BEGIN PAGE CONTAINER-->
<script language="javascript" type='text/javascript'>
function validasi2(){

	var isi = document.getElementById('akad');
	var is = document.getElementById('isi');
	
		if(notEmpty(isi, "Pilih Label Pengumuman terlebih dahulu")){
		if(notEmpty(is, "Isi berita tidak boleh kosong")){



							
											return true;
		}
						}
					

    return false;
 
}


 
function notEmpty(elem, helperMsg){
    if(elem.value ==''){
        alert(helperMsg);
        elem.focus();
        return false;
    }
    return true;
}



</script>		
			
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
                    
                       
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Dashboard
							<small>Halaman Kelola Buku Tamu</small>
						</h3>
						<ul class="breadcrumb">
							<li>
                                <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
							</li>
                            <li>
                                <a href="#">Admin Web</a> <span class="divider">&nbsp;</span>
                            </li>
							<li><a href="#">Dashboard</a><span class="divider">&nbsp;</span></li>
                           <li><a href="#">Buku Tamu</a><span class="divider-last">&nbsp;</span></li>
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
                         Selamat datang <strong>Admin</strong>. Silahkan Mengelola Buku Tamu.
                    </div>
					 <!--END NOTIFICATION-->
 
<!---------------------------------------------------SHOW LIST BERITA ----------------------->
               <div class="row-fluid">
               <div class="span12">
                    <!-- BEGIN BORDERED TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                        <h4><i class="icon-book"></i>List Buku Tamu</h4>				
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
						
                        </div>
					
                        <div class="widget-body">
		
                       <table class="table table-striped table-bordered" id="sample_1">
                        <thead>
						<tr>
									<th>No</th>
                                    <th>Nama Tamu</th>
									<th>email</th>
									<th>Komentar</th>
									<th>Tanggal</th>
									<th>Waktu</th>
									<th>Aksi</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
															
					<?php 
					$i=1;
					$sql= mysql_query("select * from buku_tamu order by id_tamu DESC");
					while ($isi= mysql_fetch_array($sql)){
						?>
                                <tr class="odd gradeX">
                                    
                                    <td><?php echo $i;  $i++; ?></td>
                                    <td class="hidden-phone"><?php echo $isi['nama']; ?></td>
									<td class="hidden-phone"><?php echo $isi['email']; ?></td>
									<td class="center hidden-phone"><?php echo $isi['komentar'];?></td>
									<td class="hidden-phone"><?php echo $isi['tanggal']; ?></td>
									 <td class="center hidden-phone"><?php echo $isi['waktu']; ?></td>
									<td class="hidden-phone">
									<a class='btn btn-mini btn-info'href="delete.php?bt=<?php echo $isi['id_tamu']; ?>"  onclick="return confirm('Yakin akan dihapus ?');"><i class='icon-trash icon-white'></i> Hapus</a>
									
									</td>
									
									
                                </tr>
                     <?php }; ?>
                                </tbody>
                        </table>

                        </div>
                    </div>
                    <!-- END BORDERED TABLE widget-->
                </div>
            </div>
				
                    <!--END NOTIFICATION-->
	</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	    </div>
	<!-- END CONTAINER -->
	<?php footer(); ?>
	
