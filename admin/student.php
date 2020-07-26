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

  <title>Students </title>

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
              <th>Student Id</th>
              <th width="15%">Name</th>
              <th width="20%">Student Email</th>
              <th>Nationality</th>
              <?php 
                if($_SESSION['is_superadmin']){
                  ?><th width="10%">Recruitment Partner</th><?php
                }
              ?>
              <th width="10%">Education</th>
              <th width="15%">Applications</th>
              <th width="10%">Program Info</th>
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
                $level_code = get_education_level($student_row['level_education'], "code");
                $application_details = get_student_application_details($student_row['id']);
                // echo $application_details['added'];
                ?>
                  <tr>
                    <td><?php echo $student_row['id'] ?></td>
                    <td><?php echo ucfirst($student_row['first_name'])." ".ucfirst($student_row['last_name']) ?>  </td>
                    
                    <td><?php echo $student_row['email'] ?></td>
                    <td>India</td>
                    <?php 
                      if($_SESSION['is_superadmin']){
                        ?><td><?php echo get_agent_email($student_row['agent_id']) ?> </td><?php
                      }
                    ?>
                    <td><span class="badge badge-primary" title="Completed <?php echo $student_row['level_education'] ?>"><?php echo $level_code ?></span></td>
                    <td>
                      <?php
                        if($application_details['added']){
                          ?><label class="w-100 mb-1 badge badge-grey"><?php echo $application_details['added']." added" ?></label><?php
                        }
                        if($application_details['applied']){
                          ?><label class="w-100 mb-1 badge badge-secondary"><?php echo $application_details['applied']." applied" ?></label><?php
                        }
                        if($application_details['submitted']){
                          ?><label class="w-100 mb-1 badge badge-info"><?php echo $application_details['submitted']." submitted" ?></label><?php
                        }
                        if($application_details['cancelled']){
                          ?><label class="w-100 mb-1 badge badge-warning"><?php echo $application_details['cancelled']." cancelled" ?></label><?php
                        }
                        if($application_details['accepted']){
                          ?><label class="w-100 mb-1 badge badge-success"><?php echo $application_details['accepted']." accepted" ?></label><?php
                        }
                      ?>
                    </td>
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