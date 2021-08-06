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

echo "Name: " . $facilityName . "\n";
echo "Type: ". $facilityType. "\n";
echo "Web Adress: " . $facilityWebAdress . "\n";


echo "PHONE: " . $facilityPhoneNumber. "\n";
echo "ADDRESS: " . $facilityAddress. "\n";
echo "POSTAL CODE: ". $facilityPostalCode . "\n";
echo "facility city: ". $facilityCity . "\n";
echo "facility province: ". $facilityProvince . "\n";

$query1 = "INSERT INTO Postal_Code  (postal_code, city, province_code) VALUES('$facilityPostalCode', '$facilityCity', '$facilityProvince') 
ON DUPLICATE KEY UPDATE city='$facilityCity', province_code='$facilityProvince';";

$query2 = "INSERT INTO Vaccination_Facility(facility_name, facility_type, web_address, phone_number,address, postal_code)
VALUES('$facilityName', '$facilityType', '$facilityWebAdress', '$facilityPhoneNumber', '$facilityAddress ', '$facilityPostalCode');";

mysqli_query($conn, $query1);
mysqli_query($conn, $query2);


header("Location: ../public/facility/Facility.php?insertion=success")

?>