<?php


session_start();

// -- eliminamos el usuario
if(isset($_SESSION['admin_id'])){
	unset($_SESSION['admin_id']);
}

//session_destroy();

header("location: ../");

?>