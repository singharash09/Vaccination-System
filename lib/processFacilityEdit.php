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

$query2 = "UPDATE Vaccination_Facility
SET facility_type='$facilityType', web_address='$facilityWebAdress', phone_number='$facilityPhoneNumber',  address='$facilityAddress', postal_code='$facilityPostalCode'
WHERE facility_name='$facilityName';";

mysqli_query($conn, $query1);
mysqli_query($conn, $query2);


header("Location: ../public/facility/Facility.php?edit=success");

?>