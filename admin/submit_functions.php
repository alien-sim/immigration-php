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
			$_SESSION['user_id']		= $row[0];
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
		$application_fee = $_POST['application_fee'];
		$tution_fee = $_POST['tution_fee'];

    	$query = $db->query("insert into programs (program_name, description, program_level, length_program, school_id, additional_requirements, other_fees, tution_fee, application_fee) values('$program_name', '$description', '$level_program', '$length_program','$school_id','$admission_req', '$other_fees', '$tution_fee', '$application_fee') ");
    	if($query){
    		header("location:programs.php");
    	}else{
    		echo mysqli_error($db);
    	}
    }

    // Add School
    if(isset($_POST['add_school'])){

		$workPermit 	= isset($_POST['workPermit']) ? 1 : 0;
		$internship 	= isset($_POST['internship']) ? 1 : 0;
		$workStudy 		= isset($_POST['workStudy']) ? 1 : 0;
		$offerLetter 	= isset($_POST['offerLetter']) ? 1 : 0;
		$accomodation 	= isset($_POST['accomodation']) ? 1 : 0;

		$queryf = $db->query("insert into features (work_permit, work_study, accomodation, internship, offer_letter) values('$workPermit', '$workStudy', '$accomodation', '$internship', '$offerLetter') ");
    	if($queryf){
    		$feature_id = $db->insert_id;
    	}
    	$school_name 	= mysqli_real_escape_string($db,$_POST['school_name']);
    	$founded 		= $_POST['founded'];
    	$type 			= $_POST['type'];
    	$total_students = $_POST['total_students'];
    	$intrested_students = $_POST['int_students'];
    	$city 			= $_POST['city'];
    	$country 		= $_POST['country'];
    	$about 			= mysqli_real_escape_string($db,$_POST['about']);
    	$tution_fee 	= $_POST['tution_fee'];
    	$living_cost 	= $_POST['living_cost'];
    	$application_fee = $_POST['application_fee'];
    	$address 		= mysqli_real_escape_string($db, $_POST['address']);
		$dli 			= mysqli_real_escape_string($db, $_POST['dli']);
		
		$ts = get_timestamp();
		
		$logo_dir = "../media/logos/";
		$logo_filename = $ts . "_" . basename($_FILES["school_logo"]["name"]);
		$logo_file = $logo_dir . $logo_filename;
		move_uploaded_file($_FILES['school_logo']['tmp_name'], $logo_file);
		
		$cover_dir = "../media/cover_img/";
		$cover_filename = $ts . "_" . basename($_FILES["cover_img"]["name"]);
		$cover_file = $cover_dir . $cover_filename;
		move_uploaded_file($_FILES['cover_img']['tmp_name'], $cover_file);

		$gallery_dir = "../media/gallery/";
		$gallery_arr = [];
		foreach($_FILES["gallery_img"]["tmp_name"] as $key=>$tmp_name) {
			$gallery_filename = $ts . "_" . basename($_FILES["gallery_img"]["name"][$key]);
			$gallery_file = $gallery_dir . $gallery_filename;
			move_uploaded_file($_FILES['gallery_img']['tmp_name'][$key], $gallery_file);
			array_push($gallery_arr, $gallery_filename);
			
		} 
		$gallery_str = implode(",",$gallery_arr);

    	$query = $db->query("insert into schools (school_name, founded, type, total_students, intrested_students, city, country, about, address, cost_of_living_yearly, tution_fee_yearly, application_fee, dli, school_logo, cover_img, gallery, features) values('$school_name', '$founded', '$type', '$total_students', '$intrested_students', '$city', '$country', '$about', '$address', '$living_cost', '$tution_fee', '$application_fee', '$dli', '$logo_filename', '$cover_filename','$gallery_str', '$feature_id') ");
    	if($query){
    		header("location:schools.php");
    	}else{
    		echo mysqli_error($db);
    	}

    }
?>