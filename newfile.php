<?php

$active5 = "active";
include "header.php";

$folders = mysqli_query($con, "select * from file where user_id=$my_user_id and is_folder=1 and folder_id is NULL order by created_at desc");

?>

<div class="content-wrapper">
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <!-- Content Header (Page header) -->
        <h1>Nuevo Archivo</h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="myfiles"><i class="fa fa-archive"></i> Mis Archivos</a></li>
            <li class="active">Nuevo Archivo</li>
        </ol>
    </section>

    <section class="content">
        <!-- Main content -->
        <div class="row">
            <!-- Small boxes (Stat box) -->
            <div class="col-md-6 col-md-offset-3">
                <?php
                // get messages
                if (isset($_GET['success'])) {
                    echo "<p class='alert alert-success'> <i class=' fa fa-exclamation-circle'></i> <strong>¡Bien hecho! </strong>archivo subido exitosamente</p>";
                } elseif (isset($_GET['error'])) {
                    echo "<p class='alert alert-warning'> <i class=' fa fa-exclamation-circle'></i> No se pudo subir, hubo un error.</p>";
                } elseif (isset($_GET['error2']) && isset($_GET['max_size'])) {
                    echo "<p class='alert alert-info'> <i class=' fa fa-exclamation-circle'></i> Hubo un error el archivo supero el peso máximo.</p>";
                } elseif (isset($_GET['error3']) && isset($_GET['fatal'])) {
                    echo "<p class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> Error fatal, el archivo no se pudo cargar.</p>";
                }
                ?>
                <div class="box box-warning">
                    <!-- general form elements -->
                    <div class="box-header with-border">
                        <h3 class="box-title"><button class="btn btn-xs btn-success"><i class="fa fa-plus"></i></button> Cargar Nuevo Archivo</h3>
                    </div><!-- /.box-header -->

                    <form role="form" action="action/addfile.php" method="post" enctype="multipart/form-data">
                        <!-- form start -->
                        <div class="box-body">
                            
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ubicacion</label>
                                <select class="form-control select2" style="width: 100%;" name="folder_id">
                                    <option value="">Mi unidad</option>
                                    <?php
                                    function getfolders($id, $lev)
                                    {
                                        global $con;
                                        $folder = mysqli_query($con, "select * from file where id=$id");
                                        $folder_rw = mysqli_fetch_array($folder);
                                        $str = str_repeat("+", $lev);
                                        echo "<option value='" . $folder_rw['id'] . "'>" . $str . $folder_rw['filename'] . "</option>";
                                        $folder_id = $folder_rw['id'];
                                        $getFoldersByFolderId = mysqli_query($con, "select * from file where folder_id=$folder_id and is_folder=1 and status=1 order by created_at desc");
                                        foreach ($getFoldersByFolderId as $f) {
                                            getfolders($f['id'], $lev + 1);
                                        }
                                    }

                                    // Obtenemos el folder del usuario por ID
                                    $user_id = $_SESSION["user_id"];
                                    $getRootFoldersByUserId = mysqli_query($con, "select * from file where user_id=$user_id and is_folder=1 and folder_id is NULL and status=1 order by created_at desc");
                                    foreach ($getRootFoldersByUserId as $f) :
                                        getfolders($f['id'], 0);
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <!-- <span class="btn btn-my-button btn-file" style="width: 100%; margin-top: 5px;"> -->
                                Selecionar Archivo<input type="file" name="filename">
                                <!--   </span> -->
                            </div>

                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Comentario..."></textarea>
                            </div>
                            <?php if($is_evaluator == 1):?>
                            <div class="form-group">
                                <div class="checkbox icheck">
                                    <label>
                                        <input type="checkbox" name="is_public">&nbsp;Archivo Publico
                                    </label>
                                </div>
                            </div>
                            <?php endif;?>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-warning">Subir archivo</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div><!-- /.row -->
    </section>
</div><!-- /.content -->

<?php include "footer.php"; ?>