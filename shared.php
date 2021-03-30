<?php

$active3 = "active";
include "header.php";
?>

<div class="content-wrapper">
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <!-- Content Header (Page header) -->
        <h1><i class="fa fa-globe"></i> Archivos Compartidos Conmigo</h1>
        <ol class="breadcrumb">
            <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Compartidos conmigo</li>
        </ol>
    </section>
    <section class="content">
        <!-- Main content -->
        <div class="row">
            <!-- Small boxes (Stat box) -->
            <div class="col-xs-12">
                <?php
                $user = $_SESSION["user_id"];
                $files = mysqli_query($con, "select * from permision where user_id=" . $user);
                $count = mysqli_num_rows($files);
                ?>
                <?php if ($count > 0) : ?>
                    <div class="box ">
                        <!-- <div class="box-header"></div> -->
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <div class="box-body table-responsive no-padding">
                                <table class="table table-bordered table-hover table-striped">
                                    <tbody>
                                        <tr>
                                            <th>Archivo</th>
                                            <th>Descripción</th>
                                            <th>Fecha</th>
                                        </tr>
                                        <?php foreach ($files as $fx) :
                                            $file_id = $fx['file_id'];

                                            $file = mysqli_query($con, "select * from file where id=$file_id");
                                            while ($row = mysqli_fetch_array($file)) {
                                                $file_is_folder = $row['is_folder'];
                                                $file_filename = $row['filename'];
                                                $file_code = $row['code'];
                                                $file_description = $row['description'];
                                                $file_created_at = $row['created_at'];
                                            }
                                            // echo var_dump($file);
                                        ?>
                                            <tr>
                                                <td>
                                                    <?php if ($file_is_folder) : ?>
                                                        <a href="myfiles?folder=<?php echo $file_code; ?>">
                                                            <i class="fa fa-folder"></i>
                                                        <?php else : ?>
                                                            <a href="file?code=<?php echo $file_code; ?>">
                                                                <?php
                                                                //by abisoft
                                                                $url = "storage/data/" . $file_is_folder . "/" . $file_filename;
                                                                $ftype = explode(".", $url);
                                                                $count = count($ftype) - 1;

                                                                if ($file_filename != "") {
                                                                    if ($ftype[$count] == "png" || $ftype[$count] == "jpeg" || $ftype[$count] == "gif" || $ftype[$count] == "jpg" || $ftype[$count] == "bmp") {
                                                                        echo "<i class='fa fa-file-image-o'></i>";
                                                                    } elseif ($ftype[$count] == "mp3" || $ftype[$count] == "wav" || $ftype[$count] == "wma" || $ftype[$count] == "ogg" || $ftype[$count] == "mp4") {
                                                                        echo "<i class='fa fa-file-audio-o'></i>";
                                                                    } elseif ($ftype[$count] == "zip" || $ftype[$count] == "rar" || $ftype[$count] == "tgz" || $ftype[$count] == "tar") {
                                                                        echo "<i class='fa fa-file-archive-o'></i>";
                                                                    } elseif ($ftype[$count] == "php" || $ftype[$count] == "php3" || $ftype[$count] == "html" || $ftype[$count] == "css" || $ftype[$count] == "py" || $ftype[$count] == "java" || $ftype[$count] == "js" || $ftype[$count] == "sql") {
                                                                        echo "<i class='fa fa-file-code-o'></i>";
                                                                    } elseif ($ftype[$count] == "pdf") {
                                                                        echo "<i class='fa fa-file-pdf-o'></i>";
                                                                    } elseif ($ftype[$count] == "xlsx") {
                                                                        echo "<i class='fa fa-file-excel-o'></i>";
                                                                    } elseif ($ftype[$count] == "pptx") {
                                                                        echo "<i class='fa fa-file-powerpoint-o'></i>";
                                                                    } elseif ($ftype[$count] == "docx") {
                                                                        echo "<i class='fa fa-file-word-o'></i>";
                                                                    } elseif ($ftype[$count] == "txt") {
                                                                        echo "<i class='fa fa-file-text-o'></i>";
                                                                    } elseif ($ftype[$count] == "avi" || $ftype[$count] == "avi" || $ftype[$count] == "asf" || $ftype[$count] == "dvd" || $ftype[$count] == "m1v" || $ftype[$count] == "movie" || $ftype[$count] == "mpeg" || $ftype[$count] == "wn" || $ftype[$count] == "wmv") {
                                                                        echo "<i class='fa fa-file-video-o'></i>";
                                                                    } else {
                                                                        echo "<i class='fa fa-file-o'></i>";
                                                                    }
                                                                }
                                                                ?>
                                                            <?php endif; ?>
                                                            <?php echo $file_filename; ?></a>
                                                </td>
                                                <td style="width: 600px"><?php echo $file_description; ?></td>
                                                <td><?php echo $file_created_at; ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div><!-- /.box-body -->
                        </div>
                    </div><!-- /.box -->
                <?php else : ?>
                    <div class="col-md-6 col-md-offset-3">
                        <br><br><br><br><br>
                        <p class="alert alert-warning">
                            <i class="fa fa-exclamation-triangle"></i>
                            No se encontraron archivos en la carpeta actual
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- /.row -->
    </section>
</div><!-- /.content -->


<?php include "footer.php"; ?>