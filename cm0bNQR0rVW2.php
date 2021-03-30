<?php

include "config/config.php";
$code = $_GET['c'];
$sql = mysqli_query($con, "select * from file where code=\"$code\"");
while ($row = mysqli_fetch_array($sql)) {
  $filename = $row['filename'];
  $description = $row['description'];
  $file_count = $row['download'];
  $file_id = $row['id'];
}
if (mysqli_num_rows($sql) > 0) {
  //echo "se cumplio";

} else {

  $alphabeth = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
  $token = "";
  for ($i = 0; $i < 75; $i++) {
    $token .= $alphabeth[rand(0, strlen($alphabeth) - 1)];
  }

  header("location: VrFVtT26qR?c=$code&t=$token");
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" type="image/png" href="images/favicon.ico" />
  <title><?php echo "ISO-DOC |" . " " . $filename ?></title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="css/public.css">
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->

<body class="hold-transition skin-yellow-light layout-top-nav">
  <div class="wrapper">

    <header class="main-header">
      <nav class="navbar navbar-static-top">
        <div class="container">
          <div class="navbar-header">
            <a href="#" class="navbar-brand"><b>ISO</b>DOC</a>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
              <i class="fa fa-bars"></i>
            </button>
          </div>

          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
              <li><a href="register">Registrarme</a></li>
              <li><a href="index">Iniciar Sesion</a></li>
            </ul>

          </div>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <img src="images/logo.png" class="user-image" alt="User Image">
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">ISO-DOC</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <img src="images/logo.png" class="img-circle" alt="User Image">
                   <!--  <p>
                      By <a href="http://abisoftgt.net" target="_blank">Abisoft-GT</a>
                    </p> -->
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="index" class="btn btn-default btn-flat">Iniciar Sesion</a>
                    </div>
                    <div class="pull-right">
                      <a href="register" class="btn btn-default btn-flat">Registrarme</a>
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
          <h1><?php echo $filename ?></h1>

        </section>

        <!-- Main content -->
        <section class="content">
          <div class="callout callout-warning">
            <h4>Descripcion!</h4>

            <p><?php echo $description ?></p>
            <center><a href="action/dwnfl.php?code=<?php echo $code; ?>&id=<?php echo $file_id; ?>&count=<?php echo $file_count; ?>" style="text-decoration: none;" class="btn btn-danger"><i class="fa fa-fownload"></i> Descargar</a></center>

            <br><br>
            <?php

            ?>
            <p>Aun no eres usuario, que esperas <a href="register">Registrate aqui!</a></p>
          </div>

          <!-- /.box -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.container -->
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
      <!-- /.content-wrapper -->
      <div class="pull-right hidden-xs">
        <b>Version</b> 1.0.0
      </div>
      <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="">Baterias<span>Ecuador</span></a>.</strong> Todos los derechos reservados
    </footer><!-- ./wrapper -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery 2.2.3 -->
  <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="plugins/slimScroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="plugins/fastclick/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/app.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
</body>

</html>