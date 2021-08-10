<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="../../css/styles.css">
    </head>

    <body>
        <div class="container">
            <div class="row top-buffer">
                <div class="col-sm-9"><h1 class="page-title"> <i class="fas fa-disease"></i> Infections</h1></div>
                <div class="col-sm-3" style="text-align: right;">
                    <a href="insertInfection.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Add</a>
                </div>
            </div>
            <div class="row">

            </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col-md">SSN</th>
                    <th scope="col-md">Date Of Infection</th>
                    <th scope="col-md">Variant</th>                   
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT*FROM Infection ORDER BY SSN;";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);
      
                if($resultCheck>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo 
                        '<tr><th scope="row">'.$row['SSN'].'</th>
                        <td>'.$row['date_of_infection'].'</td>
                        <td>'.$row['type_of_infection'].'</td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
        </div>
</html>