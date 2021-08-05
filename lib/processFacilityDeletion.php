<?php
include_once '../config/db.php';

if(isset($_GET['facilityToDelete'])){
    $FacilityToDelete = $_GET['facilityToDelete'];
    echo $FacilityToDelete ;
    $query = "DELETE FROM Vaccination_Facility WHERE facility_name='$FacilityToDelete';";
    mysqli_query($conn, $query);

    //$_SESSION['message'] = "Person successfully deleted!";
    //$_SESSION['messageType'] = "danger";
    
    header("Location: ../public/facility/facility.php?deletion=success");
}



?>