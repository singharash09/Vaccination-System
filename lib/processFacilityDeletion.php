<?php
include_once '../config/db.php';

if(isset($_GET['facilityToDelete'])){
    $FacilityToDelete = $_GET['facilityToDelete'];
    $query = "DELETE FROM Vaccination_Facility WHERE facility_name='$FacilityToDelete';";
    mysqli_query($conn, $query);

    
    header("Location: ../public/facility/facility.php?deletion=success");
}



?>