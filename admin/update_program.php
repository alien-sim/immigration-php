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
            
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="input__label">Level of Program</label>
                <select class="custom-select input-style" name="level_program" required>
                    <option value="<?php echo $program['program_level'] ?>" selected><?php echo $program['program_level'] ?> </option>
                    <option value="English as Second Language (ESL)">English as Second Language (ESL)</option>
                    <option value="1-Year Post Secondary Diploma">1-Year Post Secondary Diploma</option>
                    <option value="2-Year Undegraduate Diploma">2 Year Undegraduate Diploma</option>
                    <option value="3-Year Bachelor's Degree">3-Year Bachelor's Degree</option>
                    <option value="3-Year Undergraduate Advance Diploma">3-Year Undergraduate Advance Diploma</option>
                    <option value="4-Year Bachelor's Degree">4-Year Bachelor's Degree</option>
                    <option value="Postgraduate Certificate / Master's Degree">Postgraduate Certificate / Master's Degree</option>
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