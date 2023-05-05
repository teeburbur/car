<?php //page name ?>
<?php $page = 'add-insure'; ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>

<body id="page-top">
<?php 
  //if save button has been clicked
  if(isset($_POST['save'])){

    $valid = 1;
    
    //getting form input values into variables
    $ins_com_name     = $_POST['ins_com_name'];
    $ins_com_address  = $_POST['ins_com_address'];
    $ins_com_phone    = $_POST['ins_com_phone'];
    $ins_com_number   = $_POST['ins_com_number'];
    //$other_details          = $_POST['other_details'];
    $date_created     = date('Y-m-d H:i:s');

    //checking if the input values are empty
    if(empty($ins_com_name)){
      $valid = 0;
      $errors[] = "Insurance Company Name can not be empty";
    }
    if(empty($ins_com_address)){
      $valid = 0;
      $errors[] = "Insurance Company Address can not be empty";
    }
    if(empty($ins_com_phone)){
      $valid = 0;
      $errors[] = "Insurance Company Phone can not be empty";
    }
    if(empty($ins_com_number)){
      $valid = 0;
      $errors[] = "Insurance Company Number can not be empty";
    }
    

   

    //if everthing is fine
    if($valid == 1){

      // //Upload Car Image
      // $car_image_file = $file_name.'-car-image-'.time().'.'.$car_image_ext;
      // move_uploaded_file( $car_image_tmp, 'uploads/cars/'.$car_image_file );
      
      //insert into cars query
      $stmt = $conn->prepare("INSERT INTO insure (ins_com_name, ins_com_address, ins_com_phone, ins_com_number, date_created) VALUES (?,?,?,?,?)");
      //insert into cars data execution
      $run  = $stmt->execute(array($ins_com_name, $ins_com_address, $ins_com_phone, $ins_com_number, $date_created));
      //if car data is inserted
      if($run){
        //store a succeins_com in the SESSION
        $_SESSION['success'] = "Insure has been added successfully!";
        //redirect to the cars page
        header('location: insure.php');
        exit();
      }
    }
  }
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
                    <h6 class="m-0 font-weight-bold text-primary">Add Insurance company name</h6>
                  </div>
                  <div class="card-body">
                    <form class="" method="POST" action="" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="ins_com_name">Ins Com Name</label>
                            <input type="text" class="form-control form-control-user" id="ins_com_name" placeholder="Enter ins com name" name="ins_com_name" >
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="ins_com_address">ins com address</label>
                            <input type="text" class="form-control form-control-user" id="ins_com_address" placeholder="Enter ins com address" name="ins_com_address">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="ins_com_phone">ins com phone</label>
                            <input type="text" class="form-control form-control-user" id="ins_com_phone" placeholder="Enter ins com phone" name="ins_com_phone">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="ins_com_number">ins com number</label>
                            <input type="text" class="form-control form-control-user" id="ins_com_number" placeholder="Enter ins com Number" name="ins_com_number">
                          </div>
                        </div>
                        

                      </div>
                      <button type="submit" class="btn btn-primary btn-user" name="save">
                        Save
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
