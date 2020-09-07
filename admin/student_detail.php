<?php
    include_once './common_functions.php'; 
    include_once './update_functions.php'; 
    session_start(); 
    if(!isset($_SESSION['email'])){ 
        header("location:login.php");
    }
    $country_list = get_countries();
    
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Express Abroad</title>

  <!-- CSS files import -->
  <?php 
    include_once './header_css.php'; 
  ?>
</head>

<body class="sidebar-menu-collapsed">
  <div class="se-pre-con"></div>
<section>
  <!-- sidebar/header include -->
  <?php
    include './sidebar.php';
    include './header.php';
  ?>

  <!-- main content start -->
<div class="main-content">
  <!-- content -->
  <div class="container-fluid content-top-gap">
    <!-- breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Student</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <?php
        $student_sql = "select * from student s 
            left join exam_details ed on s.id=ed.student_id 
            where s.id=".$_GET['student_id'];
        $result = mysqli_query($db, $student_sql);
        $student = mysqli_fetch_array($result);
    ?>
    <form action="student_detail.php" method="post">
    <input type="hidden" name="student_id" value="<?php echo $_GET['student_id'] ?>">
    <!-- Card personal block -->
    <div class="card">
      <div class="card-body student-form-card">
        <h4>Personal Information</h4>
        <span class="span-note">(As indicated on your passport)</span>
        <div class="form-row mt-3">
            <div class="form-group col-md-4">
                <label class="input__label">First Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" name="first_name" value="<?php echo $student['first_name'] ?>" placeholder="First Name">
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">Middle Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" name="middle_name" value="<?php echo $student['middle_name'] ?>" placeholder="Middle Name">
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">Last Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" name="last_name" value="<?php echo $student['last_name'] ?>" placeholder="Last Name">
            </div>
        </div>

        <div class="form-row  mt-3">
            <div class="form-group col-md-4">
                <label class="input__label">Date of Birth <span class="text-danger">*</span></label>
                <input type="date" class="form-control input-style" name="dob" value="<?php echo $student['date_of_birth'] ?>" placeholder="Date of Birth">
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">First Language <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" name="first_language" value="<?php echo $student['first_language'] ?>" placeholder="First language">
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">Country of Citizenship <span class="text-danger">*</span></label>
                <select name="citizenship" class="form-control input-style" required>
                    <option value="null">Select Country</option>
                    <?php
                      for($i=0 ; $i < count($country_list) ; ++$i){
                          if($country_list[$i]['id'] == $student['citizenship']){
                              ?><option selected value=<?php echo $country_list[$i]['id'] ?> ><?php echo $country_list[$i]['country_name'] ?></option><?php
                          }else{
                              ?><option value=<?php echo $country_list[$i]['id'] ?> ><?php echo $country_list[$i]['country_name'] ?></option><?php
                          }
                      }
                    ?>
                </select>
            </div>
        </div>

        <div class="form-row mt-3">
            <div class="form-group col-md-4">
                <label class="input__label">Passport Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" value="<?php echo $student['passport_number'] ?>" name="passport" placeholder="Passport Number">
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">Gender <span class="text-danger">*</span></label>
                <select class="form-control input-style" name="gender">
                <?php 
                    if($student['gender'] == 'male'){
                        ?>
                        <option value="male" selected>Male</option>
                        <option value="female">Female</option>
                        <?php
                    }else{
                        ?>
                        <option value="male">Male</option>
                        <option value="female" selected>Female</option>
                        <?php
                    }
                ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">Marital Status <span class="text-danger">*</span></label>
                <select class="form-control input-style" name="marital">
                <?php
                    if($student['marital_status'] == 'married'){
                        ?>
                        <option value="married" selected >Married</option>
                        <option value="single">Single</option>
                        <?php
                    }else{
                        ?>
                        <option value="married" >Married</option>
                        <option value="single"selected>Single</option>
                        <?php
                    }
                ?>
                  
                </select>
            </div>
        </div>
        
        <h4 class="mt-3">Address Details</h4>
        <div class="form-row mt-3">
            <div class="form-group col-md-8">
                <label class="input__label">Address <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" value="<?php echo $student['address'] ?>" name="address" placeholder="Address">
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">City/Town <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" value="<?php echo $student['city'] ?>" name="city" placeholder="City">
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="form-group col-md-4">
                <label class="input__label">State <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" value="<?php echo $student['state'] ?>" name="state" placeholder="State">
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">Country <span class="text-danger">*</span></label>
                <select name="country" class="form-control input-style" required>
                    <option value="null">Select Country</option>
                    <?php
                      for($i=0 ; $i < count($country_list) ; ++$i){
                        if($country_list[$i]['id'] == $student['citizenship']){
                            ?><option selected value=<?php echo $country_list[$i]['id'] ?> ><?php echo $country_list[$i]['country_name'] ?></option><?php
                        }else{
                            ?><option value=<?php echo $country_list[$i]['id'] ?> ><?php echo $country_list[$i]['country_name'] ?></option><?php
                        }
                      }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">Postal/Zip Code <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" value="<?php echo $student['zip'] ?>" name="zip" placeholder="Zip/Postal Code">
            </div>
        </div>
        <div class="form-row mt-3">
            <div class="form-group col-md-4">
                <label class="input__label">Email</label>
                <input type="email" class="form-control input-style" value="<?php echo $student['email'] ?>" name="email" placeholder="Email Address">
            </div>
            <div class="form-group col-md-4">
                <label class="input__label">Phone Number <span class="text-danger">*</span></label>
                <input type="text" class="form-control input-style" name="phone" value="<?php echo $student['phone_number'] ?>" placeholder="987654321">
            </div>
        </div>
          
      </div>
    </div>
    <!-- // Card personal block -->

    <!-- Card education block -->
    <div class="card mt-3">
      <div class="card-body student-form-card">
        <h4>Education Summary</h4>
        <div class="form-row mt-3">
          <div class="form-group col-md-4">
              <label class="input__label">Country of Education <span class="text-danger">*</span></label>
              <select class="form-control input-style" name="education_country">
                <option value="null">Select Country</option>
                <?php
                  for($i=0 ; $i < count($country_list) ; ++$i){
                    if($country_list[$i]['id'] == $student['citizenship']){
                        ?><option selected value=<?php echo $country_list[$i]['id'] ?> ><?php echo $country_list[$i]['country_name'] ?></option><?php
                    }else{
                        ?><option value=<?php echo $country_list[$i]['id'] ?> ><?php echo $country_list[$i]['country_name'] ?></option><?php
                    }
                  }
                ?>
              </select>
          </div>
          <div class="form-group col-md-4">
              <label class="input__label">Highest Level of Education <span class="text-danger">*</span></label>
              <!-- <input type="text" class="form-control input-style" name="level_education" placeholder="Highest Education"> -->
              <select class="form-control input-style" id="level-education" name="level_education">
                <option value=null>Select Level of education</option>
                <?php
                  $program_level = get_program_levels();
                  for($i=0 ; $i < count($program_level) ; ++$i){
                      if($program_level[$i]['level'] == $student['level_education']){
                        ?>
                        <option selected value="<?php echo $program_level[$i]['level'] ?>" ><?php echo $program_level[$i]['level'] ?></option>
                        <?php
                      }else{
                        ?>
                        <option value="<?php echo $program_level[$i]['level'] ?>" ><?php echo $program_level[$i]['level'] ?></option>
                        <?php 
                      }
                  }
                ?>
              </select>
          </div>
          <div class="form-group col-md-4">
              <label class="input__label">Grading Scheme <span class="text-danger">*</span></label>
              <input name="grading_scheme" class="form-control input-style"  value="<?php echo $student['grading_scheme'] ?>">
              
          </div>
        </div>
        <div class="form-row mt-3">
          <div class="form-group col-md-4">
              <label class="input__label">Grade Average <span class="text-danger">*</span></label>
              <input type="text" class="form-control input-style" name="avg_grade"  value="<?php echo $student['grade_avg'] ?>" placeholder="Average grade">
          </div>
        </div>
      </div>
    </div>
    <!-- // Card education block -->

    <!-- Card Test score -->
    <div class="card mt-3">
      <div class="card-body student-form-card">
        <h4>Test Scores</h4>
        <div class="form-row mt-3">
          <div class="form-group col-md-2">
              <label class="input__label">English Exam Type <span class="text-danger">*</span></label>
              <select class="form-control input-style" name="exam_type" id="exam_type">
                  <option value="<?php echo $student['exam_type_name'] ?>"><?php echo $student['exam_type_name'] ?></option>
                  <option value="no_test">No Test taken</option>
                  <option value="ielts">IELTS</option>
                  <option value="toefl">TOEFL</option>
                  <option value="pte">PTE</option>
                  <option value="celpip">CELPIP</option>
                  <option value="cae">CAE</option>
              </select>
          </div>
          <div class="form-group col-md-2 exam_date">
            <label class="input__label">Date of Exam <span class="text-danger">*</span></label>
            <input type="date" class="form-control input-style" value="<?php echo $student['exam_date'] ?>" name="exam_type_date">
          </div>
          <div class="form-group col-md-2 listening">
            <label class="input__label"> listening <span class="text-danger">*</span></label>
            <input type="number" class="form-control input-style" name="listening" value="<?php echo $student['listening'] ?>" placeholder="listening Score"  min=0 max=10>
          </div>
          <div class="form-group col-md-2 reading">
            <label class="input__label"> reading <span class="text-danger">*</span></label>
            <input type="number" class="form-control input-style" name="reading" value="<?php echo $student['reading'] ?>" placeholder="reading Score"  min=0 max=10>
          </div>
          <div class="form-group col-md-2 writing">
            <label class="input__label"> writing<span class="text-danger">*</span></label>
            <input type="number" class="form-control input-style" name="writing" value="<?php echo $student['writing'] ?>" placeholder="writing Score"  min=0 max=10>
          </div>
          <div class="form-group col-md-2 speaking">
            <label class="input__label"> speaking<span class="text-danger">*</span></label>
            <input type="number" class="form-control input-style" name="speaking" value="<?php echo $student['speaking'] ?>" placeholder="speaking Score"  min=0 max=10>
          </div>
        </div>
      </div>
    </div>
    <!-- // Card Test score -->
    
    <!-- Card Qualifications -->
    <div class="card mt-3 d-none">
      <div class="card-body student-form-card">
        <h4>Additional Qualifications</h4>
        <div class="form-row mt-3">
          <div class="form-group col-md-12">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input gre_check" name="gre_exam" id="customSwitches">
                <label class="custom-control-label bold-label" for="customSwitches">I have GRE exam scores</label>
              </div>
          </div>
          <div class="col-md-4 gre_exam">
              <label class="input__label">GRE Exam date <span class="text-danger">*</span></label>
              <input type="date" class="form-control input-style" name="gre_date">
          </div>
          <div class="col-md-2 gre_exam">
              <label class="input__label">Verbal <span class="text-danger">*</span></label>
              <input type="number" class="form-control input-style" name="gre_verbal_score" placeholder="Score" min=0 max=100 >
              <input type="number" class="form-control input-style mt-2" name="gre_verbal_rank" placeholder="Rank %" min=0 max=100 >
          </div>
          <div class="col-md-2 gre_exam">
              <label class="input__label">Quantitive <span class="text-danger">*</span></label>
              <input type="number" class="form-control input-style" name="gre_quant_score" placeholder="Score" min=0 max=100 >
              <input type="number" class="form-control input-style mt-2" name="gre_quant_rank" placeholder="Rank %" min=0 max=100 >
          </div>
          <div class="col-md-2 gre_exam">
              <label class="input__label">Writing <span class="text-danger">*</span></label>
              <input type="number" class="form-control input-style" name="gre_writing_score" placeholder="Score" min=0 max=100 >
              <input type="number" class="form-control input-style mt-2" name="gre_writing_rank" placeholder="Rank %" min=0 max=100 >
          </div>
        </div>

        <div class="form-row mt-5">
          <div class="form-group col-md-12">
              <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input gmat_check" name="gmat_exam" id="customSwitches1">
                <label class="custom-control-label bold-label" for="customSwitches1">I have GMAT exam scores</label>
              </div>
          </div>
          <div class="col-md-4 gmat_exam">
              <label class="input__label">GMAT Exam date <span class="text-danger">*</span></label>
              <input type="date" class="form-control input-style" name="gmat_date">
          </div>
          <div class="col-md-2 gmat_exam">
              <label class="input__label">Verbal <span class="text-danger">*</span></label>
              <input type="number" class="form-control input-style" name="gmat_verbal_score" placeholder="Score" min=0 max=100 >
              <input type="number" class="form-control input-style mt-2" name="gmat_verbal_rank" placeholder="Rank %" min=0 max=100 >
          </div>
          <div class="col-md-2 gmat_exam">
              <label class="input__label">Quantitive <span class="text-danger">*</span></label>
              <input type="number" class="form-control input-style" name="gmat_quant_score" placeholder="Score" min=0 max=100 >
              <input type="number" class="form-control input-style mt-2" name="gmat_quant_rank" placeholder="Rank %" min=0 max=100 >
          </div>
          <div class="col-md-2 gmat_exam">
              <label class="input__label">Writing <span class="text-danger">*</span></label>
              <input type="number" class="form-control input-style" name="gmat_writing_score" placeholder="Score" min=0 max=100 >
              <input type="number" class="form-control input-style mt-2" name="gmat_writing_rank" placeholder="Rank %" min=0 max=100 >
          </div>
          <div class="col-md-2 gmat_exam">
              <label class="input__label">Total <span class="text-danger">*</span></label>
              <input type="number" class="form-control input-style" name="gmat_total_score" placeholder="Score" min=0 max=100 >
              <input type="number" class="form-control input-style mt-2" name="gmat_total_rank" placeholder="Rank %" min=0 max=100 >
          </div>
        </div>

      </div>
    </div>
    <!-- // Card Qualifications -->

    <!-- Card backgroud info -->
    <div class="card mt-3">
        <div class="card-body student-form-card">
            <h4>Background Information</h4>
            <div class="form-row mt-3">
              <div class="form-group col-md-12">
                <label class="input__label bold-label" style="text-transform:none">Have you been refused a visa from Canada, the USA, the United Kingdom, New Zealand or Australia? <span class="text-danger">*</span></label>
                <div class="form-check px-5">
                <?php
                    if($student['refused_visa']){
                        ?>
                        <input class="form-check-input" type="radio" name="refusedVisa" id="refusedVisa1" value="1" checked>
                        <label class="form-check-label" for="refusedVisa1">
                          Yes
                        </label>
                        <?php
                    }else{
                        ?>
                        <input class="form-check-input" type="radio" name="refusedVisa" id="refusedVisa1" value="1">
                        <label class="form-check-label" for="refusedVisa1">
                          Yes
                        </label>
                        <?php
                    }
                ?>
                </div>
                <div class="form-check px-5">
                <?php
                    if(!($student['refused_visa'])){
                        ?>
                        <input class="form-check-input" type="radio" name="refusedVisa" id="refusedVisa2" value="0" checked>
                        <label class="form-check-label" for="refusedVisa2">
                            No
                        </label>
                        <?php
                    }else{
                        ?>
                        <input class="form-check-input" type="radio" name="refusedVisa" id="refusedVisa2" value="0">
                        <label class="form-check-label" for="refusedVisa2">
                            No
                        </label>
                        <?php
                    }
                ?>
                </div>
              </div> 
            </div><!-- form-row end -->
            <div class="form-row mt-3">
                <div class="form-group col-md-12">
                  <label class="input__label  bold-label">Do you have a valid study permit/visa?</label>
                  <div class="form-check px-5">
                  <?php
                    if($student['valid_permit']){
                        ?>
                        <input class="form-check-input" type="radio" name="validPermit" id="validPermit1" value="1" checked>
                        <label class="form-check-label" for="validPermit1">
                        Yes
                        </label>
                        <?php
                    }else{
                        ?>
                        <input class="form-check-input" type="radio" name="validPermit" id="validPermit1" value="1">
                        <label class="form-check-label" for="validPermit1">
                        Yes
                        </label>
                        <?php
                    }
                  ?>
                    
                  </div>
                  <div class="form-check px-5">
                    <?php
                        if($student['valid_permit']){
                            ?>
                            <input class="form-check-input" type="radio" name="validPermit" id="validPermit2" value="0">
                            <label class="form-check-label" for="validPermit2">
                            No
                            </label>
                            <?php
                        }else{
                            ?>
                            <input class="form-check-input" type="radio" name="validPermit" id="validPermit2" value="0" checked>
                            <label class="form-check-label" for="validPermit2">
                            No
                            </label>
                            <?php
                        }
                    ?>
                    
                  </div>
                </div>
            </div><!-- form-row end -->
            <div class="form-row mt-3">
                <div class="form-group col-md-12">
                  <label class="input__label bold-label">If you answered "Yes" to any of above, provide details</label>
                  <textarea class="form-control" name="details"><?php echo $student['detail'] ?></textarea>
                </div>
            </div>
        </div>
    </div>
    <!-- Card backgroud info -->

    <!-- Card submit button -->
    <div class="card mt-3">
      <div class="card-body text-right">
        <button type="submit" name="update_student" class="btn btn-primary">Update Student</button>
      </div>
    </div>
    </form>



  </div>
  <!-- //content -->
</div>
<!-- main content end-->
</section>
  <!-- footer include -->
  <?php
    include './footer.php';
  ?>
</body>

</html>