<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>..::: Dinas Kelautan dan Perikanan Prov. Kalteng :::..</title>
	<link rel="stylesheet" type="text/css" href="style_login.css" />

	<link rel="shortcut icon" href="images/logoKKP.ico" />

	<script type="text/javascript">
		function validasi(form){
			if (form.username.value == ""){
				alert("Anda belum mengisikan Username");
				form.username.focus();
				return (false);
			}
			
			if (form.password.value == ""){
				alert("Anda belum mengisikan Password");
				form.password.focus();
				return (false);
			}
			return (true);
		}
	</script>

</head>

<body OnLoad="document.login.username.focus();">
	<div id="main">

		<!-- Header -->
		<div id="header"><img src="images/Logo_Prov_Kalteng_notdesigner.png" width="40" align="left"/>Login Website <br />Dinas Kelautan dan Perikanan Prov. Kalteng</div>

		<!-- Middle -->
		<div id="middle">
			<form id="form-login" name="login" method="post" action="cek_login.php" onSubmit="return validasi(this)">
				
				<img src="images/images_login/img_login_user.png" align="absmiddle" class="img_user" />
				<input type="text" name="username" size="29" id="input" placeholder='NIP'/>
				<br />
				
				<img src="images/images_login/img_login_pass.png" align="absmiddle" class="img_pass" />
				<input type="password" name="password" size="29" id="input" placeholder='Password'/>
				<br />
				
				<input name="Submit" type="image" value="Submit" src="images/images_login/button_login.png" id="submit" align="absmiddle" />
			</form>
			* Pegawai yang belum mempunyai user untuk login silahkan registrasi disini <a style="color:#ffcf43" href='registrasi.php'>Registrasi Pegawai</a> , selanjutnya silahkan login menggunakan NIP dan password *
		</div>

		<!-- don't Change ;) -->
		<div class="clear"></div>

		<!-- Footer -->
		<div id="footer">Copyright &copy; 2015 DKP Prov. Kalteng. All rights reserved.</div>

		<!-- vertical_effect -->
	</body>
	</html>
