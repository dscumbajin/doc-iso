<?php 
   
    $active2="active"; 
    include "header.php"; 
?>
<?php 
    $alphabeth ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
    $token = "";
    for($i=0;$i<6;$i++){
        $token .= $alphabeth[rand(0,strlen($alphabeth)-1)];
    }
    $is_public = $_SESSION['is_public'];
    $_SESSION["tkn"]=$token;
    $folder=null;
    if(isset($_GET["folder"]) && $_GET["folder"]!=""){
        $id_folder=$_GET["folder"];
        $folder = mysqli_query($con,"select * from file where code=\"$id_folder\" and is_deleted=0 ");
        while ($row=mysqli_fetch_array($folder)) {
            $file_id_folder=$row['id']; 
            $file_folder_id=$row['folder_id']; 
            $file_folder_filename=$row['filename'];
            $file_folder_code=$row['code'];
            //nuevas variables
            $file_user_id=$row['user_id'];
        }
    }
    if($folder!=null){
        foreach ($folder as $claves) {
            
            $f=$claves['id'];
            //$u_id=$claves['user_id'];
            $perm= mysqli_query($con, "select * from permision where file_id=$f");
            $go = false;
            //if($u_id==$_SESSION["user_id"]){
                $go=true;
            //}
            if(!$go&&$perm!=null){
                $go=true;
            }
            if(!$go){
                print "<script>alert('Acceso denegado!');</script>";
                print "<script>window.location='./';</script>";
            }
        }
    }

?>

    <div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
        <section class="content-header"><!-- Content Header (Page header) -->
            <h1><?php if($folder==null):?>
                Mis Archivos
                <?php else:?>
                <?php 
                    foreach ($folder as $clave_carpetas) {
                        echo $clave_carpetas['filename'];
                    }     
                ?>
                <?php endif;?>
            </h1>
            <ol class="breadcrumb">
                <li><a href="home.php"><i class="fa fa-home"></i> Inicio</a></li>
                <?php if($folder!=null):
                    function getparent($folder){
                        global $con;
                        foreach ($folder as $key) {
                            $function_folder_id=$key['folder_id'];
                            $function_code=$key['code'];
                            $function_filename=$key['filename'];
                            if($function_folder_id!=null){
                                $parent= mysqli_query($con, "select * from file where id=$function_folder_id");
                                getparent($parent);
                            }
                            echo "<li><a href='files?folder=".$function_code."'>".$function_filename."</a></li>";
                        }
                    }
                    getparent($folder);
                    endif;
                ?>
            </ol>
        </section>

        <section class="content"><!-- Main content -->
            <div class="row"><!-- Small boxes (Stat box) -->
                <div class="col-md-12">
                <?php
                    $files = null;
                    //if(@mysqli_num_rows($folder)==0){
                    if($folder==null){
                        if(isset($_GET["q"]) && $_GET["q"]!=""){
                            $q=$_GET["q"];
                            
                            $files = mysqli_query($con,"select * from file where folder_id is NULL and (filename like '%$q%' or description like '%$q%') and is_deleted=0 order by is_folder desc, filename asc");
                           
                    }else{
                        
                        $files = mysqli_query($con,"select * from file where is_deleted=0 and folder_id is NULL order by is_folder desc, filename asc");
                    }

                    }else{
                        // search
                        if(isset($_GET["q"]) && $_GET["q"]!=""){
                            $q=$_GET["q"];
                            foreach ($folder as $folder_key) {
                                $folder_key_id=$folder_key['id'];
                                $files=mysqli_query($con,"select * from files where folder_id=$folder_key_id and is_deleted=0 and  (filename like '%$q%' or description like '%$q%') order by created_at desc");
                            }
                        }else{
                            // folder/folder/file.php
                            foreach ($folder as $key_folder) {
                                $key_folder_id=$key_folder['id'];
                                // $files=mysqli_query($con,"select * from file where folder_id=$key_folder_id and is_deleted=0 order by created_at desc");
                                $files=mysqli_query($con,"select * from file where folder_id=$key_folder_id and is_deleted=0 and status=1 order by created_at desc");
                            }

                            //uso esta condicion si envia una url que no existe pues cargara el error de que no existe y seguira mostrando sus archivo/carpetas
                                
                                if(!$files){
                                    $files = mysqli_query($con,"select * from file where is_deleted=0 and folder_id is NULL order by is_folder desc, filename asc");
                                }

                            

                        }   
                    }
                ?>


               <?php if(isset($_GET["folder"]) && $_GET["folder"]!="" && mysqli_num_rows($folder)==null):?>
                    <br>
                    <p class="alert alert-danger">Estas intentando acceder a una carpeta que no existe!</p>
                <?php endif; ?>

                <?php if(isset($_GET["q"]) && $_GET["q"]!=""):?>
                    <br>
                    <p class="alert alert-info">Resultado de la busqueda: <?php echo $_GET["q"];?></p>
                <?php endif; ?>

                <?php 
                    //if(mysqli_num_rows($files)>0):
                    if(count($files)>0):
                    //var_dump($files);
                ?>
        
                    <?php
                         // get messages
                        if (isset($_GET['delsuccess'])) {
                            echo "<p class='alert alert-success'> <i class=' fa fa-exclamation-circle'></i> <strong>¡Bien hecho! </strong>Eliminado exitosamente!</p>";
                        }elseif(isset($_GET['delerror'])) {
                             echo "<p class='alert alert-danger'> <i class=' fa fa-exclamation-circle'></i> Hubo un error al eliminar el archivo, puede que contenga archivos dentro.</p>";
                        }elseif (isset($_GET['delinvalid'])) {
                            echo "<p class='alert alert-warning'> <i class=' fa fa-exclamation-circle'></i> Permiso Denegado!.</p>";
                        }
                    ?>

                    <div class="box">
                        <div class="box-body no-padding" style="margin: 15px">
                            <table id="example1" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Archivo</th>
                                        <th class="hidden-xs hidden-sm">Usuario</th>
                                        <th class="hidden-xs hidden-sm">Correo Electrónico</th>
                                        <th class="hidden-xs hidden-sm">Tamaño</th>
                                        <th class="hidden-xs hidden-sm">Subidol el:</th>
                                        <?php if($is_public ==0):?>
                                        <th class=""></th>
                                        <?php endif;?>
                                        <!-- <th class="hidden-lg hidden-md"></th> -->
                                    </tr>
                                </thead>    
                                <tbody>    
                                    <?php foreach($files as $file):?>
                                    <tr>
                                        <td style="width: 250px">
                                        <?php if($file['is_folder']):?>
                                            <a href="files?folder=<?php echo $file['code'];?>">
                                                <i class="fa fa-folder"></i>
                                        <?php else:?>

                                            <a href="file?code=<?php echo $file['code'];?>">
<?php
        //by abisoft
        $url = "storage/data/".$file['user_id']."/".$file['filename'];
        $ftype=explode(".", $url);
            $count = count($ftype)-1;

           if($file['filename']!=""){
                if(!$file['is_folder']){
                    if($ftype[$count]=="png" || $ftype[$count]=="jpeg" || $ftype[$count]=="gif" || $ftype[$count]=="jpg" || $ftype[$count]=="bmp"){
                        echo "<i class='fa fa-file-image-o'></i>";
                    }
                    elseif($ftype[$count]=="mp3" || $ftype[$count]=="wav" || $ftype[$count]=="wma" || $ftype[$count]=="ogg" || $ftype[$count]=="mp4"){
                        echo "<i class='fa fa-file-audio-o'></i>";
                    }
                    elseif ($ftype[$count]=="zip" || $ftype[$count]=="rar" || $ftype[$count]=="tgz" || $ftype[$count]=="tar") {
                        echo "<i class='fa fa-file-archive-o'></i>";
                    }
                    elseif ($ftype[$count]=="php" || $ftype[$count]=="php3" || $ftype[$count]=="html" || $ftype[$count]=="css" || $ftype[$count]=="py" || $ftype[$count]=="java" || $ftype[$count]=="js" || $ftype[$count]=="sql") {
                        echo "<i class='fa fa-file-code-o'></i>";
                    }
                    elseif ($ftype[$count]=="pdf") {
                        echo "<i class='fa fa-file-pdf-o'></i>";
                    }
                    elseif ($ftype[$count]=="xlsx") {
                        echo "<i class='fa fa-file-excel-o'></i>";
                    }
                    elseif ($ftype[$count]=="pptx") {
                        echo "<i class='fa fa-file-powerpoint-o'></i>";
                    }
                    elseif ($ftype[$count]=="docx") {
                        echo "<i class='fa fa-file-word-o'></i>";
                    }
                    elseif ($ftype[$count]=="txt") {
                        echo "<i class='fa fa-file-text-o'></i>";
                    }
                    elseif ($ftype[$count]=="avi" || $ftype[$count]=="avi" || $ftype[$count]=="asf" || $ftype[$count]=="dvd" || $ftype[$count]=="m1v" || $ftype[$count]=="movie" || $ftype[$count]=="mpeg" || $ftype[$count]=="wn" || $ftype[$count]=="wmv") {
                        echo "<i class='fa fa-file-video-o'></i>";
                    }else{
                    echo "<i class='fa fa-file-o'></i>";
                }
            }
        }
?>            
                                        <?php endif; ?>
                                        <?php echo $file['filename']; ?></a>
                                        </td>
                                        <td>
                                            <?php 
                                                $show_user_id= $file['user_id']; 
                                                $users=mysqli_query($con,"select * from user where id=$show_user_id");
                                                $user_rw=mysqli_fetch_array($users);
                                                echo $user_rw['fullname'];
                                               
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $user_email= $user_rw['email']; ?>
                                        </td>
                                        <td>
                                        <?php 
                                            $url = "storage/data/".$file['user_id']."/".$file['filename'];
                                            if(file_exists($url)){
                                                $fsize = filesize($url);
                                                if($file['filename']!=""){
                                                    if(!$file['is_folder']){
                                                        if($fsize>1000*1000*1000){
                                                            echo ($fsize/1000*1000*1000)."Gb";
                                                        }
                                                        else if($fsize>1000*1000){
                                                            echo ($fsize/1000*1000)."Mb";
                                                        }
                                                        else if($fsize>1000){
                                                            echo ($fsize/1000)."Kb";
                                                        }
                                                        else if($fsize>0){
                                                            echo $fsize."B";
                                                        }else{
                                                            echo $fsize;
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                        </td>
                                        <td style="width: 125px;" class="hidden-xs hidden-sm"><?php echo $file['created_at']; ?></td>
                                        <?php if($is_public ==0):?>
                                        <td class="" style="width:223px;">
                                            <a title="Eliminar definitivamente" href="action/delfile?id=<?php echo $file['code']; ?>&tkn=<?php echo $_SESSION["tkn"]?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Eliminar</a>
                                        </td>
                                        <?php endif;?>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div><!-- /.box-body --><br>
                    </div><!-- /.box -->
                    <?php else:?>
                       <div class="col-md-6 col-md-offset-3">
                        <p class="alert alert-warning"> <i class="
                        fa fa-exclamation-triangle"></i> No se encontraron archivos en la carpeta actual</p>
                       </div>
                       <?php //var_dump($files) ?>
                    <?php endif;?>
                </div>
            </div><!-- /.row -->
        </section>
    </div><!-- /.content -->

<?php include "footer.php"; ?>