<?php
include_once '../config/db.php';

if(isset($_GET['vaccinationToDelete'])){
    $vaccinationToDelete = $_GET['vaccinationToDelete'];
    echo $vaccinationToDelete;
    $query = "DELETE FROM Vaccination WHERE vaccination_id='$vaccinationToDelete';";
    mysqli_query($conn, $query);

    
    header("Location: ../public/vaccination/performVaccination/performVaccination.php?deletion=success");
}



?>