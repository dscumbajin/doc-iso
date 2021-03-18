<?php

session_start();
include "../config/config.php";
if (isset($_SESSION['admin_id'])) {
    header("location: home.php");
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="../images/favicon.ico" />
    <title>DOC ISO | Iniciar Session</title>

    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="../css/styles.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <?php
        if (isset($_GET['invalid'])) {
            echo "<div class='alert alert-danger alert-dismissible fade in' role='alert'>
                        <strong>¡Error!</strong> Contraseña o correo Electrónico invalido
                        </div>";
        }
        if (isset($_GET['error'])) {
            echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'>
                        <strong>¡Error!</strong> Cuenta inactiva!
                        </div>";
        }
        if (isset($_GET['noadmin'])) {
            echo "<div class='alert alert-warning alert-dismissible fade in' role='alert'>
                        <strong>¡Error!</strong> No eres Administrador!
                        </div>";
        }
        ?>
        <div class="login-logo center clearfix">
            <!-- LOGO -->
            <div id="logo">
                <img src="../images/logo.png" class="app-logo" alt="Logotipo" />
            </div>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">Iniciar Sesion</p>
            <form action="action/login.php" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="email" class="form-control" placeholder="Correo electrónico">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8"></div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-flat">Iniciar Sesion</button>
                    </div><!-- /.col -->
                </div>
            </form>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.2.3 -->
    <script src="../plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
</body>

</html>