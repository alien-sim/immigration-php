<?php
	
	include_once './config.php';
	$id = $_GET['id'];
	$page = $_GET['page']; 
	if($page == 'agents'){
		$table = 'admin';
	}
	else{
		$table = $_GET['page'];
	}

	$sql="delete from ".$table." where id='".$id."'";
	if(mysqli_query($db,$sql)){
		$success="successfully Deleted";
		header("location:".$page.".php?success=$success");
	}
	else{
		$error = mysqli_error($db);
		header("location:".$page.".php?error=$error");
	}

?>