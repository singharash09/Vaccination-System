<?php
include_once '../templates/header.php';
include_once '../../config/db.php';
?>

<html>
    <head>
        <link rel="stylesheet" href="/public/css/styles.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    </head>

    <body>
        <div class="container">
            <div class="row top-buffer">
                <div class="col-sm-6"><h1 class="page-title"> <i class="fas fa-hospital-alt"></i> Facilities</h1></div>
                <div class="col-sm-6" style="text-align: right;">
                    <a href="insertFacility.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Add facility</a>
                    <a href="receiveShipment.php" type="button" class="btn btn-outline-primary button-style"><i class="fas fa-truck"></i> Receive Shipment</a>                       
                     <a href="performTransfer.php" type="button" class="btn btn-outline-primary button-style"><i class="fas fa-random"></i> Perform Transfer</a>                              
                </div>
            </div>
            <div class="row">

            </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col-md">Facility Name</th>
                    <th scope="col-md">Facility Type</th>
                    <th scope="col-md">Web address</th>
                    <th scope="col-md">Phone Number</th>
                    <th scope="col-md">address</th>
                    <th scope="col-md">Postal Code</th>
                    <th scope="col-sm"></th>
                    <th scope="col-sm"></th>           
                    <th scope="col-sm"></th>                                 
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT*FROM Vaccination_Facility, Postal_Code WHERE Vaccination_Facility.postal_code = Postal_Code.postal_code;";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);
      
                if($resultCheck>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr><th scope="row">'.$row['facility_name'].'</th>                    
                        <td>'.$row['facility_type'].'</td>
                        <td>'.$row['web_address'].'</td>
                        <td>'.$row['phone_number'].'</td>
                        <td>'.$row['address'].'</td>
                        <td>'.$row['postal_code'].'</td>
                        <td><a href="../../lib/processFacilityDeletion.php?facilityToDelete='.$row['facility_name'].'" type="button" class="btn btn-danger button-style"><i class="fas fa-times"></i></a></td>
                        <td><a href="editFacility.php?facilityEditName='.$row['facility_name'].'" type="button" class="btn btn-secondary button-style"><i class="fas fa-edit"></i></a></td>
                        <td><a href="viewInventory.php?facilityInventoryName='.$row['facility_name'].'" type="button" class="btn btn-outline-primary button-style"><i class="fas fa-box-open"></i></a></td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
        </div>
</html>