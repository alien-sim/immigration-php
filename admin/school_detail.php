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

  <title>University Details </title>

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
    
    <?php
        $sql="select * from schools where id='".$_GET['id']."'";
        $result = mysqli_query($db, $sql);
        $school   = mysqli_fetch_array($result);

        $sql_c = "select * from countries where id=".$school['country'];
        $result_c = mysqli_query($db, $sql_c);
        $country = mysqli_fetch_array($result_c);

        $total_fees = number_format(($school['tution_fee_yearly']+$school['cost_of_living_yearly']+$school['application_fee']),2);
    ?>

  <!-- main content start -->
<div class="main-content">
  <!-- content -->
  <div class="container-fluid content-top-gap">
    <!-- breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $school['school_name'] ?></li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <div class="card">
      <div class="card-body py-0">
        <div class="row">
            <div class="w-100 cover-image" style="background-image:url('../media/cover_img/<?php echo $school['cover_img'] ?>')"></div>
            <div class="w-100 text-center school-intro">
                <img src="../media/logos/<?php echo $school['school_logo'] ?>" class="school-logo" >
                <h4><?php echo $school['school_name'] ?></h4>
                <img src="../media/flags/<?php echo $country['country_flag'] ?>" class="country-flag">
                <?php echo $school['city'] ?>
                <div class="row mt-3 py-3 bg-light light-row">
                    <div class="col">
                        <label>
                            <i class="fa fa-certificate" aria-hidden="true"></i>
                            Founded:
                        </label>
                        <span><?php echo $school['founded'] ?> </span>
                    </div>
                    <div class="col">
                        <label>
                            <i class="fa fa-university" aria-hidden="true"></i>
                            Type:
                        </label>
                        <span><?php echo $school['type'] ?> </span>
                    </div>
                    <div class="col">
                        <label>
                            <i class="fa fa-group" aria-hidden="true"></i>
                            Total Students:
                        </label>
                        <span><?php echo $school['total_students'] ?>+ </span>
                    </div>
                </div>
            </div>

            <div class="col-md-12 divided-cols">
                <h3>About</h3>
                <p><?php  echo $school['about'] ?></p>
            </div>

            <div class="col-md-12 divided-cols">
                <h3>Location</h3>
                <p> <i class="fa fa-map-marker"></i>  <?php  echo $school['address'] ?></p>
            </div>

            <div class="col-md-12 divided-cols mb-5">
                <h3>Financials</h3>
                <div class="row mx-3 mt-3 pb-2 financials-head">
                    <div class="col-md-6 pl-0 text-left">DESCRIPTION</div>
                    <div class="col-md-6 pr-0 text-right">SUBTOTAL</div>
                </div>
                <div class="row mx-3 mt-3 pb-2 tution-row">
                    <div class="col-md-6 pl-0 text-left">Avg Cost of Tuition/Year</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo number_format($school['tution_fee_yearly'],2) ?> <?php echo $school['currency'] ?></div>
                </div>
                <div class="row mx-3 mt-3 pb-2 tution-row">
                    <div class="col-md-6 pl-0 text-left">Cost of Living/Year</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo number_format($school['cost_of_living_yearly'],2) ?> <?php echo $school['currency'] ?></div>
                </div>
                <div class="row mx-3 mt-3 pb-2 tution-row">
                    <div class="col-md-6 pl-0 text-left">* Application Fee</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo number_format($school['application_fee'],2) ?> <?php echo $school['currency'] ?></div>
                </div>
                <div class="row mx-3 py-3 financials-foot">
                    <div class="col-md-6 pl-0 text-left ">Estimated Total/Year</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo $total_fees ?> <?php echo $school['currency'] ?></div>
                </div>
            </div>
        </div>
        
      </div>
    </div>
    <!-- blank block -->
    <h3 class="program-heading my-3">Featured Programs</h3>
    <?php
        $progarm = "SELECT * from `programs` where school_id=".$school['id'];
        $progarm_result = $db->query($progarm);
        while($program_row = $progarm_result->fetch_assoc()) {
            ?>
            <div class="card text-center mb-2">
                <div class="card-body">
                    <a href="#"><h6 class="card-title"><?php echo $program_row['program_name'] ?></h6></a>
                    <div class="row mt-3 py-2 bg-light light-row-2">
                        <div class="col">
                            <label>
                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                Tution Fee:
                            </label>
                            <span><?php echo $program_row['tution_fee'] ?> </span>
                        </div>
                        <div class="col">
                            <label>
                                <i class="fa fa-money" aria-hidden="true"></i>
                                Application Fee:
                            </label>
                            <span><?php echo $program_row['application_fee'] ?> </span>
                        </div>
                        <div class="col">
                            <label>
                                <i class="fa fa-signal" aria-hidden="true"></i>
                                Program Level:
                            </label>
                            <span><?php echo $program_row['program_level'] ?> </span>
                        </div>
                    
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
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