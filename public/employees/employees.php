<?php
include_once '../templates/header.php';
include_once '../../config/db.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>


    <body>
        <div class="container">
            <div class="row top-buffer">
                <div class="col-sm-9"><h1 class="page-title"> <i class="fas fa-user-nurse"></i> Employees</h1></div>
                <div class="col-sm-3" style="text-align: right;">
                  <!--  <a href="../people/insertPerson.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Add</a>  -->
                  <a href="insertEmployee.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Add</a>
                </div>
            </div>
            <div class="row">

            </div>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col-md">SSN</th>
                    <th scope="col-md">EID</th> 
                    <th scope="col-md">First Name</th> 
                    <th scope="col-md">Last Name</th> 
                    <th scope="col-md">Name of Facility Working at</th>
                    <th scope="col-md">Start Date</th>                  
                    <th scope="col-sm">End Date</th>
                    <th scope="col-sm"></th>        
                     <th scope="col-sm"></th>             
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM HealthCare_Worker, Works_At, Person WHERE HealthCare_Worker.SSN = Works_At.SSN AND Person.SSN = HealthCare_Worker.SSN;";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);
      
                if($resultCheck>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr><th scope="row">'.$row['SSN'].'</th>
                        <td>'.$row['EID'].'</td>
                        <td>'.$row['first_name'].'</td>
                        <td>'.$row['last_name'].'</td>
                        <td>'.$row['facility_name'].'</td>
                        <td>'.$row['start_date'].'</td>
                        <td>'.$row['end_date'].'</td>
                        <td><a href="../../lib/processEmployeeDeletion.php?EmployeeToDelete='.$row['SSN'].'" type="button" class="btn btn-danger button-style"><i class="fas fa-user-times"></i></a></td>
                        <td><a href="editEmployee.php?employeeEditSSN='.$row['SSN'].'" type="button" class="btn btn-secondary button-style"><i class="fas fa-user-edit"></i></a></td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>

        </body>
        </div>
</html>