<? $page = 'Data'; ?>

<?php include_once 'includes/header.php';?>

<?php

// ดึงข้อมูลจังหวัด
$provinces = [];
$sql = "SELECT * FROM provinces";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $provinces[$row["province_id"]] = $row["province_name"];
    }
}

// ดึงข้อมูลเขต
$districts = [];
$sql = "SELECT * FROM districts";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $districts[$row["district_id"]] = [
            "district_name" => $row["district_name"],
            "province_id" => $row["province_id"]
        ];
    }
}

// ดึงข้อมูลแขวง
$subdistricts = [];
$sql = "SELECT * FROM subdistricts";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {$subdistricts[$row["subdistrict_id"]] = [
"subdistrict_name" => $row["subdistrict_name"],
"district_id" => $row["district_id"]
];
}

}

// ตัวอย่างการใช้งาน
$provinceId = 1; // ตัวอย่างเลือกจังหวัดที่มี ID เท่ากับ 1 (กรุงเทพมหานคร)
$districtId = 2; // ตัวอย่างเลือกเขตที่มี ID เท่ากับ 2 (ราชเทวี)

// แสดงชื่อจังหวัด
if (isset($provinces[$provinceId])) {
echo "จังหวัด: " . $provinces[$provinceId] . "<br>";
}

// แสดงชื่อเขต
if (isset($districts[$districtId])) {
echo "เขต: " . $districts[$districtId]["district_name"] . "<br>";

// แสดงรายชื่อแขวงในเขตนั้น
foreach ($subdistricts as $subdistrictId => $subdistrict) {
    if ($subdistrict["district_id"] == $districtId) {
        echo "แขวง: " . $subdistrict["subdistrict_name"] . "<br>";
    }
}
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>


<body id="page-top">
    <?
    if (isset($_POST['save'])) {
        $valid = 1;

        $cus_name = $_POST['cus_name'];
        $cus_lastname = $_POST['cus_lname'];
        $cus_phone = $_POST['cus_tel'];
        $cus_email = $_POST['cus_email'];
        $cus_address = $_POST['cus_address'];
        $cus_province = $_POST['cus_province'];
        $cus_district = $_POST['cus_district'];
        $cus_subdistrict = $_POST['cus_subdistrict'];
        $cus_zipcode = $_POST['cus_zipcode'];
        $car_image     = $_FILES['car_image']['name'];
        $car_image_tmp = $_FILES['car_image']['tmp_name'];

        if ($car_image != '') {

            $car_image_ext = pathinfo($car_image, PATHINFO_EXTENSION);
            //get the file name of the image
            $file_name = basename($car_image, '.' . $car_image_ext);
            //ตรวจนามสกุลไฟล์ภาพรถ 
            if ($car_image_ext != 'jpg' && $car_image_ext != 'png' && $car_image_ext != 'jpeg' && $car_image_ext != 'gif') {
              $valid = 0;
              $errors[] = 'You must have to upload jpg, jpeg, gif or png file<br>';
            }
          }

        //สร้างฟังก์ชันในการตรวจสอบค่าว่างในแต่ละช่อง
        if (empty($cus_name) || empty($cus_lastname) || empty($cus_phone) || empty($cus_email) || empty($cus_address) || empty($cus_province) || empty($cus_district) || empty($cus_subdistrict) || empty($cus_zipcode)) {
            // กระบวนการที่ต้องทำเมื่อพบค่าว่างในช่องข้อมูล
            echo "กรุณากรอกข้อมูลให้ครบทุกช่อง";
        } else {
            // กระบวนการที่ต้องทำเมื่อไม่พบค่าว่างในช่องข้อมูลทุกช่อง
            // อาจเป็นการบันทึกข้อมูลหรือกระทำอื่นๆ
            // ...
        }
        

    }

    ?>
</body>

<div id="wrapper">
    <?php //include the navigation bar section 
    ?>
    <?php include_once 'includes/nav.php'; ?>
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <?php //include the top bar section 
        ?>
        <?php include_once 'includes/topbar.php'; ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <?php //if success message is set 
          ?>
          <?php if (isset($_SESSION['success'])) : ?>
            <div class="col-lg-12">
              <div class="alert with-close alert-danger alert-dismissible fade show">
                <span class="badge badge-pill badge-danger">Success</span>
                <?php //display the success message 
                ?>
                <?php echo $_SESSION['success']; ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
            </div>
            <?php //unset the success message 
            ?>
            <?php unset($_SESSION['success']); ?>
          <?php endif; ?>
          <!-- DataTables Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Form</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Car Name</th>
                      <th>Model</th>
                      <th>Manufacturer</th>
                      <th>License Plate No.</th>
                      <th>VIN No.</th>
                      <th>Insurance Company</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    //for numbering
                    $i = 1;
                    //select all cars query
                    $stmt = $conn->prepare("SELECT * FROM cars ORDER BY id DESC");
                    //execute the query
                    $stmt->execute();
                    //fetch the cars data as associative array
                    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    //loop through the array            
                    foreach ($result as $row) : ?>
                      <tr>
                        <td><?php echo $i;
                            $i++; ?></td>
                        <td><?php echo $row['car_name']; ?></td>
                        <td><?php echo $row['car_model']; ?></td>
                        <td><?php echo $row['car_manufacturer']; ?></td>
                        <td><?php echo $row['license_plate_number']; ?></td>
                        <td><?php echo $row['vin_number']; ?></td>
                        <td><?php echo $row['insurance_company_name']; ?></td>



                        <td class="text-center">
                          <!-- View Car -->
                          <a href="view-car.php?v=<?php echo base64_encode($row['id']); ?>" class="btn btn-primary btn-circle btn-sm">
                            <i class="fas fa-eye"></i>
                          </a>
                          <!-- Edit Car -->
                          <a href="edit-car.php?e=<?php echo base64_encode($row['id']); ?>" class="btn btn-success btn-circle btn-sm">
                            <i class="fas fa-edit"></i>
                          </a>
                          <!-- Delete Car -->
                          <a href="#" class="btn btn-danger btn-circle btn-sm" data-toggle="modal" data-target="#deleteModal_<?php echo $row['id']; ?>">
                            <i class="fas fa-trash"></i>
                          </a>
                          <!-- Delete Modal-->
                          <div class="modal fade" id="deleteModal_<?php echo $row['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel_<?php echo $row['id']; ?>" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                              <div class="modal-content">
                                <div class="modal-header">
                                  <h5 class="modal-title" id="exampleModalLabel_<?php echo $row['id']; ?>">Are you sure to Delete</h5>
                                  <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                  </button>
                                </div>
                                <div class="modal-body">Select "Delete" below if you are ready to delete the current Car.</div>
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
                          <!-- Download to pdf -->
                          <a href="./export-car.php" class="btn btn-info btn-circle btn-sm">
                          <i class="fas fa-download"></i>
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
      <?php //include the footer section 
      ?>
      <?php include_once 'includes/footer.php'; ?>
