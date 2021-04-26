<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="icon" type="image/png" href="images/favicon.ico" />
    <title>DOC ISO | Registro</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css"> -->
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div id="result"></div>
        <div class="login-logo center clearfix">
            <!-- LOGO -->
            <div id="logo">
                <img src="images/logo.png" class="app-logo" alt="Logotipo" />
            </div>
        </div>
        <div class="register-box-body">
            <p class="login-box-msg">Nuevo Usuario</p>
            <form method="post" id="add" name="add">
                <div class="form-group has-feedback">
                    <input type="text" name="fullname" class="form-control" placeholder="Nombre y apellidos *" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Correo Electrónico *" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Contraseña *" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <p class="text-muted text-right">campos obligatorios* </p>
                <div class="row">
                    <div class="col-xs-8"></div><!-- /.col -->
                    <div class="col-xs-4">
                        <button id="save_data" type="submit" class="btn btn-primary btn-block btn-flat">Registrarme</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <a href="index" class="text-center">Iniciar Sesión</a>

        </div><!-- /.form-box -->
    </div><!-- /.register-box -->

    <!-- jQuery 2.2.3 -->
    <script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
    <!-- Bootstrap 3.3.6 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            load(1);
        });

        $("#add").submit(function(event) {
            $('#save_data').attr("disabled", true);
            var parametros = $(this).serialize();
            $.ajax({
                type: "POST",
                url: "action/adduser.php",
                data: parametros,
                beforeSend: function(objeto) {
                    $("#result").html("Mensaje: Cargando...");
                },
                success: function(datos) {
                    $("#result").html(datos);
                    $('#save_data').attr("disabled", false);
                    load(1);
                }
            });
            event.preventDefault();
        })
    </script>
</body>

</html>