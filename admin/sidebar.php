
<!-- sidebar menu start -->
  <div class="sidebar-menu sticky-sidebar-menu">

    <!-- logo start -->
    <!-- <div class="logo">
      <h1><a href="index.php">Express Aboard</a></h1>
    </div> -->

  <!-- if logo is image enable this -->
    <!-- image logo -->
    <div class="logo bg-white">
      <a href="index.php">
        <img src="assets/images/logo_express.png" alt="Your logo" title="Your logo" class="img-fluid" style="width:90%;" />
      </a>
    </div>
    <!-- //image logo -->

    <div class="logo-icon text-center">
      <a href="index.php" title="logo"><img src="assets/images/logo.png" alt="logo-icon"> </a>
    </div>
    <!-- //logo end -->

    <div class="sidebar-menu-inner">

      <!-- sidebar nav start -->
      <ul class="nav nav-pills nav-stacked custom-nav" style="border-top:1px solid rgba(255,255,255,0.56)">
        <li><a href="index.php"><i class="fa fa-tachometer"></i><span> Dashboard</span></a></li>
        <?php
          if($_SESSION['is_superadmin']){
            ?>
              <li><a href="agents.php"><i class="fa fa-user"></i> <span>Agents</span></a></li>
              <li><a href="programs.php"><i class="fa fa-graduation-cap"></i> <span>Programs</span></a></li>
              <li><a href="schools.php"><i class="fa fa-university"></i> <span>Schools</span></a></li>

            <?php
          }
        ?>
        <li><a href="student.php"><i class="fa fa-user-circle"></i><span> Student </span></a></li>
        <li><a href="applications.php"><i class="fa fa-address-card"></i><span> Applications </span></a></li>
        <li><a href="search.php"><i class="fa fa-search"></i><span> Search </span></a></li>
      </ul>
      <!-- //sidebar nav end -->
      <!-- toggle button start -->
      <a class="toggle-btn">
        <i class="fa fa-angle-double-left menu-collapsed__left"><span>Collapse Sidebar</span></i>
        <i class="fa fa-angle-double-right menu-collapsed__right"></i>
      </a>
      <!-- //toggle button end -->
    </div>
  </div>
  <!-- //sidebar menu end