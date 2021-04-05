<?php
session_start();
include "../config/config.php";
include "class.upload.php";
// POST folder_id, filename, description, is_public
if (!empty($_POST)) {

	//id del archivo a actualizar
	$id = intval($_POST["id"]);
	$file = mysqli_query($con, "select * from file where id=$id");
	//TRAER TODOS LOS COMENTARIOS para generar historial

	//codigo del archivo anterior
	while ($rows = mysqli_fetch_array($file)) {
		$code = $rows['code'];
	}
	//NUEVAS VARIABLES DEL ARCHIVO

	$alphabeth = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWYZ1234567890_-";
	$codeNew = "";
	for ($i = 0; $i < 12; $i++) {
		$codeNew .= $alphabeth[rand(0, strlen($alphabeth) - 1)];
	}
	$codeNew = $codeNew;
	//Valores recividos del formulario
	$is_public = isset($_POST["is_public"]) ? 1 : 0;
	//nuevas variables
	$folder_id = intval($_POST["folder_id"]) != "" ? intval($_POST["folder_id"]) : "NULL";
	$folder_id;

	$user_id = $_SESSION["user_id"];
	$description = mysqli_real_escape_string($con, (strip_tags($_POST["description"], ENT_QUOTES)));
	$created_at = "NOW()";


	$handle = new Upload($_FILES['filename']);
	if ($handle->uploaded) {
		//CARGAR EL ARCHIVO NUEVO
		$url = "../storage/data/" . $_SESSION["user_id"];
		$handle->Process($url);
		if ($handle->processed) {
			$filename = $handle->file_dst_name;

			$sql = "INSERT INTO file (code, filename, description, is_public, user_id, is_folder, folder_id, created_at) VALUES (\"$codeNew\",\"$filename\",\"$description\", $is_public, $user_id, 0, $folder_id, NOW());";

			$query = mysqli_query($con, $sql);
			if ($query) {

				//INICIO ACTUALIZAR DATOS ARCHIVO ANTERIOR
				//Sentencia de actualizacion en la base , status= 0
				$sql = "update file set description=\"$description\", is_public=\"$is_public\",folder_id=$folder_id, code_last=\"$codeNew\" where id=$id";
				$update = mysqli_query($con, $sql);
				//Mensaje de actualizacion
				if ($update) {

					header("location: ../updatefile?id=" . $codeNew . "&success");
				} else {
					// echo "hubo un error al actualizar los datos";
					header("location: ../updatefile?id=" . $codeNew . "&error");
				}
				//FIN ACTUALIZAR DATOS ARCHIVO ANTERIOR 

				// echo "archivo agregado con exito";
				/* header("location: ../updatefile?success"); */
			} else {
				// echo "no se pudo, subir hubo un error".mysqli_error($con)."<br>.".mysqli_errno($con);
				/* header("location: ../updatefile?error"); */
			}
		} else {
			// echo "el archivo no se subio por peso maximo";
			/* header("location: ../updatefile?error2&max_size"); */
		}
	} else {
		// echo "el archivo no se subio por peso maximo 2";
		/* header("location: ../updatefile?error3&fatal"); */
	}
} else {
	//echo "aas";
	/* header("location: ../"); */
}
