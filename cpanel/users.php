<?php 


    $active3="active"; 
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
                    <!-- <div class="box-header">
                        <h3 class="box-title">Hover Data Table</h3>
                    </div> -->
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                  <th>Nombre</th>
                                  <th>Correo Electrónico</th>
                                  <th>Activo(a)</th>
                                  <th>Agregado el</th>
                                  <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                $users=mysqli_query($con,"select * from user");
                                foreach($users as $user):
                            ?>
                                <tr>
                                    <td><?php echo $user['fullname'] ?></td>
                                    <td><?php echo $user['email'] ?></td>
                                    <td>
                                        <?php 
                                            if($user['is_active']==1){
                                                echo "<span class='label label-success'>Activo</span>";
                                            }else{
                                                echo "<span class='label label-danger'>Inactivo</span>";
                                            }
                                        ?>
                                    </td>
                                    <td><?php echo $user['created_at'] ?></td>
                                    <td class="" style="width:223px;">
                                        <a title="Eliminar definitivamente" href="action/deluser?id=<?php echo $user['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Banear</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>    
                            </tbody>    
                        </table>
                    </div><!-- /.box-body -->
                </div> <!-- /.box -->
            </div>
        </div>
    </section>
</div>                
<?php include "footer.php" ?>