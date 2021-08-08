<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="../../css/styles.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>

    <body>
        <div class="container">
            <div class="row top-buffer">
                <div class="col-sm-9"><h1 class="page-title"> <i class="fas fa-users"></i> Vaccinations</h1></div>
                <div class="col-sm-3" style="text-align: right;">
                    <a href="insertVaccination.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Perform Vaccination</a>
                </div>
            </div>
            <div class="row">

            </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col-md">Vaccination ID</th>
                    <th scope="col-md">SSN</th>
                    <th scope="col-md">Employe SSN</th>
                    <th scope="col-md">Facility Name</th>
                    <th scope="col-md">Type Name</th>
                    <th scope="col-md">Dose Number</th>
                    <th scope="col-md">Date Of Vaccination</th>              
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT*FROM Vaccination";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);
      
                if($resultCheck>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr><th scope="row">'.$row['vaccination_id'].'</th>
                        <td>'.$row['SSN'].'</td>
                        <td>'.$row['Employee_SSN'].'</td>
                        <td>'.$row['facility_name'].'</td>
                        <td>'.$row['type_name'].'</td>
                        <td>'.$row['dose_number'].'</td>
                        <td>'.$row['date_of_vaccination'].'</td>
                        <td><a href="../../../lib/processVaccinationDeletion.php?vaccinationToDelete='.$row['vaccination_id'].'" type="button" class="btn btn-danger button-style"><i class="fas fa-user-times"></i></a></td>
                        <td><a href="editVaccination.php?vaccinationToEdit='.$row['vaccination_id'].'" type="button" class="btn btn-secondary button-style"><i class="fas fa-user-edit"></i></a></td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
        </div>
</html>




