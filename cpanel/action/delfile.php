<?php
session_start();
include "../../config/config.php";

if(isset($_GET["tkn"]) && $_GET["tkn"]==$_SESSION["tkn"]){

	$id_code=$_GET["id"];
	$file = mysqli_query($con, "select * from file where code=\"$id_code\"");

	while ($rows=mysqli_fetch_array($file)) {
		$id=$rows['id'];
		$filename=$rows['filename'];
		$is_folder=$rows['is_folder'];
		$user_id=$rows['user_id'];
	}

	 $url = "../../storage/data/".$user_id."/";

	 if(!$is_folder)
	 	@unlink($url.$filename);

	$del=mysqli_query($con, "delete from file where id=$id");
	if ($del) {
		// echo "Eliminado exitosamente!";
		header("location: ../files?delsuccess");
	} else {
		// echo "Hubo un error al eliminar ";
		header("location: ../files?delerror");
	}

}else{

	// echo "Permiso Denegado!";
	header("location: ../files?delinvalid");
}


?>