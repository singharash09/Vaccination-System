<?php
include_once '../config/db.php';

$FacilityName = $_POST['FacilityName'];
$FacilityType = $_POST['FacilityType'];
$FacilityWebAdress = $_POST['FacilityWebAdress'];


$FacilityPhoneNumber = $_POST['FacilityPhoneNumber'];
$FacilityAddress = $_POST['FacilityAddress'];
$FacilityPostalCode= $_POST['FacilityPostalCode'];

echo "Name: " . $FacilityName . "\n";
echo "Type: ". $FacilityType. "\n";
echo "Web Adress: " . $FacilityWebAdress . "\n";



echo "PHONE: " . $FacilityPhoneNumber. "\n";
echo "ADDRESS: " . $FacilityAddress. "\n";
echo "POSTAL CODE: ". $FacilityPostalCode . "\n";




$query = "INSERT INTO Vaccination_facility (facility_name, facility_type, web_address, phone_number,address, postal_code)
VALUES('$FacilityName', '$FacilityType', '$FacilityWebAdress', '$FacilityPhoneNumber', '$FacilityAddress ', '$FacilityPostalCode');";
mysqli_query($conn, $query);

header("Location: ../public/Facility.php?insertion=success")

?>