<?php
//Contiene las variables de configuracion para conectar a la base de datos
include_once "../../config/config.php";
$action = (isset($_REQUEST['action']) && $_REQUEST['action'] != NULL) ? $_REQUEST['action'] : '';

if ($action == 'ajax') {
    // escaping, additionally removing everything that could be (html/javascript-) code
    // idUsu, usuario, nombreUsu, password, mail, idPerfil
    $q = mysqli_real_escape_string($con, (strip_tags($_REQUEST['q2'], ENT_QUOTES)));
    echo "<script>$('#tabla_original').show();</script>";
    if ($_GET['q2'] != "") {
        echo "<script>$('#tabla_original').hide();</script>";
        $aColumns = array('filename'); //Columnas de busqueda
        $sTable = "file";
        $sWhere = "WHERE (";
        for ($i = 0; $i < count($aColumns); $i++) {
            $sWhere .= $aColumns[$i] . " LIKE '%" . $q . "%' OR ";
        }
        $sWhere = substr_replace($sWhere, "", -3);
        $sWhere .= ')';
        $sWhere .= " order by id";
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
                        <th>Tamaño</th>
                        <th>Subido el:</th>
                        <th>Acciones</th>

                    </tr>
                    <?php
                    while ($row = mysqli_fetch_array($query)) {
                        // idUsu, usuario, nombreUsu, password, mail, idPerfil
                        $id = $row['id'];
                        $code = $row['code'];
                        $filename = $row['filename'];
                        $description = $row['description'];
                        $download = $row['download'];
                        $is_folder = $row['is_folder'];
                        $created_at = $row['created_at'];

                    ?>

                        <tr>
                            <td><?php echo $filename; ?></td>
                            <td><?php echo $description; ?></td>
                            <td><?php echo '20kb' ?></td>
                            <td><?php echo $created_at; ?></td>
                            <td>
                            </td>

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
