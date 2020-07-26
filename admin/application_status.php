<?php 
    // include_once './submit_functions.php';
    include_once './update_functions.php';
    session_start(); 
    if(!isset($_SESSION['email'])){ 
        header("location:login.php");
    }
    if (!isset($_GET['application_id'])){
        header('location:applications.php');
    }
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Update Application Status </title>

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
        <li class="breadcrumb-item"><a href="programs.php">Application</a></li>
        <li class="breadcrumb-item active" aria-current="page">Update Application</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <?php
      $sql="select 
            ap.*, concat(s.first_name,' ',s.last_name) as name, 
            p.program_name, sl.school_name
        from applications ap
        left join student s on ap.student_id = s.id
        left join programs p on ap.program_id = p.id
        left join schools sl on p.school_id = sl.id
        where ap.id=".$_GET['application_id'];

      $result = mysqli_query($db, $sql);
      $application   = mysqli_fetch_array($result);
    ?>
    <div class="card">
      <div class="card-body">
        <h3 class="card__title mb-3">Application of <?php echo ucwords($application['name']) ?></h3>
        <hr>
        <table class="w-100 my-3">
            <tr>
                <th width="40%">School Name</th>
                <th width="60%">Program Name</th>
            <tr>
            <tr>
                <td><?php echo $application['school_name'] ?></td>
                <td><?php echo $application['program_name'] ?></td>
            </tr>
        </table>
        <hr>
        <form action="application_status.php?application_id=<?php echo $_GET['application_id'] ?>" method="post">
            <input type="hidden" name="idd" value="<?php echo $application['id'] ?>">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label class="input__label">Application Status</label>
                    <select class="form-control input-style"  name="status" id="status">
                        <option value="<?php echo $application['status'] ?>"><?php echo $application['status'] ?></option>
                        <option value="processing">Processing</option>
                        <option value="cancelled">Cancelled</option>
                        <option value="accepted">Accepted</option>
                        <option value="not paid">Not Paid</option>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4 ">
                    <div class="form-check check-remember check-me-out mt-3">
                    <?php 
                        if($application['applied']){
                            ?>
                                <input class="form-check-input checkbox" type="checkbox" id="gridCheck" name="applied" checked>
                            <?php
                        }
                        else{
                            ?>
                                <input class="form-check-input checkbox" type="checkbox" id="gridCheck" name="applied">
                            <?php
                        }
                    ?>
                        <label class="form-check-label checkmark" for="gridCheck">
                            Applied
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4 ">
                    <div class="form-check check-remember check-me-out mt-3">
                    <?php 
                        if($application['submitted']){
                            ?>
                                <input class="form-check-input checkbox" type="checkbox" id="gridCheck1" name="submitted" checked>
                            <?php
                        }
                        else{
                            ?>
                                <input class="form-check-input checkbox" type="checkbox" id="gridCheck1" name="submitted">
                            <?php
                        }
                    ?>
                        <label class="form-check-label checkmark" for="gridCheck1">
                            Submitted
                        </label>
                    </div>
                </div>
            </div>

            <div class="form-group">
              <button type="submit" name="update_application" class="btn btn-primary btn-style">Update</button>
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