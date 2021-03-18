<?php


include "../../config/config.php";

if(isset($_GET["id"])){	
	$id=intval($_GET['id']);
	$update=mysqli_query($con, "update user set is_active=0 where id=$id");
	if ($update) {
		// echo "Eliminado exitosamente!";
		header("location: ../users?delsuccess");
	} else {
		// echo "Hubo un error al eliminar ";
		header("location: ../users?delerror");
	}

}else{

	// echo "Permiso Denegado!";
	header("location: ../users?userinvalid");
}