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

  <title> Search Program/School-University </title>

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
        <li class="breadcrumb-item active" aria-current="page">Search Programs & Schools</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Schools & Universities</h5>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-item nav-link active" id="nav-search-tab" data-toggle="tab" href="#nav-search" role="tab" aria-controls="nav-search" aria-selected="true">Search</a>
                <a class="nav-item nav-link" id="nav-school-tab" data-toggle="tab" href="#nav-school" role="tab" aria-controls="nav-home" aria-selected="true">Schools</a>
                <a class="nav-item nav-link" id="nav-program-tab" data-toggle="tab" href="#nav-program" role="tab" aria-controls="nav-profile" aria-selected="false">Programs</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <?php include_once './search_list.php' ?>
            <?php include_once './school_list.php' ?>
            <?php include_once './program_list.php' ?>
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