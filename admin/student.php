<?php 
    session_start(); 
    if(!isset($_SESSION['email']) and (!isset($_SESSION['is_superadmin'])) ){ 
        header("location:login.php");
    }
    include_once './submit_functions.php'; 
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Student </title>

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
        <li class="breadcrumb-item active" aria-current="page">Students</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- table block -->
    <a class="btn btn-primary btn-style btn-sm" href="add_student.php" style="color:#fff">Add Student</a>
    <div class="card card_border p-4">
      <h3 class="card__title position-absolute">All Students Info</h3>
      <div class="table-responsive">
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th width="15%">Name</th>
              <th width="10%">Apply Date</th>
              <th width="25%">Program</th>
              <th width="25%">School</th>
              <?php 
                if($_SESSION['is_superadmin']){
                  ?><th width="10%">Agent</th><?php
                }
              ?>
              <th width="10%">Education</th>
              <th width="5%">Program Info</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if($_SESSION['is_superadmin']){
                $student = "SELECT * from student";
              }else{
                $student = "SELECT * from student where agent_id = ".$_SESSION['user_id'];
              }
              $student_result = $db->query($student);
              while($student_row = $student_result->fetch_assoc()) {
                if(!($student_row['selected_program'])){
                  $school_name = "-";
                  $program_name = "-";
                }else{
                  $program = get_program($student_row['selected_program']);
                  $school_name = get_school($program[1]);
                  $program_name = $program[0];
                }
                $level_code = get_education_level($student_row['level_education'], "code");
                ?>
                  <tr>
                    <td><?php echo ucfirst($student_row['first_name'])." ".ucfirst($student_row['last_name']) ?>  </td>
                    <td><?php echo get_date_format($student_row['created']) ?></td>
                    <td><?php echo $program_name ?></td>
                    <td><?php echo $school_name ?></td>
                    <?php 
                      if($_SESSION['is_superadmin']){
                        ?><td><?php echo get_agent_email($student_row['agent_id']) ?> </td><?php
                      }
                    ?>
                    <td><span class="badge badge-primary" title="Completed <?php echo $student_row['level_education'] ?>"><?php echo $level_code ?></span></td>
                    <td><a href="choose_program.php?student_id=<?php echo $student_row['id'] ?>" ><i class="fa fa-external-link" aria-hidden="true"></i></a> </td>
                  </tr>
                <?php
              }
            ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- table end -->
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