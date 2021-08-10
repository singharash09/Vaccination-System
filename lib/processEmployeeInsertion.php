<?php
include_once '../config/db.php';

$employeeSSN = $_POST['employeeSSN'];
$employeeEID = $_POST['employeeEID'];
$employeeFacility = $_POST['employeeFacility'];
$employeeStartDate = $_POST['employeeStartDate'];
$employeeEndDate = $_POST['employeeEndDate'];


if(empty($_POST['employeeEndDate'] )){
  
    $query1 = "INSERT INTO HealthCare_Worker VALUES('$employeeSSN', '$employeeEID');";
    $query2 = "INSERT INTO Works_At VALUES('$employeeSSN', '$employeeFacility','$employeeStartDate',null);";

    
  
    $successQuery1 = mysqli_query($conn, $query1);
    $successQuery2 = mysqli_query($conn, $query2);

    if(!$successQuery1){
        header("Location: ../public/employees/insertEmployee.php?insertion=failed&type=EID"); 
    } else if(!$successQuery2){
          header("Location: ../public/employees/insertEmployee.php?insertion=failed&type=EID");       
    }else{
        header("Location: ../public/employees/employees.php?insertion=success");
        }

    
   

} else {
    $query1 = "INSERT INTO HealthCare_Worker VALUES('$employeeSSN', '$employeeEID');";
    $query2 = "INSERT INTO Works_At VALUES('$employeeSSN', '$employeeFacility','$employeeStartDate','$employeeEndDate');";

    
  
    $successQuery1 = mysqli_query($conn, $query1);
    $successQuery2 = mysqli_query($conn, $query2);

    
    if(!$successQuery1){
        header("Location: ../public/employees/insertEmployee.php?insertion=failed&type=EID"); 
    } else if(!$successQuery2){
          header("Location: ../public/employees/insertEmployee.php?insertion=failed&type=EID");       
    }else{
        header("Location: ../public/employees/employees.php?insertion=success");
        }
}


?>