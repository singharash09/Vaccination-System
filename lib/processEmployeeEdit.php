<?php
include_once '../config/db.php';

$employeeSSN = $_POST['employeeSSN'];
$employeeEID = $_POST['employeeEID'];
$employeeFacility = $_POST['employeeFacility'];
$employeeStartDate = $_POST['employeeStartDate'];
$employeeEndDate = $_POST['employeeEndDate'];




echo "SSN: " . $employeeSSN . "\n";
echo "EID: ". $employeeEID. "\n";
echo "Facility name: " . $employeeFacility . "\n";
echo "Start Date: " .$employeeStartDate . "\n";
echo "End Date: " . $employeeEndDate . "\n";







$query1 = "UPDATE HealthCare_Worker
SET EID='$employeeEID'
WHERE SSN='$employeeSSN';";


if(empty($_POST['employeeEndDate'] )){
$query2 = "UPDATE Works_At
SET facility_name='$employeeFacility', start_date='$employeeStartDate', end_date=NULL
WHERE SSN='$employeeSSN';";

}else{
$query2 = "UPDATE Works_At
SET facility_name='$employeeFacility', start_date='$employeeStartDate', end_date='$employeeEndDate'
WHERE SSN='$employeeSSN';";
}


mysqli_query($conn, $query1);
mysqli_query($conn, $query2);


header("Location: ../public/employees/employees.php?edit=success");

?>