<?php


include "header.php";
?>
<div class="content-wrapper">
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <!-- Content Header (Page header) -->
        <h1>Mi Cuenta </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Mi Cuenta</li>
        </ol>
    </section>
    <section class="content">
        <!-- Main content -->
        <div class="row">
            <!-- .row -->
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <div class="box box-warning">
                    <div class="box-body box-profile">
                        <div id="load_img">
                            <img class="img-responsive" width="100%" src="images/profiles/<?php echo $profile_pic ?>" alt="Imagen de Perfil">
                        </div>
                        <h3 class="profile-username text-center"><?php echo $fullname; ?></h3>
                        <p class="text-muted text-center mail-text"><?php echo $email; ?></p>
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
                <span class="btn btn-my-button btn-file" style="width: 255px; margin-top: 5px;">
                    <form method="post" id="formulario" enctype="multipart/form-data">
                        Cambiar Imagen de perfil: <input type="file" name="file">
                    </form>
                </span>
                <div id="respuesta"></div><br>
            </div>
            <div class="col-md-1"></div>

            <div class="col-md-6">
                <div id="result"></div>
                <div class="box box-warning">
                    <!-- general form elements -->
                    <div class="box-header with-border">
                        <h3 class="box-title">Datos Personales: </h3>
                    </div> <!-- /.box-header -->
                    <form role="form" method="post" id="upd" name="upd">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="fullname">Nombre Completo</label>
                                <input name="fullname" type="text" class="form-control" id="fullname" value="<?php echo $fullname ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Correo Electrónico</label>
                                <input name="email" type="email" class="form-control" id="email" value="<?php echo $email ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Contraseña Actual</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="*******">
                            </div>
                            <div class="form-group">
                                <label for="new_password">Nueva Contraseña</label>
                                <input name="new_password" type="password" class="form-control" placeholder="*******" id="new_password">
                            </div>
                            <div class="form-group">
                                <label for="confirm_new_password">Confirmar Nueva Contraseña</label>
                                <input name="confirm_new_password" type="password" class="form-control" placeholder="*******" id="confirm_new_password">
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button id="upd_data" type="submit" class="btn btn-warning">Actualizar Datos</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div><!-- /.row -->
    </section>
</div><!-- /.content -->


<?php include "footer.php"; ?>
<script>
    $(function() {
        $("input[name='file']").on("change", function() {
            var formData = new FormData($("#formulario")[0]);
            var ruta = "action/uploadprofile.php";
            $.ajax({
                url: ruta,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(datos) {
                    $("#respuesta").html(datos);
                }
            });
        });
    });
</script>

<script>
    $("#upd").submit(function(event) {
        $('#upd_data').attr("disabled", true);
        var parametros = $(this).serialize();
        console.log(parametros)
        $.ajax({
            type: "POST",
            url: "action/updprofile.php",
            data: parametros,
            beforeSend: function(objeto) {
                $("#result").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#result").html(datos);
                $('#upd_data').attr("disabled", false);

            }
        });
        event.preventDefault();
    })
</script>