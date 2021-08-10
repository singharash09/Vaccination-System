<?php
include_once '../config/db.php';


$transfersFacilityIN = $_POST['transfersFacilityIN'];
$transfersFacilityOUT= $_POST['transfersFacilityOUT'];

$transfersVaccineType = $_POST['transfersVaccineType'];
$transfersNumberOfVaccines= $_POST['transfersNumberOfVaccines'];
$transfersDateOfTransfer = $_POST['transfersDateOfTransfer'];



$query ="INSERT INTO Transfers VALUES (null,'$transfersFacilityIN','$transfersFacilityOUT','$transfersVaccineType',$transfersNumberOfVaccines,'$transfersDateOfTransfer');";


$successQuery = mysqli_query($conn, $query);

if(!$successQuery){
    header("Location: ../public/Facility/performTransfer.php?insertion=failed&type=Amount"); 
    } else{
        header("Location: ../public/Facility/Facility.php?transfer=success");
    }


?>