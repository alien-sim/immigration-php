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

  <title>Applications </title>

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
        <li class="breadcrumb-item active" aria-current="page">Applications</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- table block -->
    <!-- <a class="btn btn-primary btn-style btn-sm" href="add_student.php" style="color:#fff">Add Student</a> -->
    <div class="card card_border p-4">
      <h3 class="card__title position-absolute">All Applications</h3>
      <div class="table-responsive">
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
                <th>Action</th>
                <th>Apply date</th>
                <th>Application Id</th>
                <th>Student Id</th>
                <th width="12%">Name</th>
                <th width="18%">Program</th>
                <th width="18%">School</th>
                <!-- <th>Start date</th> -->
                <?php 
                    if($_SESSION['is_superadmin']){
                    ?><th width="8%">Recruitment Partner</th><?php
                    }
                ?>
                <th width="8%">status</th>
                <th width="5%">Requirements</th>
                <th width="5%">Current Requirements</th>
            </tr>
          </thead>
          <tbody>
            <?php
              if($_SESSION['is_superadmin']){
                $app_sql = 'select 
                        ap.*, concat(s.first_name," ",s.last_name) as name, 
                        p.program_name, sl.school_name,
                        a.email, c.country_flag
                    from applications ap
                    left join student s on ap.student_id = s.id
                    left join admin a on s.agent_id = a.id
                    left join programs p on ap.program_id = p.id
                    left join schools sl on p.school_id = sl.id
                    left join countries c on sl.country = c.id';
              }else{
                $app_sql = "select 
                        ap.*, concat(s.first_name,' ',s.last_name) as name, 
                        p.program_name, sl.school_name,
                        a.email, a.id as admin_id, c.country_flag
                    from applications ap
                    left join student s on ap.student_id = s.id
                    left join admin a on s.agent_id = a.id
                    left join programs p on ap.program_id = p.id
                    left join schools sl on p.school_id = sl.id
                    left join countries c on sl.country = c.id
                    where a.id=".$_SESSION['id'];
              }
              $result = $db->query($app_sql);
              while($app = $result->fetch_assoc()) {
                
                ?>
                  <tr>
                  <td><a href="application_status.php?application_id=<?php echo $app['id'] ?>" title="Change Status of application"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>
                    <td><?php echo get_date_format($app['apply_date']) ?></td>
                    <td><?php echo $app['id'] ?></td>
                    <td><?php echo $app['student_id'] ?></td>
                    <td><?php echo ucwords($app['name']) ?></td>
                    
                    <td><?php echo $app['program_name'] ?></td>
                    <td><img src="../media/flags/<?php echo $app['country_flag'] ?>" width="25px" class="mr-2"> <?php echo $app['school_name'] ?></td>
                    <?php 
                        if($_SESSION['is_superadmin']){
                        ?><td><?php echo $app['email'] ?></th><?php
                        }
                    ?>
                    <td>
                      <span class="badge <?php echo $app['status'] ?> "> 
                        <?php 
                          if($app['status'] == 'not paid'){
                            ?>
                              <a href="stripe-integration/" target="_blank" style="color:inherit"><i class="fa fa-money" aria-hidden="true"></i>    
                            <?php
                              echo ucwords($app['status']);
                            ?></a><?php
                          }else{
                            echo ucwords($app['status']);
                          }
                        ?>
                      </span>
                      </td>
                    <td>
                      <span class="badge <?php echo $app['requirements'] ?>">
                        <?php echo $app['requirements'] ?>
                      </span>
                    </td>
                    <td>
                      <?php
                        if($app['current_stage']){
                          ?>
                            <span class="badge badge-grey">
                              <?php echo $app['current_stage'] ?>
                            </span>
                          <?php
                        }
                      ?>
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


<!-- main content end-->
</section>
  <!-- footer include -->
  <?php
    include './footer.php';
  ?>
</body>

</html>