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
$employeeInput = $_POST['employeeInput'];
$employeeFacility = $_POST['employeeFacility'];
$employeeStartDate = $_POST['employeeStartDate'];

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
// echo "employee eid: ".$employeeEID."\n";
// echo "employee facility: ".$employeeFacility."\n";
// echo "employee start date: ".$employeeStartDate."\n";

if(empty($_POST['employeeInput']) ||  empty($_POST['employeeFacility']) || empty($_POST['employeeStartDate'])){

    echo "inside the empty emloyee";
    $query1 = "INSERT INTO Postal_Code  (postal_code, city, province_code) VALUES('$personPostalCode', '$personCity', '$personProvince') 
    ON DUPLICATE KEY UPDATE city='$personCity', province_code='$personProvince';";
    
    $query2 = "INSERT INTO Person (SSN, medicare, first_name, last_name, date_of_birth, email_address, telephone_number, citizenship, address, postal_code)
    VALUES('$personSSN', '$personMedicare', '$personFname', '$personLname', '$personDOB', '$personEmail', '$personPhoneNumber', '$personCitizenship', '$personAddress', '$personPostalCode');";
    
    mysqli_query($conn, $query1);
    $successQuery = mysqli_query($conn, $query2);

    if(!$successQuery){
        header("Location: ../public/people/insertPerson.php?insertion=failed");
    }else{
        header("Location: ../public/people/people.php?insertion=success");
    }

} else{
    $query1 = "INSERT INTO Postal_Code  (postal_code, city, province_code) VALUES('$personPostalCode', '$personCity', '$personProvince') 
    ON DUPLICATE KEY UPDATE city='$personCity', province_code='$personProvince';";
    
    $query2 = "INSERT INTO Person (SSN, medicare, first_name, last_name, date_of_birth, email_address, telephone_number, citizenship, address, postal_code)
    VALUES('$personSSN', '$personMedicare', '$personFname', '$personLname', '$personDOB', '$personEmail', '$personPhoneNumber', '$personCitizenship', '$personAddress', '$personPostalCode');";
 
    $query3 = "INSERT INTO HealthCare_Worker VALUES ('$personSSN', '$employeeInput');";

    $query4 = "INSERT INTO Works_At VALUES('$personSSN', '$employeeFacility','$employeeStartDate', NULL);";

    echo "inside the non empty employee";

    mysqli_query($conn, $query1);
    $successQuery2 = mysqli_query($conn, $query2); 
    $successQuery3 = mysqli_query($conn, $query3);
    $successQuery4 = mysqli_query($conn, $query4);
    if(!$successQuery2 ||  !$successQuery3 ||  !$successQuery4){
        header("Location: ../public/people/insertPerson.php?insertion=failed");
    }else{
        header("Location: ../public/people/people.php?insertion=success");
    }
}
?>