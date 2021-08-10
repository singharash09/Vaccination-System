<?php
include_once '../config/db.php';

$infectSSN = $_POST['infectSSN'];
$infectDate = $_POST['infectDate'];
$infectType = $_POST['infectType'];


$query1 = "INSERT INTO Infection  (SSN, date_of_infection, type_of_infection) VALUES('$infectSSN', '$infectDate', '$infectType');"; 


$successQuery1 = mysqli_query($conn, $query1);


if(!$successQuery1){
header("Location: ../public/vaccination/infection/insertInfection.php?insertion=failed");
}else{
header("Location: ../public/vaccination/infection/infection.php?insetion=success");
}


?>