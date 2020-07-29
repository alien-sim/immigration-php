<?php
    include_once './config.php';
	$id = $_GET['id'];

    $sql="update admin set is_active = !is_active where id='".$id."'";
	if(mysqli_query($db,$sql)){
		$success="Successfully";
		header("location:agents.php?success=$success");
	}
	else{
		$error = mysqli_error($db);
		header("location:agents.php?error=$error");
	}
?>