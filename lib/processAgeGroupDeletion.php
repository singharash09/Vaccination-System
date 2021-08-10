<?php
include_once '../config/db.php';

if(isset($_GET['ageGroupToDelete'])){
    $ageGroupToDelete = $_GET['ageGroupToDelete'];
    echo $ageGroupToDelete;
    $query = "DELETE FROM Age_Group WHERE group_ID='$ageGroupToDelete';";
    mysqli_query($conn, $query);

    
    header("Location: ../public/vaccination/ageGroup.php?deletion=success");
}



?>