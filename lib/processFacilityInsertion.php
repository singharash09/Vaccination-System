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


$query1 ="REPLACE INTO Postal_Code (postal_code, city, province)  VALUES ('$facilityPostalCode', '$facilityCity', '$facilityProvince');";

$query2 = "INSERT INTO Vaccination_facility (facility_name, facility_type, web_address, phone_number,address, postal_code)
VALUES('$facilityName', '$facilityType', '$facilityWebAdress', '$facilityPhoneNumber', '$facilityAddress ', '$facilityPostalCode');";

mysqli_query($conn, $query1);
mysqli_query($conn, $query2);


header("Location: ../public/facility/facility.php?insertion=success")

?>