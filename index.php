<?php //include the database configuration page ?>
<?php include_once 'config/db-config.php';?>
<?php
  //if user is logged in
  if(isset($_SESSION['user'])) {
    //redirect the user to the dashboard
    header('location: dashboard.php');
    exit;
  } 
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">
  <style>.bg-login-image{background: url('assets/img/car-bg.jpg');background-position: center;background-size: cover;}</style>

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="57x57" href="../assets/images/favicons/apple-icon-57x57.png">
  <link rel="apple-touch-icon" sizes="60x60" href="../assets/images/favicons/apple-icon-60x60.png">
  <link rel="apple-touch-icon" sizes="72x72" href="../assets/images/favicons/apple-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/images/favicons/apple-icon-76x76.png">
  <link rel="apple-touch-icon" sizes="114x114" href="../assets/images/favicons/apple-icon-114x114.png">
  <link rel="apple-touch-icon" sizes="120x120" href="../assets/images/favicons/apple-icon-120x120.png">
  <link rel="apple-touch-icon" sizes="144x144" href="../assets/images/favicons/apple-icon-144x144.png">
  <link rel="apple-touch-icon" sizes="152x152" href="../assets/images/favicons/apple-icon-152x152.png">
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/images/favicons/apple-icon-180x180.png">
  <link rel="icon" type="image/png" sizes="192x192"  href="../assets/images/favicons/android-icon-192x192.png">
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/images/favicons/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="96x96" href="../assets/images/favicons/favicon-96x96.png">
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicons/favicon-16x16.png">
  <link rel="manifest" href="../assets/images/favicons/manifest.json">
  <meta name="msapplication-TileColor" content="#ffffff">
  <meta name="msapplication-TileImage" content="../assets/images/favicons/ms-icon-144x144.png">
  <meta name="theme-color" content="#ffffff">
</head>

<body class="bg-gradient-primary">
  <?php
  //if login button clicked
  if(isset($_POST['login'])) {

    //if email or password field is empty
    if(empty($_POST['email']) OR empty($_POST['password'])) {
      //store the error message in the session
      $_SESSION['error'] = 'Email or Password can not be empty';
    //if email and password field is not empty
    }else {
      //get the value of email field from the form
      $email    = $_POST['email'];
      //get the value of password field from the form
      $password = $_POST['password'];
      //secure the password via MD5 function
      $securePassword = md5($password);

      //check the user if exist query
      $stmt = $conn->prepare("SELECT * FROM users WHERE email =? AND password =? AND status=? LIMIT 1");
      //execute the query
      $stmt->execute(array($email, $securePassword,'1'));
      //fetch the record
      $rows = $stmt->fetch(PDO::FETCH_ASSOC);
      //if the above data is matched
      if($stmt->rowCount() == '1'){
        //store all the data of the user into the SESSION
        $_SESSION['user'] = $rows;
        //redirect the user to the dashboard
        header('location: dashboard.php');
      }else{
        //store the error message if there is no match
        $_SESSION['error'] = "<strong>Error!</strong> Invalid Email / Password!";
      }  
    }
}
?>
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                  </div>
                  <?php //if there is any error message ?>
                  <?php if(isset($_SESSION['error'])):?>
                    <div class="alert alert-danger alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      <?php //display the error ?>
                      <?php echo $_SESSION['error'];?>
                    </div>
                    <?php //unset the error ?>
                    <?php unset($_SESSION['error']);?>
                  <?php endif; ?>
                  <form class="user" method="POST" action="">
                    <div class="form-group">
                      <input type="email" class="form-control form-control-user" id="email" name="email" placeholder="Enter Email Address...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" placeholder="Password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block" name="login">Login</button>
                    <hr>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

</body>

</html>
