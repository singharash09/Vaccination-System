<?php
include_once '../config/db.php';

if(isset($_GET['personToDelete'])){
    $SSNToDelete = $_GET['personToDelete'];
    echo $SSNToDelete;
    $query = "DELETE FROM Person WHERE SSN='$SSNToDelete';";
    mysqli_query($conn, $query);

    //$_SESSION['message'] = "Person successfully deleted!";
    //$_SESSION['messageType'] = "danger";
    
    header("Location: ../public/people.php?deletion=success");
}



?>