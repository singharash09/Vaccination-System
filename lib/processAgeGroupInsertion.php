<?php
include_once '../config/db.php';

$group_id = $_POST['group_id'];
$min_age = $_POST['min_age'];
$max_age = $_POST['max_age'];

    $query = "INSERT INTO Age_Group (group_id, min_age, max_age)
    VALUES($group_id, $min_age, $max_age);";

   mysqli_query($conn, $query);

    header("Location: ../public/vaccination/ageGroup/ageGroup.php?insertion=success");   




?>