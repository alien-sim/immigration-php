<?php
	
	include_once './config.php';
	$id = $_GET['id'];
	$page = $_GET['page']; 
	echo $id;
	echo $page;
	$sql="delete from ".$page." where id='".$id."'";
	// $q=mysqli_query($db,$sql);
	if(mysqli_query($db,$sql)){
		$success="successfully Deleted";
		header("location:".$page.".php?success=$success");
	}
	else{
		$error = mysqli_error($db);
		header("location:".$page.".php?error=$error");
	}

?>