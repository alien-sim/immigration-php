<?php 
    include_once './submit_functions.php'; 
    session_start(); 
    if(!isset($_SESSION['email'])){ 
        header("location:login.php");
    }
    $programs = [];
    if (isset($_GET['student_id'])){
      $programs = get_student_programs($_GET['student_id']);
    }
    // echo $programs;
    // print_r($programs)
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Express Abroad </title>

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
        <li class="breadcrumb-item"><a href="index.php">Student</a></li>
        <li class="breadcrumb-item active" aria-current="page">Program relatives to Student</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <div class="card">
      <div class="card-body">
      <div class="row">
        <?php  
          // echo count($programs);
         foreach($programs as $p){
           $country_info = get_country_name($p['country'], true);
           ?>
            <div class="col-md-6 select-program">
              <div class="col-md-12 py-3 border">
                <form action="choose_program.php?student_id=<?php echo $_GET['student_id'] ?>" method="post">
                  <input type="hidden" name="student_id" value=<?php echo $_GET['student_id'] ?> >
                  <input type="hidden" name="program_id" value=<?php echo $p['id'] ?> >
                  <button type="submit" class="btn btn-primary btn-sm" name="select_program">Select</button>
                </form>
              <h5><a href="program_detail.php?id=<?php echo $p['id'] ?>" target="_blank"><?php echo $p['program_name'] ?></a></h5>
              <h6><a href="school_detail.php?id=<?php echo $p['sid'] ?>" target="_blank"><?php echo $p['school_name'] ." - ". $country_info[0]  ?> </a></h6>
              <hr>
              <table width="100%">
                <tr>
                  <td>Application Fee</td>
                  <td>Tution Fee</td>
                  <td>Cost of Living</td>
                </tr>
                <tr>
                  <td><?php echo $country_info[1]." ".number_format($p['application_fee'],2) ?></td>
                  <td><?php echo $country_info[1]." ".number_format($p['tution_fee'],2) ?></td>
                  <td><?php echo $country_info[1]." ".number_format($p['cost_of_living'],2) ?></td>
                </tr>
              </table>
            </div>
            </div>
           <?php
         }
        ?>
        </div>
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