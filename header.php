<?php

session_start();
include "config/config.php";
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null) {
    header("location: index");
}
$my_user_id = $_SESSION['user_id'];
$query = mysqli_query($con, "SELECT * from user where id=$my_user_id");
while ($row = mysqli_fetch_array($query)) {
    $fullname = $row['fullname'];
    $email = $row['email'];
    $profile_pic = $row['image'];
    $created_at = $row['created_at'];
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="images/favicon.ico" />
    <title>DOC ISO | Baterias Ecuador </title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <!-- micss -->
    <link rel="stylesheet" href="css/micss.css">

</head>

<body class="hold-transition skin-yellow-light sidebar-mini">
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
                        <?php
                        $session_user_id = $_SESSION["user_id"];
                        $n = mysqli_query($con, "select count(*) as c from notification where to_id=$session_user_id and is_readed=0");
                        while ($n_row = mysqli_fetch_array($n)) {
                            $c = $n_row['c'];
                        }
                        $l = 5;
                        $ls = mysqli_query($con, "select * from notification where to_id=$session_user_id and is_readed=0 order by created_at desc limit $l");
                        ?>
                        <!-- Notifications: style can be found in dropdown.less -->
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell-o"></i>
                                <?php if ($c > 0) : ?>
                                    <span class="label label-danger"><?php echo $c; ?></span>
                                <?php endif; ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Tienes <?= $c; ?> Notificaciones</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <?php if ($c > 0) : ?>
                                            <?php foreach ($ls as $l) :
                                                $file_id = $l['file_id'];
                                                $from_id = $l['from_id'];
                                                $file = mysqli_query($con, "select * from file where id=$file_id");
                                                $file_rw = mysqli_fetch_array($file);

                                                $user = mysqli_query($con, "select * from user where id=$from_id");
                                                $user_rw = mysqli_fetch_array($user);
                                                $href = '';

                                                if ($file_rw['is_folder']) {
                                                    $href = "myfiles?folder=" . $file_rw['code'];
                                                } else {
                                                    $href = "file?code=" . $file_rw['code'];
                                                }

                                            ?>
                                                <li>
                                                    <a href="<?php echo $href; ?>">
                                                        <i class="fa fa-users text-aqua"></i> <b><?= $user_rw['fullname']; ?></b> envia '<?= $file_rw['filename']; ?>'
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </li>
                                <li class="footer"><a href="notifications">Ver todas</a></li>
                            </ul>
                        </li>
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="images/profiles/<?php echo $profile_pic; ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $fullname; ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <!-- User image -->
                                    <img src="images/profiles/<?php echo $profile_pic; ?>" class="img-circle" alt="User Image">
                                    <p>
                                        <?php echo $fullname; ?>
                                        <small>Miembro desde el: <?php $created_at = @date('d/M/Y', strtotime($created_at));
                                                                    echo $created_at ?></small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <!-- Menu Footer-->
                                    <div class="pull-left">
                                        <a href="profile.php" class="btn btn-default btn-flat"><i class="fa fa-user"></i> Mi perfil</a>
                                    </div>
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
                        <img src="images/profiles/<?php echo $profile_pic; ?>" class="img-circle" alt="User Image">
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
                        <a href="myfiles"><i class="fa fa-database"></i> <span>Mis archivos</span></a>
                    </li>

                    <li class="<?php if (isset($active3)) {
                                    echo $active3;
                                } ?>">
                        <a href="shared"><i class="fa fa-globe"></i> <span>Compartidos conmigo</span></a>
                    </li>

                    <li class="<?php if (isset($active4)) {
                                    echo $active4;
                                } ?>">
                        <a href="newfolder"><i class="fa fa-folder"></i> <span>Nueva carpeta</span></a>
                    </li>

                    <li class="<?php if (isset($active5)) {
                                    echo $active5;
                                } ?>">
                        <a href="newfile"><i class="fa fa-upload"></i> <span>Nuevo Archivo</span></a>
                    </li>

                    <li class="<?php if (isset($active6)) {
                                    echo $active6;
                                } ?>">
                        <a href="recicle"><i class="fa fa-trash"></i> <span>Papelera de reciclaje</span></a>
                    </li>

                    <li class="<?php if (isset($active7)) {
                                    echo $active7;
                                } ?>">
                        <a href="about"><i class="fa fa-smile-o"></i> <span>Acerca del autor</span></a>
                    </li>

                </ul>
            </section><!-- /.sidebar -->
        </aside>