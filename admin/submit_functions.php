<?php
	include_once './config.php';
	include_once './common_functions.php' ;
	// Login Function
	if(isset($_POST['login'])){
        $username = mysqli_real_escape_string($db,$_POST['username']);
        $pass = mysqli_real_escape_string($db,$_POST['password']);
        $query = $db->query("select * FROM `admin` WHERE `username`='$username' AND `password`='$pass' ");
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

		$total_score = $_POST['total_score'] != '' ? $_POST['total_score'] : 0;
		$listening = $_POST['listening'] != '' ? $_POST['listening'] : 0;
		$reading = $_POST['reading'] != '' ? $_POST['reading'] : 0;
		$writing = $_POST['writing'] != '' ? $_POST['writing'] : 0;
		$speaking = $_POST['speaking'] != '' ? $_POST['speaking'] : 0;
		$exam_type = $_POST['exam_type'];

    	$query = $db->query("insert into programs (program_name, description, program_level, length_program, school_id, additional_requirements, other_fees, tution_fee, application_fee, exam_type, total_score, listening, reading, speaking, writing) values('$program_name', '$description', '$level_program', '$length_program','$school_id','$admission_req', '$other_fees', '$tution_fee', '$application_fee',  '$exam_type', '$total_score', '$listening', '$reading', '$speaking', '$writing') ");
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
	
	// Add Student
	if(isset($_POST['add_student'])){
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];
		$dob = $_POST['dob'];
		$first_language = $_POST['first_language'];
		$citizenship = $_POST['citizenship'];
		$passport = $_POST['passport'];
		$gender = $_POST['gender'];
		$marital_status = $_POST['marital'];

		$address = mysqli_real_escape_string($db,$_POST['address']);
		$city = $_POST['city'];
		$state = $_POST['state'];
		$country = $_POST['country'];
		$zip = $_POST['zip'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];

		$edu_country = $_POST['education_country'];
		$level_education = $_POST['level_education'];
		$grading_scheme  = $_POST['grading_scheme'];
		$grade_scale = $_POST['grade_scale'];
		$avg_grade = $_POST['avg_grade'];

		$exam_type = $_POST['exam_type'];
		if($exam_type != 'no_test'){
			$exam_id = add_exam_type($_POST, $db);
		}else{
			$exam_id = 0;
		}
		

		if(isset($_POST['gre_exam'])){
			$gre_id = add_gre_exam_details($_POST, $db);
		}else{
			$gre_id = 0;
		}

		if(isset($_POST['gmat_exam'])){
			$gmat_id = add_gmat_exam_details($_POST, $db);
			
		}else{
			$gmat_id = 0;
		}

		$refusedVisa = $_POST['refusedVisa'];
		$validPermit = $_POST['validPermit'];
		$details = $_POST['details'];
		session_start();
		$agent = $_SESSION['user_id'];

		$query = $db->query("insert into student(first_name, middle_name, last_name, date_of_birth, first_language, citizenship, address, city, state, country, zip,
		email, phone_number, education_country, level_education, grading_scheme, grade_scale, grade_avg, exam_type_name, exam_type_id, GRE_exam, GMAT_exam,
		refused_visa, valid_permit, detail, agent_id, passport_number, gender, marital_status, status )
		values('$first_name', '$middle_name', '$last_name', '$dob', '$first_language', '$citizenship', '$address', '$city', '$state', '$country','$zip', 
		'$email', '$phone', '$edu_country', '$level_education', '$grading_scheme', '$grade_scale', '$avg_grade', '$exam_type', $exam_id, '$gre_id', '$gmat_id',
		'$refusedVisa', '$validPermit', '$details', '$agent', '$passport', '$gender', '$marital_status', 'Pending..')
		");

		if($query){
			$student_id = $db->insert_id;
			header("location:upload_docs.php?student_id=".$student_id);
		}else{
			echo mysqli_error($db);
		}

	}

	function add_exam_type($post, $db){
		if($post['exam_type'] == 'duolingo'){
			$listening = '';
			$reading = '';
			$writing = '';
			$speaking = '';
			$exact_score = $post['exact_score'];
		}else{
			$listening = $post['listening'];
			$reading = $post['reading'];
			$writing = $post['writing'];
			$speaking = $post['speaking'];
			$exact_score = 0;
		}
		$exam_date = $post['exam_type_date'];

		$query = $db->query("insert into exam_details(exam_date, reading, writing, speaking, listening, score) 
		values('$exam_date', '$reading', '$writing', '$speaking','$listening', '$exact_score')");
    	if($query){
			$exam_type_id = $db->insert_id;
			return $exam_type_id;
    	}else{
			echo mysqli_error($db);
		}
	}

	function add_gre_exam_details($post, $db){
		$gre_exam_date = $post['gre_date'];
		$gre_verbal_score = $post['gre_verbal_score'];
		$gre_verbal_rank = $post['gre_verbal_rank'];
		$gre_quant_score = $post['gre_quant_score'];
		$gre_quant_rank = $post['gre_quant_rank'];
		$gre_writing_score = $post['gre_writing_score'];
		$gre_writing_rank = $post['gre_writing_rank'];

		$query = $db->query("insert into gre_exam(exam_date, verbal_score, verbal_rank, writing_score, writing_rank, quant_score, quant_rank) 
		values('$gre_exam_date', '$gre_verbal_score', '$gre_verbal_rank', '$gre_writing_score','$gre_writing_rank','$gre_quant_score', '$gre_quant_rank') ");
    	if($query){
			$gre_id = $db->insert_id;
			return $gre_id;
    	}else{
			echo mysqli_error($db);
		}
	}

	function add_gmat_exam_details($post, $db){
		$gmat_exam_date = $post['gmat_date'];
		$gmat_verbal_score = $post['gmat_verbal_score'];
		$gmat_verbal_rank = $post['gmat_verbal_rank'];
		$gmat_quant_score = $post['gmat_quant_score'];
		$gmat_quant_rank = $post['gmat_quant_rank'];
		$gmat_writing_score = $post['gmat_writing_score'];
		$gmat_writing_rank = $post['gmat_writing_rank'];
		$gmat_total_score = $post['gmat_total_score'];
		$gmat_total_rank = $post['gmat_total_rank'];

		$query = $db->query("insert into gmat_exam(exam_date, verbal_score, verbal_rank, writing_score, writing_rank, quant_score, quant_rank, total_score, total_rank) 
		values('$gmat_exam_date', '$gmat_verbal_score', '$gmat_verbal_rank', '$gmat_writing_score','$gmat_writing_rank','$gmat_quant_score', '$gmat_quant_rank', '$gmat_total_score', '$gmat_total_rank' )");
    	if($query){
			$gmat_id = $db->insert_id;
			return $gmat_id;
    	}else{
			echo mysqli_error($db);
		}
	}
	
	if (isset($_POST['upload_docs'])){

		$doc_dir = "../media/documents/";
		$insert_values = 'values ';
		$student_id = $_POST['student_id'];
		$ts = get_timestamp();
		foreach($_FILES["doc"]["tmp_name"] as $key=>$tmp_name) {
			if (basename($_FILES["doc"]["name"][$key]) != ''){
				$doc_filename = $ts . "_" . basename($_FILES["doc"]["name"][$key]);
				$doc_file = $doc_dir . $doc_filename;
				move_uploaded_file($_FILES['doc']['tmp_name'][$key], $doc_file);
				$insert_values .= '('.$student_id.', "'.$_POST['doc_type'][$key].'", "'.$doc_filename.'"),';
			}
		}
		$insert_values = rtrim($insert_values, ",");
		echo $insert_values;
		$query_string = "insert into upload_docs (student_id, document_name, document) ".$insert_values;
		$sql = $db->query($query_string);
		if($sql){
			header("location:choose_program.php?student_id=".$student_id);
		}else{
			echo mysqli_error($db);
		}
	}

	// choose program
	if(isset($_POST['select_program'])){
		$program_id = $_POST['program_id'];
		$student_id = $_POST['student_id'];
		$query = "insert into applications (student_id, program_id, status, apply_date) values('$student_id', '$program_id', 'not paid', now())";
		$sql = $db->query($query);
		if($sql){
			// header("location:stripe-integration/index.php?student_id=".$student_id);
			header("location:choose_program.php?student_id=".$student_id);
		}
	}

	// remove program
	if(isset($_POST['deselect_program'])){
		$program_id = $_POST['program_id'];
		$student_id = $_POST['student_id'];
		$query = "delete from applications where student_id='$student_id' and program_id='$program_id'";
		$sql = $db->query($query);
		if($sql){
			// header("location:stripe-integration/index.php?student_id=".$student_id);
			header("location:choose_program.php?student_id=".$student_id);
		}
		// echo "<script>console.log('$program_id')</script>";
	}
?>