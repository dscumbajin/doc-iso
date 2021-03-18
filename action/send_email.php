<?php

	//include("../is_logged.php");//Archivo comprueba si el usuario esta logueado
	if (empty($_POST['email'])){
			$errors[] = "Correo electrónico está vacío.";
		}  elseif (empty($_POST['nombre'])) {
            $errors[] = "Nombre está vacío.";
        }  elseif (empty($_POST['receptor'])) {
            $errors[] = "Receptor está vacío.";
        }  elseif (
        	!empty($_POST['email'])
        	&& !empty($_POST['nombre'])
        	&& !empty($_POST['receptor'])
        ){
		require_once ("../config/config.php");//Contiene las variables de configuracion para conectar a la base de datos
			
            $nombre = mysqli_real_escape_string($con,(strip_tags($_POST["nombre"],ENT_QUOTES)));
            $email = mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
            $receptor = mysqli_real_escape_string($con,(strip_tags($_POST["receptor"],ENT_QUOTES)));
            $filename = mysqli_real_escape_string($con,(strip_tags($_POST["filename"],ENT_QUOTES)));
            //$mensaje = mysqli_real_escape_string($con,(strip_tags($_POST["mensaje"],ENT_QUOTES)));
            $url = mysqli_real_escape_string($con,(strip_tags($_POST["url"],ENT_QUOTES)));
            $url2 = mysqli_real_escape_string($con,(strip_tags($_POST["url2"],ENT_QUOTES)));
            $url3 = mysqli_real_escape_string($con,(strip_tags($_POST["url3"],ENT_QUOTES)));

			$headers =  'MIME-Version: 1.0' . "\r\n"; 
			$headers .= 'From: Your name <info@address.com>' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"; 

            include "template_email.php";
           	$mail= mail($receptor, $nombre." envia ".$filename, $mensaje, $headers);
           if($mail){
           		$messages[] = "Mensaje enviado con éxito.";
           }else{
           		$errors[] = "El mensaje no se pudo enviar.";	
           }
            
			
		} else {
			$errors[] = "desconocido.";	
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