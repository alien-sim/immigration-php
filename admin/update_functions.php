<?php
	include_once './config.php';
	if(isset($_POST['update_school'])){
		$idd = $_POST['idd'];
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
		if($_FILES["school_logo"]["name"]){
			$logo_filename = $ts . "_" . basename($_FILES["school_logo"]["name"]);
			$logo_file = $logo_dir . $logo_filename;
			move_uploaded_file($_FILES['school_logo']['tmp_name'], $logo_file);
		}else{
			$logo_filename = $_POST['old_logo'];
		}
		
		
		$cover_dir = "../media/cover_img/";
		if($_FILES["cover_img"]["name"]){
			$cover_filename = $ts . "_" . basename($_FILES["cover_img"]["name"]);
			$cover_file = $cover_dir . $cover_filename;
			move_uploaded_file($_FILES['cover_img']['tmp_name'], $cover_file);
		}else{
			$cover_filename = $_POST['old_cover'];
		} 

        $sql="update schools set school_name='".$school_name."', founded='".$founded."', type='".$type."', total_students='".$total_students."', intrested_students = '".$intrested_students."', city='".$city."', country='".$country."', about='".$about."', tution_fee_yearly = '".$tution_fee."', cost_of_living_yearly = '".$living_cost."', application_fee='".$application_fee."', address='".$address."', currency='".$currency."', school_logo='".$logo_filename."', cover_img='".$cover_filename."' where id='".$idd."'";
		if(mysqli_query($db,$sql)){
			header("location:schools.php");
		}
	}

	if(isset($_POST['update_program'])){
		$idd = $_POST['idd'];
    	$program_name = mysqli_real_escape_string($db,$_POST['program_name']);
    	$description = mysqli_real_escape_string($db,$_POST['description']);
        $admission_req = mysqli_real_escape_string($db,$_POST['admission_req']);
        $other_fees = mysqli_real_escape_string($db,$_POST['other_fees']);
    	$level_program = mysqli_real_escape_string($db,$_POST['level_program']);
    	$length_program = mysqli_real_escape_string($db,$_POST['length_program']);
		$school_id = $_POST['school_id'];
		$application_fee = $_POST['application_fee'];
		$tution_fee = $_POST['tution_fee'];

    	$query = $db->query("update programs set program_name='".$program_name."', description='".$description."', additional_requirements='".$admission_req."', other_fees='".$other_fees."', program_level='".$level_program."', length_program='".$length_program."', school_id='".$school_id."', application_fee='".$application_fee."', tution_fee='".$tution_fee."' where id='".$idd."' ");
    	if($query){
    		header("location:programs.php");
    	}else{
    		echo mysqli_error($db);
    	}
	}
	
	if(isset($_POST['update_agent'])){
		$idd = $_POST['idd'];
		$username = mysqli_real_escape_string($db,$_POST['username']);
    	$pass = mysqli_real_escape_string($db,$_POST['password']);
    	$email = mysqli_real_escape_string($db,$_POST['email']);
		$is_superadmin = isset($_POST['is_admin']) ? 1 : 0;
		
		$query = $db->query("update admin set email='".$email."', username='".$username."', password='".$pass."', is_superadmin='".$is_superadmin."' where id='".$idd."' ");
		if($query){
    		header("location:agents.php");
    	}else{
    		echo mysqli_error($db);
    	}
	}
?>