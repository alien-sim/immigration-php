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

  <title>Agents </title>

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
        <li class="breadcrumb-item" aria-current="page"><a href="agents.php">Agents</a></li>
        <li class="breadcrumb-item active" >Agent Details</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <?php
        $sql = "select * from admin a 
            left join agent_info ai on a.id = ai.admin_id
            where a.id=".$_GET['agent_id'];
        $result = mysqli_query($db, $sql);
        $agent   = mysqli_fetch_array($result);
    ?>
    
    <div class="card card_border p-4">
      <h3 class="card__title"><?php echo ucwords($agent['first_name']." ".$agent['last_name']) ?></h3>
      <div class="table-responsive mt-3">
        <table class="table bordered table-striped">
          <tr>
            <td>Comapny Name</td>
            <td><?php echo $agent['company'] ?></td>
          </tr>
          <tr>
            <td>Website</td>
            <td><?php echo $agent['website'] ?></td>
          </tr>
          <tr>
            <td>Facebook Page</td>
            <td><?php echo $agent['facebook'] ?></td>
          </tr>
          <tr>
            <td>Address</td>
            <td><?php echo $agent['address'] ?></td>
          </tr>
          <tr>
            <td>City</td>
            <td><?php echo $agent['city'] ?></td>
          </tr>
          <tr>
            <td>State</td>
            <td><?php echo $agent['state'] ?></td>
          </tr>
          <tr>
            <td>Zip Code</td>
            <td><?php echo $agent['zip'] ?></td>
          </tr>
          <tr>
            <td>Contact Number</td>
            <td><?php echo $agent['contact_number'] ?></td>
          </tr>
          <tr>
            <td>Whatsapp Number</td>
            <td><?php echo $agent['whatsapp'] ?></td>
          </tr>
          <tr>
            <td>Main Source of student</td>
            <td><?php echo $agent['student_source'] ?></td>
          </tr>
          <tr>
            <td>What services provided to client</td>
            <td><?php echo $agent['services'] ?></td>
          </tr>
          <tr>
            <td>When did begin recruiting students</td>
            <td><?php echo $agent['begin_recruitment'] ?></td>
          </tr>
          <tr>
            <td>Where do you recruit from?</td>
            <td><?php echo $agent['recruit_from'] ?></td>
          </tr>
          <tr>
            <td>Approximately how many students do you send abroad per year?</td>
            <td><?php echo $agent['approx_student'] ?></td>
          </tr>
          <tr>
            <td>What type of marketing methods do you undertake?</td>
            <td><?php echo $agent['marketing'] ?></td>
          </tr>
          <tr>
            <td>Please provide an estimate of the number of students you will refer to Express Abroad.</td>
            <td><?php echo $agent['no_of_students'] ?></td>
          </tr>
          <tr>
            <td>Has anyone from Express Abroad helped or referred you?</td>
            <td><?php echo $agent['referred'] == 1 ? 'Yes':'No' ?></td>
          </tr>
          <tr>
            <td></td>
            <td></td>
          </tr>
        </table>
      </div>

      <div class="form-group text-center">
        <?php
          if($agent['is_active']){
            ?><a href="activate_deactivate.php?id=<?php echo $_GET['agent_id'] ?>" class="btn btn-warning">Dectivate</a><?php
          }else{
            ?><a href="activate_deactivate.php?id=<?php echo $_GET['agent_id'] ?>" class="btn btn-success">Activate</a><?php
          }
        ?>
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