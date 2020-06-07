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

        $sql="update schools set school_name='".$school_name."', founded='".$founded."', type='".$type."', total_students='".$total_students."', intrested_students = '".$intrested_students."', city='".$city."', country='".$country."', about='".$about."', tution_fee_yearly = '".$tution_fee."', cost_of_living_yearly = '".$living_cost."', application_fee='".$application_fee."', address='".$address."', currency='".$currency."' where id='".$idd."'";
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

    	$query = $db->query("update programs set program_name='".$program_name."', description='".$description."', additional_requirements='".$admission_req."', other_fees='".$other_fees."', program_level='".$level_program."', length_program='".$length_program."', school_id='".$school_id."' where id='".$idd."' ");
    	if($query){
    		header("location:programs.php");
    	}else{
    		echo mysqli_error($db);
    	}
    }
?>