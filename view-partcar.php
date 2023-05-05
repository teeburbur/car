<?php //Page name ?>
<?php $page = 'View-partcar';  ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>
<?php 
  //decode the id 
  $id = base64_decode($_GET['v']);
  //get the selected car by the id
  $stmt = $conn->prepare("SELECT * FROM part1 WHERE id =? LIMIT 1");
  //execute the query
  $stmt->execute(array($id));
  //fetch the car record
  $row = $stmt->fetch();
  //extract the record/result
  extract($row,EXTR_PREFIX_ALL, "view");
?>

<body id="page-top">
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
          <div class="row">
            <div class="col-xl-4">
              <div class="card mb-4 mb-xl-0">
                <div class="card-header py-3 ">
                  <h6 class="m-0 font-weight-bold text-primary">Part Car Image</h6>
                </div>
                <div class="card-body text-center">
                  <!-- Car Image Link  -->
                  <a href="uploads/partcars/<?php echo $view_Part_car_image; ?>">
                    <!-- Display Car Image -->
                    <img class="img-fluid rounded mb-2" src="uploads/partcars/<?php echo $view_Part_car_image; ?>" alt="part car image">
                  </a>
                </div>
              </div>
            </div>
            <div class="col-xl-8">
              <div class="card mb-4 mb-xl-0">
                <div class="card-header py-3 ">
                  <h6 class="m-0 font-weight-bold text-primary">Part Car Details</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <!-- Display Car Name -->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Part Name</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_Part_car_name; ?></h4>
                    </div>
                    <!-- Display Car Model -->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Part Car Model</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_Part_car_model; ?></h4>
                    </div>
                    <!-- Display Car Manufacturer -->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Part Manufacturer</label>
                      <h4 class="font-weight-bold text-gray-800 "><?php echo $view_Part_car_manufacturer; ?></h4>
                    </div>
                    <!-- Display License Plate No. -->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Part License plate No.</label>
                      <h4 class="font-weight-bold text-gray-800 "><?php echo $view_Part_license_plate_number; ?></h4>
                    </div>
                    <!-- Display VIN  No.-->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Part No.</label>
                      <h4 class="font-weight-bold text-gray-800 "><?php echo $view_Part_number; ?></h4>
                    </div>
                    <!-- Display Insurance Company -->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Part store name</label>
                      <h4 class="font-weight-bold text-gray-800 "><?php echo $view_Part_store_name; ?></h4>
                    </div>
                    <!-- Display Other Details -->
                    <div class="col-lg-12 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Other Details</label>
                      <p class="text-gray-800 "><?php echo $view_other_details; ?></p>
                    </div>

                  </div>
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