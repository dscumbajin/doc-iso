<?php

session_start();
include "../config/config.php";
$is_public = $_SESSION['is_public'];
if (!isset($_SESSION["admin_id"]) || $_SESSION["admin_id"] == null) {
    header("location: index");
}
$my_user_id = $_SESSION['admin_id'];
$query = mysqli_query($con, "SELECT * from user where id=$my_user_id");
while ($row = mysqli_fetch_array($query)) {
    $fullname = $row['fullname'];
    $email = $row['email'];
    //$profile_pic = $row['image'];
    //$created_at = $row['created_at'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/ico" href="../images/favicon.ico" />
    <title>DOC-ISO | Panel de administración</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../dist/css/skins/_all-skins.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="../plugins/select2/select2.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
    <!-- micss -->
    <link rel="stylesheet" href="../css/micss.css">

</head>

<body class="hold-transition skin-yellow sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <a href="home.php" class="logo">
                <!-- Logo -->
                <span class="logo-mini"><b>ISO</b>DOC</span>
                <span class="logo-lg"><b>ISO</b>DOC</span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <!-- Sidebar toggle button-->
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="../images/ecu.jpg" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $fullname; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <!-- User image -->
                                    <img src="../images/ecu.jpg" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $fullname; ?>
                                        <small>(<?php echo $email ?>)</small>
                                        <!--CONTROLAR EL BLOQUEO DEl super administrador-->
                                    </p>
                                    <p>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <!-- Menu Footer-->
                                    <div class="pull-right">
                                        <a href="action/logout.php" class="btn btn-default btn-flat"><i class="glyphicon glyphicon-off"></i> Salir</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="main-sidebar">
            <!-- Left side column. contains the logo and sidebar -->
            <section class="sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <div class="user-panel">
                    <!-- Sidebar user panel -->
                    <div class="pull-left image">
                        <img src="../images/ecu.jpg" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $fullname; ?></p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <li class="header">NAVEGACIÓN</li>

                    <li class="<?php if (isset($active1)) {
                                    echo $active1;
                                } ?>">
                        <a href="home"><i class="fa fa-home"></i> <span>Inicio</span></a>
                    </li>

                    <li class="<?php if (isset($active2)) {
                                    echo $active2;
                                } ?>">
                        <a href="files"><i class="fa fa-archive"></i> <span>Archivos</span></a>
                    </li>
                    <?php if ($is_public == 0) : ?>
                        <li class="<?php if (isset($active3)) {
                                        echo $active3;
                                    } ?>">
                            <a href="users"><i class="fa fa-users"></i> <span>Usuarios</span></a>
                        </li>
                    
                    <li class="<?php if (isset($active4)) {
                                    echo $active4;
                                } ?>">
                        <a href="configuration"><i class="fa fa-cog"></i> <span>Configuración</span></a>
                    </li>
                    <?php endif; ?>

                </ul>
            </section><!-- /.sidebar -->
        </aside>