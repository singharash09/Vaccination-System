<?php
include_once '../config/db.php';

$personSSN = $_POST['personSSN'];
$personMedicare = $_POST['personMedicare'];
$personFname = $_POST['personFname'];
$personLname = $_POST['personLname'];
$personDOB = $_POST['personDOB'];

$personEmail = $_POST['personEmail'];
$personPhoneNumber = $_POST['personPhoneNumber'];
$personCitizenship = $_POST['personCitizenship'];
$personAddress = $_POST['personAddress'];
$personCity = $_POST['personCity'];
$personProvince = $_POST['personProvince'];
$personPostalCode= $_POST['personPostalCode'];




$query1 = "INSERT INTO Postal_Code  (postal_code, city, province_code) VALUES('$personPostalCode', '$personCity', '$personProvince') 
ON DUPLICATE KEY UPDATE city='$personCity', province_code='$personProvince';";

$query2 = "UPDATE Person 
SET medicare='$personMedicare', first_name='$personFname', last_name='$personLname', date_of_birth='$personDOB', email_address='$personEmail', telephone_number='$personPhoneNumber', citizenship='$personCitizenship', address='$personAddress', postal_code='$personPostalCode'
WHERE SSN='$personSSN';";


mysqli_query($conn, $query1);
mysqli_query($conn, $query2);

header("Location: ../public/people/people.php?edit=success");

?>