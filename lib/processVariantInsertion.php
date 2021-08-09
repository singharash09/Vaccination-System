<?php
include_once '../config/db.php';

$type_of_infection = $_POST['type_of_infection'];

$query ="INSERT INTO Infection_Type VALUES ('$type_of_infection');";

mysqli_query($conn, $query);

header("Location: ../public/vaccination/variants/variants.php?transfer=success");

?>
