<?php 
    include_once './submit_functions.php';
    include_once './update_functions.php';
    session_start(); 
    if(!isset($_SESSION['email'])){ 
        header("location:login.php");
    }
    $month = [
      1 => 'Jan',
      2 => 'Feb',
      3 => 'Mar',
      4 => 'Apr',
      5 => 'May',
      6 => 'Jun',
      7 => 'Jul',
      8 => 'Aug',
      9 => 'Sept',
      10 => 'Oct',
      11 => 'Nov',
      12 => 'Dec'
    ]

?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Update Program </title>

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
        <li class="breadcrumb-item"><a href="programs.php">Programs</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Programs</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <?php
      $sql="select * from programs where id='".$_GET['id']."'";
      $result = mysqli_query($db, $sql);
      $program   = mysqli_fetch_array($result);
    ?>
    <div class="card">
      <div class="card-body">
        <h3 class="card__title mb-3">All Schools & Universities</h3>
        <form action="update_program.php" method="post">
            <input type="hidden" name="idd" value="<?php echo $program['id'] ?>">
            <div class="form-group">
                <label class="input__label">Program Name</label>
                <input type="text" class="form-control input-style" name="program_name" placeholder="Program Name" value="<?php echo $program['program_name'] ?>" required="required">
            </div>

            <div class="form-group">
                <label class="input__label">School Name</label>
                <select class="custom-select input-style" name="school_id" required>
                    
                    <?php
                        $school = "SELECT id,school_name from `schools`";
                        $school_result = $db->query($school);
                        while($school_row = $school_result->fetch_assoc()) {
                          if( $school_row['id'] == $program['school_id']){
                            ?>
                              <option value="<?php echo $school_row['id'] ?>" selected > <?php echo $school_row['school_name'] ?> </option>
                            <?php
                          }
                          else{
                            ?>

                              <option value=<?php echo $school_row['id'] ?> > <?php echo $school_row['school_name'] ?> </option>
                            <?php
                          }
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label class="input__label">Program Description</label>
                <textarea class="form-control input-style" name="description" row=2><?php echo $program['description'] ?> </textarea>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="input__label">Tution Fee</label>
                <input type="number" class="form-control input-style" value=<?php echo $program['tution_fee'] ?> name="tution_fee" placeholder="Tution Fee" required="required">
              </div>
              <div class="form-group col-md-6">
                <label class="input__label">Application Fee</label>
                <input type="number" class="form-control input-style" name="application_fee" value=<?php echo $program['application_fee'] ?> placeholder="Application Fee" required="required">
              </div>
            </div>

            <div class="form-group">
              <label class="input__label">Intake</label>
              <select name="intakes[]" class="w-100 selectpicker my-select intake-select border border-radius" multiple required>
                <?php
                  $selected_month = explode(",", $program['intakes']);
                  foreach($month as $key => $mon){
                    if(in_array($key ,$selected_month)){
                      ?><option value=<?php echo $key ?> selected><?php echo $mon ?></option><?php
                    }else{
                      ?><option value=<?php echo $key ?>><?php echo $mon ?></option><?php
                    }
                  }
                ?>
                    
              </select>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="input__label">Level of Program</label>
                <select class="custom-select input-style" name="level_program" required>
                    <option value="<?php echo $program['program_level'] ?>" selected><?php echo $program['program_level'] ?> </option>
                    <?php
                      $program_level = get_program_levels();
                      for($i=0 ; $i < count($program_level) ; ++$i){
                        ?>
                          <option value=<?php echo $program_level[$i]['level'] ?> ><?php echo $program_level[$i]['level'] ?></option>
                        <?php
                      }
                    ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                    <label class="input__label">Length of Program</label>
                    <input type="text" class="form-control input-style" value="<?php echo $program['length_program'] ?>" name="length_program" placeholder="length of program">
              </div>

            </div>  
            <div class="form-group">
                <label class="input__label">Admission Requirements</label>
                <textarea class="form-control input-style" name="admission_req" row=2><?php echo $program['additional_requirements'] ?> </textarea>
            </div>  
            <div class="form-group">
                <label class="input__label">Other Fees</label>
                <textarea class="form-control input-style" name="other_fees" row=2><?php echo $program['other_fees'] ?> </textarea>
            </div>          

            <!-- EXAMS -->
            <?php 
            
              $ielts_sql = "select * from program_exam_details where program_id=".$program['id']." and exam_type='ielts'";
              $ielts_result =  mysqli_query($db, $ielts_sql);
              $ielts   = mysqli_fetch_array($ielts_result);

              $toefl_sql = "select * from program_exam_details where program_id=".$program['id']." and exam_type='toefl'";
              $toefl_result =  mysqli_query($db, $toefl_sql);
              $toefl   = mysqli_fetch_array($toefl_result);

              $pte_sql = "select * from program_exam_details where program_id=".$program['id']." and exam_type='pte'";
              $pte_result =  mysqli_query($db, $pte_sql);
              $pte   = mysqli_fetch_array($pte_result);

              $celpip_sql = "select * from program_exam_details where program_id=".$program['id']." and exam_type='celpip'";
              $celpip_result =  mysqli_query($db, $celpip_sql);
              $celpip   = mysqli_fetch_array($celpip_result);

              $cae_sql = "select * from program_exam_details where program_id=".$program['id']." and exam_type='cae'";
              $cae_result =  mysqli_query($db, $cae_sql);
              $cae   = mysqli_fetch_array($cae_result);

            ?>

            <!-- IELTS -->
            <div class="form-row">
              
              
              <div class="col-md-2 pt-3">
                <div class="form-check check-remember check-me-out">
                  <?php
                  if($ielts){
                    ?><input class="form-check-input checkbox" type="checkbox" id="ielts" checked name="ielts"><?php
                  }else{
                    ?><input class="form-check-input checkbox" type="checkbox" id="ielts" name="ielts"><?php
                  }
                  ?>
                  <label class="form-check-label checkmark" for="ielts">
                      IELTS
                  </label>
                </div>
              </div>
              
              <div class="form-group col-md-2">
                <label class="input__label">Total Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $ielts['total_score'] ?>" step="0.1" name="ielts_total_score" placeholder="" min=0 max=10>
              </div>

              <div class="form-group col-md-2">
                <label class="input__label">Listening Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $ielts['listening'] ?>" step="0.1" name="ielts_listening" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Speaking Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $ielts['speaking'] ?>" step="0.1" name="ielts_speaking" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Writing Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $ielts['writing'] ?>" step="0.1" name="ielts_writing" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Reading Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $ielts['reading'] ?>" step="0.1" name="ielts_reading" placeholder="" min=0 max=10>
              </div>
            </div>

            <!-- TOEFL -->
            <div class="form-row">
              
              <div class="col-md-2 pt-3">
                <div class="form-check check-remember check-me-out">
                  <?php 
                    if($toefl){
                      ?><input class="form-check-input checkbox" type="checkbox" checked id="toefl" name="toefl"><?php
                    }else{
                      ?><input class="form-check-input checkbox" type="checkbox" id="toefl" name="toefl"><?php
                    }
                  ?>
                  <label class="form-check-label checkmark" for="toefl">
                    TOEFL
                  </label>
                </div>
              </div>

              <div class="form-group col-md-2">
                <label class="input__label">Total Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $toefl['total_score'] ?>" step="0.1" name="toefl_total_score" placeholder="" min=0 max=10>
              </div>

              <div class="form-group col-md-2">
                <label class="input__label">Listening Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $toefl['listening'] ?>" step="0.1" name="toefl_listening" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Speaking Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $toefl['speaking'] ?>" step="0.1" name="toefl_speaking" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Writing Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $toefl['writing'] ?>" step="0.1" name="toefl_writing" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Reading Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $toefl['reading'] ?>" step="0.1" name="toefl_reading" placeholder="" min=0 max=10>
              </div>
            </div>

            <!-- PTE -->
            <div class="form-row">
              
              <div class="col-md-2 pt-3">
                <div class="form-check check-remember check-me-out">
                  <?php 
                    if($pte){
                      ?><input class="form-check-input checkbox" type="checkbox" checked id="pte" name="pte"><?php
                    }else{
                      ?><input class="form-check-input checkbox" type="checkbox" id="pte" name="pte"><?php
                    }
                  ?>
                  <label class="form-check-label checkmark" for="pte">
                    PTE
                  </label>
                </div>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Total Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $pte['total_score'] ?>" step="0.1" name="pte_total_score" placeholder="" min=0 max=10>
              </div>

              <div class="form-group col-md-2">
                <label class="input__label">Listening Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $pte['listening'] ?>" step="0.1" name="pte_listening" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Speaking Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $pte['speaking'] ?>" step="0.1" name="pte_speaking" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Writing Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $pte['writing'] ?>" step="0.1" name="pte_writing" placeholder="" min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Reading Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $pte['reading'] ?>" step="0.1" name="pte_reading" placeholder="" min=0 max=10>
              </div>
            </div>

            <!-- CELPIP -->
            <div class="form-row">
              
              <div class="col-md-2 pt-3">
                <div class="form-check check-remember check-me-out">
                <?php 
                    if($celpip){
                      ?><input class="form-check-input checkbox" type="checkbox" checked id="celpip" name="celpip"><?php
                    }else{
                      ?><input class="form-check-input checkbox" type="checkbox" id="celpip" name="celpip"><?php
                    }
                  ?>
                  <label class="form-check-label checkmark" for="celpip">
                    CELPIP
                  </label>
                </div>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Total Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $celpip['total_score'] ?>" step="0.1" name="celpip_total_score" placeholder="" min=0 max=10>
              </div>

              <div class="form-group col-md-2">
                <label class="input__label">Listening Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $celpip['listening'] ?>" step="0.1" name="celpip_listening" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Speaking Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $celpip['speaking'] ?>" step="0.1" name="celpip_speaking" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Writing Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $celpip['writing'] ?>" step="0.1" name="celpip_writing" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Reading Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $celpip['reading'] ?>" step="0.1" name="celpip_reading" placeholder="" min=0 max=10>
              </div>
            </div>

            <!-- CAE -->
            <div class="form-row">
              
              <div class="col-md-2 pt-3">
                <div class="form-check check-remember check-me-out">
                <?php 
                    if($cae){
                      ?><input class="form-check-input checkbox" type="checkbox" checked id="cae" name="cae"><?php
                    }else{
                      ?><input class="form-check-input checkbox" type="checkbox" id="cae" name="cae"><?php
                    }
                  ?>
                  <label class="form-check-label checkmark" for="cae">
                    CAE
                  </label>
                </div>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Total Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $cae['total_score'] ?>" step="0.1" name="cae_total_score" placeholder="" min=0 max=10>
              </div>

              <div class="form-group col-md-2">
                <label class="input__label">Listening Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $cae['listening'] ?>" step="0.1" name="cae_listening" placeholder=" " min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Speaking Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $cae['speaking'] ?>" step="0.1" name="cae_speaking" placeholder="" min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Writing Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $cae['writing'] ?>" step="0.1" name="cae_writing" placeholder="" min=0 max=10>
              </div>
              <div class="form-group col-md-2">
                <label class="input__label">Reading Score</label>
                <input type="number" class="form-control input-style" value="<?php echo $cae['reading'] ?>" step="0.1" name="cae_reading" placeholder="" min=0 max=10>
              </div>
            </div>

            <div class="form-group text-right">
              <button type="submit" name="update_program" class="btn btn-primary btn-style">Update</button>
            </div>
        </form>
      </div>
    </div>
    <!-- blank block -->
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