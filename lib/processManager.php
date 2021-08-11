<?php
include_once '../config/db.php';

$employeeSSN = $_POST['managerSSN'];
$employeeFacility = $_POST['managerFacility'];
$employeeStartDate = $_POST['managerStartDate'];
$employeeEndDate = $_POST['managerEndDate'];


if(empty($_POST['employeeEndDate'] )){
  
    $queryDelete1 = "DELETE FROM Manages WHERE facility_name='$employeeFacility';";
        mysqli_query($conn, $queryDelete1);
    $query1 = "INSERT INTO Manages VALUES('$employeeSSN', '$employeeFacility', '$employeeStartDate', NULL);";

    $successQuery1 = mysqli_query($conn, $query1);

    header("Location: ../public/Facility/Facility.php?insertion=success");


    
   

} else {

    $queryDelete2 = "DELETE FROM Manages WHERE facility_name='$employeeFacility';";
     mysqli_query($conn, $queryDelete2);
    $query2 = "INSERT INTO Manages VALUES('$employeeSSN', '$employeeFacility','$employeeStartDate','$employeeEndDate');";

    
      $successQuery2 = mysqli_query($conn, $query2);


   header("Location: ../public/Facility/Facility.php?insertion=success");

}


?>