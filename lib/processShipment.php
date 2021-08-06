<?php
include_once '../config/db.php';

$shipmentFacility = $_POST['shipmentFacility'];
$shipmentType = $_POST['shipmentType'];
$shipmentQuantity = $_POST['shipmentQuantity'];
$shipmentDate = $_POST['shipmentDate'];


echo "FACILITY = " . $shipmentFacility;
echo "Type = " . $shipmentType;
echo "Quantity = " . $shipmentQuantity;
echo "date = " . $shipmentDate;
$query = "INSERT INTO Shipment VALUES (NULL, '$shipmentType', '$shipmentQuantity', '$shipmentDate', '$shipmentFacility');";

mysqli_query($conn, $query);


header("Location: ../public/facility/Facility.php?shipment=success");

?>