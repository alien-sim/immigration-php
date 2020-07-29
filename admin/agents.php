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

  <title>Agents </title>

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
        <li class="breadcrumb-item active" aria-current="page">Agents</li>
      </ol>
    </nav>
    <!-- //breadcrumbs -->
    <!-- table block -->
    <button class="btn btn-primary btn-style btn-sm" data-toggle="modal" data-target="#addAgentModal">Add</button>
    <div class="card card_border p-4">
      <h3 class="card__title position-absolute">All Agents Info</h3>
      <div class="table-responsive">
        <table id="example" class="display" style="width:100%">
          <thead>
            <tr>
              <th>Username</th>
              <th>Email</th>
              <th>Activate/Deactivate</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $agent = "SELECT * from `admin` where id != ".$_SESSION['user_id'];
              $agent_result = $db->query($agent);
              while($agent_row = $agent_result->fetch_assoc()) {
                ?>
                  <tr>
                    <td><?php echo $agent_row['username'] ?>  </td>
                    <td><?php echo $agent_row['email'] ?></td>
                    <td>
                      <?php
                        if($agent_row['is_active']){
                          ?><a href="activate_deactivate.php?id=<?php echo $agent_row['id'] ?>" class="badge badge-warning">Dectivate</a><?php
                        }else{
                          ?><a href="activate_deactivate.php?id=<?php echo $agent_row['id'] ?>" class="badge badge-success">Activate</a><?php
                        }
                      ?>
                    </td>
                    <td>
						<a href="update_agent.php?id=<?php echo $agent_row['id'] ?>" class="btn btn-link"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						<a href="delete.php?page=agents&id=<?php echo $agent_row['id'] ?>" class="btn btn-link" onclick="return confirm('Are you sure to delete School?')"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
<div class="modal fade bd-example-modal-lg" id="addAgentModal" tabindex="-1" role="dialog" aria-labelledby="addAgentModalLabel" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <form action="agents.php" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="addAgentModalLabel">Add New Agent</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          
            
            <div class="form-group">
                <label for="inputEmail4" class="input__label" name="email">Email</label>
                <input type="email" class="form-control input-style" id="inputEmail4" name="email" placeholder="Email"  required="required">
            </div>
            
            <div class="form-row">
              <div class="form-group col-md-6">
                  <label class="input__label">Username</label>
                  <input type="text" class="form-control input-style" name="username" placeholder="Username" required="required">
              </div>
              <div class="form-group col-md-6">
                  <label for="inputPassword4" class="input__label">Password</label>
                  <input type="password" class="form-control input-style" id="inputPassword4" name="password" placeholder="Password" required="required">
              </div>
            </div>

            <div class="form-check check-remember check-me-out">
                <input class="form-check-input checkbox" type="checkbox" id="gridCheck" name="is_admin">
                <label class="form-check-label checkmark" for="gridCheck">
                    Is Superadmin
                </label>
            </div>
            
          
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Close</button>
          <button type="submit" name="add_agent" class="btn btn-primary">Save changes</button>
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