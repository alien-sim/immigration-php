<?php 
	session_start(); 
	unset($_SESSION["email"]); 
	unset($_SESSION['is_superadmin']);
	unset($_SESSION['username']);
	session_destroy(); 
	header("location:home.php"); 
?>