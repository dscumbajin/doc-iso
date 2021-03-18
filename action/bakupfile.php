<?php

session_start();
include "../config/config.php";

if(isset($_GET["tkn"]) && $_GET["tkn"]==$_SESSION["tkn"]){

	$id_code=$_GET["id"];
	$file = mysqli_query($con, "select * from file where code=\"$id_code\"");

	while ($rows=mysqli_fetch_array($file)) {
		$id=$rows['id'];
		$filename=$rows['filename'];
		$is_folder=$rows['is_folder'];
	}


	$update=mysqli_query($con, "update file set is_deleted=0 where id=$id");
	if ($update) {
		// echo "Eliminado exitosamente!";
		header("location: ../recicle?movesuccess");
	} else {
		// echo "Hubo un error al eliminar ";
		header("location: ../recicle?moveerror");
	}

}else{

	// echo "Permiso Denegado!";
	header("location: ../recicle?moveinvalid");
}


?>