<?php


$active3 = "active";
include "header.php";
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>Usuarios</h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Inicio</a></li>
            <li class="active">Usuarios</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box-body ">
                        <div class="box-body table-responsive">
                        <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Correo Electrónico</th>
                                        <th>Activo(a)</th>
                                        <th>Perfil</th>
                                        <th>Agregado el</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $users = mysqli_query($con, "select * from user");
                                    foreach ($users as $user) :
                                    ?>
                                        <tr>
                                            <td><?php echo $user['fullname'] ?></td>
                                            <td><?php echo $user['email'] ?></td>
                                            <td>
                                                <?php
                                                if ($user['is_active'] == 1) {
                                                    echo "<span class='label label-success'>Activo</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>Inactivo</span>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($user['is_admin'] == 1) {
                                                    echo "<span class='label label-success'>Administrador</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>User</span>";
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $user['created_at'] ?></td>
                                            <td>
                                                <!--PUBLICO-->
                                                <a title="Editar perfil" href="action/deluser?id=<?php echo $user['id']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Editar</a>
                                                <a title="Eliminar definitivamente" href="action/deluser?id=<?php echo $user['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div><!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
        </div>
    </section>
</div>
<?php include "footer.php" ?>