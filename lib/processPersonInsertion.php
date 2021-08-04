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
$personPostalCode= $_POST['personPostalCode'];


echo "SSN: " . $personSSN . "\n";
echo "medicare: ". $personMedicare . "\n";
echo "FNAME: " . $personFname . "\n";
echo "LNAME: " . $personLname . "\n";
echo "DOB: " . $personDOB . "\n";

echo "EMAIL: " . $personEmail . "\n";
echo "PHONE: " . $personPhoneNumber . "\n";
echo "CITIZENSHIP: " . $personCitizenship . "\n";
echo "ADDRESS: " . $personAddress . "\n";
echo "POSTAL CODE: ". $personPostalCode . "\n";



$query = "INSERT INTO Person (SSN, medicare, first_name, last_name, date_of_birth, email_address, telephone_number, citizenship, address, postal_code)
VALUES('$personSSN', '$personMedicare', '$personFname', '$personLname', '$personDOB', '$personEmail', '$personPhoneNumber', '$personCitizenship', '$personAddress', '$personPostalCode');";
mysqli_query($conn, $query);

header("Location: ../public/people.php?insertion=success")

?>