<?php //page name ?>
<?php $page = 'Add-part'; ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>

<body id="page-top">
<?php 
  //if save button has been clicked
  if(isset($_POST['save'])){

    $valid = 1;
    
    //getting form input values into variables
    $Part_car_name               = $_POST['Part_car_name'];
    $Part_car_model              = $_POST['Part_car_model'];
    $Part_car_manufacturer       = $_POST['Part_car_manufacturer'];
    $Part_license_plate_number   = $_POST['Part_license_plate_number'];
    $Part_number                 = $_POST['Part_number'];
    $Part_store_name             = $_POST['Part_store_name'];
    $other_details               = $_POST['other_details'];
    $date_created                = date('Y-m-d H:i:s');

    //checking if the input values are empty
    if(empty($Part_car_name)){
      $valid = 0;
      $errors[] = "Car Name can not be empty";
    }
    if(empty($Part_car_model)){
      $valid = 0;
      $errors[] = "Car Model can not be empty";
    }
    if(empty($Part_car_manufacturer)){
      $valid = 0;
      $errors[] = "Car Manufacturer can not be empty";
    }
    if(empty($Part_license_plate_number)){
      $valid = 0;
      $errors[] = "License Plate Number can not be empty";
    }
    if(empty($Part_number)){
      $valid = 0;
      $errors[] = "VIN Number can not be empty";
    }
    if(empty($Part_store_name)){
      $valid = 0;
      $errors[] = "Insurance Company Name can not be empty";
    }

    //car image variables
    $Part_car_image     = $_FILES['Part_car_image']['name'];
    $Part_car_image_tmp = $_FILES['Part_car_image']['tmp_name'];
    //check if the car image is empty
    if(empty($Part_car_image)){
      $valid = 0;
      $errors[] = "Car Image can not be empty";
    }
    //if car image is not empty
    if($Part_car_image!='') {
      //get the image extention, i.e jpg, png
      $Part_car_image_ext = pathinfo( $Part_car_image, PATHINFO_EXTENSION );
      //get the file name of the image
      $file_name = basename( $Part_car_image, '.' . $Part_car_image_ext );
      //check the car image file extention 
      if( $Part_car_image_ext!='jpg' && $Part_car_image_ext!='png' && $Part_car_image_ext!='jpeg' && $Part_car_image_ext!='gif' )
      {
          $valid = 0;
          $errors[]= 'You must have to upload jpg, jpeg, gif or png file<br>';
      }   
    }

    //if everthing is fine
    if($valid == 1){

      //Upload Car Image
      $Part_car_image_file = $file_name.'-car-image-'.time().'.'.$Part_car_image_ext;
      move_uploaded_file( $Part_car_image_tmp, 'uploads/partcars/'.$Part_car_image_file );
      
      //insert into cars query
      $stmt = $conn->prepare("INSERT INTO part1 (Part_car_name, Part_car_model, Part_car_manufacturer, Part_license_plate_number, Part_number, Part_store_name, other_details, Part_car_image, date_created) VALUES (?,?,?,?,?,?,?,?,?)");
      //insert into cars data execution
      $run  = $stmt->execute(array($Part_car_name, $Part_car_model, $Part_car_manufacturer, $Part_license_plate_number, $Part_number, $Part_store_name, $other_details, $Part_car_image_file, $date_created));
      //if car data is inserted
      if($run){
        //store a success message in the SESSION
        $_SESSION['success'] = "Car has been added successfully!";
        //redirect to the cars page
        header('location: partcar.php');
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
                    <h6 class="m-0 font-weight-bold text-primary">Add Part</h6>
                  </div>
                  <div class="card-body">
                    <form class="" method="POST" action="" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_car_name">Part Name</label>
                            <input type="text" class="form-control form-control-user" id="Part_car_name" placeholder="Enter Part Name" name="Part_car_name" >
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_car_model">Part Model</label>
                            <input type="text" class="form-control form-control-user" id="Part_car_model" placeholder="Enter Part Model" name="Part_car_model">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_car_manufacturer">Part Manufacturer</label>
                            <input type="text" class="form-control form-control-user" id="Part_car_manufacturer" placeholder="Enter Part Manufacturer" name="Part_car_manufacturer">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_license_plate_number">Part Serial-Number</label>
                            <input type="text" class="form-control form-control-user" id="Part_license_plate_number" placeholder="Enter Part Number" name="Part_license_plate_number">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Path_number">Part Number</label>
                            <input type="text" class="form-control form-control-user" id="Part_number" placeholder="Enter Part Number" name="Part_number" >
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_store_name">Part store Name</label>
                            <input type="text" class="form-control form-control-user" id="Part_store_name" placeholder="Enter Part store name" name="Part_store_name" >
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_car_image">Part Image</label>
                            <input type="file" class="form-control form-control-user" id="Part_car_image" name="Part_car_image" style="padding-bottom: 36px;">
                          </div>
                        </div>
                        <div class="col-lg-12">
                          <div class="form-group">
                            <label for="other_details">Other Details <small>(If any)</small></label>
                            <textarea class="form-control form-control-user" id="other_details" name="other_details" ></textarea>
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
