<?php
include_once '../config/db.php';

$newProvince = $_POST['province_code'];
$newGroup = $_POST['eligible_group_id'];
$provinceToEdit =$_GET['provinceToEdit'];

$query = "UPDATE Province 
SET province_code='$newProvince', eligible_group_id=$newGroup
WHERE province_code='$provinceToEdit';";

mysqli_query($conn, $query);

header("Location: ../public/vaccination/province/province.php?edit=success");

?>