<?php
include_once '../config/db.php';

if(isset($_GET['EmployeeToDelete'])){
    $SSNToDelete = $_GET['EmployeeToDelete'];
    $query = "DELETE FROM HealthCare_Worker WHERE SSN='$SSNToDelete';";
    mysqli_query($conn, $query);

    
    header("Location: ../public/employees/employees.php?deletion=success");
}



?>