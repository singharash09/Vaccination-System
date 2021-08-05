<?php
include_once '../templates/header.php';
include_once '../../config/db.php';
?>


<html>
    <head>

    </head>

    <body>
        <div class="container">
            <div class="row">
                <h2 class="modify-page-title">
                  <?php
                    if(isset($_GET['facilityInventoryName'])){
                        $facilityInventory = $_GET['facilityInventoryName'];
                    }
                    echo $facilityInventory
                    ?>'s Inventory 
                </h2>
            </div>
            

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col-md">Vaccine Type</th>
                    <th scope="col-md">Number</th>                               
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT  type_name, number_of_vaccines FROM Inventory WHERE facility_name='$facilityInventory';";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);
      
                if($resultCheck>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr><th scope="row">'.$row['type_name'].'</th>                    
                        <td>'.$row['number_of_vaccines'].'</td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>

        </div>