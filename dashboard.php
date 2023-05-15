<?php //page name ?>
<?php $page = 'Dashboard'; ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>
<body id="page-top">

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
          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
          </div>
  			  <?php 

            //Total Cars
            $stmt = $conn->prepare("SELECT * FROM cars");
            $stmt->execute();
            $total_cars = $stmt->rowCount();

            
  		      //Total Users
  		      $stmt = $conn->prepare("SELECT * FROM users");
  		      $stmt->execute();
  		      $users = $stmt->rowCount();

  		      //Active Users
  		      $stmt = $conn->prepare("SELECT * FROM users WHERE status= 1");
  		      $stmt->execute();
  		      $active_users = $stmt->rowCount();

  		      //Pending Users
  		      $stmt = $conn->prepare("SELECT * FROM users WHERE status= 0");
  		      $stmt->execute();
  		      $pending_users = $stmt->rowCount();

            //Total Part
            $stmt = $conn->prepare("SELECT * FROM part1");
            $stmt->execute();
  		      $part_car = $stmt->rowCount();

  		    ?>
          <!-- Content Row -->
          <div class="row">

            <!-- Total Cars -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">Total Cars</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php  echo $total_cars; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-car fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>  
            </div>

            <!-- Part -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success   shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total Parts</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $part_car; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fa fa-wrench fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Total Users -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $users; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Active Users -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Active Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $active_users; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-check fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Users -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Users</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $pending_users; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-user-clock fa-2x text-gray-300"></i>
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
