<?php 
    include_once './submit_functions.php'; 
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

  <title>Programs </title>

  <!-- CSS files import -->
  <?php 
    include_once './header_css.php'; 
  ?>
</head>
<?php
    $sql="select * from programs where id='".$_GET['id']."'";
    $result = mysqli_query($db, $sql);
    $program   = mysqli_fetch_array($result);
    
    $sql1="select * from schools where id='".$program['school_id']."'";
    $result1 = mysqli_query($db, $sql1);
    $school   = mysqli_fetch_array($result1);

    $sql_c = "select * from countries where id=".$school['country'];
    $result_c = mysqli_query($db, $sql_c);
    $country = mysqli_fetch_array($result_c);
?>

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
        <li class="breadcrumb-item active" aria-current="page"><?php echo $program['program_name'] ?></li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <div class="card program-card-cover">
      <div class="card-body p-0">
        <div class="col-md-12 px-0">
            <div class="w-100 program-cover text-center" style="background-image:url('../media/cover_img/<?php echo $school['cover_img'] ?>')">
                <div class="col-md-12 px-0">
                    <img src="../media/logos/<?php echo $school['school_logo'] ?>" />
                    <h3><label><?php echo $program['program_name'] ?></label></h3>
                    <h3><a href="school_detail.php?id=<?php echo $school['id'] ?>"><?php echo $school['school_name'] ?> </a></h3>
                </div>
            </div>
        </div>
      </div>
    </div>
    <div class="row program-details">
        
        <div class="col-md-8 div-common program2">
            <div class="col-md-12 bg-light">
                <h3><?php echo $program['program_name'] ?></h3>
                <h6 class="text-muted font-italic" style="font-size:14px">
                    <i class="fa fa-map-marker"></i> <?php echo $school['city'].", ".$country['country_name'] ?>
                </h6>
                <hr>
                <h6 class="program-head">Program Description</h6>
                <p><?php echo $program['description'] ?></p>
                <h6 class="program-head mt-3">Addmission Requirments</h6>
                <?php echo $program['additional_requirements'] ?>
                <h6 class="program-head mt-3">Other Fees</h6>
                <?php echo $program['other_fees'] ?>

                <h5 class="note text-info mt-4">* Note: Additional fees may apply</h5>
                <h5 class="note text-info">** All fees are subject to change without notice</h5>
            </div>
        </div>
        <div class="col-md-4 div-common program1">
            <div class="col-md-12 bg-light">
                <div class="w-100 text-center text-primary py-2">
                    <i class="fa fa-graduation-cap"></i>
                </div>
                <table width="100%">
                    <tr>
                        <td width="8%" class="text-info"><i class="fa fa-signal" aria-hidden="true"></i></td>
                        <td width="32%" class="text-info"><b>Program Level :</b></td>
                        <td width="60%"><?php echo $program['program_level'] ?></td>
                    </tr>
                    <tr>
                        <td width="8%" class="text-info"><i class="fa fa-calendar" aria-hidden="true"></i></td>
                        <td width="32%" class="text-info"><b>Program Length :</b></td>
                        <td width="60%"><?php echo $program['length_program'] ?></td>
                    </tr>
                    <tr>
                        <td width="8%" class="text-info"><i class="fa fa-money" aria-hidden="true"></i></td>
                        <td width="32%" class="text-info"><b>Application fee :</b></td>
                        <td width="60%"><?php echo $country['currency_symbol']." ".number_format($program['application_fee'],2)." ".$country['country_currency'] ?></td>
                    </tr>
                    <tr>
                        <td width="8%"></td>
                        <td width="32%" class="text-info"><b>Tution fee :</b></td>
                        <td width="60%"><?php echo $country['currency_symbol']." ".number_format($program['tution_fee'],2)." ".$country['country_currency'] ?></td>
                    </tr>
                </table>
            <hr>
            <?php
              if($program['intakes']){
                ?><h5 class="text-info text-center">Intakes</h5><?php

                $current_year = date("Y");
                $next_year = (int)$current_year+1;
                $months = explode(',', $program['intakes']);
                $current_month = date("m");
                foreach($months as $mon ){
                  if($current_month > $mon){
                    ?>
                      <h6 class="month-intake"><span class="badge badge-primary"><?php echo date("F", mktime(0, 0, 0, $mon, 10))." ". $next_year ?></span></h6>
                    <?php
                  }else{
                    ?>
                      <h6 class="month-intake"><span class="badge badge-primary"><?php echo date("F", mktime(0, 0, 0, $mon, 10))." ". $current_year ?></span></h6>
                    <?php
                  }
                }
              }
            ?>

            <hr>
              <div class="text-center">
                <button id="program-<?php echo $program['id'] ?>" data-toggle="modal" data-target="#selectStudentModalProgram" attr="<?php echo $program['id'] ?>" class="select-student-program btn btn-outline-dark">Select Student</button>
              </div>

            </div>
        </div>
    </div>
    <!-- blank block -->
  </div>
  <!-- //content -->
</div>
<!-- main content end-->

<!-- Select Student Modal -->
<div class="modal fade bd-example-modal" id="selectStudentModalProgram" tabindex="-1" role="dialog" aria-hidden="true">
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
            <input type="hidden" id="program_id" name="program_id" value="<?php echo $_GET['id'] ?>">
            <input type="hidden" name="page" value="search">
            <select class="custom-select input-style" name="student_id" required>
            <option disabled selected value="">Select..</option>
                <?php
                    $sql_student = "select s.id, s.first_name, s.last_name from student s 
                    inner join program_exam_details ped on s.exam_type_name = ped.exam_type 
                    inner join exam_details ed on s.id = ed.student_id 
                    where 
                        ped.program_id = ".$_GET['id']." and
                        ed.reading >= ped.reading and 
                        ed.speaking >= ped.speaking and 
                        ed.writing  >= ped.writing and 
                        ed.listening >= ped.listening  
                    order by 
                        s.first_name, s.last_name";

                        // echo $sql_student;
                    $query_student = $db->query($sql_student);
                    if(mysqli_num_rows($query_student)) { 
                      while($student = $query_student->fetch_assoc()) {
                          ?><option value=<?php echo $student['id'] ?>><?php echo ucwords($student['first_name']." ".$student['last_name']) ?></option><?php
                      }
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


</section>
  <!-- footer include -->
  <?php
    include './footer.php';
  ?>
</body>

</html>