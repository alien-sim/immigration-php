<?php
    $city_array = [];
    $country = "SELECT city from `schools` group by city";
    $country_result = $db->query($country);
    // echo $country_result;
    while($city_row = $country_result->fetch_assoc()){
        // $city_split = explode(",", $city_row['city']);
        // for($i=0; $i<count($city_split); ++$i){
        // }
        array_push($city_array, $city_row['city']);
    }
    $city_array = array_unique($city_array);
?>

<div class="tab-pane fade show active my-4 row" id="nav-search" role="tabpanel" aria-labelledby="nav-search-tab">
    <div class="row px-3">
        <div class="col-md-3">

            <div class="form-group">
                <label class="input__label">Country</label>
                <select name="country" class="w-100 selectpicker my-select country-select" multiple required>
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
                <select name="city" class="selectpicker my-select w-100 city-select" multiple required>
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
                <label class="input__label">Tution Fee</label>
                <input id="tution-slider" class="custom-range " type="range" min="0" max="100" value="0" style="width:90%" />
                <span class="font-weight-bold text-primary tutionSpan valueSpan"></span>
            </div>

            <div class="form-group">
                <label class="input__label">Application Fee</label>
                <input id="application-slider" class="custom-range " type="range" min="0" max="50" value="0" style="width:90%" />
                <span class="font-weight-bold text-primary applicationSpan valueSpan"></span>
            </div>

            <div class="form-group">
                <label>Program Level</label>
                <select class="selectpicker my-select w-100 level-select" multiple name="program_level">
                    <option value="English as Second Language (ESL)">English as Second Language (ESL)</option>
                    <option value="1-Year Post Secondary Diploma">1-Year Post Secondary Diploma</option>
                    <option value="2-Year Undegraduate Diploma">2 Year Undegraduate Diploma</option>
                    <option value="3-Year Bachelor's Degree">3-Year Bachelor's Degree</option>
                    <option value="3-Year Undergraduate Advance Diploma">3-Year Undergraduate Advance Diploma</option>
                    <option value="4-Year Bachelor's Degree">4-Year Bachelor's Degree</option>
                    <option value="Postgraduate Certificate / Master's Degree">Postgraduate Certificate / Master's Degree</option>
                </select>

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

