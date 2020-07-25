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

  <title>Progarms </title>

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
        <li class="breadcrumb-item active" aria-current="page">Programs</li>
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
    <button class="btn btn-primary btn-style btn-sm" data-toggle="modal" data-target="#addProgramModal">Add Progarm</button>
    <div class="card card_border p-4">
      <h3 class="card__title position-absolute">All Programs Info</h3>
      <div class="table-responsive">
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Program Name</th>
              <th>Length Of Program</th>
              <th>Program Level</th>
              <th width="10%">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $progarm = "SELECT * from `programs`";
              $progarm_result = $db->query($progarm);
              while($progarm_row = $progarm_result->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $progarm_row['program_name'] ?></td>
                    <td><?php echo $progarm_row['length_program'] ?></td>
                    <td><?php echo $progarm_row['program_level'] ?></td>
                    <td>
                        <a href="update_program.php?id=<?php echo $progarm_row['id'] ?>" class="btn btn-link"><i class="fa fa-pencil" aria-hidden="true"></i></a>

                        <a href="delete.php?page=programs&id=<?php echo $progarm_row['id'] ?>" class="btn btn-link" onclick="return confirm('Are you sure to delete Program?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="addProgramModal" tabindex="-1" role="dialog" aria-labelledby="addProgramModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <form action="programs.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="addProgramModalLabel">Add New Program</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            
            <div class="form-group">
                <label class="input__label">Program Name</label>
                <input type="text" class="form-control input-style" name="program_name" placeholder="Program Name" required="required">
            </div>

            <div class="form-group">
                <label class="input__label">School Name</label>
                <select class="custom-select input-style" name="school_id" required>
                    <option value="">Select School</option>
                    <?php
                        $school = "SELECT id,school_name from `schools`";
                        $school_result = $db->query($school);
                        while($school_row = $school_result->fetch_assoc()) {
                        ?>
                            <option value=<?php echo $school_row['id'] ?> > <?php echo $school_row['school_name'] ?> </option>
                        <?php
                        }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label class="input__label">Program Description</label>
                <textarea class="form-control input-style" name="description" row=2></textarea>
            </div> 

            <div class="form-row">
              
              <div class="form-group col-md-6">
                <label class="input__label">Exam Type</label>
                <select class="form-control input-style" name="exam_type" id="exam_type">
                  <option value="no_test">No Test</option>
                  <option value="ielts">IELTS</option>
                  <option value="toefl">TOEFL</option>
                  <option value="duolingo">Duolingo English Test</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label class="input__label">Total Score</label>
                <input type="number" class="form-control input-style" name="total_score" placeholder="Total Score" min=0 max=10>
              </div>

              <div class="form-group col-md-3">
                <label class="input__label">Listening Score</label>
                <input type="number" class="form-control input-style" name="listening" placeholder="Listening Score" min=0 max=10>
              </div>
              <div class="form-group col-md-3">
                <label class="input__label">Speaking Score</label>
                <input type="number" class="form-control input-style" name="speaking" placeholder="Speaking Score" min=0 max=10>
              </div>
              <div class="form-group col-md-3">
                <label class="input__label">Writing Score</label>
                <input type="number" class="form-control input-style" name="writing" placeholder="Writing Score" min=0 max=10>
              </div>
              <div class="form-group col-md-3">
                <label class="input__label">Reading Score</label>
                <input type="number" class="form-control input-style" name="reading" placeholder="Reading Score" min=0 max=10>
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="input__label">Tution Fee</label>
                <input type="number" class="form-control input-style" name="tution_fee" placeholder="Tution Fee" required="required">
              </div>
              <div class="form-group col-md-6">
                <label class="input__label">Application Fee</label>
                <input type="number" class="form-control input-style" name="application_fee" placeholder="Application Fee" required="required">
              </div>
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-6">
                <label class="input__label">Level of Program</label>
                <select class="custom-select input-style" name="level_program" required>
                  <option value="English as Second Language (ESL)">English as Second Language (ESL)</option>
                  <option value=null>Select Level of education</option>
                  <?php
                    $program_level = get_program_levels();
                    for($i=0 ; $i < count($program_level) ; ++$i){
                      ?>
                        <option value=<?php echo $program_level[$i]['level'] ?> ><?php echo $program_level[$i]['level'] ?></option>
                      <?php
                    }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                    <label class="input__label">Length of Program</label>
                    <input type="text" class="form-control input-style" name="length_program" placeholder="length of program">
              </div>

            </div>  
            <div class="form-group">
                <label class="input__label">Admission Requirements</label>
                <textarea class="form-control input-style" name="admission_req" row=2></textarea>
            </div>  
            <div class="form-group">
                <label class="input__label">Other Fees</label>
                <textarea class="form-control input-style" name="other_fees" row=2></textarea>
            </div>          
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
          <button type="submit" name="add_program" class="btn btn-primary">Save changes</button>
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