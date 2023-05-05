<?php $page = 'Edit User'; ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>
<body id="page-top">
  <?php 
    //decode the id
    $id = base64_decode($_GET['e']);
    //get the selected user by the id
    $stmt = $conn->prepare("SELECT * FROM users WHERE id =? LIMIT 1");
    //execute the query
    $stmt->execute(array($id));
    //fetch the user record
    $row = $stmt->fetch();
    //extract the record/result
    extract($row,EXTR_PREFIX_ALL, "edit");

  if(isset($_POST['update'])){

    $valid = 1;
    
    // Getting form input values into variables
    $first_name   = $_POST['first_name'];
    $last_name    = $_POST['last_name'];
    $email        = $_POST['email'];
    $password     = $_POST['password'];
    $c_password   = $_POST['confirm_password'];
    $status       = $_POST['status'];
    $date_created = date('Y-m-d H:i:s');

    //checking if the input values are empty
    if(empty($first_name)){
      $valid = 0;
      $errors[] = "First Name can not be empty";
    }
    if(empty($last_name)){
      $valid = 0;
      $errors[] = "Last Name can not be empty";
    }
    if(empty($email)){
      $valid = 0;
      $errors[] = "Email can not be empty";
    }
    if(empty($password)){
      //if password field is empty then use the old password
      $password = $edit_password;
    }else
    if(!empty($password)) {
      //if password and confirm password is not equals then show error
      if($password != $c_password){
        $valid = 0;
        $errors[] = "Passwords are not the same";
      }
      //if password is less than 5 then show error
      if(strlen($password) < 5){
        $valid = 0;
        $errors[] = "Password must be atleast 5 characters";
      }else{
        //if everything is fine then store the encrypted password using the MD5 algorithm
        $password = md5($password);
      }
      
    }
    //if there is no error then proceed
    if($valid == 1){
      //update query
      $stmt = $conn->prepare("UPDATE users SET first_name = ?, last_name = ?, email = ?, password = ?, status = ? WHERE id = ?");
      //execute the update query
      $run  = $stmt->execute(array($first_name, $last_name, $email, $password, $status, $id));
      //if the query is executed
      if($run){
        //store the success message
        $_SESSION['success'] = "User has been updated successfully!";
        //redirect to the users page
        header('location: users.php');
        exit();
      }
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
                    <h6 class="m-0 font-weight-bold text-primary">Add User</h6>
                  </div>
                  <div class="card-body">
                    <form class="" method="POST" action="">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control form-control-user" id="first_name" placeholder="Enter First Name" name="first_name" value="<?php echo $edit_first_name; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control form-control-user" id="last_name" placeholder="Enter Last Name" name="last_name" value="<?php echo $edit_last_name; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control form-control-user" id="email" placeholder="Enter Email" name="email" value="<?php echo $edit_email; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control form-control-user" id="password" placeholder="Enter Password" name="password">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="confirm_password">Confirm Password</label>
                            <input type="password" class="form-control form-control-user" id="confirm_password" placeholder="Enter Confirm Password" name="confirm_password" >
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control form-control-user" name="status" id="status">
                              <option value="0" <?php if($edit_status == 0){echo "selected";} ?> > Inactive </option>
                              <option value="1" <?php if($edit_status == 1){echo "selected";} ?> > Active </option>
                            </select>
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
