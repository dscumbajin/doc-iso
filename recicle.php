<?php 

    $active6="active"; 
    include "header.php"; 
?>
<?php 
    $alphabeth ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
    $token = "";
    for($i=0;$i<6;$i++){
        $token .= $alphabeth[rand(0,strlen($alphabeth)-1)];
    }
    $_SESSION["tkn"]=$token;
    $folder=null;
    if(isset($_GET["folder"]) && $_GET["folder"]!=""){
        
        $id_folder=$_GET["folder"];
        $folder = mysqli_query($con,"select * from file where code=\"$id_folder\" and is_deleted=1 ");

        while ($row=mysqli_fetch_array($folder)) {
            $file_id_folder=$row['id']; 
            $file_folder_id=$row['folder_id']; 
            $file_folder_filename=$row['filename'];
            $file_folder_code=$row['code'];
        }
    }

?>

    <div class="content-wrapper"><!-- Content Wrapper. Contains page content -->
        <section class="content-header"><!-- Content Header (Page header) -->
            <h1>Papelera de reciclaje <i class="fa fa-trash"></i> </h1>
            <ol class="breadcrumb">
                <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active"><a href="myfiles.php"><i class="fa fa-archive"></i> Mis Archivos</a></li>
                <?php
                    if(@mysqli_num_rows($folder)!=0){
                        echo '<li class="active"><a href="myfiles?folder='.$file_folder_code.'"><i class="fa fa-folder-open"></i> '.$file_folder_filename.'</a></li>';
                    }
                ?>
            </ol>
        </section>

        <section class="content"><!-- Main content -->
            <div class="row"><!-- Small boxes (Stat box) -->
                <div class="col-md-12">
                <?php
                    $files = null;
                    if(@mysqli_num_rows($folder)==0){
                        if(isset($_GET["q"]) && $_GET["q"]!=""){
                            $q=$_GET["q"];
                            $files = mysqli_query($con,"select * from file where user_id=$my_user_id and folder_id is NULL and (filename like '%$q%' or description like '%$q%') and is_deleted=1 order by is_folder desc, filename asc");
                           
                    }else{
                        $files = mysqli_query($con,"select * from file where user_id=$my_user_id and is_deleted=1 and folder_id is NULL order by is_folder desc, filename asc");
                    }

                    }else{
                        // search
                        if(isset($_GET["q"]) && $_GET["q"]!=""){
                            $q=$_GET["q"];
                            $files=mysqli_query($con,"select * from files where folder_id=$file_id_folder and is_deleted=1 and  (filename like '%$q%' or description like '%$q%') order by created_at desc");
                        }else{
                            // folder/folder/file.php
                            $files=mysqli_query($con,"select * from file where folder_id=$file_id_folder and is_deleted=1 order by created_at desc");

                        }
                    }
                ?>


               <?php if(isset($_GET["folder"]) && $_GET["folder"]!="" && mysqli_num_rows($folder)==0):?>
                    <p class="alert alert-danger">Estas intentando acceder a una carpeta que no existe!</p>
                <?php endif; ?>

               

                    <?php if(isset($_GET["q"]) && $_GET["q"]!=""):?>
                        <p class="alert alert-info">Resultado de la busqueda: <?php echo $_GET["q"];?></p>
                    <?php endif; ?>

                    <?php if(@mysqli_num_rows($files)>0):?>

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
                        <div class="box-header">
                            <?php if(@mysqli_num_rows($folder)==0):?>
                            <h3 class="box-title">Mis Archivos borrados</h3>
                            <?php else:?>
                            <h3 class="box-title"><?php echo $file_folder_filename;?> <i class="fa fa-folder"></i></h3>
                            <?php endif;?>
                            <div class="box-tools">
                            </div>
                        </div><!-- /.box-header -->

                        <div class="box-body no-padding" style="margin: 15px">
                            <table id="example1" class="table table-bordered table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>Archivo</th>
                                        <th class="hidden-xs hidden-sm">Descripción</th>
                                        <th class="hidden-xs hidden-sm">Tamaño</th>
                                        <th class="hidden-xs hidden-sm">Subidol el:</th>
                                        <th class="hidden-xs hidden-sm"></th>
                                        <th class="hidden-lg hidden-md"></th>
                                    </tr>
                                </thead>    
                                <tbody>    
                                    <?php foreach($files as $file):?>
                                    <tr>
                                        <td style="width: 250px">
                                        <?php if($file['is_folder']):?>
                                            <a href="myfiles.php?folder=<?php echo $file['code'];?>">
                                                <i class="fa fa-folder"></i>
                                        <?php else:?>

                                            <a href="file.php?code=<?php echo $file['code'];?>">
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
                                        <td class="hidden-xs hidden-sm" style="width: 350px"><?php echo $file['description']; ?></td>
                                        <td class="hidden-xs hidden-sm">
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
                                                        }
                                                    }
                                                }
                                            }
                                        ?>
                                        </td>
                                        <td class="hidden-xs hidden-sm"><?php echo $file['created_at']; ?></td>
                                        <td class="hidden-xs hidden-sm" style="width:250px;">
                                            <a href="action/bakupfile.php?id=<?php echo $file['code'];?>&tkn=<?php echo $_SESSION["tkn"]?>" class="btn btn-xs btn-primary"><i class="fa fa-pencil"></i> Recuperar</a>
                                            <a href="action/delfile.php?id=<?php echo $file['code']; ?>&tkn=<?php echo $_SESSION["tkn"]?>" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Eliminar Definitivamente</a>
                                        </td>
                                        <td class="hidden-lg hidden-md">
                                           <div class="dropdown">
                                                <a id="dLabel" data-target="#" href="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                                    <span class="caret"></span>
                                                </a>

                                            <ul class="dropdown-menu" aria-labelledby="dLabel">
                                                <li>
                                                    <a href="action/bakupfile.php?id=<?php echo $file['code'];?>&tkn=<?php echo $_SESSION["tkn"]?>"><i class="fa fa-pencil"></i> Recuperar</a>
                                                </li>
                                                <li>    
                                                <a href="action/delfile.php?id=<?php echo $file['code']; ?>&tkn=<?php echo $_SESSION["tkn"]?>"><i class="fa fa-trash"></i> Eliminar Definitivamente</a>
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
                    <?php else:?>
                       <div class="col-md-6 col-md-offset-3">
                        <p class="alert alert-warning"> <i class="
                        fa fa-exclamation-triangle"></i> No se encontraron archivos en la papelera de reciclaje</p>
                       </div>
                    <?php endif;?>
                </div>
            </div><!-- /.row -->
        </section>
    </div><!-- /.content -->

<?php include "footer.php"; ?>