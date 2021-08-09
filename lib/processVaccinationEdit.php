<?php
include_once '../config/db.php';

$vaccination_id = $_POST['vaccination_id'];
$personSSN = $_POST['personSSN'];
$employeeSSN = $_POST['employeeSSN'];
$facilityName = $_POST['facilityName'];
$typeName = $_POST['typeName'];
$doseNumber = $_POST['doseNumber'];
$vaccinationDate = $_POST['vaccinationDate'];


$query1 = "UPDATE Vaccination 
SET SSN='$personSSN', Employee_SSN='$employeeSSN', facility_name='$facilityName', type_name='$typeName', dose_number='$doseNumber', date_of_vaccination='$vaccinationDate'
WHERE vaccination_id='$vaccination_id';";


mysqli_query($conn, $query1);

header("Location: ../public/vaccination/performVaccination/performVaccination.php?edit=success")

?>