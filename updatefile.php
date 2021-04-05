<?php

$active2 = "active";
include "header.php";


$id_code = $_GET["id"];
$file = mysqli_query($con, "select * from file where code=\"$id_code\"");
while ($rows = mysqli_fetch_array($file)) {
    $id = $rows['id'];
    $filename = $rows['filename'];
    $code = $rows['code'];
    $is_public = $rows['is_public'];
    $description = $rows['description'];
    $folder_id_rw = $rows['folder_id'];
}
if (!mysqli_num_rows($file) > 0) {
    print "<script>window.location=\"myfiles.php\"</script>";
}

?>
<div class="content-wrapper">
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <!-- Content Header (Page header) -->
        <h1>Actualizar versión Archivo <small><?php echo $filename ?></small> </h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="myfiles"><i class="fa fa-archive"></i> Mis Archivos</a></li>
            <li class="active">Actualizar versión Archivo </li>
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
                    echo "<p class='alert alert-success'> <i class=' fa fa-exclamation-circle'></i> <strong>¡Bien hecho! </strong> Archivo actualizado correctamente.</p>";
                } elseif (isset($_GET['error'])) {
                    echo "<p class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> <strong>¡Error! </strong>No se pudo actualizar el archivo.</p>";
                }
                ?>
                <div class="box box-warning">
                    <!-- general form elements -->
                    <div class="box-header with-border">
                        <h3 class="box-title"><i class="fa fa-pencil">Actualizar Archivo: </i><a href="file.php?code=<?php echo $code; ?>"> <?php echo $filename; ?></a></h3>
                    </div><!-- /.box-header -->
                    <form action="action/updatefile.php" method="post" role="form" enctype="multipart/form-data">
                        <!-- form start -->
                        <div class="box-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Ubicación</label>
                                <select class="form-control select2" style="width: 100%;" name="folder_id">
                                    <option value="">Mi unidad</option>
                                    <?php
                                    function getfolders($id, $lev)
                                    {
                                        global $con;
                                        $folder = mysqli_query($con, "select * from file where id=$id");
                                        $folder_rw = mysqli_fetch_array($folder);
                                        $str = str_repeat("+", $lev);
                                        $folder_id_func = $folder_rw['id'];

                                        //variable de la carpeta ya existente.
                                        global $folder_id_rw;
                                    ?>
                                        <!-- //echo "<option value='".$folder_rw['id']."'>".$str.$folder_rw['filename']."</option>"; -->
                                        <option <?php if ($folder_id_rw == $folder_id_func) {
                                                    echo "selected";
                                                } ?> value="<?php echo $folder_rw['id']; ?>"><?php echo $str . $folder_rw['filename']; ?></option>
                                    <?php
                                        $folder_id = $folder_rw['id'];
                                        $getFoldersByFolderId = mysqli_query($con, "select * from file where folder_id=$folder_id and is_folder=1 and status=1 order by created_at desc");
                                        foreach ($getFoldersByFolderId as $f) {
                                            getfolders($f['id'], $lev + 1);
                                        }
                                    }
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
                                <label for="exampleInputEmail1">Selecionar Archivo</label>
                                <input type="file" name="filename">
                                <!--   </span> -->
                            </div>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea name="description" class="form-control" rows="3" placeholder="Descripción..."><?php echo $description; ?></textarea>
                            </div>
                            <?php if ($is_evaluator == 1) : ?>
                                <div class="form-group">
                                    <div class="checkbox icheck">
                                        <label>
                                            <input type="checkbox" name="is_public" <?php if ($is_public) {
                                                                                        echo "checked";
                                                                                    } ?>>&nbsp;Archivo Publico
                                        </label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <button type="submit" class="btn btn-warning">Actualizar Archivo</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div>
        </div><!-- /.row -->
    </section>
</div><!-- /.content -->


<?php include "footer.php"; ?>