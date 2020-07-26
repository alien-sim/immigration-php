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

  <title>Update Agent </title>

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
        <li class="breadcrumb-item"><a href="agents.php">Agents</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Agent</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <?php
      $sql="select * from admin where id='".$_GET['id']."'";
      $result = mysqli_query($db, $sql);
      $agent   = mysqli_fetch_array($result);
    ?>
    <div class="card">
      <div class="card-body">
        <h3 class="card__title mb-3">Agents</h3>
        <form action="update_agent.php" method="post">
            <input type="hidden" name="idd" value="<?php echo $agent['id'] ?>">
            <div class="form-group">
                <label for="inputEmail4" class="input__label" name="email">Email</label>
                <input type="email" class="form-control input-style" id="inputEmail4" name="email" placeholder="Email" value="<?php echo $agent['email'] ?>"  required="required">
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-6">
                  <label class="input__label">Username</label>
                  <input type="text" class="form-control input-style" name="username" placeholder="Username" value="<?php echo $agent['username'] ?> " required="required">
              </div>
              <div class="form-group col-md-6">
                  <label for="inputPassword4" class="input__label">Password</label>
                  <input type="text" class="form-control input-style" id="inputPassword4" name="password" placeholder="Password" value="<?php echo $agent['password'] ?>" required="required">
              </div>
            </div>

            <div class="form-check check-remember check-me-out">
            <?php 
                if($agent['is_superadmin']){
                    ?>
                        <input class="form-check-input checkbox" type="checkbox" id="gridCheck" name="is_admin" checked>
                    <?php
                }
                else{
                    ?>
                        <input class="form-check-input checkbox" type="checkbox" id="gridCheck" name="is_admin">
                    <?php
                }
            ?>
                <label class="form-check-label checkmark" for="gridCheck">
                    Is Superadmin
                </label>
            </div>     

            <div class="form-group text-right">
              <button type="submit" name="update_agent" class="btn btn-primary btn-style">Update</button>
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