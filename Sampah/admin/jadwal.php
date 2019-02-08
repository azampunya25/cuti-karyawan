<?php 
session_start();
include "koneksi.php";
include "function.php"; 
$id_admin=$_SESSION['admin'];
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) ){ 
echo "<script> window.location = 'login.php'</script>";
}
else {


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
	<title> Admin - Jadwal Siaran</title>
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
	<?php 
            if (isset($_POST['tambah2'])) {

$hari=$_POST['hari'];
$nama=$_POST['nama'];
$pukul=$_POST['pukul'];

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
$direktori1 = "../images/jadwal/$nama_file1";
$direktori2 = "images/jadwal/$nama_file1";
move_uploaded_file($folder_file1,"$direktori1");
} 

if ($tipe_file != "image/jpeg" AND $tipe_file != "image/png"){
    echo "<script>window.alert('Tambah Data Gagal, Pastikan File Photo yang di Upload bertipe *.JPG atau *.PNG');
        window.location=('jadwal.php')</script>";
    } else if ($file_size > $maxsize){
    echo "<script>window.alert('Maaf upload photo Gagal, file photo yang anda pilih terlalu besar, maximal 250 KB..! ');
        window.location=('jadwal.php')</script>";
    }
else if(empty($error)){
 $input="insert into jadwal (hari,nama,pukul,cover) values ('$hari','$nama','$pukul','$direktori2')";
 $cek = mysql_query($input);

 
if($cek){

echo "<script> alert ('Data  berhasil di Tambah');window.location=('galeri.php')</script>";
}}
else{
echo "<script>alert('Gagal'); window.location=('galeri.php')</script>";
}
}

            ?>		
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
                    
                       
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Dashboard
							<small>Halaman Kelola Jadwal</small>
						</h3>
						<ul class="breadcrumb">
							<li>
                                <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
							</li>
                            <li>
                                <a href="#">Admin Web</a> <span class="divider">&nbsp;</span>
                            </li>
							<li><a href="#">Dashboard</a><span class="divider">&nbsp;</span></li>
                           <li><a href="#">Jadwal Siaran</a><span class="divider-last">&nbsp;</span></li>
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
                         Selamat datang <strong>Admin</strong>. Silahkan Mengelola Jadwal Siaran.
                    </div>
					 <!--END NOTIFICATION-->
 
                     <div class="row-fluid">
					 <div class="widget">
                     <div class="widget-title">
                        <h4><i class="icon-bullhorn"></i> Tambah Jadwal</h4>
                       
                     </div>
                     <div class="widget-body form">
                        <!-- BEGIN FORM-->
                        <form enctype="multipart/form-data"  id="biodata-form" method="post" class="form-horizontal" onsubmit='return validasi2()'>
						
						  <div class="control-group">
                              <label class="control-label">Hari</label>
                              <div class="controls">
                                <select class="input-xlarge" name="hari" required>
                                    <option value="">Pilih Hari</option>
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu</option>
                                </select>
                                 
                              </div>
                           </div>
                            <div class="control-group">
                              <label class="control-label">Nama</label>
                              <div class="controls">
                                 <input type="text" id='na' name='nama' placeholder="Nama" class="input-xlarge" required/>
                                 
                              </div>
                           </div>
                            <div class="control-group">
                              <label class="control-label">Pukul</label>
                              <div class="controls">
                                 <input type="text" id='na' name='pukul' placeholder="ex: 07.30" class="input-xlarge" required/>
                                 
                              </div>
                           </div>
						   							
							<div class="control-group">
                                    <label class="control-label">Cover</label>
                                    <div class="controls">
                                     <input type="file" name='gambar' class="default" accept='image/*' required/> 
											</div>
							</div>
						   
						     <div class="form-actions">
                              <button type="submit" name='tambah2' class="btn btn-success">Tambah</button>
                              
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
                        <h4><i class="icon-edit"></i> List Jadwal</h4>				
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
									<th>Hari</th>
									<th>Nama</th>
									<th>Pukul</th>
									<th>Cover</th>
									<th>Aksi</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
															
					<?php 
					$i=1;
					$sql= mysql_query("select * from jadwal order by id DESC");
					while ($isi= mysql_fetch_array($sql)){
                                                
						?>
                                <tr class="odd gradeX">
                                    
                                    <td><?php echo $i;  $i++; ?></td>
									<td class="hidden-phone"><?php echo $isi['hari']; ?></td>
									<td class="hidden-phone"><?php echo $isi['nama']; ?></td>
									<td class="hidden-phone"><?php echo $isi['pukul']; ?></td>
									<td class="center hidden-phone"><?php allfoto($isi['cover']); ?></td>
									<td class="hidden-phone">
                                    <a class='btn btn-mini btn-info'href="ubah.php?ga=<?php echo $isi['id']; ?>"><i class='icon-edit icon-white'></i> Ubah</a>
									<a class='btn btn-mini btn-info'href="delete.php?ga=<?php echo $isi['id']; ?>"  onclick="return confirm('Yakin akan dihapus ?');"><i class='icon-trash icon-white'></i> Hapus</a>
																		
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
	<?php footer(); }?>
	
