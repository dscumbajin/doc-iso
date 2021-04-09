<?php
session_start();
//Contiene las variables de configuracion para conectar a la base de datos
include_once "../../config/config.php";
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';
//ESTADO DEL USUARIO - Usuario publico
$is_public = $_SESSION['is_public'];

if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    // idUsu, usuario, nombreUsu, password, mail, idPerfil
    $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q2'], ENT_QUOTES)));
    echo "<script>$('#tabla_original').show();</script>";
    if ($_GET['q2'] != "") {
        echo "<script>$('#tabla_original').hide();</script>";
        $aColumns = array('filename'); //Columnas de busqueda
        $sTable = "file";
        if ($is_public == 0) {
            $sWhere = "WHERE is_deleted=0   and (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
            $sWhere .= " order by is_folder desc, filename asc";
        } else {
            $sWhere = "WHERE is_deleted=0   and is_public=1 and (";
            for ($i = 0; $i < count($aColumns); $i++) {
                $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
            }
            $sWhere = substr_replace($sWhere, "", -3);
            $sWhere .= ')';
            $sWhere .= " order by is_folder desc, filename asc";
        }

        include 'pagination.php'; //include pagination file
        //pagination variables
        $page = (isset($_REQUEST['page']) && !empty($_REQUEST['page'])) ? $_REQUEST['page'] : 1;
        $per_page = 10; //how much records you want to show
        $adjacents  = 4; //gap between pages after number of adjacents
        $offset = ($page - 1) * $per_page;
        //Count the total number of row in your table*/
        $count_query   = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable  $sWhere");
        $row = mysqli_fetch_array($count_query);
        $numrows = $row['numrows'];
        $total_pages = ceil($numrows / $per_page);
        $reload = '../files.php';
        //main query to fetch the data
        $sql = "SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
        $query = mysqli_query($con, $sql);
        //loop through fetched data

        if ($numrows > 0) {
?>
            <div class="table-responsive">
                <table id="registros" class="table table-bordered table-striped">
                    <tr class="info">

                        <th>Archivo</th>
                        <th>Descripción</th>
                        <th>Usuario</th>
                        <th>Correo Electrónico</th>
                        <th>Tamaño</th>
                        <th>Subido el:</th>
                        <?php if ($is_public == 0) : ?>
                            <th class="hidden-xs hidden-sm">Acciones </th>
                        <?php endif; ?>

                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query)) {
                        // idUsu, usuario, nombreUsu, password, mail, idPerfil
                        $id = $row['id'];
                        $code = $row['code'];
                        $filename = $row['filename'];
                        $description = $row['description'];
                        $download = $row['download'];
                        $is_public = $row['is_public'];
                        $is_folder = $row['is_folder'];
                        $is_deleted = $row['is_deleted'];
                        $user_id = $row['user_id'];
                        $created_at = $row['created_at'];

                    ?>

                        <tr>
                            <td style="width: 250px">
                                <?php if ($row['is_folder']) : ?>
                                    <a href="files?folder=<?php echo $row['code']; ?>">
                                        <i class="fa fa-folder"></i>
                                    <?php else : ?>

                                        <a href="file?code=<?php echo $row['code']; ?>">
                                            <?php

                                            $url = "storage/data/" . $row['user_id'] . "/" . $row['filename'];
                                            $ftype = explode(".", $url);
                                            $count = count($ftype) - 1;

                                            if ($row['filename'] != "") {
                                                if (!$row['is_folder']) {
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
                                        <?php echo $row['filename']; ?></a>
                            </td>

                            <td><?php echo $description; ?></td>
                            <td>
                                <?php
                                $show_user_id = $row['user_id'];
                                $users = mysqli_query($con, "select * from user where id=$show_user_id");
                                $user_rw = mysqli_fetch_array($users);
                                echo $user_rw['fullname'];

                                ?>
                            </td>
                            <td>
                                <?php echo $user_email = $user_rw['email']; ?>
                            </td>
                            <td>
                                <?php
                                $url = "../../storage/data/" . $row['user_id'] . "/" . $row['filename'];
                                /*  var_dump($url); */
                                if (file_exists($url)) {
                                    $fsize = filesize($url);
                                    if ($row['filename'] != "") {
                                        if (!$row['is_folder']) {
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
                            <td><?php echo $created_at; ?></td>
                            <?php if ($is_public == 0) : ?>
                                <td class="" style="width:223px;">
                                    <a title="Eliminar definitivamente" href="action/delfile?id=<?php echo $row['code']; ?>&tkn=<?php echo $_SESSION["tkn"] ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
                                </td>
                            <?php endif; ?>

                        </tr>
                    <?php
                    }
                    ?>

                </table>
                <div class="paginacion">

                    <?php
                    echo paginate($reload, $page, $total_pages, $adjacents);
                    ?>

                </div>
            </div>
            <?php
        } else {
            if ($_GET['q2'] != "") {
            ?>
                <div class="alert alert-danger text-center" role="alert">
                    No existen usuarios filtrados con el dato: <?php echo $_GET['q2']; ?>
                </div>
<?php
            }
        }
    }
}
?>