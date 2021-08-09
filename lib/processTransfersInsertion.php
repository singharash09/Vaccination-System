<?php
include_once '../config/db.php';


$transfersFacilityIN = $_POST['transfersFacilityIN'];
$transfersFacilityOUT= $_POST['transfersFacilityOUT'];

$transfersVaccineType = $_POST['transfersVaccineType'];
$transfersNumberOfVaccines= $_POST['transfersNumberOfVaccines'];
$transfersDateOfTransfer = $_POST['transfersDateOfTransfer'];



echo "Receiving Facility: ". $transfersFacilityIN. "\n";
echo "Sending Facility: " . $transfersFacilityOUT . "\n";

echo "Vaccine type: " . $transfersVaccineType. "\n";
echo "Number of Vaccines: " . $transfersNumberOfVaccines. "\n";
echo "DATE OF TRANSFER: ". $transfersDateOfTransfer. "\n";

$query ="INSERT INTO Transfers VALUES (null,'$transfersFacilityIN','$transfersFacilityOUT','$transfersVaccineType',$transfersNumberOfVaccines,'$transfersDateOfTransfer');";


$successQuery = mysqli_query($conn, $query);

if(!$successQuery){
    header("Location: ../public/facility/performTransfer.php?insertion=failed&type=Amount"); 
    } else{
        header("Location: ../public/facility/Facility.php?transfer=success");
    }


?>