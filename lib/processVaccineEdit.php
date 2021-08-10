<?php
include_once '../config/db.php';


$type_name = $_POST['type_name'];
$status = $_POST['status'];
$date_of_approval = $_POST['date_of_approval'];
$date_of_suspension = $_POST['date_of_suspension'];


if(empty($date_of_suspension)){
    echo "in empty";
    $query = "UPDATE Vaccine_Type 
SET status='$status', date_of_approval='$date_of_approval', date_of_suspension=NULL
WHERE type_name='$type_name';";    
}else{
    echo "in not empty";
$query = "UPDATE Vaccine_Type 
SET status='$status', date_of_approval='$date_of_approval', date_of_suspension='$date_of_suspension'
WHERE type_name='$type_name';";
}


if(mysqli_query($conn, $query)){
    echo "success";
}else{
    echo "fail";
}

header("Location: ../public/vaccination/vaccine/vaccine.php?edit=success");
?>