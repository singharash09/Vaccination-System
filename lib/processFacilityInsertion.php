<?php
include_once '../config/db.php';

$facilityName = $_POST['facilityName'];
$facilityType = $_POST['facilityType'];
$facilityWebAdress = $_POST['facilityWebAdress'];

$facilityPhoneNumber = $_POST['facilityPhoneNumber'];
$facilityAddress = $_POST['facilityAddress'];
$facilityCity = $_POST['facilityCity'];
$facilityProvince = $_POST['facilityProvince'];
$facilityPostalCode= $_POST['facilityPostalCode'];


$query1 = "INSERT INTO Postal_Code  (postal_code, city, province_code) VALUES('$facilityPostalCode', '$facilityCity', '$facilityProvince') 
ON DUPLICATE KEY UPDATE city='$facilityCity', province_code='$facilityProvince';";

$query2 = "INSERT INTO Vaccination_Facility(facility_name, facility_type, web_address, phone_number,address, postal_code)
VALUES('$facilityName', '$facilityType', '$facilityWebAdress', '$facilityPhoneNumber', '$facilityAddress ', '$facilityPostalCode');";

$successQuery1 = mysqli_query($conn, $query1);
$successQuery2 = mysqli_query($conn, $query2);


if(!$successQuery1){
header("Location: ../public/Facility/insertFacility.php?insertion=failed&type=Unexpected");
}else if (!$successQuery2){
header("Location: ../public/Facility/insertFacility.php?insertion=failed&type=name");
}else{
header("Location: ../public/facility/Facility.php?insertion=success");
}


?>