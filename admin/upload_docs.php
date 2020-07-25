<?php 
    include_once './submit_functions.php'; 
    session_start(); 
    if(!isset($_SESSION['email'])){ 
        header("location:login.php");
    }
    // if(!isset($_GET['student_id'])){
    //     header("location:student.php");
    // }
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
        <li class="breadcrumb-item">Student</a></li>
        <li class="breadcrumb-item active" aria-current="page">Upload Docs</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <div class="card">
      <div class="card-body">
        <h4>Upload Documents</h4>
        <form action="upload_docs.php?student_id=<?php echo $_GET['student_id'] ?>" method="post" enctype="multipart/form-data">
          <input type="hidden" value=<?php echo $_GET['student_id'] ?> name="student_id"  >
            <div class="form-row mt-3">
                <div class="form-group col-md-5">
                    <label class="input__label">Document Type<span class="text-danger">*</span></label>
                    <select class="custom-select" name="doc_type[]">
                        <option> Select </option>
                        <option>Grade 10 Transcript</option>
                        <option>Grade 12 Transcript</option>
                        <option>Undergraduate Transcript</option>
                        <option>Postgraduate Transcript</option>
                        <option>Others</option>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label class="input__label">Doc Attachment</label>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="doc[]" id="validatedCustomFiledoc" required>
                        <label class="custom-file-label" for="validatedCustomFiledoc">Choose document attachment...</label>
                    </div>
                </div>
            </div>
            <div class="w-100 more-docs-div"></div>
            <div class="form-row mt-3">
              <button type="button" class="btn btn-primary add-doc">Add More</button>
              <button class="btn btn-primary ml-2" type="submit" name="upload_docs">Upload Docs</button>
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