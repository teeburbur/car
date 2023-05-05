<?php //Page name ?>
<?php $page = 'View-ins-Car';  ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>
<?php 
  //decode the id 
  $id = base64_decode($_GET['v']);
  //get the selected car by the id
  $stmt = $conn->prepare("SELECT * FROM insure WHERE id =? LIMIT 1");
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
            <div class="col-xl-8">
              <div class="card mb-4 mb-xl-0">
                <div class="card-header py-3 ">
                  <h6 class="m-0 font-weight-bold text-primary">Insure Details</h6>
                </div>
                <div class="card-body">
                  <div class="row">
                    <!-- Display Car Name -->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Iwnsurance company name</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_ins_com_name; ?></h4>
                    </div>
                    <!-- Display Car Model -->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Insurance company address</label>
                      <h4 class="font-weight-bold text-gray-800"><?php echo $view_ins_com_address; ?></h4>
                    </div>
                    <!-- Display Car Manufacturer -->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Insurance company phone</label>
                      <h4 class="font-weight-bold text-gray-800 "><?php echo $view_ins_com_phone; ?></h4>
                    </div>
                    <!-- Display Insurance Company -->
                    <div class="col-lg-6 mb-4">
                      <label class="font-weight-bold text-gray-600 mb-0">Insurance Number</label>
                      <h4 class="font-weight-bold text-gray-800 "><?php echo $view_ins_com_number; ?></h4>
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