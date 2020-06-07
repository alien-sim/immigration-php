<?php 
	include_once './submit_functions.php'; 
	session_start(); 
	if(isset($_SESSION['email'])){ 
		header("location:add_agent.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>first page</title>
</head>
<body>
	<form method="post" action="index.php">
		<label>Username</label>
		<input type="text" name="username">
		<label>Password</label>
		<input type="text" name="password">
		<input type="submit" name="login">
	</form>
</body>
</html>