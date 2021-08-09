<?php
include_once '../config/db.php';

$province_code = $_POST['province_code'];
$eligible_group_id = $_POST['eligible_group_id'];

$query ="INSERT INTO Province VALUES ('$province_code', $eligible_group_id);";

mysqli_query($conn, $query);

header("Location: ../public/vaccination/province/province.php?transfer=success");

?>