<?php
include_once '../config/db.php';

if(isset($_GET['personToDelete'])){
    $SSNToDelete = $_GET['personToDelete'];
    echo $SSNToDelete;
    $query = "DELETE FROM Person WHERE SSN='$SSNToDelete';";
    mysqli_query($conn, $query);

    
    header("Location: ../public/people/people.php?deletion=success");
}



?>