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


// echo "SSN: " . $personSSN . "\n";
// echo "medicare: ". $personMedicare . "\n";
// echo "FNAME: " . $personFname . "\n";
// echo "LNAME: " . $personLname . "\n";
// echo "DOB: " . $personDOB . "\n";

// echo "EMAIL: " . $personEmail . "\n";
// echo "PHONE: " . $personPhoneNumber . "\n";
// echo "CITIZENSHIP: " . $personCitizenship . "\n";
// echo "ADDRESS: " . $personAddress . "\n";
// echo "POSTAL CODE: ". $personPostalCode . "\n";


$query1 = "INSERT INTO Postal_Code  (postal_code, city, province_code) VALUES('$personPostalCode', '$personCity', '$personProvince') 
ON DUPLICATE KEY UPDATE city='$personCity', province='$personProvince';";

$query2 = "INSERT INTO Person (SSN, medicare, first_name, last_name, date_of_birth, email_address, telephone_number, citizenship, address, postal_code)
VALUES('$personSSN', '$personMedicare', '$personFname', '$personLname', '$personDOB', '$personEmail', '$personPhoneNumber', '$personCitizenship', '$personAddress', '$personPostalCode');";

mysqli_query($conn, $query1);
mysqli_query($conn, $query2);

header("Location: ../public/people/people.php?insertion=success")

?>