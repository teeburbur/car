<?php

$con = mysqli_connect("localhost", "root", "", "car_project_db") or die("Error: " . mysqli_error($con));
mysqli_query($con, "SET NAMES 'utf8' ");
error_reporting(error_reporting() & ~E_NOTICE);
date_default_timezone_set('Asia/Bangkok');


if (isset($_POST['function']) && $_POST['function'] == 'provinces') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM districts WHERE province_id='$id'";
    $query = mysqli_query($con, $sql);
    echo '<option value="" selected disabled>-Choose District-</option>';
    foreach ($query as $value) {
        echo '<option value="' . $value['id'] . '">' . $value['name_en'] . '</option>';
    }
}


if (isset($_POST['function']) && $_POST['function'] == 'districts') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM subdistricts WHERE districts_id='$id'";
    $query = mysqli_query($con, $sql);
    echo '<option value="" selected disabled>-Choose Subdistricts-</option>';
    foreach ($query as $value2) {
        echo '<option value="' . $value2['id'] . '">' . $value2['name_en'] . '</option>';
    }
}

if (isset($_POST['function']) && $_POST['function'] == 'subdistricts') {
    $id = $_POST['id'];
    $sql = "SELECT * FROM subdistricts WHERE id='$id'";
    $query3 = mysqli_query($con, $sql);
    $result = mysqli_fetch_assoc($query3);
    echo $result['zip_code'];
    exit();
}
?>