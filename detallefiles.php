<?php

$active2 = "active";
include "header.php";
?>
<?php
$alphabeth = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
$token = "";
for ($i = 0; $i < 6; $i++) {
    $token .= $alphabeth[rand(0, strlen($alphabeth) - 1)];
}
$_SESSION["tkn"] = $token;
$id_user = $_GET["id"];
$folder = null;

?>

<div class="content-wrapper">
    <!-- Content Wrapper. Contains page content -->
    <section class="content-header">
        <!-- Content Header (Page header) -->
        <h1><?php if ($folder == null) : ?>
                Detalle archivos Descargados
            <?php else : ?>
                <?php
                foreach ($folder as $clave_carpetas) {
                    echo $clave_carpetas['filename'];
                }
                ?>
            <?php endif; ?>
        </h1>

    </section>

    <section class="content">
        <!-- Main content -->
        <div class="row">
            <!-- Small boxes (Stat box) -->
            <div class="col-md-12">
                <?php
                $files = null;
                $sql = "select * from descargas INNER JOIN file ON file.id = descargas.id_file where id_user=$id_user";
                $files = mysqli_query($con, $sql);
                //if(@mysqli_num_rows($folder)==0){

                ?>

                <?php
                //if(mysqli_num_rows($files)>0):
                if (count($files) > 0) :
                    // var_dump($files);
                ?>

                    <?php
                    // get messages
                    if (isset($_GET['delsuccess'])) {
                        echo "<p class='alert alert-success'> <i class=' fa fa-exclamation-circle'></i> <strong>¡Bien hecho! </strong>Eliminado exitosamente!</p>";
                    } elseif (isset($_GET['delerror'])) {
                        echo "<p class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> Hubo un error al eliminar el archivo, puede que contenga archivos dentro.</p>";
                    } elseif (isset($_GET['delinvalid'])) {
                        echo "<p class='alert alert-warning'> <i class=' fa fa-exclamation-circle'></i> Permiso Denegado!.</p>";
                    }
                    ?>

                    <div class="box">
                        <div class="box-body no-padding" style="margin: 15px">
                            <table id="example1" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th class="hidden-xs hidden-sm"># Descargas</th>
                                        <th>Archivo</th>
                                        <th class="hidden-xs hidden-sm">Descripción</th>
                                        <th class="hidden-xs hidden-sm">Tamaño</th>
                                        <th class="hidden-xs hidden-sm">Subidol el:</th>
                                        <th class="hidden-xs hidden-sm"></th>
                                        <th class="hidden-lg hidden-md"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($files as $file) : ?>
                                        <tr>
                                            <td class="hidden-xs hidden-sm" style="width: 100px; text-align: center;"><?php echo $file['contador']; ?></td>
                                            <td style="width: 250px">
                                                <?php if ($file['is_folder']) : ?>
                                                    <a href="myfiles?folder=<?php echo $file['code']; ?>">
                                                        <i class="fa fa-folder"></i>
                                                    <?php else : ?>

                                                        <a href="file?code=<?php echo $file['code']; ?>">
                                                            <?php

                                                            $url = "storage/data/" . $file['user_id'] . "/" . $file['filename'];
                                                            $ftype = explode(".", $url);
                                                            $count = count($ftype) - 1;

                                                            if ($file['filename'] != "") {
                                                                if (!$file['is_folder']) {
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
                                                            }
                                                            ?>
                                                        <?php endif; ?>
                                                        <?php echo $file['filename']; ?></a>
                                            </td>

                                            <td class="hidden-xs hidden-sm" style="width: 350px"><?php echo $file['description']; ?></td>

                                            <td class="hidden-xs hidden-sm">
                                                <?php
                                                $url = "storage/data/" . $file['user_id'] . "/" . $file['filename'];
                                                /* var_dump($url); */
                                                if (file_exists($url)) {
                                                    $fsize = filesize($url);
                                                    if ($file['filename'] != "") {
                                                        if (!$file['is_folder']) {
                                                            if ($fsize > 1000 * 1000 * 1000) {
                                                                echo ($fsize / 1000 * 1000 * 1000) . "Gb";
                                                            } else if ($fsize > 1000 * 1000) {
                                                                echo ($fsize / 1000 * 1000) . "Mb";
                                                            } else if ($fsize > 1000) {
                                                                echo ($fsize / 1000) . "Kb";
                                                            } else if ($fsize > 0) {
                                                                echo $fsize . "B";
                                                            } else {
                                                                echo $fsize;
                                                            }
                                                        }
                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td style="width: 125px;" class="hidden-xs hidden-sm"><?php echo $file['created_at']; ?></td>
                                            <td class="hidden-xs hidden-sm" style="width:223px;">
                                                <a title="Compartir con amigos" href="filepermision?id=<?php echo $file['code']; ?>" class="btn btn-xs btn-default"><i class="fa fa-globe"></i></a>
                                                <a title="Editar" href="editfile?id=<?php echo $file['code']; ?>" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                                <a title="Mover a la papelera" href="action/recicle?id=<?php echo $file['code']; ?>&tkn=<?php echo $_SESSION["tkn"] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
                                            </td>
                                            <td class="hidden-lg hidden-md">
                                                <div class="dropdown">
                                                    <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                        <span class="caret"></span>
                                                    </a>

                                                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                        <li>
                                                            <a href="filepermision?id=<?php echo $file['code']; ?>"><i class="fa fa-globe"></i> Compartir</a>
                                                        </li>
                                                        <li>
                                                            <a href="editfile?id=<?php echo $file['code']; ?>"><i class="fa fa-pencil"></i> Editar</a>
                                                        </li>
                                                        <li>
                                                            <a href="action/recicle?id=<?php echo $file['code']; ?>&tkn=<?php echo $_SESSION["tkn"] ?>"><i class="fa fa-trash"></i> Eliminar</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body --><br>
                    </div><!-- /.box -->
                <?php else : ?>
                    <div class="col-md-6 col-md-offset-3">
                        <p class="alert alert-warning"> <i class="
                        fa fa-exclamation-triangle"></i> No se encontraron archivos en la carpeta actual</p>
                    </div>
                    <?php //var_dump($files) 
                    ?>
                <?php endif; ?>
            </div>
        </div><!-- /.row -->
    </section>
</div><!-- /.content -->

<?php include "footer.php"; ?>