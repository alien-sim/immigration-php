<?php
    $city_array = [];
    $country = "SELECT distinct state from `schools` where state != ''";
    $country_result = $db->query($country);
    // echo $country_result;
    while($city_row = $country_result->fetch_assoc()){
        // $city_split = explode(",", $city_row['city']);
        // for($i=0; $i<count($city_split); ++$i){
        // }
        array_push($city_array, $city_row['state']);
    }
    // $city_array = array_unique($city_array);
    $current_month = date("m");
?>

<div class="tab-pane fade show active my-4 row" id="nav-search" role="tabpanel" aria-labelledby="nav-search-tab">
    <div class="row px-3">
        <div class="col-md-3 bg-light border py-3 border-radius">

            <div class="form-group">
                <label class="input__label">Student </label>
                <select name="student" class="w-100 selectpicker my-select student-select border border-radius"> 
                    <option value=null>Select Student</option>
                <?php
                    $student = 'SELECT id, CONCAT(first_name," ",last_name) as `name` from `student`';
                    $student_result = $db->query($student);
                    while($student_row = $student_result->fetch_assoc()) {
                        ?>
                        <option value=<?php echo $student_row['id'] ?> ><?php echo $student_row['name'] ?></option>
                        <?php
                    }
                ?>
                </select>
            </div>

            <hr>

            <!-- <div class="form-group">
                <label class="input__label">English Exam Type </label>
                <select name="exam_type" class="w-100 selectpicker my-select exam-type-select border border-radius"> 
                    <option value="">Exam Type</option>
                    <option value="no_test">No Test taken</option>
                    <option value="ielts">IELTS</option>
                    <option value="toefl">TOEFL</option>
                    <option value="duolingo">Duolingo English Test</option>
                </select>
            </div> -->

            <div class="form-group">
                <label class="input__label">Country</label>
                <select name="country" class="w-100 selectpicker my-select country-select border border-radius" multiple required>
                    <?php
                    $country = "SELECT * from `countries`";
                    $country_result = $db->query($country);
                    while($country_row = $country_result->fetch_assoc()) {
                        ?>
                        <option value=<?php echo $country_row['id'] ?> ><?php echo $country_row['country_name'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label class="input__label">State/ City</label>
                <select name="city" class="selectpicker my-select w-100 city-select border border-radius" multiple required>
                    <?php
                    foreach($city_array as $city) {
                        ?>
                        <option value="<?php echo $city ?>"><?php echo ucwords($city) ?></option>
                        <?php
                    }
                    ?>
                </select>
            </div>
            
            <div class="form-group">
                <div class="form-check check-remember check-me-out ">
                    <input class="form-check-input checkbox workPermit" type="checkbox" id="workPermit" name="workPermit">
                    <label class="form-check-label checkmark" for="workPermit" style="font-size:14px">
                        Post-Graduation Work Permit Available
                    </label>
                </div>
            </div>

            <div class="form-group">
              <label class="input__label">Type of School</label>
                <div class="form-check check-remember check-me-out col-sm-12 mt-1 ">
                  <input class="form-check-input checkbox university" type="checkbox" id="university" name="university">
                  <label class="form-check-label checkmark" for="university" style="font-size:14px">
                    University
                  </label>
                </div>
                
                <div class="form-check check-remember check-me-out col-sm-12 mt-1">
                  <input class="form-check-input checkbox college" type="checkbox" id="college" name="college">
                  <label class="form-check-label checkmark" for="college" style="font-size:14px">
                      College
                  </label>
                </div>

                <div class="form-check check-remember check-me-out col-sm-12 mt-1">
                  <input class="form-check-input checkbox english" type="checkbox" id="english" name="english">
                  <label class="form-check-label checkmark" for="english" style="font-size:14px">
                      English Institute
                  </label>
                </div>

                <div class="form-check check-remember check-me-out col-sm-12 mt-1">
                  <input class="form-check-input checkbox highSchool" type="checkbox" id="highSchool" name="highSchool">
                  <label class="form-check-label checkmark" for="highSchool" style="font-size:14px">
                      High School
                  </label>
                </div>
            </div>

            <div class="form-group">
                <label>Program Level</label>
                <select class="selectpicker my-select w-100 level-select border border-radius" multiple name="program_level">
                    <option value="English as Second Language (ESL)">English as Second Language (ESL)</option>
                    <?php
                        $program_level = get_program_levels();
                        for($i=0 ; $i < count($program_level) ; ++$i){
                            ?>
                            <option value="<?php echo $program_level[$i]['level'] ?>" ><?php echo $program_level[$i]['level'] ?></option>
                            <?php
                        }
                    ?>
                </select>

            </div>

            <div class="form-group">
              <label class="input__label">Intake</label>
              <select name="intakes" class="w-100 selectpicker my-select intake-select border border-radius">
                <option value=null>Select intake</option>
                    <option value="1">Jan
                    <?php
                        
                        if($current_month>=1){
                            echo (int) date("Y")+1;
                        }else{
                            echo date("Y");
                        }
                    ?>
                    </option>
                    <option value="2">Feb
                        <?php
                            if($current_month>=2){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                    <option value="3">Mar
                        <?php
                            
                            if($current_month>=3){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                    <option value="4">Apr
                        <?php
                            
                            if($current_month>=4){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                    <option value="5">May
                        <?php
                            
                            if($current_month>=5){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                    <option value="6">Jun
                        <?php
                            
                            if($current_month>=6){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                    <option value="7">Jul
                        <?php
                            
                            if($current_month>=3){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                    <option value="8">Aug
                    <?php
                        
                        if($current_month>=8){
                            echo (int) date("Y")+1;
                        }else{
                            echo date("Y");
                        }
                    ?>
                    </option>
                    <option value="9">Sept
                        <?php
                        
                            if($current_month>=9){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                    <option value="10">Oct
                        <?php
                        
                            if($current_month>=10){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                    <option value="11">Nov
                        <?php
                            if($current_month>=11){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                    <option value="12">Dec
                        <?php
                            if($current_month>=12){
                                echo (int) date("Y")+1;
                            }else{
                                echo date("Y");
                            }
                        ?>
                    </option>
                </select>
            </div>

            <div class="form-group">
                <label class="input__label">Tution Fee</label>
                <input id="tution-slider" class="custom-range " type="range" min="0" max="100" value="0" style="width:90%" />
                <span class="font-weight-bold text-primary tutionSpan valueSpan"></span>
            </div>

            <div class="form-group">
                <label class="input__label">Application Fee</label>
                <input id="application-slider" class="custom-range " type="range" min="0" max="50" value="0" style="width:90%" />
                <span class="font-weight-bold text-primary applicationSpan valueSpan"></span>
            </div>

            <hr>
            <div class="form-group text-right">
                <button class="btn btn-primary apply-filter">Apply Filters</button>
            </div>

        </div>

        <div class="col-md-9 search-result" style="">
            <div class='before-ajax text-center'  style="height:100vh">
                <h3>Search By Filters</h3>
            </div>
            <div class='after-ajax'>
                <nav>
                    <div class="nav nav-pills " id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-school-search" role="tab" aria-controls="nav-home" aria-selected="true">Schools</a>
                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-program-search" role="tab" aria-controls="nav-profile" aria-selected="false">Programs</a>
                    </div>
                </nav>
                <div class="tab-content mt-3" id="nav-tabContent">
                    <!-- searched school content -->
                    <div class="tab-pane fade show active" id="nav-school-search" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="row"></div>
                    </div>
                    <!-- searched program content -->
                    <div class="tab-pane fade" id="nav-program-search" role="tabpanel" aria-labelledby="nav-profile-tab"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal" id="selectStudentModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <form action="search.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title">Select Student</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="program_id" name="program_id">
            <input type="hidden" name="page" value="search">
            <select class="custom-select input-style" name="student_id" required>
            <option hidden disabled selected value="">Select..</option>
                <?php
                    $sql = "select id, first_name, last_name from student order by first_name, last_name";
                    $query = $db->query($sql);
                    while($student = $query->fetch_assoc()) {
                        ?><option value=<?php echo $student['id'] ?>><?php echo ucwords($student['first_name']." ".$student['last_name']) ?></option><?php
                    }
                ?>
            </select>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
          <button type="submit" name="select_program" class="btn btn-primary">Apply</button>
        </div>
      </form>
    </div>
  </div>
</div>

