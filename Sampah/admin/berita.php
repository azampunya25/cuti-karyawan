<?php 
session_start();
include "koneksi.php";
include "function.php"; 
$id_admin=$_SESSION['admin'];
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) ){ 
echo "<script> window.location = 'login.php'</script>";
}
else {

if (isset($_POST['tambah2'])) {

$nama=$_POST['pud'];
$isi=$_POST['isi'];
$tgl=date("y-m-d");

if($_FILES['gambar']['error']==0) {
// buat kode acak
$length = 3;
$acak = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
$folder_file1 = $_FILES['gambar']['tmp_name'];
$nama_file1 = $_FILES['gambar']['name'];
$tipe_file  = $_FILES['gambar']['type'];
$file_size  = $_FILES['gambar']['size'];
$maxsize= 1024 * 250;

$error = array();
$nama_file1 = "$acak-$nama_file1";
$direktori1 = "../data1/images/$nama_file1";
move_uploaded_file($folder_file1,"$direktori1");
} 

if ($tipe_file != "image/jpeg" AND $tipe_file != "image/png"){
    echo "<script>window.alert('Tambah Data Gagal, Pastikan File Photo yang di Upload bertipe *.JPG atau *.PNG');
        window.location=('berita.php')</script>";
    } else if ($file_size > $maxsize){
    echo "<script>window.alert('Maaf upload photo Gagal, file photo yang anda pilih terlalu besar, maximal 250 KB..! ');
        window.location=('berita.php')</script>";
    }
else if(empty($error)){
 $input="insert into berita (judul, isi, tgl, foto) values ('$nama','$isi','$tgl','$nama_file1' )";
 $cek = mysql_query($input);

 
if($cek){

echo "<script> alert ('Data  berhasil di tambah');history.go(-1)</script>";
}}
else{
echo "<script>alert('Gagal'); history.go(-1)</script>";
}
}

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
	<title> Admin - Berita</title>
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
							<small>Halaman Kelola Berita</small>
						</h3>
						<ul class="breadcrumb">
							<li>
                                <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
							</li>
                            <li>
                                <a href="#">Admin Web</a> <span class="divider">&nbsp;</span>
                            </li>
							<li><a href="#">Dashboard</a><span class="divider">&nbsp;</span></li>
                           <li><a href="#">Kelola Berita</a><span class="divider-last">&nbsp;</span></li>
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
                         Selamat datang <strong>Admin</strong>. Silahkan Membuat dan Memodifikasi Berita.
                    </div>
					 <!--END NOTIFICATION-->
                     <div class="row-fluid">
					 <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-bullhorn"></i> Posting Berita</h4>
                       
                     </div>
                     <div class="widget-body form">
                        <!-- BEGIN FORM-->
                        <form enctype="multipart/form-data"  id="biodata-form" method="post" class="form-horizontal" onsubmit='return validasi2()'>
						
						
						<div class="control-group">
                              <label class="control-label">Judul </label>
                              <div class="controls">
                                 <input type="text" id='na' name='pud' class="input-xlarge"  required/>
                                 
                              </div>
                           </div>
						   
					
						   
						   <div class="control-group">
							  <label class="control-label" for="textarea2">Isi Informasi Berita</label>
							  <div class="controls">
								
								 <textarea class="ckeditor" id="isi2" name="isi" rows="4"></textarea>
							  </div>
							</div>
							
							<div class="control-group">
                                    <label class="control-label">Foto Sampul </label>
                                    <div class="controls">
                                     <input type="file" name='gambar' value='<?php echo $photo;?>' class="default" accept='image/*' />
											</div>
							</div>
						   
						     <div class="form-actions">
                              <button type="submit" name='tambah2' class="btn btn-success">Posting</button>
                              
                           </div>
                        </form>
                        <!-- END FORM-->           
                     </div>
                  </div>
		</div>
<!---------------------------------------------------SHOW LIST BERITA ----------------------->
               <div class="row-fluid">
               <div class="span12">
                    <!-- BEGIN BORDERED TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                        <h4><i class="icon-paper-clip"></i> List Data Berita</h4>				
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
                                    <th>Judul</th>
									<th>isi</th>
									<th>Tanggal</th>
									<th>Foto sampul</th>
									<th>Aksi</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
															
					<?php 
					$i=1;
					$sql= mysql_query("Select * from berita");
					while ($isi= mysql_fetch_array($sql)){
                         $isib=substr($isi['isi'],0,40);
						?>
                                <tr class="odd gradeX">
                                    
                                    <td><?php echo $i; ?></td>
                                    <td class="hidden-phone"><?php echo $isi['judul']; ?></td>
									<td class="hidden-phone"><?php echo "$isib" ; ?></td>
									<td class="hidden-phone"><?php echo $isi['tgl']; ?></td>
									<td class="hidden-phone"><?php echo $isi['foto']; ?></td>
									<td class="hidden-phone">
									<a class='btn btn-mini btn-info'href="delete.php?ia=<?php echo $isi['id_berita']; ?>"  onclick="return confirm('Yakin akan dihapus ?');"><i class='icon-trash icon-white'></i> Hapus</a>
									
									<a class='btn btn-mini btn-info'href="ubah.php?ia=<?php echo $isi['id_berita']; ?>"  onclick="return confirm('Yakin akan diubah ?');"><i class='icon-edit icon-white'></i> Ubah</a>
									
									</td>
									
									
                                </tr>
                     <?php $i++; } ?>
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