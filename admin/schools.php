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

  <title>Schools & Universities </title>

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
        <li class="breadcrumb-item active" aria-current="page">Schools & Universities</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- Alert messages -->
    <?php
        if(isset($_GET['success'])){
            ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>SUCCESS!</strong> <?php echo $_GET['success'] ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        elseif (isset($_GET['error'])) {
            ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>ERROR!</strong> <?php echo $_GET['error'] ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
    ?>
    <!-- table block -->
    <button class="btn btn-primary btn-style btn-sm" data-toggle="modal" data-target="#addSchoolModal">Add School</button>
    <div class="card card_border p-4">
      <h3 class="card__title position-absolute">All Schools & Universities</h3>
      <div class="table-responsive">
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th>School Name</th>
              <th>City </th>
              <th>Country</th>
              <th>Currency</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $schools = "SELECT * from `schools`";
              $school_result = $db->query($schools);
              while($school_row = $school_result->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $school_row['school_name'] ?></td>
                    <td><?php echo $school_row['city'] ?></td>
                    <td><?php echo $school_row['country'] ?></td>
                    <td><?php echo $school_row['currency'] ?></td>
                    <td>
                        
                        <a href="update_school.php?page=schools&id=<?php echo $school_row['id'] ?>" class="btn btn-link" onclick="return confirm('Are you sure to Update School?')"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                        <a href="delete.php?page=schools&id=<?php echo $school_row['id'] ?>" class="btn btn-link" onclick="return confirm('Are you sure to delete School?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
                    </td>
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

<!-- Add Modal -->
<div class="modal fade bd-example-modal-lg" id="addSchoolModal" tabindex="-1" role="dialog" aria-labelledby="addSchoolModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <form action="schools.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="addSchoolModalLabel">Add New School</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">  
            <div class="form-group">
                <label class="input__label">School Name</label>
                <input type="text" class="form-control input-style" name="school_name" placeholder="School Name" required="required">
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-4">
                  <label class="input__label">Founded</label>
                  <input type="number" class="form-control input-style" name="founded" placeholder="e.g. 1918" required="required">
              </div>
              <div class="form-group col-md-4">
                  <label class="input__label">Type</label>
                <input type="text" class="form-control input-style" name="type" placeholder="e.g. Public or University etc." required="required">
              </div>
              <div class="form-group col-md-4">
                  <label class="input__label">Currency</label>
                <input type="text" class="form-control input-style" name="currency" placeholder="e.g. $" required="required">
              </div>

            </div> 

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="input__label">Total Students</label>
                    <input type="number" class="form-control input-style" name="total_students" placeholder="Total students" required="required">
                </div>
                <div class="form-group col-md-6">
                    <label class="input__label">Intrested Students</label>
                    <input type="number" class="form-control input-style" name="int_students" placeholder="Intrested students" required="required">
                </div>
            </div> 
            <div class="form-group">
                <label class="input__label">Address</label>
                <textarea class="form-control input-style" name="address" row=2></textarea>
            </div>    
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label class="input__label">City</label>
                    <input type="text" class="form-control input-style" name="city" placeholder="City" required="required">
                </div>
                <div class="form-group col-md-6">
                    <label class="input__label">Country</label>
                    <input type="text" class="form-control input-style" name="country" placeholder="Country" required="required">
                </div>
            </div>

            <div class="form-row">
              <div class="form-group col-md-4">
                  <label class="input__label">Tution Fee (Yearly)</label>
                  <input type="number" class="form-control input-style" name="tution_fee" placeholder="Yearly Tution Fee" required="required">
              </div>
              <div class="form-group col-md-4">
                  <label class="input__label">Cost of Living (Yearly)</label>
                <input type="number" class="form-control input-style" name="living_cost" placeholder="Yearly Cost of Living" required="required">
              </div>
              <div class="form-group col-md-4">
                  <label class="input__label">Application Fee</label>
                <input type="number" class="form-control input-style" name="application_fee" placeholder="Application Fee" required="required">
              </div>
            </div>
            <div class="form-group">
                <label class="input__label">Abount School</label>
                <textarea class="form-control input-style" name="about" row=4></textarea>
            </div>   
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
          <button type="submit" name="add_school" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- main content end-->
</section>

  <!-- footer include -->
  <?php
    include './footer.php';
  ?>
</body>

</html>