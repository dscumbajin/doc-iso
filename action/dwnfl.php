<?php
  

	include "../config/config.php";

	// Count Download
		$id=intval($_GET["id"]);
	   	$count=intval($_GET["count"]+1);
	   	$sql = mysqli_query($con,"UPDATE file SET download ='.$count.'WHERE id ='".$id."' ");
	//end count donwload


	$id_code=$_GET["code"];
	$file = mysqli_query($con,"select * from file where code=\"$id_code\"");

	while ($rows=mysqli_fetch_array($file)) {
		$filename=$rows['filename'];
		$user_id=$rows['user_id'];
		$is_folder=$rows['is_folder'];
	}

	$url = "../storage/data/'.$user_id.'/";


	if(!$is_folder){
		$fullurl=$url.$filename;
	header("Content-Disposition: attachment; filename='$filename'");
	readfile($fullurl);

	}


?>