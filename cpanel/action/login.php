<?php
	session_start();

	if (empty($_POST['email'])) {
           echo  "<script>alert(\"Correo electrónico invalido\"); window.location=\"../index.php\"</script>";
        } else if (empty($_POST['password'])){
			echo  "<script>alert(\"Contraseña invalida\"); window.location=\"../index.php\"</script>";
		} else if (
			!empty($_POST['email'])  &&
			!empty($_POST['password'])
		){
			
		//Contiene las variables de configuracion para conectar a la base de datos
		include_once "../../config/config.php";


		$email=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$password=sha1(md5(mysqli_real_escape_string($con,(strip_tags($_POST["password"],ENT_QUOTES)))));

		$sql = "SELECT * FROM user WHERE email = '" . $email . "' AND password = '" . $password . "';";
            $query = mysqli_query($con,$sql);
			$numrows = mysqli_num_rows($query);

		if ($row = mysqli_fetch_array($query)) 
		{
			if ($row['is_active']>0) { //comprobamos que el usuario este activo
				if ($row['is_admin']>0) { //comprobamos que el usuario sea administrador

					$_SESSION['admin_id'] = $row['id'];
					$_SESSION['fullname'] = $row['fullname'];
					$_SESSION['is_public']=$row['is_public'];
					$_SESSION['is_admin']=$row['is_admin'];

					print "Cargando ... $email";
					print "<script>window.location='../home';</script>";
				
				}else{
					header("location: ../index?noadmin");
				}
			}else{
				$error=sha1(md5("cuenta inactiva"));
				header("location: ../index?error=$error");
			}
		}else{
			$invalid=sha1(md5("contrasena y email invalido"));
			header("location: ../index?invalid=$invalid");
		}
	}
