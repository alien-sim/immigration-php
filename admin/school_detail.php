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

  <title>University Details </title>

  <!-- CSS files import -->
  <?php 
    include_once './header_css.php'; 
  ?>
</head>
<style>
    /* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: black;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
  text-align:center
}

    /* The Close Button */
.close {
  color: white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #999;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}
.mySlides img{max-height:500px; max-width:100%; margin:auto}
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(51, 51, 51, 0.8);
}

</style>

<body class="sidebar-menu-collapsed">
  <div class="se-pre-con"></div>
<section>
  <!-- sidebar/header include -->
  <?php
    include './sidebar.php';
    include './header.php';
  ?>
    
    <?php
        $sql="select * from schools where id='".$_GET['id']."'";
        $result = mysqli_query($db, $sql);
        $school   = mysqli_fetch_array($result);

        $gallery = explode(",", $school['gallery']);

        $sql_c = "select * from countries where id=".$school['country'];
        $result_c = mysqli_query($db, $sql_c);
        $country = mysqli_fetch_array($result_c);

        $total_fees = number_format(($school['tution_fee_yearly']+$school['cost_of_living_yearly']+$school['application_fee']),2);
    ?>

  <!-- main content start -->
<div class="main-content">
  <!-- content -->
  <div class="container-fluid content-top-gap">
    <!-- breadcrumbs -->
    <nav aria-label="breadcrumb" class="mb-4">
      <ol class="breadcrumb my-breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo $school['school_name'] ?></li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- blank block -->
    <div class="card">
      <div class="card-body py-0">
        <div class="row">
            <div class="w-100 cover-image" style="background-image:url('../media/cover_img/<?php echo $school['cover_img'] ?>')"></div>
            <div class="col-md-12 school-gallery position-absolute">
                <div class="row">
                    <div class="col-md-6 text-center">
                        <div class="img-common">
                          <?php 
                          if(count($gallery)>3){
                            ?>
                            <div class="img-div mr-5" style="background-image:url('../media/gallery/<?php echo $gallery[0] ?>')" onclick="openModal();currentSlide(0)"></div>
                            <div class="img-div ml-5" style="background-image:url('../media/gallery/<?php echo $gallery[1] ?>')" onclick="openModal();currentSlide(1)"></div>
                            <?php
                          }
                          ?>
                        </div>
                    </div>
                    <div class="col-md-6 text-center">
                        <div class="img-common">
                        <?php 
                          if(count($gallery)>3){
                            ?>
                            <div class="img-div mr-5" style="background-image:url('../media/gallery/<?php echo $gallery[2] ?>')" onclick="openModal();currentSlide(2)"></div>
                            <div class="img-div ml-5" style="background-image:url('../media/gallery/<?php echo $gallery[3] ?>')" onclick="openModal();currentSlide(3)"></div>
                            <?php
                          }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100 text-center school-intro">
                <img src="../media/logos/<?php echo $school['school_logo'] ?>" class="school-logo" >
                <h4><?php echo $school['school_name'] ?></h4>
                <img src="../media/flags/<?php echo $country['country_flag'] ?>" class="country-flag">
                <?php echo $school['city'] ?>
                <?php
                  if($school['dli']){
                    ?>
                    <div class="col-md-12 text-center my-2 text-muted">
                              <h6 style="font-size:14px">DLI# : <?php echo $school['dli'] ?></h6>
                    </div>
                    <?php
                  }
                ?>
                <div class="row mt-3 py-3 bg-light light-row">
                    <div class="col">
                        <label>
                            <i class="fa fa-certificate" aria-hidden="true"></i>
                            Founded:
                        </label>
                        <span><?php echo $school['founded'] ?> </span>
                    </div>
                    <div class="col">
                        <label>
                            <i class="fa fa-university" aria-hidden="true"></i>
                            Type:
                        </label>
                        <span><?php echo $school['type'] ?> </span>
                    </div>
                    <div class="col">
                        <label>
                            <i class="fa fa-group" aria-hidden="true"></i>
                            Total Students:
                        </label>
                        <span><?php echo $school['total_students'] ?>+ </span>
                    </div>
                </div>
            </div>

            <div class="col-md-12 divided-cols">
                <h3>About</h3>
                <p><?php  echo $school['about'] ?></p>
            </div>

            <div class="col-md-12 divided-cols">
                <h3>Location</h3>
                <p> <i class="fa fa-map-marker"></i> <?php  echo $school['address'] ?></p>
                <div class="col-md-12 gmap_canvas">
                <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2796.2803904488196!2d-73.57544908456839!3d45.50443397910148!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4cc91a465e73b34d%3A0xdcbfab498dcc40a5!2sMcGill%20University%20School%20of%20Continuing%20Studies!5e0!3m2!1sen!2sin!4v1592836907315!5m2!1sen!2sin" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe> -->
                </div>
            </div>

            <div class="col-md-12 divided-cols mb-5">
                <h3>Financials</h3>
                <div class="row mx-3 mt-3 pb-2 financials-head">
                    <div class="col-md-6 pl-0 text-left">DESCRIPTION</div>
                    <div class="col-md-6 pr-0 text-right">SUBTOTAL</div>
                </div>
                <div class="row mx-3 mt-3 pb-2 tution-row">
                    <div class="col-md-6 pl-0 text-left">Avg Cost of Tuition/Year</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo number_format($school['tution_fee_yearly'],2) ?> <?php echo $country['country_currency'] ?></div>
                </div>
                <div class="row mx-3 mt-3 pb-2 tution-row">
                    <div class="col-md-6 pl-0 text-left">Cost of Living/Year</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo number_format($school['cost_of_living_yearly'],2) ?> <?php echo $country['country_currency'] ?></div>
                </div>
                <div class="row mx-3 mt-3 pb-2 tution-row">
                    <div class="col-md-6 pl-0 text-left">* Application Fee</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo number_format($school['application_fee'],2) ?> <?php echo $country['country_currency'] ?></div>
                </div>
                <div class="row mx-3 py-3 financials-foot">
                    <div class="col-md-6 pl-0 text-left ">Estimated Total/Year</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo $total_fees ?> <?php echo $country['country_currency'] ?></div>
                </div>
            </div>
        </div>
        
      </div>
    </div>
    <!-- blank block -->
    <h3 class="program-heading my-3">Featured Programs</h3>
    <?php
        $progarm = "SELECT * from `programs` where school_id=".$school['id'];
        $progarm_result = $db->query($progarm);
        while($program_row = $progarm_result->fetch_assoc()) {
            ?>
            <div class="card text-center mb-2">
                <div class="card-body">
                    <a href="#"><h6 class="card-title"><?php echo $program_row['program_name'] ?></h6></a>
                    <div class="row mt-3 py-2 bg-light light-row-2">
                        <div class="col">
                            <label>
                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                Tution Fee:
                            </label>
                            <span><?php echo $program_row['tution_fee'] ?> </span>
                        </div>
                        <div class="col">
                            <label>
                                <i class="fa fa-money" aria-hidden="true"></i>
                                Application Fee:
                            </label>
                            <span><?php echo $program_row['application_fee'] ?> </span>
                        </div>
                        <div class="col">
                            <label>
                                <i class="fa fa-signal" aria-hidden="true"></i>
                                Program Level:
                            </label>
                            <span><?php echo $program_row['program_level'] ?> </span>
                        </div>
                    
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
  </div>
  <!-- //content -->
</div>
<!-- Gallery modal -->
<div id="myModal" class="modal">
    <span class="close cursor" onclick="closeModal()">&times;</span>
    <div class="modal-content">
        <?php
            for($x=0;$x<count($gallery);++$x){
                ?>
                    <div class="mySlides">
                        <img src="../media/gallery/<?php echo $gallery[$x] ?>">
                    </div>
                <?php
            }
        ?>

        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
        <a class="next" onclick="plusSlides(1)">&#10095;</a>
    </div>
</div>

<!-- Gallery modal end -->
<!-- main content end-->
</section>
  <!-- footer include -->
  <?php
    include './footer.php';
  ?>
<script>
function openModal() {
  document.getElementById("myModal").style.display = "block";
}

function closeModal() {
  document.getElementById("myModal").style.display = "none";
}

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    if (n == slides.length) {slideIndex = 0}
    if (n < 0) {slideIndex = slides.length-1}
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slides[slideIndex].style.display = "block";
}
</script>
</body>

</html>