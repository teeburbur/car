<?php //page name ?>
<?php $page = 'Admin Change Password'; ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>
<body id="page-top">
<?php
  //if update button clicked
  if(isset($_POST['update'])){
    //select from users query
    $stmt = $conn->prepare("SELECT * FROM users WHERE id =? LIMIT 1");
    //execute the query where the ID is equal to the current logged in user ID
    $stmt->execute(array($_SESSION['user']['id']));
    //fetch the results
    $rows = $stmt->fetch();

    $valid = 1;
    // Getting form input values into variables
    $old_pass   = $_POST['old_password'];
    $new_pass   = $_POST['new_password'];
    $con_pass   = $_POST['confirm_password'];

    //checking if the input values are empty
    if(empty($old_pass)){
      $valid = 0;
      $errors[] = "Old Password can not be empty";
    }else
     //if old password is matched with the database password then show the error message
    if(md5($old_pass) != $rows['password']){
      $valid = 0;
      $errors[] = "Old Password is not valid";
    }
    if(empty($new_pass)){
      $valid = 0;
      $errors[] = "New Password can not be empty";
    }else
    //if password is less than 5 then show error
    if(strlen($new_pass) < 5) {
      $valid = 0;
      $errors[] = 'Password must contains atleast 5 characters';
    }
    if(empty($con_pass)){
      $valid = 0;
      $errors[] = "Confirm Password can not be empty";
    }
     //if password and confirm password is not equal then show the error message
    if( $new_pass != $con_pass ) {
      $valid = 0;
      $errors[] = 'New Password and Confirm Password are not the same<br>';
    }

    //if everything is fine then proceed 
    if($valid == 1){
      //store the new password into the variable
      $password = $new_pass;
      //update the password query
      $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
      //execute the update password query where ID is equal to the current logged in user ID and encrypt the password using MD5 algorithm
      $run  = $stmt->execute(array(md5($password),$_SESSION['user']['id']));
      //if query is executed
      if($run){
        //store the success message 
        $_SESSION['success'] = "Admin Passwsord has been Updated successfully !";}
      }
  }
?>
    <!-- Page Wrapper -->
    <div id="wrapper">
      <?php //include the navigation bar ?>
      <?php include_once 'includes/nav.php'; ?>

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
          <?php //include the top bar ?>
          <?php include_once 'includes/topbar.php'; ?>

          <!-- Begin Page Content -->
          <div class="container-fluid">
            <!-- Content Row -->
            <div class="row">

              <div class="offset-lg- col-lg-12 mb-4">

                <?php //if success message is set ?>
                <?php if(isset($_SESSION['success'])):?>
                  <div class="col-lg-12">
                    <div class="alert with-close alert-danger alert-dismissible fade show">
                      <span class="badge badge-pill badge-danger">Success</span>
                      <?php //display the success message ?>
                      <?php echo $_SESSION['success'];?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  </div>
                  <?php //unset the success message ?>
                  <?php unset($_SESSION['success']);?>
                <?php endif; ?>

                <?php //if there are any errors ?>
                <?php if(isset($errors)):
                  //loop through all the errors
                  foreach($errors as $error):
                    ?>
                    <div class="alert with-close alert-danger alert-dismissible fade show">
                      <span class="badge badge-pill badge-danger">Error</span> <?php echo $error; ?>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>

                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Change Admin Password</h6>
                  </div>
                  <div class="card-body">
                    <form class="" method="POST">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="old_password">Old Password</label>
                            <input type="password" class="form-control form-control-user" id="old_password" placeholder="Enter Old Password" name="old_password">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="new_password">New Password</label>
                            <input type="password" class="form-control form-control-user" id="new_password" placeholder="Enter New Password" name="new_password">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control form-control-user" id="confirm_password" placeholder="Enter Confirm Password" name="confirm_password">
                          </div>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-user" name="update">
                        Update
                      </button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->
<?php //include the footer section ?>
<?php include_once 'includes/footer.php'; ?>
