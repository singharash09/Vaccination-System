<?php
include_once '../config/db.php';

if(isset($_GET['vaccineToDelete'])){
    $vaccineToDelete = $_GET['vaccineToDelete'];

    $query = "DELETE FROM Vaccine_Type WHERE type_name='$vaccineToDelete';";
    mysqli_query($conn, $query);
    
    header("Location: ../public/vaccination/vaccine/vaccine.php?deletion=success");
}
?>