<?php

	session_start();

	include "../config/config.php";

//print_r($_SESSION);
if(!empty($_POST) && isset($_SESSION["user_id"])){

	$alphabeth ="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
	$code = "";
	for($i=0;$i<12;$i++){
	    $code .= $alphabeth[rand(0,strlen($alphabeth)-1)];
	}

	
	$code= $code;
	$is_public = isset($_POST["is_public"])?1:0;
	$user_id=$_SESSION["user_id"];
	$description = mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
    $filename = mysqli_real_escape_string($con,(strip_tags($_POST["filename"],ENT_QUOTES)));
    $folder_id=$_POST["folder_id"]!=""?$_POST["folder_id"]:"NULL";

    $sql = "insert into file (code,filename,description,is_folder,is_public,user_id,folder_id,created_at) ";
	$sql .= "value (\"$code\",\"$filename\",\"$description\",1,$is_public,$user_id,$folder_id,NOW())";

	$query = mysqli_query($con, $sql);
	if ($query) {
		// echo "carpeta creada con exito";
		header("location: ../newfolder?success");
	} else {
		// echo "hubo un error al crear la carpeta";
		header("location: ../newfolder?error");
	}


}

?>