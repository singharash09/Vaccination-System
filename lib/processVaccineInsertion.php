<?php
include_once '../config/db.php';

$type_name = $_POST['type_name'];
$status = $_POST['status'];
$date_of_approval = $_POST['date_of_approval'];
$date_of_suspension = $_POST['date_of_suspension'];

$date_of_suspension = !empty($date_of_suspension) ? "'$date_of_suspension'" : "NULL";

$query ="INSERT INTO Vaccine_Type VALUES ('$type_name', '$status', '$date_of_approval', $date_of_suspension);";

mysqli_query($conn, $query);

header("Location: ../public/vaccination/vaccine/vaccine.php?insertion=success");

?>