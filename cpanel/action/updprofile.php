<?php
session_start();

if (empty($_POST['fullname'])) {
	$errors[] = "Nombre vacío";
} else if (
	!empty($_POST['fullname'])
) {

	include "../../config/config.php"; //Contiene funcion que conecta a la base de datos

	$id = $_POST['id_user'];
	$fullname = mysqli_real_escape_string($con, (strip_tags($_POST["fullname"], ENT_QUOTES)));
	$email = mysqli_real_escape_string($con, (strip_tags($_POST["email"], ENT_QUOTES)));
	$is_admin = isset($_POST["is_admin"]) ? 1 : 0;
	$is_public = isset($_POST["is_public"]) ? 1 : 0;
	$is_evaluator = isset($_POST["is_evaluator"]) ? 1 : 0;

	$sql = "UPDATE user set fullname=\"$fullname\", email=\"$email\" , is_admin=\"$is_admin\", is_public=\"$is_public\", is_evaluator=\"$is_evaluator\" where id=$id";
	$query_update = mysqli_query($con, $sql);
	if ($query_update) {
		$messages[] = "Datos actualizados satisfactoriamente.";	

		$password = sha1(md5(mysqli_real_escape_string($con, (strip_tags($_POST["password"], ENT_QUOTES)))));

		if ($_POST['password'] != "") {
			if ($_POST['new_password'] == $_POST['confirm_new_password']) {
				$sql = mysqli_query($con, "SELECT * from user where id=$id");
				while ($row = mysqli_fetch_array($sql)) {
					$p = $row['password'];
				}
				if ($p == $password) { //comprobamos que la contraseña sea igual a la anterior
					$password2 = sha1(md5(mysqli_real_escape_string($con, (strip_tags($_POST['new_password'], ENT_QUOTES)))));
					$update_passwd = mysqli_query($con, "UPDATE user set password=\"$password2\" where id=$id");
					if ($update_passwd) {
						$messages[] = " Y la contraseña fue actualizada";
					}
				} else {
					$errors[] = "la contraseña no coincide con la anterior";
				}
			} else {
				$errors[] = "las nuevas contraseñas no coinciden";
			}
		}
	} else {
		$errors[] = "Lo siento algo ha salido mal intenta nuevamente.";
	}
} else {
	$errors[] = "Error desconocido.";
}

if (isset($errors)) {

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
if (isset($messages)) {

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