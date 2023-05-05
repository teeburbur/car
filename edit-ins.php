<?php //page name ?>
<?php $page = 'Edit-Insure'; ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>
<?php 
  //decode the id
  $id = base64_decode($_GET['e']);
  //get the selected car by the id
  $stmt = $conn->prepare("SELECT * FROM insure WHERE id =? LIMIT 1");
  //execute the query
  $stmt->execute(array($id));
  //fetch the user record
  $row = $stmt->fetch();
  //extract the record/result
  extract($row,EXTR_PREFIX_ALL, "edit");
?>
<body id="page-top">
<?php 
  //if update button has been clicked
  if(isset($_POST['update'])){

    $valid = 1;
    
    //getting form input values into variables
    $ins_com_name     = $_POST['ins_com_name'];
    $ins_com_address  = $_POST['ins_com_address'];
    $ins_com_phone    = $_POST['ins_com_phone'];
    $ins_com_number   = $_POST['ins_com_number'];
    // $car_image        = $_FILES['car_image']['name'];
    $date_created     = date('Y-m-d H:i:s');

    //checking if the input values are empty
    if(empty($ins_com_name)){
      $valid = 0;
      $errors[] = "insurance company Name can not be empty";
    }
    if(empty($ins_com_address)){
      $valid = 0;
      $errors[] = "insurance address can not be empty";
    }
    if(empty($ins_com_phone)){
      $valid = 0;
      $errors[] = "insurance phone can not be empty";
    }
    if(empty($ins_com_number)){
      $valid = 0;
      $errors[] = "insurance Number can not be empty";
    }

    if($valid == 1){
      //update cars query
      $stmt = $conn->prepare("UPDATE insure  SET ins_com_name = ?, ins_com_address = ?, ins_com_phone = ?, ins_com_number = ? WHERE id = ?");
      //update cars data execution
      $run = $stmt->execute(array($ins_com_name, $ins_com_address, $ins_com_phone, $ins_com_number, $id));
      //if car data is inserted
      if($run){
        //store a success message in the SESSION
        $_SESSION['success'] = "Insure has been updated successfully!";
        //redirect to the cars page
        header('location: insure.php');
        exit();
      }
    }
  }

    //if car image is not empty
    // if($car_image!='') {
    //   //get the image extention, i.e jpg, png
    //   $car_image_ext = pathinfo( $car_image, PATHINFO_EXTENSION );
    //   //get the file name of the image
    //   $file_name = basename( $car_image, '.' . $car_image_ext );
    //   //check the car image file extention 
    //   if( $car_image_ext!='jpg' && $car_image_ext!='png' && $car_image_ext!='jpeg' && $car_image_ext!='gif' )
    //   {
    //       $valid = 1;
    //       $errors[]= 'You must have to upload jpg, jpeg, gif or png file<br>';
    //   }   
    // }

    //if everthing is fine
    
  
?>
    <!-- Page Wrapper -->
    <div id="wrapper">
      <?php //include the navigation bar section ?>
      <?php include_once 'includes/nav.php'; ?>

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
          <?php //include the top bar section ?>
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
                    <h6 class="m-0 font-weight-bold text-primary">Edit Insure</h6>
                  </div>
                  <div class="card-body">
                    <form class="" method="POST" action="" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="ins_name">insurance Name</label>
                            <input type="text" class="form-control form-control-user" id="ins_com_name" placeholder="Enter insurance Name" name="ins_com_name" value="<?php echo $edit_ins_com_name; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="ins_com_address">insurance address</label>
                            <input type="text" class="form-control form-control-user" id="ins_com_address" placeholder="Enter insurance address" name="ins_com_address" value="<?php echo $edit_ins_com_address; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="ins_com_phone">insurance phone</label>
                            <input type="text" class="form-control form-control-user" id="ins_com_phone" placeholder="Enter insurance phone" name="ins_com_phone" value="<?php echo $edit_ins_com_phone; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="ins_com_number">insurance Number</label>
                            <input type="text" class="form-control form-control-user" id="ins_com_number" placeholder="Enter insurance number" name="ins_com_number" value="<?php echo $edit_ins_com_number; ?>">
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
