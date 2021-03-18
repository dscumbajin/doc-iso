<?php

	if (empty($_POST['url_base'])) {
           $errors[] = "URL BASE vacío";
        } else if (
			!empty($_POST['url_base'])
		){

		include "../../config/config.php";//Contiene funcion que conecta a la base de datos

		$url_base=mysqli_real_escape_string($con,(strip_tags($_POST["url_base"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		//$id=$_POST['mod_id'];

		$sql="UPDATE configuration SET url_base=\"$url_base\",email_admin=\"$email\" ";
		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "La Configuración ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>