<?php
session_start();
echo $_SESSION['namauser'];
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
  echo "<link href='config/adminstyle.css' rel='stylesheet' type='text/css'><center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=index.php><b>LOGIN</b></a></center>";
}
else {
  ?>
  <html>
  <head>
    <title>:: Cuti Karyawan Online ::</title>
    <link href="contents/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <link href="contents/dist/css/AdminLTE.min.css"" rel="stylesheet" type="text/css" />
    <link href="contents/dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="contents/plugins/datatables/dataTables.bootstrap.css">
    <style type="text/css">
    .row {
      margin-right: -15px;
      margin-left: -15px;
      padding: 5px;
    }
  </style>
</head>
<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="?module=home" class="navbar-brand"><b>CUKA</b></a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <?php include "menu.php"; ?>
            </ul>
          </div>
          <!-- /.navbar-collapse -->
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
          <!-- /.navbar-custom-menu -->
        </div>
        <!-- /.container-fluid -->
      </nav>
    </header>
    <!-- Full Width Column -->
    <div class="content-wrapper">
      <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Top Navigation
            <small>Example 2.0</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Layout</a></li>
            <li class="active">Top Navigation</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php include "content.php"; ?>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="container">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.8
        </div>
        <strong>Copyright &copy; <?echo date('Y')?> by Cuti Karyawan Online</strong> All rights
        reserved.
      </div>
      <!-- /.container -->
    </footer>
  </div>
  <!-- jQuery 2.2.3 -->
  <script src="contents/plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="contents/bootstrap/js/bootstrap.min.js"></script>
  <!-- DataTables -->
  <script src="contents/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="contents/plugins/datatables/dataTables.bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="contents/plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="contents/plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="contents/dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="contents/dist/js/demo.js"></script>

  <script>
    $(document).ready(function(){
      $('#example').dataTable();
    });
  </script>
</body>
</body>
</html>
<?php
}
?>
