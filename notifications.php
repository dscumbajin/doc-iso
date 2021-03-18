<?php 


    include "header.php";  
?>   
<div class="content-wrapper"><!-- Content Wrapper. Contains page content --> 
    <section class="content-header"><!-- Content Header (Page header) -->
            <h1><!-- <i class="fa fa-globe"></i>  -->Notificaciones</h1>
            <ol class="breadcrumb">
                <li><a href="home"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Notificaciones</li>
            </ol>
        </section>
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
			<?php
				$sessions_user=$_SESSION['user_id'];
				$Notification=mysqli_query($con,"select * from notification where to_id=$sessions_user");
			?>
			<?php if(mysqli_num_rows($Notification)>0):?>
			<div class="box box-primary">
				<table class="table">
					<thead>
						<th>Descripcion</th>
						<th>Archivo</th>
						<th>Fecha</th>
					</thead>
					<?php 
						foreach($Notification as $fx):
						$fx_id = $fx['id'];
						$file_id = $fx['file_id'];
						$file=mysqli_query($con,"select * from file where id=$file_id");
						$file_rw=mysqli_fetch_array($file);
						$file_status=$file_rw['status'];
						$file_code=$file_rw['code'];
						$file_filename=$file_rw['filename'];
						$file_is_folder=$file_rw['is_folder'];
						$file_created_at=$file_rw['created_at'];
						$from_id = $fx['from_id'];
						$user=mysqli_query($con,"select * from user where id=$from_id");
						$user_rw=mysqli_fetch_array($user);
						if($file_status){
					?>
					<tr>
					<td>
						<?php if($fx['kind']==1):?>
							Nuevo archivo compartido por
						<?php endif; ?>
						<?php echo $user_rw['fullname'];?>
					</td>
						<td>
						<?php if($file_is_folder):?>
						<a href="myfiles?folder=<?php echo $file_code;?>">
							<i class="fa fa-folder"></i>
						<?php else:?>
						<a href="file?code=<?php echo $file_code;?>">
							<i class="fa fa-file"></i>
						<?php endif; ?>
						<?php echo $file_filename; ?></a>
						</td>
						<td><?php echo $file_created_at; ?></td>
					</tr>
					<?php }
						$read=mysqli_query($con,"update notification set is_readed=1 where id=$fx_id");
						endforeach;
					?>
				</table>
			</div>
			<?php else:?>
				<div class="alert alert-warning alert-dismissible" role="alert">
				  	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				  	<strong>Sin Notificaciónes!</strong> Aun no tienes notificaciónes.
				</div>
			<?php endif;?>
			</div>
		</div>
	</section>
</div>
<?php include "footer.php"; ?>
