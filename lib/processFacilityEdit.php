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

$query = "UPDATE Vaccination_facility
SET facility_type='$FacilityType', web_address='$FacilityWebAdress', phone_number='$FacilityPhoneNumber',  address='$FacilityAddress', postal_code='$FacilityPostalCode'
WHERE facility_name='$FacilityName';";

if(!mysqli_query($conn, $query)){
    echo mysqli_error($conn);
}else{
    echo "good";
}


header("Location: ../public/Facility.php?edit=success");

?>