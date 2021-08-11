<?php
include_once '../config/db.php';

$personSSN = $_POST['personSSN'];
$employeeSSN = $_POST['employeeSSN'];
$typeName = $_POST['typeName'];
$doseNumber = $_POST['doseNumber'];
$vaccinationDate = $_POST['vaccinationDate'];


$preQuery = "SELECT facility_name FROM Works_At WHERE SSN=$employeeSSN;";
$result = mysqli_query($conn, $preQuery);
$resultCheck = mysqli_num_rows($result);
if($resultCheck>0){
    $facilityName = mysqli_fetch_assoc($result)['facility_name'];
}

$query1 = "INSERT INTO Vaccination (SSN, Employee_SSN, facility_name, type_name, dose_number, date_of_vaccination)
VALUES('$personSSN', '$employeeSSN', '$facilityName', '$typeName', '$doseNumber', '$vaccinationDate');";

$successQuery1 = mysqli_query($conn, $query1);

if(!$successQuery1){
    header("Location: ../public/vaccination/performVaccination/insertVaccination.php?insertion=failed"); 
}
else {
    header("Location: ../public/vaccination/performVaccination/performVaccination.php?insertion=success");
}


?>