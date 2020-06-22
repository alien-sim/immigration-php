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
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Profile</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->

    <!-- blank block -->
    <?php
      $sql="select * from admin where id='".$_SESSION['user_id']."'";
      $result   = mysqli_query($db, $sql);
      $agent    = mysqli_fetch_array($result);
    ?>
    <div class="card card_border p-4">
      <h3 class="card__title">My Profile</h3>
      <div class="form-row">
          <div class="form-group col-md-6">
              <label class="input__label">Username</label>
              <input type="text" class="form-control input-style" name="username" placeholder="Username" value="<?php echo $agent['username'] ?>" required="required" disabled>
          </div>
          <div class="form-group col-md-6">
              <label class="input__label">Email</label>
              <input type="text" class="form-control input-style" name="username" placeholder="Username" value="<?php echo $agent['email'] ?>" required="required"  disabled>
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