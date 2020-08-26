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
#myModal {
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
#myModal .modal-content {
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

        $sql_f = "select * from features where id=".$school['features'];
        $result_f = mysqli_query($db, $sql_f);
        $feature = mysqli_fetch_array($result_f);

        $total_fees = number_format(($school['tution_fee_yearly']+$school['cost_of_living_yearly']+$school['application_fee']),2);
    ?>

  <!-- main content start -->
<div class="main-content">
  <!-- content -->
  <div class="container-fluid content-top-gap p-0">
    
    <!-- blank block -->
    <div class="card">
      <div class="card-body p-0">
        <div class="col-md-12 px-0">
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
                <?php echo $school['city'].", ".$school['state'].", ".$country['country_name'] ?>
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
                  <h3>Features</h3>
                  <hr>
                  <div class="row feature-cols mb-3">
                    <div class="col" data-toggle="modal" data-target="#workPermit">
                      <i class="fa fa-graduation-cap"></i>
                      <?php
                        if($feature['work_permit']){
                          ?><i class="fa fa-check"></i><?php
                        }else{
                          ?><i class="fa fa-ban"></i><?php
                        }
                      ?>
                      <h6>Post graduation work permit</h6>
                    </div>

                    <div class="col" data-toggle="modal" data-target="#internship">
                      <i class="fa fa-suitcase"></i>
                      <?php
                        if($feature['internship']){
                          ?><i class="fa fa-check"></i><?php
                        }else{
                          ?><i class="fa fa-ban"></i><?php
                        }
                      ?>
                      <h6>Co-op / Internship Participation</h6>
                    </div>
                    <div class="col" data-toggle="modal" data-target="#workStudying">
                      <i class="fa fa-usd"></i>
                      <?php
                        if($feature['work_study']){
                          ?><i class="fa fa-check"></i><?php
                        }else{
                          ?><i class="fa fa-ban"></i><?php
                        }
                      ?>
                      <h6>Work While Studying</h6>  
                    </div>

                    <div class="col" data-toggle="modal" data-target="#offerLetter">
                      <i class="fa fa-envelope"></i>
                      <?php
                        if($feature['offer_letter']){
                          ?><i class="fa fa-check"></i><?php
                        }else{
                          ?><i class="fa fa-ban"></i><?php
                        }
                      ?>
                      <h6>Conditional Offer Letter</h6>  
                    </div>
                    <div class="col" data-toggle="modal" data-target="#accomodation">
                      <i class="fa fa-home"></i>
                      <?php
                        if($feature['accomodation']){
                          ?><i class="fa fa-check"></i><?php
                        }else{
                          ?><i class="fa fa-ban"></i><?php
                        }
                      ?>
                      <h6>Type of Accomodation</h6>
                    </div>
                  </div>
                  <label class="feature-label text-muted">* Information listed is subject to change without notice and should not be construed as a commitment by Express Board.</label>
                  <hr>
            </div>

            <div class="col-md-12 divided-cols">
                <h3>Location</h3>
                <p> <i class="fa fa-map-marker"></i> <?php  echo $school['address'] ?></p>
                <?php 
                  if($school['map']){
                    ?>
                      <div class="col-md-12 mt-4 gmap_canvas">
                        <iframe src="<?php echo $school['map'] ?>" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" ></iframe>
                      </div>
                    <?php
                  }
                ?>
            </div>

            <div class="col-md-12 divided-cols mb-5">
                <h3>Financials</h3>
                <div class="row mx-3 mt-3 pb-2 financials-head">
                    <div class="col-md-6 pl-0 text-left">DESCRIPTION</div>
                    <div class="col-md-6 pr-0 text-right">SUBTOTAL</div>
                </div>
                <div class="row mx-3 mt-3 pb-2 tution-row">
                    <div class="col-md-6 pl-0 text-left">Avg Cost of Tuition/Year</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo $country['currency_symbol']." ".number_format($school['tution_fee_yearly'],2) ?> <?php echo $country['country_currency'] ?></div>
                </div>
                <div class="row mx-3 mt-3 pb-2 tution-row">
                    <div class="col-md-6 pl-0 text-left">Cost of Living/Year</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo $country['currency_symbol']." ".number_format($school['cost_of_living_yearly'],2) ?> <?php echo $country['country_currency'] ?></div>
                </div>
                <div class="row mx-3 mt-3 pb-2 tution-row">
                    <div class="col-md-6 pl-0 text-left">* Application Fee</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo $country['currency_symbol']." ".number_format($school['application_fee'],2) ?> <?php echo $country['country_currency'] ?></div>
                </div>
                <div class="row mx-3 py-3 financials-foot">
                    <div class="col-md-6 pl-0 text-left ">Estimated Total/Year</div>
                    <div class="col-md-6 pr-0 text-right"><?php echo $country['currency_symbol']." ".$total_fees." ".$country['country_currency'] ?></div>
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
                    <a href="program_detail.php?id=<?php echo $program_row['id'] ?>" target="_blank"><h6 class="card-title"><?php echo $program_row['program_name'] ?></h6></a>
                    <div class="row mt-3 py-2 bg-light light-row-2">
                        <div class="col">
                            <label>
                                <i class="fa fa-credit-card" aria-hidden="true"></i>
                                <b>Tution Fee :</b>
                            </label>
                            <span><?php echo $country['currency_symbol']." ".number_format($program_row['tution_fee'],2)." ". $country['country_currency'] ?> </span>
                        </div>
                        <div class="col">
                            <label>
                                <i class="fa fa-money" aria-hidden="true"></i>
                                <b>Application Fee :</b>
                            </label>
                            <span><?php echo $country['currency_symbol']." ".number_format($program_row['application_fee'],2)." ". $country['country_currency']?> </span>
                        </div>
                        <div class="col">
                            <label>
                                <i class="fa fa-signal" aria-hidden="true"></i>
                                <b>Program Level :</b>
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
<!-- workPermit Modal -->
<div class="modal fade feature-modal" id="workPermit" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          <h5>
          <?php
            if($feature['work_permit']){
              $verb = 'Eligible';
              ?><i class="fa fa-check"></i><?php
            }else{
              $verb = 'Ineligible';
              ?><i class="fa fa-ban"></i><?php
            }
          ?>
          <?php echo $verb ?>  for Post Graduation Work Permit</h5>
          <p>The Post-Graduation Work Permit Program (PGWPP) allows students who have graduated from a participating Canadian post-secondary institution to gain valuable Canadian work experience.</p>
        </div>
        
      </div>
    </div>
</div>

<!-- internship Modal -->
<div class="modal fade feature-modal" id="internship" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          <h5>
          <?php
            if($feature['internship']){
              $verb = ' ';
              ?><i class="fa fa-check"></i><?php
            }else{
              $verb = ' No ';
              ?><i class="fa fa-ban"></i><?php
            }
          echo $verb ?>Co-op / Internship Participation</h5>
          <p>Cooperative education (or co-operative education) and internships are methods of combining classroom-based education with practical work experience. A cooperative education experience ("co-op"), provides academic credit for structured job experience. Co-ops are full-time, paid or unpaid positions. Internships may be full-time or part-time, paid or unpaid positions.</p>
        </div>
        
      </div>
    </div>
</div>

<!-- workStudying Modal -->
<div class="modal fade feature-modal" id="workStudying" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          <h5>
          <?php
            if($feature['work_study']){
              $verb = ' ';
              $para = '<p>Full-time undergraduate and post-graduate international students can work anywhere on or off campus without a work permit. The rules around the number of hours a student will be allowed to work may vary based on the country the student chooses to study in. International students are typically able to work up to 20 hours a week.</p>';
              ?><i class="fa fa-check"></i><?php
            }else{
              $verb = ' Ineligible for ';
              $para = '';
              ?><i class="fa fa-ban"></i><?php
            }
          echo $verb ?>Work While Studying </h5>
          <?php echo $para ?>
        </div>
        
      </div>
    </div>
</div>

<!-- offerLetter Modal -->
<div class="modal fade feature-modal" id="offerLetter" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          <h5>
          <?php
            if($feature['offer_letter']){
              $verb = ' ';
              $para = '<p>Even if you do NOT meet our minimum English requirement (IELTS or TOEFL), you still can get conditionally accepted in the program of your choice with the condition of completing our English program prior to starting your chosen program.</p>';
              ?><i class="fa fa-check"></i><?php
            }else{
              $verb = ' ';
              $para = '<p>Conditional Admission is not available for this school</p>';
              ?><i class="fa fa-ban"></i><?php
            }
          echo $verb ?>Conditional Offer Letter  </h5>
          <?php echo $para ?>
        </div>
        
      </div>
    </div>
</div>

<!-- accomodation Modal -->
<div class="modal fade feature-modal" id="accomodation" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          <h5>
          <?php
            if($feature['accomodation']){
              $verb = ' ';
              ?><i class="fa fa-check"></i><?php
            }else{
              $verb = ' ';
              ?><i class="fa fa-ban"></i><?php
            }
          echo $verb ?>Type of Accommodation  </h5>
          <p>
            Students need to plan their accommodations well in advance of their arrival as all accommodation options fill up quickly, well before the start of the semester.</p>
            <br>
            <h6>On-Campus Residence Accommodations</h6>
            <p>On-Campus residence accommodations are provided per discretion by the school.</p>
            <br>
            <h6>Off-Campus Accommodations</h6>
            <p>The local area has a variety of off-campus rental housing options including single homes, duplexes, apartments and rooms for rent. Students wishing to live off-campus need to research availability on their own and should arrive well before the start of term to do so.</p>
            <br>
            <h6>Homestay</h6>
            <p>There are a wide variety of homestay options available, and our partners do their best to match students and hosts according to their interests and preferences. Homestay hosts include single people, young couples with children and pets, and older couples. All homestay accommodations have been inspected, and all adults in the home have completed a required criminal reference check.</p>
          
        </div>
        
      </div>
    </div>
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