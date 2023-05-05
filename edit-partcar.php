<?php //page name ?>
<?php $page = 'Edit-partcar'; ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>
<?php 
  //decode the id
  $id = base64_decode($_GET['e']);
  //get the selected car by the id
  $stmt = $conn->prepare("SELECT * FROM part1 WHERE id =? LIMIT 1");
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
    $Part_car_name               = $_POST['Part_car_name'];
    $Part_car_model              = $_POST['Part_car_model'];
    $Part_car_manufacturer       = $_POST['Part_car_manufacturer'];
    $Part_license_plate_number   = $_POST['Part_license_plate_number'];
    $Part_number                 = $_POST['Part_number'];
    $Part_store_name             = $_POST['Part_store_name'];
    // $Part_car_image              = $_POST['Part_car_image'];
    $other_details               = $_POST['other_details'];
    $date_created                = date('Y-m-d H:i:s');


    //checking if the input values are empty
    if(empty($Part_car_name)){
      $valid = 0;
      $errors[] = "Part Car Name can not be empty";
    }
    if(empty($Part_car_model)){
      $valid = 0;
      $errors[] = "Part Car Model can not be empty";
    }
    if(empty($Part_car_manufacturer)){
      $valid = 0;
      $errors[] = "Part Car Manufacturer can not be empty";
    }
    if(empty($Part_license_plate_number)){
      $valid = 0;
      $errors[] = "Part License Plate Number can not be empty";
    }
    if(empty($Part_number)){
      $valid = 0;
      $errors[] = "Part Number can not be empty";
    }
    if(empty($Part_store_name)){
      $valid = 0;
      $errors[] = "Part store Name can not be empty";
    }

    //car image variables
    $Part_car_image     = $_FILES['Part_car_image']['name'];
    $Part_car_image_tmp = $_FILES['Part_car_image']['tmp_name'];
    
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

      if($Part_car_image!=''){
        //Upload Car Image
        $Part_car_image_file = $file_name.'-car-image-'.time().'.'.$Part_car_image_ext;
        move_uploaded_file( $Part_car_image_tmp, 'uploads/partcars/'.$Part_car_image_file );
        //delete the old image of the car
        unlink('uploads/partcars/'.$edit_Part_car_image);
      }else{
        //assgin old image file name
        $Part_car_image_file = $edit_Part_car_image;
      }
      //update cars query
      $stmt = $conn->prepare("UPDATE  part1  SET Part_car_name = ?, Part_car_model = ?, Part_car_manufacturer = ?, Part_license_plate_number = ?, Part_number = ?, Part_store_name = ?, other_details = ?, Part_car_image = ? WHERE id = ?");
      //update cars data execution
      $run  = $stmt->execute(array($Part_car_name, $Part_car_model, $Part_car_manufacturer, $Part_license_plate_number, $Part_number, $Part_store_name, $other_details, $Part_car_image_file, $id));
      //if car data is inserted
      if($run){
        //store a success message in the SESSION
        $_SESSION['success'] = "Part Car has been updated successfully!";
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
                    <h6 class="m-0 font-weight-bold text-primary">Edit Part Car</h6>
                  </div>
                  <div class="card-body">
                    <form class="" method="POST" action="" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_car_name">Part Car Name</label>
                            <input type="text" class="form-control form-control-user" id="Part_car_name" placeholder="Enter Part Car Name" name="Part_car_name" value="<?php echo $edit_Part_car_name; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_car_model">Part Car Model</label>
                            <input type="text" class="form-control form-control-user" id="Part_car_model" placeholder="Enter Part Car Model" name="Part_car_model" value="<?php echo $edit_Part_car_model; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_car_manufacturer">Part Car Manufacturer</label>
                            <input type="text" class="form-control form-control-user" id="Part_car_manufacturer" placeholder="Enter Part Car Manufacturer" name="Part_car_manufacturer" value="<?php echo $edit_Part_car_manufacturer; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_license_plate_number">Part License Plate Number</label>
                            <input type="text" class="form-control form-control-user" id="Part_license_plate_number" placeholder="Enter Part License Plate Number" name="Part_license_plate_number" value="<?php echo $edit_Part_license_plate_number; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_number">Part Number</label>
                            <input type="text" class="form-control form-control-user" id="Part_number" placeholder="Enter Part Number" name="Part_number" value="<?php echo $edit_Part_number; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_store_name">Part store Name</label>
                            <input type="text" class="form-control form-control-user" id="Part_store_name" placeholder="Enter Part store Name" name="Part_store_name" value="<?php echo $edit_Part_store_name; ?>">
                          </div>
                        </div>
                        <div class="col-lg-6">
                          <div class="form-group">
                            <label for="Part_car_image">Part Car Image</label>
                            <input type="file" class="form-control form-control-user" id="Part_car_image" name="Part_car_image" style="padding-bottom: 36px;">
                          </div>
                          <label for="Part_car_image">Existing Image</label><br>
                            <a href="uploads/partcars/<?php echo $edit_Part_car_image; ?>">
                              <img class="img-thumbnail" width="200px" src="uploads/partcars/<?php echo $edit_Part_car_image; ?>" alt="Part car image">
                            </a>
                        </div>
                        <div class="col-lg-12 mt-4">
                          <div class="form-group">
                            <label for="other_details">Other Details <small>If any</small></label>
                            <textarea class="form-control form-control-user" id="other_details" name="other_details"><?php echo $edit_other_details; ?></textarea>
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
