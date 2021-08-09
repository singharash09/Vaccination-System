<?php
include_once '../config/db.php';

if(isset($_GET['provinceToDelete'])){
    $provinceToDelete = $_GET['provinceToDelete'];

    $query = "DELETE FROM Province WHERE province_code='$provinceToDelete';";
    mysqli_query($conn, $query);
    
    header("Location: ../public/vaccination/province/province.php?deletion=success");
}
?>