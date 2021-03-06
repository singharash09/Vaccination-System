<?php
include_once '../templates/header.php';
include_once '../../config/db.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="../css/styles.css">
    </head>

    <body>
        <div class="container">
            <div class="row top-buffer">
                <div class="col-sm-9"><h1 class="page-title"> <i class="fas fa-users"></i> People</h1></div>
                <div class="col-sm-3" style="text-align: right;">
                    <a href="insertPerson.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Add</a>
                </div>
            </div>
            <div class="row">

            </div>
        <div style="height: 600px;overflow: scroll;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col-md">SSN</th>
                    <th scope="col-md">Medicare</th>
                    <th scope="col-md">First Name</th>
                    <th scope="col-md">Last Name</th>
                    <th scope="col-md">DOB</th>
                    <th scope="col-md">Citizenship</th>
                    <th scope="col-md">Province</th>
                    <th scope="col-sm"></th>
                    <th scope="col-sm"></th>  
                    <th scope="col-sm"></th>                                         
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT*FROM Person, Postal_Code WHERE Person.postal_code = Postal_Code.postal_code;";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);
      
                if($resultCheck>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr><th scope="row">'.$row['SSN'].'</th>
                        <td>'.$row['medicare'].'</td>
                        <td>'.$row['first_name'].'</td>
                        <td>'.$row['last_name'].'</td>
                        <td>'.$row['date_of_birth'].'</td>
                        <td>'.$row['citizenship'].'</td>
                        <td>'.$row['province_code'].'</td>
                        <td><a href="../../lib/processPersonDeletion.php?personToDelete='.$row['SSN'].'" type="button" class="btn btn-danger button-style"><i class="fas fa-user-times"></i></a></td>
                        <td><a href="editPerson.php?personEditSSN='.$row['SSN'].'" type="button" class="btn btn-secondary button-style"><i class="fas fa-user-edit"></i></a></td>
                        <td><a href="personInfo.php?personInfoSSN='.$row['SSN'].'" type="button" class="btn  btn-warning button-style"><i class="fas fa-info-circle"></i>  </a></td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
        </div>
    </body>
        </div>
</html>




