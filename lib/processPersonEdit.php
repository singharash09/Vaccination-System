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

$query = "UPDATE Person 
SET medicare='$personMedicare', first_name='$personFname', last_name='$personLname', date_of_birth='$personDOB', email_address='$personEmail', telephone_number='$personPhoneNumber', citizenship='$personCitizenship', address='$personAddress', postal_code='$personPostalCode'
WHERE SSN='$personSSN';";

if(!mysqli_query($conn, $query)){
    echo mysqli_error($conn);
}else{
    echo "good";
}


header("Location: ../public/people.php?edit=success");

?>