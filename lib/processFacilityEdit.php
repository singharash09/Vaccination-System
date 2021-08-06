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
echo "CITY: ". $facilityCity. "\n";
echo "PROVINCE: ". $facilityPostalCode . "\n";
echo "POSTAL CODE: ". $facilityPostalCode . "\n";

$query1 = "REPLACE INTO Postal_Code (postal_code, city, province)  VALUES ('$facilityPostalCode', '$facilityCity', '$facilityProvince');";

$query2 = "UPDATE Vaccination_Facility
SET facility_type='$facilityType', web_address='$facilityWebAdress', phone_number='$facilityPhoneNumber',  address='$facilityAddress', postal_code='$facilityPostalCode'
WHERE facility_name='$facilityName';";

mysqli_query($conn, $query1);
mysqli_query($conn, $query2);


//header("Location: ../public/facility/Facility.php?edit=success");

?>