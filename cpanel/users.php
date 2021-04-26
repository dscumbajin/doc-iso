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
                                        <th class="hidden-xs hidden-sm">Activo(a)</th>
                                        <th class="hidden-xs hidden-sm">Administrador</th>
                                        <th class="hidden-xs hidden-sm">Publico</th>
                                        <th class="hidden-xs hidden-sm">Evaluador</th>
                                        <th class="hidden-xs hidden-sm">Agregado el</th>
                                        <th class="hidden-xs hidden-sm">Acciones</th>
                                        <th class="hidden-lg hidden-md"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $users = mysqli_query($con, "select * from user");
                                    foreach ($users as $user) :
                                    ?>
                                        <tr>
                                            <td style="width: 250px">
                                                <a style="font-weight: bold;" title="Detalle descargas" href="detallefiles.php?id=<?php echo $user['id'] ?>&nom_user=<?php echo $user['fullname'] ?>"><i class="fa fa-server" style="color: black;"></i> <?php echo $user['fullname'] ?> </a>
                                            </td>
                                            <td ><?php echo $user['email'] ?></td>
                                            <td class="hidden-xs hidden-sm" style="text-align: center;">
                                                <?php
                                                if ($user['is_active'] == 1) {
                                                    echo "<span class='label label-success'>Activo</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>Inactivo</span>";
                                                }
                                                ?>
                                            </td>
                                            <td class="hidden-xs hidden-sm" style="text-align: center;">
                                                <?php
                                                if ($user['is_admin'] == 1) {
                                                    echo "<span class='label label-success'>Si</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                            <td class="hidden-xs hidden-sm" style="text-align: center;">
                                                <?php
                                                if ($user['is_public'] == 1) {
                                                    echo "<span class='label label-success'>Si</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                            <td class="hidden-xs hidden-sm" style="text-align: center;">
                                                <?php
                                                if ($user['is_evaluator'] == 1) {
                                                    echo "<span class='label label-success'>Si</span>";
                                                } else {
                                                    echo "<span class='label label-danger'>No</span>";
                                                }
                                                ?>
                                            </td>
                                            <td class="hidden-xs hidden-sm" ><?php echo $user['created_at'] ?></td>
                                            <td >
                                                <!--PUBLICO-->
                                                <a title="Editar perfil" href="profile?id=<?php echo $user['id']; ?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i></a>
                                                <a title="Deshabilitar " href="action/deluser?id=<?php echo $user['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                                <a title="Habilitar" href="action/activaruser?id=<?php echo $user['id']; ?>" class="btn btn-xs btn-success"><i class="fa fa-check-square"></i></a>
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
<script>

</script>