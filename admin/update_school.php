<?php 
    include_once './submit_functions.php';
    include_once './update_functions.php';
    session_start(); 
    if(!isset($_SESSION['email'])){ 
        header("location:login.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Update School/University </title>

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
        <li class="breadcrumb-item"><a href="schools.php">Schools</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update School</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <?php
      $sql="select * from schools where id='".$_GET['id']."'";
      $result = mysqli_query($db, $sql);
      $school   = mysqli_fetch_array($result);

      $sql_f = "select * from features where id=".$school['features'];
      $result_f = mysqli_query($db, $sql_f);
      $feature = mysqli_fetch_array($result_f);
    ?>
    <div class="card">
      <div class="card-body">
        <h3 class="card__title mb-3">Update Schools/ Universities</h3>
        <form action="update_school.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="idd" value="<?php echo $school['id'] ?>">
            <input type="hidden" name="feature_id" value="<?php echo $school['features'] ?>">
            <div class="form-group">
                <label class="input__label">School Name</label>
                <input type="text" class="form-control input-style" name="school_name" placeholder="School Name" value="<?php echo $school['school_name'] ?>" required="required">
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-4">
                  <label class="input__label">Founded</label>
                  <input type="number" class="form-control input-style" name="founded" placeholder="e.g. 1918" value="<?php echo $school['founded'] ?>" required="required">
              </div>
              <div class="form-group col-md-4">
                  <label class="input__label">Type</label>
                <input type="text" class="form-control input-style" name="type" placeholder="e.g. Public or University etc." value="<?php echo $school['type'] ?>" required="required">
              </div>
              <div class="form-group col-md-4">
                  <label class="input__label">DLI Number</label>
                  <input type="text" class="form-control input-style" name="dli" value="<?php echo $school['dli'] ?>" placeholder="e.g. O242632228347">
              </div>

            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="input__label">Total Students</label>
                    <input type="number" class="form-control input-style" name="total_students" placeholder="Total students" value="<?php echo $school['total_students'] ?>" required="required">
                </div>
                <div class="form-group col-md-6">
                    <label class="input__label">Intrested Students</label>
                    <input type="number" class="form-control input-style" name="int_students" placeholder="Intrested students" value="<?php echo $school['intrested_students'] ?>" required="required">
                </div>
            </div> 
            <div class="form-group">
                <label class="input__label">Address</label>
                <textarea class="form-control input-style" name="address" row=2><?php echo $school['address'] ?></textarea>
            </div>    
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="input__label">City</label>
                    <input type="text" class="form-control input-style" name="city" placeholder="City" value="<?php echo $school['city'] ?>" required="required">
                </div>
                <div class="form-group col-md-6">
                    <label class="input__label">Country</label>
                    <!-- <input type="text" class="form-control input-style" name="country" placeholder="Country" value="<?php echo $school['country'] ?>" required="required"> -->
                    <select name="country" class="custom-select input-style" required>
                      <option value="null">Select Country</option>
                      <?php
                      $country = "SELECT * from `countries`";
                      $country_result = $db->query($country);
                      while($country_row = $country_result->fetch_assoc()) {
                        if($country_row['id'] == $school['country']){
                          ?>
                          <option value="<?php echo $country_row['id'] ?>" selected><?php echo $country_row['country_name'] ?></option>
                          <?php
                        }
                        else{
                          ?>
                          <option value="<?php echo $country_row['id'] ?>"><?php echo $country_row['country_name'] ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                  <label class="input__label">Tution Fee (Yearly)</label>
                  <input type="number" class="form-control input-style" name="tution_fee" placeholder="Yearly Tution Fee" value="<?php echo $school['tution_fee_yearly'] ?>" required="required">
              </div>
              <div class="form-group col-md-4">
                  <label class="input__label">Cost of Living (Yearly)</label>
                <input type="number" class="form-control input-style" name="living_cost" placeholder="Yearly Cost of Living" value="<?php echo $school['cost_of_living_yearly'] ?>" required="required">
              </div>
              <div class="form-group col-md-4">
                  <label class="input__label">Application Fee</label>
                <input type="number" class="form-control input-style" name="application_fee" placeholder="Application Fee" value="<?php echo $school['application_fee'] ?>" required="required">
              </div>
            </div>
            <div class="form-group">
                <label class="input__label">About School</label>
                <textarea class="form-control input-style" name="about" rows=4><?php echo $school['about'] ?></textarea>
            </div> 

            <div class="form-group">
              <label class="input__label">Features of School</label>
              <div class="row px-5">
                <div class="form-check check-remember check-me-out col-sm-6 mt-1 ">
                  <?php 
                    if($feature['work_permit']){
                      ?><input class="form-check-input checkbox" type="checkbox" id="workPermit" name="workPermit" checked><?php
                    }else{
                      ?><input class="form-check-input checkbox" type="checkbox" id="workPermit" name="workPermit"><?php
                    }
                  ?>
                  <label class="form-check-label checkmark" for="workPermit" style="font-size:14px">
                      Work Permit
                  </label>
                </div>
                
                <div class="form-check check-remember check-me-out col-sm-6 mt-1">
                <?php 
                    if($feature['internship']){
                      ?><input class="form-check-input checkbox" type="checkbox" id="internship" name="internship" checked><?php
                    }else{
                      ?><input class="form-check-input checkbox" type="checkbox" id="internship" name="internship"><?php
                    }
                ?>
                  <label class="form-check-label checkmark" for="internship" style="font-size:14px">
                      Internship Participation
                  </label>
                </div>

                <div class="form-check check-remember check-me-out col-sm-6 mt-1">
                  <?php
                    if($feature['work_study']){
                      ?><input class="form-check-input checkbox" type="checkbox" id="workStudy" name="workStudy" checked><?php
                    }else{
                      ?><input class="form-check-input checkbox" type="checkbox" id="workStudy" name="workStudy"><?php
                    }
                  ?>
                    <label class="form-check-label checkmark" for="workStudy" style="font-size:14px">
                      Work while Study
                  </label>
                </div>

                <div class="form-check check-remember check-me-out col-sm-6 mt-1">
                  <?php
                    if($feature['offer_letter']){
                      ?><input class="form-check-input checkbox" type="checkbox" id="offerLetter" name="offerLetter" checked><?php
                    }else{
                      ?><input class="form-check-input checkbox" type="checkbox" id="offerLetter" name="offerLetter"><?php
                    }
                  ?>
                  <label class="form-check-label checkmark" for="offerLetter" style="font-size:14px">
                      Offer Letter
                  </label>
                </div>

                <div class="form-check check-remember check-me-out col-sm-6 mt-1">
                  <?php
                    if($feature['accomodation']){
                      ?><input class="form-check-input checkbox" type="checkbox" id="accomodation" name="accomodation" checked><?php
                    }else{
                      ?><input class="form-check-input checkbox" type="checkbox" id="accomodation" name="accomodation"><?php
                    }
                  ?>
                  <label class="form-check-label checkmark" for="accomodation" style="font-size:14px">
                      Accomodation
                  </label>
                </div>
                    </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="input__label">School Logo</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="school_logo" >
                    <label class="custom-file-label">Choose School logo image...</label>
                </div>
                <input type="hidden" value="<?php echo $school['school_logo'] ?>" name="old_logo" />
              </div>
              <div class="form-group col-md-6">
                <label class="input__label">Cover Image of School</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="cover_img">
                    <label class="custom-file-label">Choose Cover image of School...</label>
                </div>
                <input type="hidden" value="<?php echo $school['cover_img'] ?>" name="old_cover"/>
              </div>

            </div>
              <div class="form-group">
                <label class="input__label">Gallery Images <span class="text-muted">(Atleast select 4 images)</span></label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" name="gallery_img[]" multiple >
                    <label class="custom-file-label">Choose 4 Gallery Images</label>
                </div>
                <input type="hidden" value="<?php echo $school['gallery_img'] ?>" name="old_gallery"/>
              </div>


            <div class="form-group text-right">
              <button type="submit" name="update_school" class="btn btn-primary btn-style">Update</button>
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