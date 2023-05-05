<?php //page name ?>
<?php $page = 'Users'; ?>
<?php //include the header section ?>
<?php include_once 'includes/header.php'; ?>
<body id="page-top">
<?php
  //if delete button is clicked
  if(isset($_POST['delete']))
  {
    //decode the encoded ID
    $id = base64_decode($_POST['id']);
    //delete from users query
    $stmt_delete = $conn->prepare('DELETE FROM users WHERE id =?');
    //execute the query
    $delete = $stmt_delete->execute(array($id));
    //if query is executed
    if($delete){
      //store the success message
      $_SESSION['success'] = "User has been deleted";
      //redirect to the users.php page
      header('location: users.php');
      exit();
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
          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Users</h1>
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
               
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Users List</h6>
            </div>
            <div class="card-body">

              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>S. No</th>
                      <td>Name</td>
                      <th>Email</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>S. No</th>
                      <td>Name</td>
                      <th>Email</th>
                      <th class="text-center">Status</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                  <?php
                    //for counting
                    $i=1;
                    //select query from users
                    $stmt = $conn->prepare("SELECT * FROM users ORDER BY id DESC");
                    //execute the query
                    $stmt->execute();
                    //fetch all the results
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    //loop through the results             
                    foreach ($result as $row):?>
                      <tr>
                        <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $row['first_name']; ?> <?php echo $row['last_name']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td class="text-center"><?php if($row['status'] == 1){echo "<span class='btn btn-success btn-sm'>Active</span>";}else{echo "<span class='btn btn-danger btn-sm'>Inactive</span>";}; ?></td>
                        <td class="text-center">
                          <!-- Edit User -->
                          <a href="edit-user.php?e=<?php echo base64_encode($row['id']);?>" class="btn btn-primary btn-circle btn-sm">
                            <i class="fas fa-edit"></i>
                          </a>
                          <!-- Delete User -->
                          <?php if($row['id'] != 2){ ?>
                            <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteModal_<?php echo $row['id'];?>">
                              <i class="fas fa-trash"></i>
                            </a>
                          <?php } ?>
                          <!-- Delete Modal-->
                          <div class="modal fade" id="deleteModal_<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?php echo $row['id'];?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel_<?php echo $row['id'];?>">Are you sure to Delete</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">Select "Delete" below if you are ready to delete the current user.</div>
                                <div class="modal-footer">
                                  <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                  <form action="" method="POST">
                                    <input type="hidden" name="id" value="<?php echo base64_encode($row['id']); ?>">
                                    <button class="btn btn-danger" type="submit" name="delete">Delete</button>
                                  </form>
                                </div>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

<?php //include the footer section ?>
<?php include_once 'includes/footer.php'; ?>
