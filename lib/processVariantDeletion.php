<?php
include_once '../config/db.php';

if(isset($_GET['variantToDelete'])){
    $variantToDelete = $_GET['variantToDelete'];
    echo $variantToDelete;
    $query = "DELETE FROM Infection_Type WHERE type_of_infection='$variantToDelete';";
    mysqli_query($conn, $query);
    
    header("Location: ../public/vaccination/variants/variants.php?deletion=success");
}



?>