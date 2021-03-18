<?php
   
	session_start();

	include "../config/config.php";

	//hacer una consulta para que el usuario no pueda darle dos o mas veces permisos por un archivo

	if(!empty($_POST)){
		$nick=mysqli_real_escape_string($con,(strip_tags($_POST["email"],ENT_QUOTES)));
		$user = mysqli_query($con, "select * from user where email=\"$nick\"");

		while ($rowu=mysqli_fetch_array($user)) {
				$user_id=$rowu['id'];
		}

		$id=intval($_POST["file_id"]);
		$file = mysqli_query($con, "select * from file where id=$id");

		while ($rowf=mysqli_fetch_array($file)) {
				$file_id=$rowf['id'];
				$file_code=$rowf['code'];
		}

		if($user_id!=null){	
			if($user_id!=$_SESSION["user_id"]){

				//$perm = PermisionData::getByUF($user->id,$file->id);
				$perm=mysqli_query($con,"select * from permision where user_id=$user_id and file_id=$file_id");
				if(mysqli_num_rows($perm)==0){
					$user_id= $user_id;
					$file_id = $file_id;
					$p_id= mysqli_real_escape_string($con,(strip_tags($_POST["p_id"],ENT_QUOTES)));
					$created_at = "NOW()";

					$sql = "insert into permision (p_id,file_id,user_id,created_at)";
					$sql .= "value ($p_id,\"$file_id\",$user_id,$created_at)";

					$query=mysqli_query($con, $sql);

					//notificaciones
					$from_id = $_SESSION["user_id"];
					$to_id=$user_id;
					$file_id = $file_id;
					$kind=1;
					$noti_add=mysqli_query($con, "insert into notification (kind,from_id,file_id,to_id,created_at) value ($kind,\"$from_id\",\"$file_id\",$to_id,$created_at)");


					if ($query and $noti_add) {
						// echo "Agregado exitosamente!";
						header("location: ../filepermision?id=".$file_code."&success");
					} else {
						// echo "Hubo un error al dar los permisos!";
						header("location: ../filepermision?id=".$file_code."&error");
					}
				}else{
					// echo "No se puede repetir el permiso!";
					header("location: ../filepermision?id=".$file_code."&errorpermission");
				}	

			}else{
				// echo "No puedes agregarte ati mismo!";
				header("location: ../filepermision?id=".$file_code."&error2");
			}

		}else{
			// echo "El usuario no existe!";
			header("location: ../filepermision?id=".$file_code."&error3&not_found");
		}
	}

?>