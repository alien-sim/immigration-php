<?php
	include_once './config.php';
	include_once './common_functions.php' ;
	// Login Function
	if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $pass = mysqli_real_escape_string($db,$_POST['password']);
        $query = $db->query("SELECT * FROM `admin` WHERE `username`='$username' AND `password`='$pass' ");
        if(mysqli_num_rows($query)) { 
        	$row = mysqli_fetch_row($query);
        	session_start();
			$_SESSION['email'] 			= $row[1];
			$_SESSION['is_superadmin'] 	= $row[4];
        	$_SESSION['username'] 		= $username;
            header("location:index.php");
        }

        else { 
        	echo "Wrong user id or password!"; 
        }
    }

    // Add Agent
    if(isset($_POST['add_agent'])){
    	$username = mysqli_real_escape_string($db,$_POST['username']);
    	$pass = mysqli_real_escape_string($db,$_POST['password']);
    	$email = mysqli_real_escape_string($db,$_POST['email']);
    	$is_superadmin = isset($_POST['is_admin']) ? 1 : 0;

    	$check_username = $db->query("select * from admin where username='$username' or email='$email'");
    	if(mysqli_num_rows($check_username)) {
    		$row = mysqli_fetch_row($check_username);
    		if($row[1] == $email){
    			echo "email already exist";
    		}elseif ($row[3] == $username) {
    			echo "username exist";
    		}
    	}else{
	    	$query = $db->query("insert into admin (username, email, password, is_superadmin) values('$username', '$email', '$pass', '$is_superadmin') ");
	    	if($query){
	    		header("location:agents.php");
	    	}else{
	    		echo mysqli_error($db);
	    	}
    	}
    }

    // Add Program
    if(isset($_POST['add_program'])){
    	$program_name = mysqli_real_escape_string($db,$_POST['program_name']);
    	$description = mysqli_real_escape_string($db,$_POST['description']);
        $admission_req = mysqli_real_escape_string($db,$_POST['admission_req']);
        $other_fees = mysqli_real_escape_string($db,$_POST['other_fees']);
    	$level_program = mysqli_real_escape_string($db,$_POST['level_program']);
    	$length_program = mysqli_real_escape_string($db,$_POST['length_program']);
        $school_id = $_POST['school_id'];

    	$query = $db->query("insert into programs (program_name, description, program_level, length_program, school_id, additional_requirements, other_fees) values('$program_name', '$description', '$level_program', '$length_program','$school_id','$admission_req', '$other_fees') ");
    	if($query){
    		header("location:programs.php");
    	}else{
    		echo mysqli_error($db);
    	}
    }

    // Add School
    if(isset($_POST['add_school'])){
    	$school_name = mysqli_real_escape_string($db,$_POST['school_name']);
    	$founded = $_POST['founded'];
    	$type = $_POST['type'];
    	$total_students = $_POST['total_students'];
    	$intrested_students = $_POST['int_students'];
    	$city = $_POST['city'];
    	$country = $_POST['country'];
    	$about = mysqli_real_escape_string($db,$_POST['about']);
    	$tution_fee = $_POST['tution_fee'];
    	$living_cost = $_POST['living_cost'];
    	$application_fee = $_POST['application_fee'];
    	$address = mysqli_real_escape_string($db, $_POST['address']);
		$currency = mysqli_real_escape_string($db, $_POST['currency']);
		
		$ts = get_timestamp();
		
		$logo_dir = "../media/logos/";
		$logo_filename = $ts . "_" . basename($_FILES["school_logo"]["name"]);
		$logo_file = $logo_dir . $logo_filename;
		move_uploaded_file($_FILES['school_logo']['tmp_name'], $logo_file);
		
		$cover_dir = "../media/cover_img/";
		$cover_filename = $ts . "_" . basename($_FILES["cover_img"]["name"]);
		$cover_file = $cover_dir . $cover_filename;
		move_uploaded_file($_FILES['cover_img']['tmp_name'], $cover_file);

		echo '<script>console.log("' .$logo_file. '"); </script>'; 
		echo '<script>console.log("' .$file_name. '"); </script>'; 

    	$query = $db->query("insert into schools (school_name, founded, type, total_students, intrested_students, city, country, about, address, cost_of_living_yearly, tution_fee_yearly, application_fee, currency, school_logo, cover_img) values('$school_name', '$founded', '$type', '$total_students', '$intrested_students', '$city', '$country', '$about', '$address', '$living_cost', '$tution_fee', '$application_fee', '$currency', '$logo_filename', '$cover_filename') ");
    	if($query){
    		header("location:schools.php");
    	}else{
    		echo mysqli_error($db);
    	}

    }
?>