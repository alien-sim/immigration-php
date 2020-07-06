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

  <title>Collective Admin Panel a Flat Bootstrap Responsive Website Template | Login </title>

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
        <!-- login form -->
        <section class="login-form py-md-5 py-3">
            <div class="card card_border p-md-4">
                <div class="card-body">
                    <!-- form -->
                    <form action="login.php" method="POST">
                        <div class="login__header text-center mb-lg-5 mb-4">
                            <h3 class="login__title mb-2"> Login</h3>
                            <p>Welcome back, login to continue</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" class="input__label">Username</label>
                            <input type="text" class="form-control login_text_field_bg input-style"
                                id="exampleInputEmail1" name="username" aria-describedby="emailHelp" placeholder="" required=""
                                autofocus>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1" class="input__label">Password</label>
                            <input type="password" class="form-control login_text_field_bg input-style"
                                id="exampleInputPassword1" name="password" placeholder="" required>
                        </div>
                        <!-- <div class="form-check check-remember check-me-out">
                            <input type="checkbox" class="form-check-input checkbox" id="exampleCheck1">
                            <label class="form-check-label checkmark" for="exampleCheck1">Remember
                                me</label>
                        </div> -->
                        <div class="d-flex align-items-center flex-wrap justify-content-between">
                            <button type="submit" name="login" class="btn bg-red btn-style mt-4">Login now</button>
                            <!-- <p class="signup mt-4">Don’t have an account? <a href="register.html"
                                    class="signuplink">Sign
                                    up</a></p> -->
                        </div>
                    </form>
                    <!-- //form -->
                    <!-- <p class="backtohome mt-4"><a href="index.php" class="back"><i class="fa fa-chevron-left"
                                aria-hidden="true"></i>Back to Home </a></p> -->
                </div>
            </div>
        </section>

    </div>
    <!-- //content -->

</section>


</body>

</html>