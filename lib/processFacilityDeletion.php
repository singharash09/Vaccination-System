<?php
include_once '../config/db.php';

if(isset($_GET['FacilityToDelete'])){
    $FacilityNameToDelete = $_GET['FacilityToDelete'];
    echo $FacilityNameToDelete ;
    $query = "DELETE FROM Vaccination_Facility WHERE facility_name='$FacilityNameToDelete';";
    mysqli_query($conn, $query);

    //$_SESSION['message'] = "Person successfully deleted!";
    //$_SESSION['messageType'] = "danger";
    
    header("Location: ../public/Facility.php?deletion=success");
}



?>