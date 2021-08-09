<?php
include_once '../config/db.php';

$newType = $_POST['type_of_infection'];
$variantToEdit =$_GET['variantToEdit'];


echo "Variant: " . $newType . "\n";

$query1 = "INSERT INTO Postal_Code  (postal_code, city, province_code) VALUES('$personPostalCode', '$personCity', '$personProvince') 
ON DUPLICATE KEY UPDATE city='$personCity', province_code='$personProvince';";

$query = "UPDATE Infection_Type 
SET type_of_infection='$newType'
WHERE type_of_infection='$variantToEdit';";


mysqli_query($conn, $query);

header("Location: ../public/vaccination/variants/variants.php?edit=success");

?>