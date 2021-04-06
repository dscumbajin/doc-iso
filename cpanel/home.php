<?php

$active1 = "active";
include "header.php";

$id = $_SESSION['admin_id'];
$is_public = $_SESSION['is_public'];
$count_files = mysqli_query($con, "select * from file where is_folder = 0");
$count_download = mysqli_query($con, "select sum(download) as download from file");
$count_user = mysqli_query($con, "select * from user");
$count_comments = mysqli_query($con, "select * from comment")

?>
<div class="content-wrapper">
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <!-- Content Header (Page header) -->
        <h1>Dashboard<small>Panel de control</small> </h1>
        <ol class="breadcrumb">
            <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
    <section class="content">
        <!-- Main content -->
        <div class="row">
            <!-- Small boxes (Stat box) -->
            <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3><?php echo mysqli_num_rows($count_files); ?></h3>
                        <p>Archivos</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-file"></i>
                    </div>
                    <a href="files.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div><!-- ./col -->
            <!--DESCARGAS-->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-red">
                    <!-- small box -->
                    <div class="inner">
                        <?php
                        //compruebo si existing by abissoft
                        if (mysqli_num_rows($count_files) != null) {
                            foreach ($count_download as $count) {
                        ?>
                                <h3><?php echo $count['download']; ?></h3>
                            <?php
                            } //end foreach
                        } else {

                            ?>
                            <h3>0</h3>
                        <?php
                        }

                        ?>
                        <p>Descargas</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-download"></i>
                    </div>
                </div>
            </div><!-- ./col -->
            <!--FIN DESCARGAS-->
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <!-- small box -->
                    <div class="inner">
                        <h3><?php echo mysqli_num_rows($count_comments); ?></h3>
                        <p>Comentarios</p>
                    </div>
                    <div class="icon">
                        <i class="fa fa-comment"></i>
                    </div>
                </div>
            </div><!-- ./col -->

            <?php
            if ($is_public == 0) : ?>
                <div class="col-lg-3 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3><?php echo mysqli_num_rows($count_user); ?></h3>
                            <p>Usuarios</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-file"></i>
                        </div>
                        <a href="users.php" class="small-box-footer">Más info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div><!-- ./col -->
            <?php endif; ?>


        </div><!-- /.row -->
        <div class='row'>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h4>Archivos vrs Carpetas <small>Reporte mensual</small></h4>
                        <div class="clearfix"></div>
                    </div>
                    <div class="box-body"><iframe class="chartjs-hidden-iframe" style="width: 100%; display: block; border: 0px; height: 0px; margin: 0px; position: absolute; left: 0px; right: 0px; top: 0px; bottom: 0px;"></iframe>
                        <canvas id="mybarChart2" style="width: 521px; height: 260px;" width="521" height="260"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div><!-- /.content -->

<?php include "footer.php"; ?>
<?php
function archivos($month)
{
    global $con;
    $year = date('Y');
    //$user_id=$_SESSION['user_id'];
    $sql = mysqli_query($con, "select count(id) as total from file where is_folder=0 and year(created_at) = '$year' and month(created_at)= '$month' ");
    $rw = mysqli_fetch_array($sql);
    echo $total = $rw['total'];
}
function carpetas($month)
{
    global $con;
    $year = date('Y');
    //$user_id=$_SESSION['user_id'];
    $sql = mysqli_query($con, "select count(id) as total from file where is_folder=1 and year(created_at) = '$year' and month(created_at)= '$month' ");
    $rw = mysqli_fetch_array($sql);
    echo $total = $rw['total'];
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
<script>
    if ($("#mybarChart2").length) {
        var f = document.getElementById("mybarChart2");
        new Chart(f, {
            type: "bar",
            data: {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
                datasets: [{
                        label: "Archivos",
                        backgroundColor: "#f39c12",
                        data: [<?php echo archivos(1); ?>, <?php echo archivos(2); ?>, <?php echo archivos(3); ?>, <?php echo archivos(4); ?>, <?php echo archivos(5); ?>, <?php echo archivos(6); ?>, <?php echo archivos(7); ?>, <?php echo archivos(8); ?>, <?php echo archivos(9); ?>, <?php echo archivos(10); ?>, <?php echo archivos(11); ?>, <?php echo archivos(12); ?>]
                    },
                    {
                        label: "Carpetas",
                        backgroundColor: "#dd4b39",
                        data: [<?php echo carpetas(1); ?>, <?php echo carpetas(2); ?>, <?php echo carpetas(3); ?>, <?php echo carpetas(4); ?>, <?php echo carpetas(5); ?>, <?php echo carpetas(6); ?>, <?php echo carpetas(7); ?>, <?php echo carpetas(8); ?>, <?php echo carpetas(9); ?>, <?php echo carpetas(10); ?>, <?php echo carpetas(11); ?>, <?php echo carpetas(12); ?>]
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: !0
                        }
                    }]
                }
            }
        })
    }
</script>