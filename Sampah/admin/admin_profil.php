<?php 
session_start();
include "koneksi.php";
include "function.php"; 
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) ){ 
echo "<script> window.location = 'login.php'</script>";
}
else {
if (isset($_POST['ubah'])) {
 $password=$_POST['newpass'];
 $user=$_POST['username'];
 $name=$_POST['name'];
 
 $input2="update admin set pass_login='$password', nm_login='$user', nama='$name' where id_admin='1'";
 $cek2 = mysql_query($input2);
 if($cek2){

echo "<script> alert ('Akun anda berhasil diubah');history.go(-1)</script>";
}
else{
echo "<script>alert('Gagal'); history.go(-1)</script>";
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
	<title> Admin - Ubah Akun</title>
	<?php header_admin(); ?>
	<!-- BEGIN CONTAINER -->
	<div id="container" class="row-fluid">
	<?php menu_utama(); ?>
		<!-- BEGIN PAGE -->
		<div id="main-content">
			<!-- BEGIN PAGE CONTAINER-->
<script language="javascript" type='text/javascript'>

function validasi(){
	var judul = document.getElementById('judul');
	var isi = document.getElementById('password2');
	
   if(notEmpty(judul, "Ketik Password Baru Terlebih dahulu")){
   if(notEmpty(isi, "Ketik Kembali Password BAru anda Terlebih dahulu")){
   if(match(isi, "Password tidak cocok, Ketik Kembali Password baru anda")){
   		if(isAlphabet(judul2, "Form Nama Ruangan Harus berformat huruf")){
		
		if(isNumeric(isi2, "Form Kapasitas Harus Berformat angka")){
							
											return true;
											}
		}
						}
					}
		}
    return false;
 
}
 function isAlphabet(elem, helperMsg){
    var alphaExp = /^[a-zA-Z\s-]+$/;
    if(elem.value.match(alphaExp)){
        return true;
    }else{
        alert(helperMsg);
        elem.focus();
        return false;
    }
} 
 
function notEmpty(elem, helperMsg){
    if(elem.value.length == 0){
        alert(helperMsg);
        elem.focus();
        return false;
    }
    return true;
}
  
function isNumeric(elem, helperMsg){
    var numericExpression = /^[0-9]+$/;
    if(elem.value.match(numericExpression)){
        return true;
    }else{
        alert(helperMsg);
        elem.focus();
        return false;
    }
}
 
function isAlphanumeric(elem, helperMsg){
    var alphaExp = /^[0-9a-zA-Z\s-.]+$/;
    if(elem.value.match(alphaExp)){
        return true;
    }else{
        alert(helperMsg);
        elem.focus();
        return false;
    }
}

function match(elem, helperMsg){
    var pass1 = document.getElementById('judul');
    var pass2 = document.getElementById('password2');
    if(pass1.value == pass2.value){
        return true;
    }else{
        alert(helperMsg);
        elem.focus();
        return false;
    }
}

function checkPass()
{
    //Store the password field objects into variables ...
    var pass1 = document.getElementById('judul');
    var pass2 = document.getElementById('password2');
    //Store the Confimation Message Object ...
    var message = document.getElementById('confirmMessage');
    //Set the colors we will be using ...
    var goodColor = "#66cc66";
    var badColor = "#ff6666";
    //Compare the values in the password field
    //and the confirmation field
    if(pass1.value == pass2.value){
        //The passwords match.
        //Set the color to the good color and inform
        //the user that they have entered the correct password
        pass2.style.backgroundColor = goodColor;
        message.style.color = goodColor;
        message.innerHTML = "Passwords cocok!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = badColor;
        message.style.color = badColor;
        message.innerHTML = "Passwords tidak cocok!"
		
    }
}

</script>			
			
			<div class="container-fluid">
				<!-- BEGIN PAGE HEADER-->
				<div class="row-fluid">
					<div class="span12">
                    
                       
						<!-- BEGIN PAGE TITLE & BREADCRUMB-->
						<h3 class="page-title">
							Dashboard
							<small>Ubah Akun</small>
						</h3>
						<ul class="breadcrumb">
							<li>
                                <a href="#"><i class="icon-home"></i></a><span class="divider">&nbsp;</span>
							</li>
                            <li>
                                <a href="#">Admin Web</a> <span class="divider">&nbsp;</span>
                            </li>
							<li><a href="#">Dashboard</a><span class="divider">&nbsp;</span></li>
                           <li><a href="#">Ubah Akun</a><span class="divider-last">&nbsp;</span></li>
						</ul>
						<!-- END PAGE TITLE & BREADCRUMB-->
					</div>
				</div>
				<!-- END PAGE HEADER-->
				<!-- BEGIN PAGE CONTENT-->
				<div id="page" class="dashboard">
				
				<?php 
                            	$sql= mysql_query("SELECT * from admin where id_admin='1'");
									while ($isi= mysql_fetch_array($sql)){

									$user = $isi['nm_login'];
									$password = $isi['pass_login'];
									$nama = $isi['nama'];
																	
									;
									} ?>
                    <!--BEGIN NOTIFICATION-->
                    <div class="alert alert-info">
                        <button data-dismiss="alert" class="close">+</button>
                         Selamat datang <strong><?php echo $nama ;?></strong>. Silahkan ubah detail akun anda.
                    </div>
					 <!--END NOTIFICATION-->
					 					<div class="row-fluid">
               <div class="span8">
                    <!-- BEGIN BORDERED TABLE widget-->
                    <div class="widget">
                        <div class="widget-title">
                            <h4><i class="icon-user"></i>Ubah akun anda</h4>
                        <span class="tools">
                        <a href="javascript:;" class="icon-chevron-down"></a>
                        <a href="javascript:;" class="icon-remove"></a>
                        </span>
                        </div>
                        <div class="widget-body form">
                         <form enctype="multipart/form-data"  action="admin_profil.php" method="post" class="form-horizontal" onsubmit='return validasi()'>
						 
						 
						 <div class="control-group">
                              <label class="control-label">Nama Admin</label>
                              <div class="controls">
                                 <input type="text" name='name' value='<?php echo $nama; ?>'/>
                                 
                              </div>
                        </div>
						 <div class="control-group">
                              <label class="control-label">username</label>
                              <div class="controls">
                                 <input type="text" name='username' value='<?php echo $user; ?>'/>
                                 
                              </div>
                        </div>
						 
						  <div class="control-group">
                              <label class="control-label">Password Lama</label>
                              <div class="controls">
                                 <input type="password" name='oldpass' value='<?php echo $password; ?>' disabled />
                        
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Ketik Password Baru</label>
                              <div class="controls">
                                 <input type="password" name='newpass' id="judul" value='' class="span6 " />
                        
                              </div>
                           </div>
						   
						   <div class="control-group">
                              <label class="control-label">Ketik Kembali Password Baru</label>
                              <div class="controls">
                                 <input onkeyup="checkPass(); return false;" type="password" class="required" id="password2" name="confirmpass" value=""/><span id="confirmMessage" class="confirmMessage"></span>
                              
                        
                              </div>
                           </div>
						   
						<div class="form-actions">
                              <button type="submit" name='ubah' class="btn btn-success">Simpan</button>
                              
                           </div>
						</form>
                        </div>
                    </div>
                    <!-- END BORDERED TABLE widget-->
                </div>
            </div>

				
	</div>
				<!-- END PAGE CONTENT-->
			</div>
			<!-- END PAGE CONTAINER-->
		</div>
		<!-- END PAGE -->
	    </div>
	<!-- END CONTAINER -->
	<?php footer(); ?>
		<?php } ?>