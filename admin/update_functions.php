<?php
	include_once './config.php';

	if(isset($_POST['update_school'])){

		$workPermit 	= isset($_POST['workPermit']) ? 1 : 0;
		$internship 	= isset($_POST['internship']) ? 1 : 0;
		$workStudy 		= isset($_POST['workStudy']) ? 1 : 0;
		$offerLetter 	= isset($_POST['offerLetter']) ? 1 : 0;
		$accomodation 	= isset($_POST['accomodation']) ? 1 : 0;

		$feature_id = $_POST['feature_id'];
		$sqlf="update features set work_permit='".$workPermit."', work_study='".$workStudy."', accomodation='".$accomodation."', internship='".$internship."', offer_letter='".$offerLetter."' where id='".$feature_id."'";
		mysqli_query($db,$sqlf);

		$idd = $_POST['idd'];
		$school_name = mysqli_real_escape_string($db,$_POST['school_name']);
    	$founded = $_POST['founded'];
    	$type = $_POST['type'];
    	$total_students = $_POST['total_students'];
    	$intrested_students = $_POST['int_students'];
		$city = $_POST['city'];
		$state = $_POST['state'];
    	$country = $_POST['country'];
    	$about = mysqli_real_escape_string($db,$_POST['about']);
    	$tution_fee = $_POST['tution_fee'];
    	$living_cost = $_POST['living_cost'];
    	$application_fee = $_POST['application_fee'];
    	$address = mysqli_real_escape_string($db, $_POST['address']);
		$dli = mysqli_real_escape_string($db, $_POST['dli']);
		
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
		if($_FILES['gallery_img']['size'][0] != 0){
			$gallery_dir = "../media/gallery/";
			$gallery_arr = [];
			foreach($_FILES["gallery_img"]["tmp_name"] as $key=>$tmp_name) {
				$gallery_filename = $ts . "_" . basename($_FILES["gallery_img"]["name"][$key]);
				$gallery_file = $gallery_dir . $gallery_filename;
				move_uploaded_file($_FILES['gallery_img']['tmp_name'][$key], $gallery_file);
				array_push($gallery_arr, $gallery_filename);
			}
			$gallery_str = implode(",",$gallery_arr);
		}else{
			$gallery_str = $_POST['old_gallery'];
		}

		$map = get_map_link($_POST['map']);
		
        $sql="update schools set school_name='".$school_name."', founded='".$founded."', type='".$type."', total_students='".$total_students."', intrested_students = '".$intrested_students."', city='".$city."', state='".$state."', country='".$country."', about='".$about."', tution_fee_yearly = '".$tution_fee."', cost_of_living_yearly = '".$living_cost."', application_fee='".$application_fee."', address='".$address."', dli='".$dli."', school_logo='".$logo_filename."', cover_img='".$cover_filename."', gallery='".$gallery_str."', map='".$map."' where id='".$idd."'";
		if(mysqli_query($db,$sql)){
			header("location:schools.php");
		}
		else{
			echo mysqli_error($db);
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

		update_exam_details($_POST, $db);

		$intakes_arr = [];
		foreach($_POST['intakes'] as $mon){
			array_push($intakes_arr, $mon);
		}
		$intakes = implode(",",$intakes_arr);

		$query = $db->query("update programs set program_name='".$program_name."', description='".$description."', 
		additional_requirements='".$admission_req."', other_fees='".$other_fees."', program_level='".$level_program."', 
		length_program='".$length_program."', school_id='".$school_id."', application_fee='".$application_fee."', 
		tution_fee='".$tution_fee."', intakes='$intakes' where id='".$idd."' ");
    	if($query){
    		header("location:programs.php");
    	}else{
    		echo mysqli_error($db);
    	}
	}

	function update_exam_details($post, $db){
		$program_id = $_POST['idd'];

		if(isset($post['ielts'])){
			$ielts = $db->query("select * FROM program_exam_details WHERE program_id='$program_id' and exam_type='ielts' ");
        	if(mysqli_num_rows($ielts)) {
				update_program_exam_details($post, $db, 'ielts');
			}else{
				insert_in_exam_in_table($program_id, 'ielts', $db, $post);
			}
		}
		
		if(isset($post['toefl'])){
			$toefl = $db->query("select * FROM program_exam_details WHERE program_id='$program_id' and exam_type='toefl' ");
        	if(mysqli_num_rows($toefl)) {
				update_program_exam_details($post, $db, 'toefl');
			}else{
				insert_in_exam_in_table($program_id, 'toefl', $db, $post);
			}
		}

		if(isset($post['pte'])){
			$pte = $db->query("select * FROM program_exam_details WHERE program_id='$program_id' and exam_type='pte' ");
        	if(mysqli_num_rows($pte)) {
				update_program_exam_details($post, $db, 'pte');
			}else{
				insert_in_exam_in_table($program_id, 'pte', $db, $post);
			}
		}

		if(isset($post['celpip'])){
			$celpip = $db->query("select * FROM program_exam_details WHERE program_id='$program_id' and exam_type='celpip' ");
        	if(mysqli_num_rows($celpip)) {
				update_program_exam_details($post, $db, 'celpip');
			}else{
				insert_in_exam_in_table($program_id, 'celpip', $db, $post);
			}
		}

		if(isset($post['cae'])){
			$cae = $db->query("select * FROM program_exam_details WHERE program_id='$program_id' and exam_type='cae' ");
        	if(mysqli_num_rows($cae)) {
				update_program_exam_details($post, $db, 'cae');
			}else{
				insert_in_exam_in_table($program_id, 'cae', $db, $post);
			}
		}
	}

	function update_program_exam_details($post, $db, $exam){
		$total_score = $post[$exam.'_total_score'];
		$listening = $post[$exam.'_listening'];
		$speaking = $post[$exam.'_speaking'];
		$writing = $post[$exam.'_writing'];
		$reading = $post[$exam.'_reading'];

		$update_query = "update program_exam_details set total_score='$total_score', listening='$listening', 
		speaking='$speaking', writing='$writing', reading='$reading' where program_id=".$post['idd']." and exam_type='$exam'";
		
		$query = $db->query($update_query);
		if($query){
			echo 'done';
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

	if(isset($_POST['update_application'])){
		$app_id = $_POST['idd'];
		$status = $_POST['status'];
		$applied =  isset($_POST['applied']) ? 1 : 0;
		$submitted =  isset($_POST['submitted']) ? 1 : 0;
		$requirements = $_POST['requirements'];
		$current_stage = $_POST['current_stage'];
		// echo $app_id, $status, $applied, $submitted;
		$sql = "update applications set status='$status', applied='$applied', submitted='$submitted', requirements='$requirements', current_stage='$current_stage' where id='$app_id'";
		$query = $db->query($sql);
		if($query){
			header("location:applications.php");
			// echo 'done';
		}else{
			echo mysqli_error($db);
		}
	}
?>