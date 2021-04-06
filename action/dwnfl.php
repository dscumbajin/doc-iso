<?php
session_start();
include "../config/config.php";

// Count Download
$user_id = $_SESSION["user_id"];
$id = intval($_GET["id"]);
$count = intval($_GET["count"] + 1);
$sql = mysqli_query($con, "UPDATE file SET download ='.$count.'WHERE id ='" . $id . "' ");

$sqlDes = mysqli_query($con, "select * from descargas WHERE id_user ='" . $user_id . "' and id_file ='" . $id . "'");

if (mysqli_num_rows($sqlDes) != null) {
	while ($fila = mysqli_fetch_array($sqlDes)) {
		$contador = intval($fila["contador"] + 1);
	}
	$sqlUpdDes = mysqli_query($con, "UPDATE descargas SET contador ='.$contador.', download_at = NOW() WHERE id_user ='" . $user_id . "' and id_file ='" . $id . "'");
} else {
	$sql = "INSERT INTO descargas (id_user, id_file, contador, download_at) VALUES ( $user_id,$id, 1,NOW());";
	$sqlInsetDes = mysqli_query($con, $sql);
}

//end count donwload

$id_code = $_GET["code"];
$file = mysqli_query($con, "select * from file where code=\"$id_code\"");

while ($rows = mysqli_fetch_array($file)) {
	$filename = $rows['filename'];
	$user_id = $rows['user_id'];
	$is_folder = $rows['is_folder'];
}

$url = "../storage/data/$user_id/";

if (!$is_folder) {
	$fullurl = $url . $filename;
	header("Content-Disposition: attachment; filename=$filename");
	readfile($fullurl);
}
