<?php

	include "../config/config.php";

if(!empty($_POST)){

	$id=intval($_POST["id"]);
	$file = mysqli_query($con, "select * from file where id=$id");
	while ($rows=mysqli_fetch_array($file)) {
		$code=$rows['code'];
	}

	$description = mysqli_real_escape_string($con,(strip_tags($_POST["description"],ENT_QUOTES)));
	$is_public = isset($_POST["is_public"])?1:0;

	//nuevas variables by amner saucedo sosa
	$folder_id = intval($_POST["folder_id"])!="" ? intval($_POST["folder_id"]):"NULL";
	$folder_id;

	$sql = "update file set description=\"$description\", is_public=\"$is_public\",folder_id=$folder_id where id=$id";

	$update=mysqli_query($con, $sql);
	if ($update) {
		// echo "actualizado con exito";
		header("location: ../editfile?id=".$code."&success");
	} else {
		// echo "hubo un error al actualizar los datos";
		header("location: ../editfile?id=".$code."&error");
	}
	

}


?>