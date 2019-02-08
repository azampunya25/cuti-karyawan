<?php 
session_start();
include "koneksi.php";
include "function.php"; 
if (empty($_SESSION['username']) AND empty($_SESSION['passuser']) ){
//cek login
if (isset($_POST['login'])) {

$username=$_POST['username'];


$login="SELECT * FROM admin WHERE nm_login='$_POST[username]'";
$cek_lagi=mysql_query($login);
$ketemu=mysql_num_rows($cek_lagi);
$login2="SELECT * FROM admin WHERE pass_login='$_POST[password]'";
$cek_lagi2=mysql_query($login2);
$ketemu2=mysql_num_rows($cek_lagi2);
$login3="SELECT * FROM admin WHERE nm_login='$_POST[username]' AND pass_login='$_POST[password]'";
$cek_lagi3=mysql_query($login3);
$ketemu3=mysql_num_rows($cek_lagi3);
$r=mysql_fetch_array($cek_lagi3);

if ($ketemu == 0 & $ketemu2 ==0){
echo "<script type=\"text/javascript\">
	alert(\"Username & Password Kosong silahkan isi Terlebih dahulu...!!!\");
	</script>";
	echo "<meta http-equiv='refresh' content='0; url=login.php'>";
	}




else if ($ketemu == 0){
echo "<script type=\"text/javascript\">
	alert(\"Username anda tidak Valid...!!!\");
	</script>";
	echo "<meta http-equiv='refresh' content='0; url=login.php'>";
	}

else if ($ketemu2 == 0) {
echo "<script type=\"text/javascript\">
	alert(\"Password anda tidak Valid...!!!\");
	</script>";
		echo "<meta http-equiv='refresh' content='0; url=login.php'>";
	}
else if ($ketemu3 == 0) {
echo "<script type=\"text/javascript\">
	alert(\"Username dan Password Anda tidak Valid...!!!\");
	</script>";
		echo "<meta http-equiv='refresh' content='0; url=login.php'>";
	}

// Apabila username dan password ditemukan
else  {

  $_SESSION['username']=$username;
  $_SESSION['username']     = $r['nm_login'];
  $_SESSION['password']     = $r['pass_login'];
  $_SESSION['status']       = 'adminutana';
  $_SESSION['admin']       = '1';


echo "<script> alert ('Login Berhasil Selamat Datang, $r[nama]');
window.location = 'index.php'</script>";
}
}
}
else {
echo "<script> window.location = 'index.php'</script>";}
?>
<!DOCTYPE html>
<!--
Template Name: Admin ANDI Dashboard build with Bootstrap v2.3.1
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
  <title>RadioStars - Login Admin </title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
   <link rel='icon' type='image/png' href='FP/a12.png'>
  <link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/style_responsive.css" rel="stylesheet" />
  <link href="css/style_default.css" rel="stylesheet" id="style_color" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body id="login-body">
  <div class="login-header">
      <!-- BEGIN LOGO -->
      <div id="logo" class="center">
          <img src="FP/a13.png" alt="logo" class="center" width="100" height="100" />
      </div>
      <!-- END LOGO -->
  </div>

  <!-- BEGIN LOGIN -->
  <div id="login">
    <!-- BEGIN LOGIN FORM -->
    <form id="loginform" class="form-vertical no-padding no-margin" method="post" action="login.php">
      <div class="lock">
          <i class="icon-home"></i>
      </div>
      <div class="control-wrap">
          <h4>Login Admin</h4>
          <div class="control-group">
              <div class="controls">
                  <div class="input-prepend">
                      <span class="add-on"><i class="icon-user"></i></span><input id="input-username" type="text" name='username' placeholder="Username" />
                  </div>
              </div>
          </div>
          <div class="control-group">
              <div class="controls">
                  <div class="input-prepend">
                      <span class="add-on"><i class="icon-key"></i></span><input id="input-password" type="password" name='password' placeholder="Password" />
                  </div>
                
                  <div class="clearfix space5"></div>
              </div>

          </div>
      </div>

      <input type="submit" id="login-btn" class="btn btn-block login-btn" name='login' value="Login" />
    </form>
    <!-- END LOGIN FORM -->        
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form id="forgotform" class="form-vertical no-padding no-margin hide" action="index.html">
      <p class="center">Enter your e-mail address below to reset your password.</p>
      <div class="control-group">
        <div class="controls">
          <div class="input-prepend">
            <span class="add-on"><i class="icon-envelope"></i></span><input id="input-email" type="text" placeholder="Email"  />
          </div>
        </div>
        <div class="space20"></div>
      </div>
      <input type="button" id="forget-btn" class="btn btn-block login-btn" value="Submit" />
    </form>
    <!-- END FORGOT PASSWORD FORM -->
  </div>
  <!-- END LOGIN -->
  <!-- BEGIN COPYRIGHT -->
  <div id="login-copyright">
      2016 &copy; F.B.O inc
  </div>
  <!-- END COPYRIGHT -->
  <!-- BEGIN JAVASCRIPTS -->
  <script src="js/jquery-1.8.3.min.js"></script>
  <script src="assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/jquery.blockui.js"></script>
  <script src="js/scripts.js"></script>
  <script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
  </script>
  <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>