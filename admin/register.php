<?php 
    include_once './submit_functions.php'; 
    session_start(); 
    if(isset($_SESSION['email'])){ 
        header("location:index.php");
    }
?>
<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>Collective Admin Panel a Flat Bootstrap Responsive Website Template | Signup </title>

  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style-liberty.css">
    <link rel="stylesheet" href="assets/css/style.css">

  <!-- google fonts -->
  <link href="//fonts.googleapis.com/css?family=Nunito:300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body class="sidebar-menu-collapsed">
  <section>

    <!-- content -->
    <div class="">
        <!-- Register form -->
        <section class="col-md-6 offset-3 py-md-5 py-3">
            <div class="card card_border p-md-4">
                <div class="card-body">
                    <!-- form -->
                    <form action="register.php" method="POST">
                        <div class="register__header text-center mb-lg-5 mb-4">
                            <div class="col-md-8 offset-md-2">
                                <img src="assets/images/logo_express.png" style="width:65% ; margin-bottom:15px">
                            </div>
                            <h3 class="register__title mb-2"> Signup</h3>
                            <p>Create your account here, and continue </p>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputName" class="input__label">First Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control   input-style"
                                    id="exampleInputName" placeholder="Legal First Name" required="required" name="first_name" autofocus>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputName" class="input__label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control   input-style"
                                    id="exampleInputName" placeholder="Legal Last Name" required="required"  name="last_name">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1" class="input__label">Email address <span class="text-danger">*</span></label>
                                <input type="email" class="form-control input-style"
                                    id="exampleInputEmail1" aria-describedby="emailHelp" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="exampleInputPassword1" class="input__label">Password <span class="text-danger">*</span></label>
                                <input type="password" class="form-control input-style"
                                    id="exampleInputPassword1" placeholder="Password" name="password" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="input__label">Company Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-style" name="company_name" placeholder="Company Name" required="required">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="input__label">Website</label>
                                <input type="text" class="form-control input-style" name="website" placeholder="Website Address">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="input__label">Facebook Page Name</label>
                                <input type="text" class="form-control input-style" name="facebook" placeholder="Facebook Page name/link" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="input__label">Main source of student <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-style" name="student_source" required placeholder="">
                            </div>
                        </div>

                        
                        <div class="form-group mb-3">
                            <label class="input__label">Address <span class="text-danger">*</span></label>
                            <textarea class="form-control inout-style" name="address" placeholder="Address" required></textarea>
                        </div>
                        

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label class="input__label">City <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-style" placeholder="City" name="city" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="input__label">State <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-style" placeholder="State" name="state" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label class="input__label">Postal Code <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-style" name="zip" placeholder="Postal code" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="input__label">Contact Number <span class="text-danger">*</span></label>
                                <input type="number" class="form-control input-style" name="contact_number" required placeholder="Contact Number" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="input__label">Whatsapp Id</label>
                                <input type="number" class="form-control input-style" name="whatsapp" placeholder="WhatsApp number">
                            </div>
                        </div>

                        <div class="form-row mt-3">
                            <div class="form-group col-md-6">
                                <label class="input__label">When did you begin recruiting students?</label>
                                <input type="number" class="form-control input-style" name="begin_recruitment" placeholder="" >
                            </div>
                            <div class="form-group col-md-6">
                                <label class="input__label">What services do you provide to your clients? <span class="text-danger">*</span></label>
                                <input type="text" class="form-control input-style" name="services" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="input__label">What educational associations or groups does your organization belong to? <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-style" name="association" required>
                        </div>

                        <div class="form-group">
                            <label class="input__label">Where do you recruit from? <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-style" name="recruit_from" required>
                        </div>

                        <div class="form-group">
                            <label class="input__label">Approximately how many students do you send abroad per year?</label>
                            <input type="text" class="form-control input-style" name="approx_students">
                        </div>

                        <div class="form-group">
                            <label class="input__label">What type of marketing methods do you undertake? <span class="text-danger">*</span></label>
                            <input type="text" class="form-control input-style" name="marketting" required>
                        </div>

                        <div class="form-group">
                            <label class="input__label">Please provide an estimate of the number of students you will refer to Express Abroad. <span class="text-danger">*</span></label>
                            <input type="number" class="form-control input-style" name="no_of_students" required>
                        </div>

                        <div class="form-check check-remember check-me-out col-sm-12 mt-3 ">
                            <input class="form-check-input checkbox" type="checkbox" id="referred" name="referred">
                            <label class="form-check-label checkmark" for="referred">
                                Has anyone from Express Abroad helped or referred you?
                            </label>
                        </div>

                        <div class="form-check check-remember check-me-out mt-3">
                            <input type="checkbox" class="form-check-input checkbox" id="exampleCheck1">
                            <label class="form-check-label checkmark" for="exampleCheck1">I agree to the
                                <a href="#terms">Terms of service</a> and <a href="#privacy">Privacy policy</a> </label>
                        </div>
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <button type="submit" class="btn bg-red btn-style mt-4" name="register">Create Account</button>
                            <p class="signup mt-4">Already have an account? <a href="login.php"
                                    class="signuplink">Login </a>
                            </p>
                        </div>
                    </form>
                    <!-- //form -->
                    <p class="backtohome mt-4"><a href="../index.html" class="back"><i class="fa fa-chevron-left"
                                aria-hidden="true"></i>Back to Home </a></p>
                </div>
            </div>
        </section>

    </div>
    <!-- //content -->

</section>


</body>

</html>