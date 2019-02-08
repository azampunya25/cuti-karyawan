<?php
// Warning Error To Login Admin Page
$sukses = "Terima Kasih. Admin akan mengkonfirmasi terlebih dahulu untuk masuk kedalam sistem";

// View Error Message To Browser
echo "
<html>
<head>
<title>Login Administrator</title>
<link rel=\"stylesheet\" type=\"text/css\" href=\"style_login.css\" />

<link rel=\"shortcut icon\" href=\"images/images_admin/favicon.ico\" />
</head>
<body>

<div id=\"main\" style=\"width:560px;\">
<div id=\"error_login\">
<img src=\"images/images_login/img_login_lock.png\" width=\"30\" height=\"31\" align=\"absmiddle\" class=\"img_lock\"/> 
$sukses
<br /><center><a href=\"index.php\" class=\"clickhere\">Login Sistem</a></center>
</div>

</body>
</html>
";
?>
