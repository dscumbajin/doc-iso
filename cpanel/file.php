<?php

$active2 = "active";
include "header.php";
?>
<?php
$file = null;
if (isset($_GET["code"]) && $_GET["code"] != "") {
    $id_code = $_GET["code"];
    $file = mysqli_query($con, "select * from file where code=\"$id_code\"");

    while ($row = mysqli_fetch_array($file)) {
        $file_id = $row['id'];
        $is_public = $row['is_public'];
        $user_id = $row['user_id'];
        $code = $row['code'];
        $filename = $row['filename'];
        $description = $row['description'];
        $created_at = $row['created_at'];
        $file_count = $row['download'];

        $folder_id = $row['folder_id'];
    }
}

$is_public = false;
$is_logged = false;
$is_owner = false;
$go = false;


if ($is_public) {
    $is_public = true;
}
if (isset($_SESSION["admin_id"])) {
    $is_logged = true;
}

if (@$is_logged) {
    $is_owner = true;
}

if ($is_public) {
    $go = true;
}
if (!$is_logged) {

    print "<script>alert(\"Acceso Denegado!\")</script>";
    print "<script>window.location='./';</script>";
} else if ($go == false && !$is_owner) {

    @$ps = mysqli_query($con, "select * from permision where file_id=" . $file_id);
    $found = false;
    foreach ($ps as $p) {
        //if($p['user_id']==$_SESSION["user_id"]){
        $found = true;
        //}
    }

    if ($found == true) {
        $go = true;
    } else {
        print "<script>alert(\"Acceso Denegado!\")</script>";
        echo "<script>window.location='./';</script>";
    }
}
?>

<?php if ($go || $is_owner) : ?>
    <div class="content-wrapper">
        <!-- Content Wrapper. Contains page content -->
        <section class="content-header">
            <!-- Content Header (Page header) -->
            <h1>Mis Archivos <small><?php echo $filename; ?></small> </h1>
            <?php if (isset($_SESSION["admin_id"])) : ?>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="myfiles"><i class="fa fa-archive"></i> Mis Archivos</a></li>

                    <?php
                    if ($folder_id != 0) {
                        $f = mysqli_query($con, "select * from file where id=$folder_id");
                        while ($g = mysqli_fetch_array($f)) {
                            $f_code = $g['code'];
                            $f_filename = $g['filename'];
                        }
                        echo '<li class="active"><a href="myfiles?folder=' . $f_code . '"><i class="fa fa-folder-open"></i> ' . $f_filename . '</a></li>';
                    }
                    ?>
                </ol>
            <?php endif; ?>
        </section>
        <section class="content">
            <!-- Main content -->
            <div class="row">
                <!-- Small boxes (Stat box) -->
                <div class="col-lg-6 col-xs-12 col-md-offset-3">
                    <div id="resultados_ajax"></div><!-- Resultados Ajax -->
                    <?php
                    $session = sha1(md5($_SESSION['admin_id']));
                    $alphabeth = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
                    $token = "";
                    for ($i = 0; $i < 75; $i++) {
                        $token .= $alphabeth[rand(0, strlen($alphabeth) - 1)];
                    }

                    $id_cript = sha1(md5($file_id));

                    //funcion de url base;
                    $url_base = url_base();

                    $url1 = $url_base . "file?code=" . $_GET['code'];

                    $url2 = $url_base . "cm0bNQR0rVW2?c=" . $_GET['code'] . "&i=" . $id_cript . "&s=" . $session . "&t=" . $token;

                    $url3 = $url_base . "action/dwnfl?code=" . $code . "&id=" . $file_id . "&count=" . $file_count;
                    ?>
                    <div style="padding-right:6px;" class="btn-group  pull-right">
                        <!-- <a onclick="copylink('copy')" class="btn btn-default"><i class="fa fa-link"></i> Copiar enlace</a> -->

                        <p style="display: none;" id="copyprivate"><?php echo $url1 ?></p>
                        <p style="display: none;" id="copypublic"><?php echo $url2 ?></p>
                        <p style="display: none;" id="copydown"><?php echo $url3 ?></p>

                        <!-- <div class="dropdown">
                            <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" class="btn btn-default">
                            <i class="fa fa-link"></i> Copiar Enlace
                            <span class="caret"></span>
                          </a>

                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                <li>
                                    <a href="#" onclick="copylinkpublic('copypublic')"><i class="fa fa-globe"></i> Enlace Publico</a>
                                </li>
                                <li>
                                    <a href="#" onclick="copylinkprivate('copyprivate')"><i class="fa fa-unlock-alt"></i> Enlace Privado</a>
                                </li>
                            </ul>
                        </div> -->
                    </div>

                    <br>
                    <?php if (mysqli_num_rows($file) == 0) : ?>
                        <h1>404</h1>
                    <?php else : ?>
                        <br>
                        <?php
                        //$filename1=$filename;
                        $url = "../storage/data/" . $user_id . "/" . $filename;
                        if (file_exists($url)) {
                            $ftype = explode(".", $url);
                            if ($filename != "") {
                                if ($ftype[1] == "png" || $ftype[1] == "jpg" || $ftype[1] == "gif" || $ftype[1] == "jpeg") {
                                    echo " <img src=\"$url\" class=\"offline\" width=\"540\">";
                                } else {
                                    echo "<h2>$filename</h2>";
                                }
                            } ?>
                            <!--BOTON DESCARGA-->
                            <div class="btn-group  pull-right">
                                <a id='no_file' href="action/dwnfl?code=<?php echo $code; ?>&id=<?php echo $file_id; ?>&count=<?php echo $file_count; ?>" class="btn btn-default"><i class="fa fa-download"></i> Descargar</a>
                            </div>
                            <!--FIN BOTON DESCARGA-->

                            <!--COMENTARIOS-->
                            <br><br>
                            <p><?php echo $description; ?></p><br>
                            <p class="text-muted text-right"><i class="fa fa-clock-o"></i> <?php echo $created_at; ?></p>
                            <br><br>
                            <?php
                            $comments = mysqli_query($con, "select * from comment where file_id=" . $file_id);
                            $count = mysqli_num_rows($comments);
                            ?>
                            <?php
                            // get messages
                            if (isset($_GET['success'])) {
                                echo "<p class='alert alert-success'> <i class=' fa fa-exclamation-circle'></i> <strong>¡Comentario agregado! </strong> .</p>";
                            } elseif (isset($_GET['error'])) {
                                echo "<p class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> <strong>¡Error! </strong>No se puede comentar este archivo.</p>";
                            }
                            ?>

                            <div class="box box-success">
                                <!-- small box -->
                                <div class="box-header">
                                    <i class="fa fa-comments-o"></i>
                                    <h3 class="box-title">Comentarios (<?php echo $count ?>)</h3>
                                </div>
                                <?php if ($count > 0) : ?>
                                    <div class="box-body chat" id="chat-box">
                                        <div class="item">
                                            <!-- chat item -->
                                            <?php foreach ($comments as $com) : ?>
                                                <?php

                                                $com_user_id = $com['user_id'];
                                                $commm = mysqli_query($con, "select * from comment where user_id=$com_user_id");
                                                while ($usi = mysqli_fetch_array($commm)) {
                                                    $userd = $usi['user_id'];
                                                }
                                                $userss = mysqli_query($con, "select * from user where id=$userd");
                                                while ($com2 = mysqli_fetch_array($userss)) {
                                                    $profile_pic = $com2['image'];
                                                    $fullname = $com2['fullname'];
                                                }
                                                ?>
                                                <img src="../images/profiles/<?php echo $profile_pic; ?>" alt="user image" class="offline">
                                                <p class="message">
                                                    <small class="text-muted pull-right"><i class="fa fa-clock-o"></i><?php echo $com['created_at']; ?></small>
                                                    <a href="#" class="name">
                                                        <?php echo $fullname;  ?>
                                                    </a>
                                                    <?php echo $com['comment']; ?>
                                                </p>
                                            <?php endforeach; ?>
                                        </div><!-- /.item -->
                                    </div><!-- /.chat -->

                                <?php endif; ?>
                                <div class="box-footer">
                                    <form method="post" action="action/addfilecomment.php">
                                        <div class="input-group">
                                            <input type="hidden" value="<?php echo $file_id ?>" name="id">
                                            <input name="comment" required class="form-control" placeholder="Escribe un comentario...">
                                            <div class="input-group-btn">
                                                <button type="submit" class="btn btn-success"><i class="fa fa-comments"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!--FIN COMENTARIOS-->
                        <?php } else {
                            echo  "<h1 class='text-muted'>Error 404 El archivo no existe</h1>";
                        }
                        ?>
                    <?php endif; ?>

                    <?php if (mysqli_num_rows($file) != 0) : ?>
                    <?php else : ?>
                        <div class="jumbotron">
                            <h2>No hay archivos</h2>
                            <p>No se encontraron archivos en la carpeta actual.</p>
                        </div>
                    <?php endif; ?>
                </div><!-- ./col -->
            </div><!-- /.row -->
        </section>
    </div><!-- /.content -->
<?php endif; ?>


<script>
    function copylinkdown(id) {
        var aux = document.createElement("input");
        aux.setAttribute("value", document.getElementById(id).innerHTML);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
    }

    function copylinkpublic(id) {
        var aux = document.createElement("input");
        aux.setAttribute("value", document.getElementById(id).innerHTML);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
    }

    function copylinkprivate(id) {
        var aux = document.createElement("input");
        aux.setAttribute("value", document.getElementById(id).innerHTML);
        document.body.appendChild(aux);
        aux.select();
        document.execCommand("copy");
        document.body.removeChild(aux);
    }
</script>

<?php include "footer.php"; ?>
<script>
    $("#nuevo_registro").submit(function(event) {
        $('#guardar_datos').attr("disabled", true);
        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "action/compartir_email.php",
            data: parametros,
            beforeSend: function(objeto) {
                $("#resultados_ajax").html("Enviando...");
            },
            success: function(datos) {
                $("#resultados_ajax").html(datos);
                $('#guardar_datos').attr("disabled", false);
                load(1);
                window.setTimeout(function() {
                    $(".alert").fadeTo(500, 0).slideUp(500, function() {
                        $(this).remove();
                    });
                }, 5000);
                $('#formModal').modal('hide');
            }
        });
        event.preventDefault();
    })
</script>