<?php //page name ?>
<?php $page = 'Admin Profile'; ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>
<body id="page-top">
<?php 
  
  //select query from users
  $stmt_user = $conn->prepare('SELECT * FROM users WHERE id =?');
  //execute the query where user ID is equal to current logged in user ID
  $stmt_user->execute(array($_SESSION['user']['id']));
  //fetch the results
  $user_row = $stmt_user->fetch(PDO::FETCH_ASSOC);
  //extract the results
  extract($user_row);

  //if update button is clicked
  if(isset($_POST['update'])){

    $valid = 1;

    // Getting form input values into variables
    $first_name = $_POST['first_name'];
    $last_name  = $_POST['last_name'];
    $email      = $_POST['email'];

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

    //if everything is fine then proceed
    if($valid == 1){
      //update users query
      $stmt = $conn->prepare("UPDATE users SET first_name=?, last_name=?,email=? WHERE id=?");
      //execute the update query
      $run  = $stmt->execute(array($first_name,$last_name,$email,$_SESSION['user']['id']));
      //if the query is executed
      if($run){
        //store the success message
        $_SESSION['success'] = "Admin Details has been Updated successfully !";}
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
                    <h6 class="m-0 font-weight-bold text-primary">Admin Profile</h6>
                  </div>
                  <div class="card-body">
                    <form class="" method="POST">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="first_name">First Name</label>
                            <input type="text" class="form-control form-control-user" id="first_name" placeholder="Enter First Name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" class="form-control form-control-user" id="last_name" placeholder="Enter Last Name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control form-control-user" id="email" placeholder="Enter Email Address" name="email" value="<?php echo htmlspecialchars($email); ?>">
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
