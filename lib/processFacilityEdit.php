<?php
include_once '../config/db.php';

$facilityName = $_POST['facilityName'];
$facilityType = $_POST['facilityType'];
$facilityWebAdress = $_POST['facilityWebAdress'];


$facilityPhoneNumber = $_POST['facilityPhoneNumber'];
$facilityAddress = $_POST['facilityAddress'];
$facilityPostalCode= $_POST['facilityPostalCode'];

echo "Name: " . $facilityName . "\n";
echo "Type: ". $facilityType. "\n";
echo "Web Adress: " . $facilityWebAdress . "\n";

echo "PHONE: " . $facilityPhoneNumber. "\n";
echo "ADDRESS: " . $facilityAddress. "\n";
echo "POSTAL CODE: ". $facilityPostalCode . "\n";

$query = "UPDATE Vaccination_facility
SET facility_type='$facilityType', web_address='$facilityWebAdress', phone_number='$facilityPhoneNumber',  address='$facilityAddress', postal_code='$facilityPostalCode'
WHERE facility_name='$facilityName';";

if(!mysqli_query($conn, $query)){
    echo mysqli_error($conn);
}else{
    echo "good";
}


header("Location: ../public/facility/facility.php?edit=success");

?>