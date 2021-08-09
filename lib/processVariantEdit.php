<?php
include_once '../config/db.php';

$newType = $_POST['type_of_infection'];
$variantToEdit =$_GET['variantToEdit'];

echo "Variant: " . $newType . "\n";

$query = "UPDATE Infection_Type 
SET type_of_infection='$newType'
WHERE type_of_infection='$variantToEdit';";


mysqli_query($conn, $query);

header("Location: ../public/vaccination/variants/variants.php?edit=success");

?>
