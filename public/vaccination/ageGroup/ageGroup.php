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
                <div class="col-sm-9"><h1 class="page-title"> <i class="bi bi-person-circle"></i> Age Group</h1></div>
                <div class="col-sm-3" style="text-align: right;">
                    <a href="insertAgeGroup.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Add</a>
                </div>
            </div>
            <div class="row">

            </div>
        <div style="height: 600px;overflow: scroll;">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col-md">Group Number</th>
                    <th scope="col-md">Minimum Age</th>
                    <th scope="col-md">Maximum Age</th>
                    <th scope="col-sm"></th>
                    <th scope="col-sm"></th>  
                    <th scope="col-sm"></th>                                         
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT*FROM Age_Group";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);
      
                if($resultCheck>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo '<tr><th scope="row">'.$row['group_id'].'</th>
                        <td>'.$row['min_age'].'</td>
                        <td>'.$row['max_age'].'</td>
                        <td><a href="../../lib/processAgeGroupDeletion.php?ageGroupToDelete='.$row['group_id'].'" type="button" class="btn btn-danger button-style"><i class="fas fa-user-times"></i></a></td>
                        <td><a href="editAgeGroup.php?ageGroupEditID='.$row['group_ID'].'" type="button" class="btn btn-secondary button-style"><i class="fas fa-user-edit"></i></a></td>
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




