<?php
include_once '../config/db.php';

$group_id = $_POST['group_id'];
$min_age = $_POST['min_age'];
$max_age = $_POST['max_age'];


$query = "UPDATE Age_Group 
SET  min_age=$min_age, max_age=$max_age
WHERE group_id=$group_id;";



mysqli_query($conn, $query);

header("Location: ../public/vaccination/ageGroup/ageGroup.php?edit=success");

?>