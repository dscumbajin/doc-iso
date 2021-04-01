<?php 

    $active2="active"; 
    include "header.php"; 

    $id_code=$_GET["id"];
    $file = mysqli_query($con,"select * from file where code=\"$id_code\"");
    while ($rows=mysqli_fetch_array($file)) {
        $file_id=$rows['id'];
        $file_filename=$rows['filename'];
        $file_code=$rows['code'];
    }

    if (!mysqli_num_rows($file)>0) {
    print "<script>window.location=\"myfiles\"</script>";
}

?>
    <div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
        <section class="content-header"><!-- Content Header (Page header) -->
            <h1>Permisos <small><?php echo $file_filename;?> </small> </h1>
            <ol class="breadcrumb">
                <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="myfiles.php"><i class="fa fa-archive"></i> Mis Archivos</a></li>
                <li class="active"><i class="fa fa-lock"></i> Permisos </li>
            </ol>
        </section>
        <section class="content"><!-- Main content -->
            <div class="row"><!-- Small boxes (Stat box) -->
                <div class="col-md-6 col-md-offset-3">

                    <?php
                        // get messages
                        if (isset($_GET['success'])) {
                            echo "<p class='alert alert-success'> <i class=' fa fa-exclamation-circle'></i> <strong>¡Bien hecho! </strong>Agregado exitosamente!</p>";
                        }elseif(isset($_GET['error'])) {
                             echo "<p class='alert alert-warning'> <i class=' fa fa-exclamation-circle'></i> Hubo un error al dar los permisos!</p>";
                        }elseif (isset($_GET['error2'])) {
                            echo "<p class='alert alert-info'> <i class=' fa fa-exclamation-circle'></i> No puedes agregarte tu mismo!</p>";
                        }elseif (isset($_GET['error3']) && isset($_GET['not_found'])) {
                            echo "<p class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> El usuario no existe!</p>";
                        }elseif (isset($_GET['errorpermission'])) {
                            echo "<p class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> No se puede repetir el permiso!</p>";
                        }
                    ?>
                    <?php
                        // get messages
                        if (isset($_GET['delsuccess'])) {
                            echo "<p class='alert alert-success'> <i class=' fa fa-exclamation-circle'></i> <strong>¡Bien hecho! </strong>Eliminado correctamente!</p>";
                        }elseif(isset($_GET['delerror'])) {
                             echo "<p class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> Hubo un error al eliminar al usuario!</p>";
                        }elseif (!isset($_GET['delerror']) and !isset($_GET['delsuccess']) and !isset($_GET['errorpermission']) and !isset($_GET['error3']) and !isset($_GET['not_found']) and !isset($_GET['error2']) and !isset($_GET['error']) and !isset($_GET['success'])) {
                             echo "<div class='alert alert-warning alert-dismissible' role='alert'>
                                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                    <strong>¡Advertencia!</strong> Si compartes una carpeta, das los permisos de: <strong class='text-danger'>COMPARTIR, EDITAR Y ELIMINAR.</strong>
                                </div>";
                        }
                    ?>

                    <div class="box box-warning"><!-- general form elements -->
                        <div class="box-header with-border">
                          <h3 class="box-title"><i class="fa fa-unlock-alt"> Permisos: </i><a href="file.php?code=<?php echo $file_code; ?>"> <?php echo $file_filename; ?></a></h3>
                        </div><!-- /.box-header -->
                        <form method="post" action="action/addfilepermision.php" role="form"><!-- form start -->
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Permisos:</label>
                                    <select name="p_id" class="form-control select2" style="width: 100%;">
                                      <option value="1">Ver, Dercargar y Comentar</option>
                                    </select>
                                </div>
                               
                                <div class="form-group">
                                    <label for="email">Correo Electrónico</label>
                                    <select class="form-control select2" style="width: 100%;" required name="email" id="email">
                                        <?php $users=mysqli_query($con,"select * from user where is_active=1"); 
                                            foreach ($users as $user) {
                                        ?>
                                            <option value="<?php echo $user['email'] ?>"><?php echo $user['fullname'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                               <!--  <div class="form-group">
                                    <label for="exampleInputEmail1">Ubicacion</label>
                                    <select class="form-control select2" style="width: 100%;" name="folder_id">
                                        <option value="">Mi unidad</option>
                                        <?php 
                                            function getfolders($id,$lev){
                                                global $con;
                                                $folder = mysqli_query($con, "select * from file where id=$id");
                                                $folder_rw = mysqli_fetch_array($folder);
                                                $str = str_repeat("+", $lev);
                                                echo "<option value='".$folder_rw['id']."'>".$str.$folder_rw['filename']."</option>";

                                                $folder_id=$folder_rw['id'];
                                                $getFoldersByFolderId=mysqli_query($con, "select * from file where folder_id=$folder_id and is_folder=1 and status=1 order by created_at desc");
                                                foreach($getFoldersByFolderId as $f){
                                                    getfolders($f['id'],$lev+1);
                                                }
                                            }
                                            $user_id=$_SESSION["user_id"];
                                            $getRootFoldersByUserId=mysqli_query($con, "select * from file where user_id=$user_id and is_folder=1 and folder_id is NULL and status=1 order by created_at desc");
                                            foreach($getRootFoldersByUserId as $f):
                                                getfolders($f['id'],0);
                                            endforeach;
                                        ?>
                                    </select>
                                </div> -->

                            </div><!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="file_id" value="<?php echo $file_id;?>">
                                <button type="submit" class="btn btn-warning">Agregar</button>
                            </div>
                        </form>
                    </div><!-- /.box -->
                </div>
            </div><!-- /.row -->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?php 
                    $permisions = mysqli_query($con,"select * from permision where file_id=$file_id");
                    $count=mysqli_num_rows($permisions);
                    ?>
                <?php if($count>0):?>
                <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Usuarios: </h3>
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding" style="margin: 10px">
                            <table class="table table-bordered table-hover table-striped">
                                <tbody><tr>
                                    <th>Nombre</th>
                                    <th>Permisos</th>
                                    <th>Fecha</th>
                                    <th></th>
                                </tr>
                                <?php foreach($permisions as $p):

                                    $permission_id=$p['user_id'];
                                    $permi=mysqli_query($con,"select * from permision where user_id=$permission_id");
                                    while ($usi=mysqli_fetch_array($permi)) {
                                        $userd=$usi['user_id'];

                                    }
                                    $userss=mysqli_query($con,"select * from user where id=$userd");
                                    while($com2=mysqli_fetch_array($userss)){
                                        $fullname=$com2['fullname'];
                                    }
                                   
                                ?> 
                                <tr>
                                    <td><?php echo $fullname;?></td>
                                    <td><?php if($p['p_id']==1){ echo "Ver, Descargar y Comentar"; }?></td>
                                    <td><span class="label label-warning"><?php echo $p['created_at'];?></span></td>
                                    <td style="width:30px;">
                                      <a href="action/delfilepermision.php?id=<?php echo $p['id']; ?>" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                            <br>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                    <?php else:?>
                    <div class="col-md-6 col-md-offset-3">
                        <!-- message file permision null -->
                    </div>
                    <?php endif;?>
                </div>
            </div>
        </section>
    </div><!-- /.content -->

<?php include "footer.php"; ?>